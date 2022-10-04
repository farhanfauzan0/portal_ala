<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VisimisiController extends Controller
{
    function index($type)
    {
        if (!empty($type)) {
            $data = DB::table('front_visimisi')->wheretype($type)->first();
            return view('visimisi.index', ['data' => $data, 'type' => $type]);
        } else {
            return redirect()->route('/');
        }
    }

    function post(Request $request)
    {
        if (!empty($request->visi)) {
            DB::table('front_visimisi')->wheretype($request->type)->update([
                'visi' => $request->visi
            ]);
        } else {
            DB::table('front_visimisi')->wheretype($request->type)->update([
                'misi' => $request->misi
            ]);
        }

        return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'Visi Misi berhasil disimpan', 'icon_a' => 'success']);
    }
}
