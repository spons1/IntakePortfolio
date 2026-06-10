<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminUserController extends Controller
{
    public function index()
    {
        if (!auth()->user()->is_admin) 
        {
            abort(403, 'Unauthorized.');
        }

        $users = User::all();
        return view('admin.userlist', compact('users'));
    }
    
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        if (!auth()->user()->is_admin) 
        {
            abort(403, 'No permission');
        }

        $user->delete();

        return redirect()->route('admin-userlist')->with('success', 'Review deleted.');
    }
}
