<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Album;
use App\Models\AlbumReview;

class AlbumReviewController extends Controller
{
    public function show($id)
    {
        $album = Album::with(['artist', 'user', 'reviews'])->findOrFail($id);

        return view('info.album', compact('album'));
    }

    public function store(Request $request, $albumId)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'stars' => 'required|integer|min:1|max:5',
        ]);

        AlbumReview::create([
            'user_id' => auth()->id(),
            'album_id' => $albumId,
            'title' => $validated['title'],
            'message' => $validated['message'],
            'stars' => $validated['stars'],
        ]);

        return redirect()->route('album-show', $albumId)->with('success', 'Review added.');
    }

    public function destroy($id)
    {
        $albumreview = AlbumReview::findOrFail($id);

        if ($albumreview->user_id != auth()->id() && !auth()->user()->is_admin) 
        {
            abort(403, 'No permission');
        }

        $albumreview->delete();

        return redirect()->route('album-show', $albumreview->album_id)->with('success', 'Review deleted.');
    }
}
