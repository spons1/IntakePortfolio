<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use App\Models\Album;

class AlbumController extends Controller
{
    public function index()
    {
         $albums = Album::with(['artist', 'user'])->get(); 
        return view('lists.albums', compact('albums'));
    }

    public function create()
    {
        $artists = Artist::all();
        return view('create.album', compact('artists'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'titel' => 'required|string|max:255',
            'release_datum' => 'required|date',
            'genre' => 'required|string|max:255',
            'artist_id' => 'required|exists:artists,id',
            'image' => 'required|image|max:2048',
        ]);
        $validated['cover_path'] = $request->file('image')->store('albums', 'public');

        $validated['user_id'] = auth()->id();
        unset($validated['image']);
        Album::create($validated);

        return redirect()->route('album-list')->with('success', 'Album created successfully!');
    }


    public function show($id)
    {
        $album = Album::with(['artist', 'user'])->findOrFail($id);
        return view('info.album', compact('album'));
    }

    public function destroy($id)
    {
        if (!auth()->check() || !auth()->user()->is_admin) 
        {
            abort(403, 'No permission');
        }
        
        $album = Album::findOrFail($id);
        $album->delete();

        return redirect()->route('album-list')->with('success', 'Album deleted successfully!');
    }

}
