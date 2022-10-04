<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MasterController extends Controller
{
    function index()
    {
        $datapesanan = DB::table('portal_master_pesanan')->get();
        $datastatus = DB::table('portal_master_status')->get();
        $datadeadline = DB::table('portal_master_deadline')->get();
        $datajournal = DB::table('portal_master_journal')->get();

        return view('administrator.masterparam', ['datapesanan' => $datapesanan, 'datastatus' => $datastatus, 'datadeadline' => $datadeadline, 'datajournal' => $datajournal]);
    }

    function add_pesanan(Request $request)
    {
        try {
            DB::table('portal_master_pesanan')->insert([
                'name' => $request->pesanan,
                'created_at' => Carbon::now()
            ]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil diinput.', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput!', 'icon_a' => 'error']);
        }
    }
    function add_status(Request $request)
    {
        try {
            DB::table('portal_master_status')->insert([
                'name' => $request->status,
                'created_at' => Carbon::now()
            ]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil diinput.', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput!', 'icon_a' => 'error']);
        }
    }
    function add_deadline(Request $request)
    {
        try {
            DB::table('portal_master_deadline')->insert([
                'tanggal' => $request->deadline,
                'created_at' => Carbon::now()
            ]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil diinput.', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput!', 'icon_a' => 'error']);
        }
    }
    function add_journal(Request $request)
    {
        try {
            DB::table('portal_master_journal')->insert([
                'code' => $request->journal,
                'created_at' => Carbon::now()
            ]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil diinput.', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput!', 'icon_a' => 'error']);
        }
    }

    function edit_pesanan(Request $request)
    {
        $data = DB::table('portal_master_pesanan')->whereid($request->id)->first();
        return response()->json($data);
    }
    function edit_status(Request $request)
    {
        $data = DB::table('portal_master_status')->whereid($request->id)->first();
        return response()->json($data);
    }
    function edit_deadline(Request $request)
    {
        $data = DB::table('portal_master_deadline')->whereid($request->id)->first();
        return response()->json($data);
    }
    function edit_journal(Request $request)
    {
        $data = DB::table('portal_master_journal')->whereid($request->id)->first();
        return response()->json($data);
    }

    function update_pesanan(Request $request)
    {
        try {
            DB::table('portal_master_pesanan')->whereid($request->id)->update(['name' => $request->pesanan]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil dirubah.', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal dirubah!', 'icon_a' => 'error']);
        }
    }
    function update_status(Request $request)
    {
        try {
            DB::table('portal_master_status')->whereid($request->id)->update(['name' => $request->status]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil dirubah.', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal dirubah!', 'icon_a' => 'error']);
        }
    }
    function update_deadline(Request $request)
    {
        try {
            DB::table('portal_master_deadline')->whereid($request->id)->update(['tanggal' => $request->deadline]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil dirubah.', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal dirubah!', 'icon_a' => 'error']);
        }
    }
    function update_journal(Request $request)
    {
        try {
            DB::table('portal_master_journal')->whereid($request->id)->update(['code' => $request->journal]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil dirubah.', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal dirubah!', 'icon_a' => 'error']);
        }
    }

    function delete_pesanan(Request $request)
    {
        try {
            DB::table('portal_master_pesanan')->whereid($request->id)->delete();
            return response()->json(['mysweet' => true, 'title' => 'Berhasil', 'text' => 'Data berhasil dihapus.', 'icon' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['mysweet' => true, 'title' => 'Gagal', 'text' => 'Data gagal dihapus!', 'icon' => 'error']);
        }
    }
    function delete_status(Request $request)
    {
        try {
            DB::table('portal_master_status')->whereid($request->id)->delete();
            return response()->json(['mysweet' => true, 'title' => 'Berhasil', 'text' => 'Data berhasil dihapus.', 'icon' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['mysweet' => true, 'title' => 'Gagal', 'text' => 'Data gagal dihapus!', 'icon' => 'error']);
        }
    }
    function delete_deadline(Request $request)
    {
        try {
            DB::table('portal_master_deadline')->whereid($request->id)->delete();
            return response()->json(['mysweet' => true, 'title' => 'Berhasil', 'text' => 'Data berhasil dihapus.', 'icon' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['mysweet' => true, 'title' => 'Gagal', 'text' => 'Data gagal dihapus!', 'icon' => 'error']);
        }
    }
    function delete_journal(Request $request)
    {
        try {
            DB::table('portal_master_journal')->whereid($request->id)->delete();
            return response()->json(['mysweet' => true, 'title' => 'Berhasil', 'text' => 'Data berhasil dihapus.', 'icon' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['mysweet' => true, 'title' => 'Gagal', 'text' => 'Data gagal dihapus!', 'icon' => 'error']);
        }
    }
}
