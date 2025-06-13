<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Media;
use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class MediaController extends Controller
{
    public function index(Request $request): View|Application|Factory
    {
        $user = auth()->user();
        $ownedMedia = Media::query()->where('owner', $user->login);
        $sharedMedia = $user->media();

        if ($request->filled('keywords')) {
            $keywordIds = $request->input('keywords');
            $ownedMedia->whereHas('keywords', function ($query) use ($keywordIds) {
                $query->whereIn('keywords.id', $keywordIds);
            });
            $sharedMedia->whereHas('keywords', function ($query) use ($keywordIds) {
                $query->whereIn('keywords.id', $keywordIds);
            });
        }

        $media = $ownedMedia->get()->merge($sharedMedia->get())->unique('uuid');

        $allKeywords = Keyword::query()->orderBy('name')->get();
        $selectedKeywords = $request->input('keywords', []);

        return view('media.index', compact('media', 'allKeywords', 'selectedKeywords'));
    }

    public function create(): View|Application|Factory
    {
        return view('media.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'media' => ['required', 'file', 'max:100000'],
            'description' => ['nullable', 'string'],
            'keywords' => ['nullable', 'string'],
        ]);
        $file = $request->file('media');
        $mimeType = $file->getMimeType();
        $parts = explode('/', $mimeType);
        $type = $parts[0];
        $path = $file->store('uploads', 'private');
        $media = Media::query()->create([
            'name' => $request->input('name'),
            'owner' => Auth::id(),
            'type' => $type,
            'route' => $path,
            'description' => $request->input('description')
        ]);

        if ($request->filled('keywords')) {
            $keywords = explode(',', $request->input('keywords'));
            foreach ($keywords as $word) {
                $word = trim($word);
                if ($word) {
                    $keyword = Keyword::query()->firstOrCreate(['name' => $word]);
                    $media->keywords()->attach($keyword->id);
                }
            }
        }

        return redirect()->route('media.index')->with('success', __('Media created successfully.'));
    }

    public function show(string $id): View|Application|Factory
    {
        $media = Media::query()->find($id);
        return view('media.show', compact('media'));
    }

    public function edit(string $id): View|Application|Factory
    {
        $media = Media::query()->find($id);
        return view('media.edit', compact('media'));
    }

    public function update(Request $request, string $id): RedirectResponse
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'keywords' => ['nullable', 'string'],
        ]);
        $media = Media::query()->find($id);
        $media->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
        ]);

        $media->keywords()->detach();

        if ($request->filled('keywords')) {
            $keywords = explode(',', $request->input('keywords'));
            foreach ($keywords as $word) {
                $word = trim($word);
                if ($word) {
                    $keyword = Keyword::query()->firstOrCreate(['name' => $word]);
                    $media->keywords()->attach($keyword->id);
                }
            }
        }
        return redirect()->route('media.show', $media->uuid)
            ->with('success', __('Media updated successfully.'));
    }

    public function pdf(Media $media): BinaryFileResponse
    {
        $originalPath = $media->route;
        $basePath = preg_replace('/\.[^.]+$/', '', $originalPath);
        $pdfPath = $basePath . '.pdf';

        if (!file_exists(Storage::disk('private')->path($pdfPath))) {
            $outputDir = dirname(Storage::disk('private')->path($media->route));
            $escapedPath = escapeshellarg(Storage::disk('private')->path($media->route));
            $escapedOutput = escapeshellarg($outputDir);

            $command = "libreoffice --headless --convert-to pdf $escapedPath --outdir $escapedOutput";
            exec($command, $output, $resultCode);

            if ($resultCode !== 0 || !file_exists(Storage::disk('private')->path($pdfPath))) {
                abort(404, __("Conversion error"));
            }
        }
        return response()->file(Storage::disk('private')->path($pdfPath));
    }

    public function destroy(Media $medium): RedirectResponse
    {
        if($medium->owner !== Auth::id()){
            abort(403, __('Not authorized to view media'));
        }
        $path = $medium->route;
        if(!Storage::disk('private')->exists($path)){
            abort(404, __("Media not found"));
        }

        $mimeType= Storage::disk('private')->mimeType($medium->route);
        if (!hash_equals($mimeType, 'application/pdf' )) {
            $fullPath = Storage::disk('private')->path($path);
            $pdfPath = preg_replace('/\.[^.]+$/', '', $fullPath) . '.pdf';

            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }
        }

        Storage::disk('private')->delete($path);
        $medium->delete();
        return redirect()->route('media.index')->with('success', __('Media deleted successfully.'));
    }

    public function preview(string $id): BinaryFileResponse
    {
        $media = Media::query()->where('uuid', $id)->firstOrFail();

        if($media->owner !== Auth::id()){
            abort(403, __("Not authorized to view media"));
        }
        $path = $media->route;
        if(!Storage::disk('private')->exists($path)){
            abort(404, __("Media not found"));
        }

        if((hash_equals($media->type, 'application'))){
            $mimeType= Storage::disk('private')->mimeType($media->route);
            $unsupported = [
                'application/json',
                'application/xml',
                'application/zip',
                'application/x-rar-compressed',
                'application/x-7z-compressed',
                'application/octet-stream',
                'application/x-msdownload',
                'application/x-java-archive',
                'application/x-bittorrent',
                'application/pkcs7-signature',
                'application/x-httpd-php',
                'application/x-python',
                'application/x-font-ttf'
            ];
            if (hash_equals($mimeType, 'application/pdf' )) {
                return response()->file(Storage::disk('private')->path($path));
            }
            if (in_array($mimeType, $unsupported)) {
                return response()->file(public_path('assets/document.jpg'));
            }
            return $this->pdf($media);
        }

        return response()->file(Storage::disk('private')->path($path));
    }

    public function download(string $id): BinaryFileResponse
    {
        $media = Media::query()->where('uuid', $id)->firstOrFail();

        if($media->owner !== Auth::id()){
            abort(403, __("Not authorized to view media"));
        }
        $path = $media->route;
        if(!Storage::disk('private')->exists($path)){
            abort(404, __("Media not found"));
        }

        return response()->download(Storage::disk('private')->path($path));
    }

    public function share(Request $request, $uuid): RedirectResponse
    {
        $media = Media::query()->where('uuid', $uuid)->firstOrFail();

        if ($media->owner !== auth()->user()->login) {
            abort(403);
        }

        $request->validate([
            'user_login' => 'required|string|exists:users,login',
        ]);

        $userLoginToShare = $request->input('user_login');

        if ($userLoginToShare === auth()->user()->login) {
            return back()->with('share_error', __('You cannot share media with yourself.'));
        }

        $media->sharedUsers()->syncWithoutDetaching([
            $userLoginToShare => ['read' => true, 'write' => false],
        ]);

        return back()->with('share_success', __('Media shared successfully with :user.', ['user' => $userLoginToShare]));
    }
}
