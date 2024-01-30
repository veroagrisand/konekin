<?php

namespace App\Http\Controllers;

use App\Models\Community;
use App\Models\joins;
use App\Models\kegiatan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Superuser extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return view('SuperUser.SUNavbar');
    // }
    public function Home()
    {
        $User =User::all();
        $kegiatan =kegiatan::all();
        return view('SuperUser.SUhome',compact('User','kegiatan'));
    }
    public function kelola()
    {
        return view('SuperUser.SUkelola');
    }
    public function user()
    {
        $User =User::all();
        return view('SuperUser.SUusers',compact('User'));
    }
    public function kegiatan(Request $request, $id)
    {
        $komunitass = Community::where('id_komunitas', $id)->first();
        $kegiatan = kegiatan::all();

        return view('SuperUser.SUkelolakegiatan', compact('komunitass', 'kegiatan'));
    }
    public function create(Request $request, $id)
    {
        $komunitass = Community::where('id_komunitas', $id)->first();
        $kegiatan = kegiatan::all();

        return view('SuperUser.SUkelolakegiatan', compact('komunitass', 'kegiatan'));
    }


    public function logout()
    {
        Auth::logout();

        return redirect()->route('landing.page')->with('logoutMessage', 'You have been logged out. Please log in again.');
    }
    public function editkomunitas($id_komunitas)
    {
        $komunitass = Community::find($id_komunitas);

        if (!$komunitass) {
            return redirect()->back()->with('error', 'Community not found.');
        }
            return view('SuperUser.Sukelolakomunitas', compact('komunitass'));
    }
    public function updatekomunitas(Request $request, $id_komunitas)
    {
        // Validate the request
        $request->validate([
            'new_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'new_name' => 'sometimes|required|string|max:255',
            'description_komunitas' => 'sometimes|required|string|max:255',
        ]);

        // Find the community
        $community = Community::findOrFail($id_komunitas);

        // Update community information
        if ($request->has('new_name')) {
            $community->nama_komunitas = $request->input('new_name');
        }


        if ($request->has('description_komunitas')) {
            $community->description_komunitas = $request->input('description_komunitas');
        }

        if ($request->hasFile('new_image')) {
            // ... (rest of the code remains unchanged)
        }

        // Save the changes
        $community->save();

        // Redirect to the appropriate page
        return redirect()->route('superuser.kelola');
        // return view('SuperUser.SUkelola');
    }


        public function hapuskomunitas($id_komunitas)
        {
            // Temukan komunitas berdasarkan ID atau sesuaikan dengan cara Anda
            $komunitas = Community::find($id_komunitas);

            // Periksa apakah komunitas ditemukan sebelum mencoba menghapus
            if ($komunitas) {
                // Hapus semua record yang terkait dari tabel joint
                joins::where('id_komunitas', $id_komunitas)->delete();

                // Lakukan penghapusan komunitas
                $komunitas->delete();

                // Redirect atau kembalikan respons sesuai kebutuhan
                return redirect()->route('superuser.kelola')->with('success', 'Komunitas dan joint berhasil dihapus');
            } else {
                // Redirect atau kembalikan respons sesuai kebutuhan jika komunitas tidak ditemukan
                // return redirect()->route('superuser.SUkelola')->with('error', 'Komunitas tidak ditemukan');
            }
        }
    public function editkegiatan($id_komunitas)
    {
        $komunitass = Community::find($id_komunitas);

        if (!$komunitass) {
            return redirect()->back()->with('error', 'Community not found.');
        }
            return view('SuperUser.Sukelolakomunitas', compact('komunitass'));
    }
    public function updatekegiatan(Request $request, $id_komunitas)
    {
        // Validate the request
        $request->validate([
            'new_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'new_name' => 'sometimes|required|string|max:255',
            'description_komunitas' => 'sometimes|required|string|max:255',
        ]);

        // Find the community
        $community = Community::findOrFail($id_komunitas);

        // Update community information
        if ($request->has('new_name')) {
            // Get the prefix from the existing nama_komunitas
            $prefix = strtoupper(substr($request->input('new_name'), 0, 2));

            // Ambil nilai maksimum dari kolom id_komunitas dengan awalan yang sesuai
            $maxId = Community::where('id_komunitas', 'like', $prefix . '%')->max('id_komunitas');

            // Jika tidak ada nilai maksimum (tabel kosong atau belum ada dengan awalan tersebut), mulai dari 1
            $nextNumber = (!$maxId) ? 1 : (intval(substr($maxId, -2)) % 100) + 1;

            // Format nilai berikutnya dengan menambahkan dua huruf di awal
            $id_komunitas = $prefix . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
            $community->id_komunitas = $id_komunitas;

            $id_joint = $community->id_joint;
            $joint = joins::where('id', $id_joint)->first();

            $id = $community->id;
            $kegiatan = kegiatan::where('id', $id)->update(['id_komunitas' => $id_komunitas]);
            $id = $community->id;
            $joint = joins::where('id', $id)->update(['id_komunitas' => $id_komunitas]);

            $community->nama_komunitas = $request->input('new_name');
        }


        if ($request->has('description_komunitas')) {
            $community->description_komunitas = $request->input('description_komunitas');
        }

        if ($request->hasFile('new_image')) {
            // ... (rest of the code remains unchanged)
        }

        // Save the changes
        $community->save();

        // Redirect to the appropriate page
        return redirect()->route('superuser.kelola');
        // return view('SuperUser.SUkelola');
    }


        public function hapuskegiatan($id_komunitas)
        {
            // Temukan komunitas berdasarkan ID atau sesuaikan dengan cara Anda
            $komunitas = Community::find($id_komunitas);

            // Periksa apakah komunitas ditemukan sebelum mencoba menghapus
            if ($komunitas) {
                // Hapus semua record yang terkait dari tabel joint
                joins::where('id_komunitas', $id_komunitas)->delete();

                // Lakukan penghapusan komunitas
                $komunitas->delete();

                // Redirect atau kembalikan respons sesuai kebutuhan
                return redirect()->route('superuser.kelola')->with('success', 'Komunitas dan joint berhasil dihapus');
            } else {
                // Redirect atau kembalikan respons sesuai kebutuhan jika komunitas tidak ditemukan
                // return redirect()->route('superuser.SUkelola')->with('error', 'Komunitas tidak ditemukan');
            }
        }
}
