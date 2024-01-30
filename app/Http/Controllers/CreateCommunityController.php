<?php

namespace App\Http\Controllers;

use App\Models\AdminCommunity;
use App\Models\comment;
use App\Models\Community;
use App\Models\forum;
use App\Models\joins;
use App\Models\Kategori;
use App\Models\kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateCommunityController extends Controller
{
    public function create()
    {
        $kategori = Kategori::all();
        return view('layouts.createcommunity', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_komunitas' => 'required',
            'image_komunitas' => 'required|image|mimes:jpeg,png,jpg,svg|max:5048',
            'description_komunitas' => 'required|max:255',
            'id_kategori' => 'required',
        ]);

        $newFotoName = 'images/community/' . Auth::user()->name . '-' . $request->input('nama_komunitas') . '.' . $request->image_komunitas->getClientOriginalExtension();
        $request->image_komunitas->move(public_path('images/community'), $newFotoName);

        $prefix = Auth::user()->KEY;
        $maxId = Community::where('id_komunitas', 'like', $prefix . '%')->max('id_komunitas');

        // Jika tidak ada nilai maksimum (tabel kosong atau belum ada dengan awalan tersebut), mulai dari 1
        if (!$maxId) {
            $nextNumber = 1;
        } else {
            $twoDigitLast = substr($maxId, -2);
            $lastTwoDigits = (int)$twoDigitLast;
            $nextNumber = $lastTwoDigits + 1;
            $nextNumber = $nextNumber > 99 ? 1 : $nextNumber;
        }

        $nextNumberString = str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        $id_komunitas = $prefix . '_' . $nextNumberString;

        $komunitas = Community::create([
            'id_komunitas' => $id_komunitas,
            'nama_komunitas' => $request->input('nama_komunitas'),
            'KEY' => Auth::user()->KEY,
            'image_komunitas' => $newFotoName,
            'description_komunitas' => $request->input('description_komunitas'),
            'id_kategori' => $request->input('id_kategori'),
        ]);

        $user = Auth::user();

        if ($user->KEY !== 'SUPER') {
            User::where('id', $user->id)->update(['role' => 'admin_group']);
            return redirect()->route('dashboard')->with('success', 'User role updated.');
        } else {
            return redirect()->route('dashboard')->with('error', 'Cannot change user role with SUPER key.');
        }

        // return redirect()->route('community');
    }

    public function join(Request $request, $id)
    {
        $komunitass = Community::where('id_komunitas', $id)->first();
        return view('layouts.komunitas.event', compact('komunitass'));
    }

    public function joinS($id)
    {
        $komunitass = Community::where('id_komunitas', $id)->first();

        joins::create([
            'id_komunitas' => $id,
            'email' => Auth::user()->email,
            'KEY' => Auth::user()->KEY,
        ]);

        return redirect()->route('mycommunity.Event', ['id_komunitas' => $komunitass->id_komunitas]);
    }

    public function mycommunity()
    {
        $user = Auth::user();
        $komunitas = $user->komunitas;

        return view('layouts/mycommunity', compact('komunitas'));
    }

    public function event(Request $request, $id)
    {
        $komunitass = Community::where('id_komunitas', $id)->first();
        $events = kegiatan::all();

        return view('layouts.komunitas.event', compact('komunitass', 'events'));
    }

    public function galery(Request $request, $id)
    {
        $komunitass = Community::where('id_komunitas', $id)->first();
        return view('layouts.komunitas.galery', compact('komunitass'));
    }

    public function forum(Request $request, $id)
    {
        $komunitass = Community::findOrFail($id);
        $comment = forum::where('id_komunitas', $id)->get();
        return view('layouts.komunitas.forum', compact('komunitass', 'comment'));
    }

    public function forumAdd(Request $request, $id_komunitas)
    {
        $request->validate([
            'content' => 'required',
        ]);

        $community = Community::findOrFail($id_komunitas);
        $comment = new forum();
        $comment->id_komunitas = $community->id_komunitas;
        $comment->KEY = auth::user()->KEY;
        $comment->comment = $request->content;
        $comment->save();

        return redirect()->back()->with('success', 'Comment added successfully');
    }

    public function edit($id_komunitas)
    {
        $komunitass = Community::find($id_komunitas);

        if (!$komunitass) {
            return redirect()->back()->with('error', 'Community not found.');
        }

        return view('layouts.komunitas.edit', compact('komunitass'));
    }

    public function update(Request $request, $id_komunitas)
    {
        $request->validate([
            'new_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'new_name' => 'sometimes|required|string|max:255',
            'description_komunitas' => 'sometimes|required|string|max:255',
        ]);

        $community = Community::findOrFail($id_komunitas);

        if ($request->has('new_name')) {
            $community->nama_komunitas = $request->input('new_name');
        }

        if ($request->has('description_komunitas')) {
            $community->description_komunitas = $request->input('description_komunitas');
        }

        if ($request->hasFile('new_image')) {
            // ...
        }

        $community->save();

        return redirect()->route('mycommunity.Event', ['id_komunitas' => $id_komunitas]);
    }

    public function addevent(Request $request, $id)
    {
        $komunitass = Community::where('id_komunitas', $id)->first();
        return view('layouts.komunitas.addevent', compact('komunitass'));
    }
}
