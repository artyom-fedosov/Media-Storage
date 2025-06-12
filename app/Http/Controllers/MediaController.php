<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::where('owner', auth()->user()->login)->get(); // Implement logic to show only available media
        return view('media.index', compact('media')); // create media.index
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
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
        $media = Media::create([
            'name' => $request->name,
            'owner' => Auth::id(),
            'type' => $type,
            'route' => $path,
            'description' => $request->description
        ]);


        if ($request->filled('keywords')) {
            $keywords = explode(',', $request->keywords);
            foreach ($keywords as $word) {
                $word = trim($word);
                if ($word) {
                    $keyword = Keyword::firstOrCreate(['name' => $word]);
                    $media->keywords()->attach($keyword->id);
                }
            }
        }


        return redirect()->route('media.index')->with('success', __('Media created successfully.'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $media = Media::find($id);
        return view('media.show', compact('media'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $media = Media::find($id);
        return view('media.edit', compact('media'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'keywords' => ['nullable', 'string'],
        ]);
        $media = Media::find($id);
        $media->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        $media->keywords()->detach();

        if ($request->filled('keywords')) {
            $keywords = explode(',', $request->keywords);
            foreach ($keywords as $word) {
                $word = trim($word);
                if ($word) {
                    $keyword = Keyword::firstOrCreate(['name' => $word]);
                    $media->keywords()->attach($keyword->id);
                }
            }
        }
        return redirect()->route('media.show', $media->uuid)
            ->with('success', __('Media updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Media $medium) //?????
    {
        if($medium->owner !== Auth::id()){
            abort(403, __('Not authorized to view media'));
        }
        $path = $medium->route;
        if(!Storage::disk('private')->exists($path)){
            abort(404, __("Media not found"));
        }
        Storage::disk('private')->delete($path);
        $medium->delete();
        return redirect()->route('media.index')->with('success', __('Media deleted successfully.'));
    }

    public function preview(string $id){
        $media = Media::where('uuid', $id)->firstOrFail();

        if($media->owner !== Auth::id()){
            abort(403, __("Not authorized to view media"));
        }
        $path = $media->route;
        if(!Storage::disk('private')->exists($path)){
            abort(404, __("Media not found"));
        }

        return response()->file(Storage::disk('private')->path($path));

    }

    public function download(string $id){
        $media = Media::where('uuid', $id)->firstOrFail();

        if($media->owner !== Auth::id()){
            abort(403, __("Not authorized to view media"));
        }
        $path = $media->route;
        if(!Storage::disk('private')->exists($path)){
            abort(404, __("Media not found"));
        }

        return response()->download(Storage::disk('private')->path($path));

    }

}
