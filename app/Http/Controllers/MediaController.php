<?php

namespace App\Http\Controllers;

use App\Models\Keyword;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $media = Media::all(); // Implement logic to show only available media
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
//        request()->validate([
//            'name' => ['required', 'string', 'max:255'],
//            'media' => ['required', 'file', 'max:100000'],
//            'description' => ['nullable', 'string'],
//            'keywords' => ['nullable', 'string'],
//        ]);
//        Media::create([]);
        return redirect()->route('media.index')->with('success', 'Media created successfully.');
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
            ->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Media $media) //?????
    {
        $media->delete();
        return redirect()->route('media.index')->with('success', 'Media deleted successfully.');
    }
}
