<?php

namespace App\Http\Controllers;

use App\Models\kegiatan;
use App\Http\Requests\StorekegiatanRequest;
use App\Http\Requests\UpdatekegiatanRequest;
use App\Models\Community;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function addEvent(Request $request, $id)
    {
        $komunitass = Community::where('id_komunitas', $id)->first();
        $kegiatan = kegiatan::all(); // Adjust model name
        return view('layouts.komunitas.addevent', compact('kegiatan', 'komunitass'));
    }

    public function addEventPost(Request $request, $id_komunitas)
    {
        $request->validate([
            'nama_kegiatan'     => 'required',
            'detail_kegiatan'   => 'required',
            'tgl_kegiatan'      => 'required',
            'jam_kegiatan'      => 'required',
            'slug'              => 'required',
            'gallery'           => 'required|image|mimes:jpeg,png,jpg,svg|max:5048',
        ]);

        // Generate a unique filename
        $filename = Auth::user()->name . '-' . $request->input('nama_kegiatan') . '.' . $request->file('gallery')->getClientOriginalExtension();
        $path = 'images/kegiatan/';

        // Check if file with the same name exists
        if (Storage::disk('public')->exists($path . $filename)) {
            // Handle filename conflict (e.g., add timestamp, random string, etc.)
            $filename = Auth::user()->name . '-' . $request->input('nama_kegiatan') . '_' . time() . '.' . $request->file('gallery')->getClientOriginalExtension();
        }

        // Store the new image in public/images/kegiatan
        $request->file('gallery')->storeAs($path, $filename, 'public');

        // Get the next auto-incremented value for id_kegiatan
        $id_kegiatan = DB::table('kegiatan')->max('id_kegiatan') + 1;
        

        // Create a new Kegiatan instance
        $kegiatan = new Kegiatan([
            'id_komunitas'      => $id_komunitas,
            'id_kegiatan'       => $id_kegiatan,
            'nama_kegiatan'     => $request->input('nama_kegiatan'),
            'detail_kegiatan'   => $request->input('detail_kegiatan'),
            'tgl_kegiatan'      => $request->input('tgl_kegiatan'),
            'jam_kegiatan'      => $request->input('jam_kegiatan'),
            'slug'              => $request->input('slug'),
            'gallery'           => $path . $filename,
        ]);

        // Save the Kegiatan model
        $kegiatan->save();

        return redirect()->route('mycommunity.Event', ['id_komunitas' => $id_komunitas])->with('success', 'Event added successfully');
    }


     public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorekegiatanRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(kegiatan $kegiatan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(kegiatan $kegiatan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatekegiatanRequest $request, kegiatan $kegiatan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(kegiatan $kegiatan)
    {
        //
    }
}
