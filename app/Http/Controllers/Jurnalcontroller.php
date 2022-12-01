<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class Jurnalcontroller extends Controller
{
    function index(Request $request)
    {
        if (!empty($request->tanggal_dari) && !empty($request->tanggal_ke)) {
            $data = DB::table('portal_journal')->whereBetween('tanggal', [$request->tanggal_dari, $request->tanggal_ke])->get();
        } else {

            $data = DB::table('portal_journal')->get();
        }
        $datacode = DB::table('portal_master_journal')->get();
        return view('jurnal.index', ['data' => $data, 'datacode' => $datacode]);
    }

    function insert(Request $request)
    {
        $valids = Validator::make($request->all(), [
            "code" => "required",
            "detail" => "required",
            "debit" => "required",
            "credit" => "required",
            "tanggal" => "required",
        ]);

        if ($valids->fails()) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput, periksa kembali data anda!', 'icon_a' => 'error']);
        }

        DB::table('portal_journal')->insert([
            'code' => $request->code,
            'detail' => $request->detail,
            'debit' => str_replace(".", "", $request->debit),
            'credit' => str_replace(".", "", $request->credit),
            'tanggal' => $request->tanggal,
            'created_at' => Carbon::now()
        ]);
        try {
            return back()->with(['mysweet' => true, 'title_a' => 'Berhasil', 'text_a' => 'Data berhasil diinput!', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diinput!', 'icon_a' => 'error']);
        }
    }

    function edit(Request $request)
    {
        $data = DB::table('portal_journal')->whereid($request->id)->first();
        return response()->json($data);
    }

    function update(Request $request)
    {
        $valids = Validator::make($request->all(), [
            "code" => "required",
            "detail" => "required",
            "debit" => "required",
            "credit" => "required",
            "tanggal" => "required",
        ]);

        if ($valids->fails()) {
            return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Data gagal diedit, periksa kembali data anda!', 'icon_a' => 'error']);
        }
        try {
            DB::table('portal_journal')->whereid($request->id)->update([
                'code' => $request->code,
                'detail' => $request->detail,
                'debit' => $request->debit,
                'credit' => $request->credit,
                'tanggal' => $request->tanggal,
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
            DB::table('portal_journal')->whereid($request->id)->delete();
            return response()->json(['mysweet' => true, 'title' => 'Berhasil', 'text' => 'Data berhasil dihapus.', 'icon' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['mysweet' => true, 'title' => 'Gagal', 'text' => 'Data gagal dihapus!', 'icon' => 'error']);
        }
    }
}
