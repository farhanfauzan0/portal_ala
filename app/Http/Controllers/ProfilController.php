<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    function index($type = null)
    {
        if (!empty($type)) {
            $data = DB::table('front_profil')->where('type', $type)->first();
            return view('profil.index', ['data' => $data, 'type' => $type]);
        } else {
            return redirect()->route('/');
        }
    }

    function update(Request $request)
    {
        DB::table('front_profil')->where('type', $request->type)->update([
            'nama' => $request->nama,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'alamat' => $request->alamat,
            'desc' => $request->desc
        ]);

        return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'Profil berhasil disimpan', 'icon_a' => 'success']);
    }

    function update_foto(Request $request)
    {
        if ($request->hasFile('file')) {
            $allow = ['jpg', 'png', 'jpeg'];
            $files = $request->file('file');
            $extension = $files->getClientOriginalExtension();

            $filename = 'logo-' . $request->type . '.' . $extension;
            $checkex = in_array($extension, $allow);

            if ($checkex) {
                $files->move(public_path('assets/images/'), $filename);
                DB::table('front_profil')->where('type', $request->type)->update([
                    'foto' => 'assets/images/' . $filename,
                ]);
            } else {
                return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Periksa kembali data yang diinput', 'icon_a' => 'error']);
            }
        } else {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Periksa kembali data yang diinput', 'icon_a' => 'error']);
        }

        return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'Profil berhasil disimpan', 'icon_a' => 'success']);
    }
}
