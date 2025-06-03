<?php

namespace App\Http\Controllers;

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
        request()->validate([]); //
        Media::create([]);
        return redirect()->route('media.index')->with('success', 'Media created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $media = Media::find($id);
        return view('media.show', compact('media')); // create media.show
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //Mb logic to allow search for specific piece
        $media = Media::find($id);
        return view('media.edit', compact('media')); // create media.edit
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //Mb logic to allow search for specific piece
        $media = Media::find($id);
        $media->update([]);
        return view('media.show', compact('media'))->with('success', 'Media updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Media $media)
    {
        $media->delete();
        return redirect()->route('media.index')->with('success', 'Media deleted successfully.');
    }
}
