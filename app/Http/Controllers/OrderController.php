<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{
    function index()
    {
        $data = DB::table('portal_order')->get();
        $datapesanan = DB::table('portal_master_pesanan')->get();
        $datastatus = DB::table('portal_master_status')->get();
        $datadeadline = DB::table('portal_master_deadline')->get();
        return view('order.index', ['data' => $data, 'datapesanan' => $datapesanan, 'datastatus' => $datastatus, 'datadeadline' => $datadeadline]);
    }

    function insert(Request $request)
    {
        $valids = Validator::make($request->all(), [
            "pemesan" => "required",
            "pesanan" => "required",
            "jumlah_pesanan" => "required",
            "status" => "required",
            "deadline" => "required",
            "omset" => "required"
        ]);

        if ($valids->fails()) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput, periksa kembali data anda!', 'icon_a' => 'error']);
        }

        try {
            DB::table('portal_order')->insert([
                'pemesan' => $request->pemesan,
                'pesanan' => $request->pesanan,
                'jumlah_pesanan' => $request->jumlah_pesanan,
                'status' => $request->status,
                'deadline' => $request->deadline,
                'omset' => $request->omset,
                'created_at' => Carbon::now()
            ]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil diinput!', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput!', 'icon_a' => 'error']);
        }
    }

    function edit(Request $request)
    {
        $data = DB::table('portal_order')->whereid($request->id)->first();
        return response()->json($data);
    }

    function update(Request $request)
    {
        $valids = Validator::make($request->all(), [
            "pemesan" => "required",
            "pesanan" => "required",
            "jumlah_pesanan" => "required",
            "status" => "required",
            "deadline" => "required",
            "omset" => "required"
        ]);

        if ($valids->fails()) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diedit, periksa kembali data anda!', 'icon_a' => 'error']);
        }
        try {
            DB::table('portal_order')->whereid($request->id)->update([
                'pemesan' => $request->pemesan,
                'pesanan' => $request->pesanan,
                'jumlah_pesanan' => $request->jumlah_pesanan,
                'status' => $request->status,
                'deadline' => $request->deadline,
                'omset' => $request->omset,
                'created_at' => Carbon::now()
            ]);
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil diedit!', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diedit!', 'icon_a' => 'error']);
        }
    }

    function delete(Request $request)
    {
        try {
            DB::table('portal_order')->whereid($request->id)->delete();
            return response()->json(['mysweet' => true, 'title' => 'Berhasil', 'text' => 'Data berhasil dihapus.', 'icon' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['mysweet' => true, 'title' => 'Gagal', 'text' => 'Data gagal dihapus!', 'icon' => 'error']);
        }
    }
}
