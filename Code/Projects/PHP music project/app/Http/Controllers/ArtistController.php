<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;

class ArtistController extends Controller
{
    public function index()
    {
        $artists = Artist::all();
        return view('lists.artists', compact('artists'));
    }

    public function create()
    {
        return view('create.artist');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'name' => 'required|string|max:255',
        'year' => 'required|integer|min:1900|max:' . date('Y'),
        'description' => 'nullable|string|max:1000',
        'image' => 'required|image',
]);

        $validated['starting_year'] = $validated['year']; 
        unset($validated['year']);

        $validated['image_path'] = $request->file('image')->store('artists', 'public');
        unset($validated['image']);

        Artist::create($validated);

        return redirect()->route('artist-list')->with('success', 'Artist created successfully!');
    }

    public function show($id)
    {
        $artist = Artist::with('albums')->findOrFail($id);

        return view('info.artist', compact('artist'));
    }

    public function destroy($id)
    {
        $artist = Artist::findOrFail($id);

        $artist->albums()->each(function ($album) 
        {
            $album->delete();
        });
        $artist->delete();

        return redirect()->route('artist-list')->with('success', 'Album deleted successfully!');
    }
}
