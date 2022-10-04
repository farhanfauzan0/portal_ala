<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    function index($type = null)
    {
        if (!empty($type)) {
            $data = DB::table('front_produk')->where('type', $type)->get();
            // dd($data);
            return view('produk.index', ['data' => $data, 'type' => $type]);
        } else {
            return redirect()->route('/');
        }
    }
    function insert(Request $request)
    {
        if ($request->hasFile('file')) {
            $allow = ['jpg', 'png', 'jpeg'];
            $files = $request->file('file');
            $extension = $files->getClientOriginalExtension();
            $filenames = $files->getClientOriginalName();

            $filename = pathinfo($filenames, PATHINFO_FILENAME) . '~' . date('ymdhis') . '.' . $extension;
            $folders = date('Y') . '/' . date('m') . '/' . date('d') . '/ALA/' . 'produk';
            $checkex = in_array($extension, $allow);

            if ($checkex) {
                $files->move(public_path('uploads/' . $folders), $filename);
                DB::table('front_produk')->insert([
                    'foto' => 'uploads/' . $folders . '/' . $filename,
                    'nama' => $request->nama,
                    'type' => $request->type,
                    'created_at' => Carbon::now()
                ]);
            } else {
                return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Periksa kembali data yang diinput', 'icon_a' => 'error']);
            }
        } else {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Periksa kembali data yang diinput', 'icon_a' => 'error']);
        }

        return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'Produk berhasil disimpan', 'icon_a' => 'success']);
        // return view('produk.index');
    }
    function edit(Request $request)
    {
        $data = DB::table('front_produk')->whereid($request->id)->first();
        return response()->json($data);
    }
    function update(Request $request)
    {
        if ($request->hasFile('file')) {
            $allow = ['jpg', 'png', 'jpeg'];
            $files = $request->file('file');
            $extension = $files->getClientOriginalExtension();
            $filenames = $files->getClientOriginalName();

            $filename = pathinfo($filenames, PATHINFO_FILENAME) . '~' . date('ymdhis') . '.' . $extension;
            $folders = date('Y') . '/' . date('m') . '/' . date('d') . '/ALA/' . 'produk';
            $checkex = in_array($extension, $allow);

            if ($checkex) {
                $files->move(public_path('uploads/' . $folders), $filename);
                DB::table('front_produk')->whereid($request->id)->update([
                    'foto' =>  'uploads/' . $folders . '/' . $filename,
                ]);
            } else {
                return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Periksa kembali data yang diinput', 'icon_a' => 'error']);
            }
        }
        DB::table('front_produk')->whereid($request->id)->update([
            'nama' => $request->nama,
            'updated_at' => Carbon::now()
        ]);
        return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'Produk berhasil dirubah', 'icon_a' => 'success']);
    }

    function delete(Request $request)
    {
        DB::table('front_produk')->whereid($request->id)->delete();
        return response()->json(['mysweet' => true, 'title' => 'Sukses', 'text' => 'Produk berhasil dihapus', 'icon' => 'success']);
    }
}
