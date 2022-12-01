<?php

namespace App\Http\Controllers;

use App\Imports\InvoiceImport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;
use Maatwebsite\Excel\Facades\Excel;

class InvoiceController extends Controller
{
    function index()
    {
        return view('invoice.newinvoice');
    }

    function index_setting()
    {
        $data = DB::table('invoice_param')->get();
        return view('invoice.invoiceset', ['data' => $data]);
    }

    function index_list()
    {
        // DB::raw("SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
        $data = DB::table('invoice')->select('id', 'no_invoice', 'deskripsi', 'qty', 'amount', 'total', 'perusahaan', 'nama_pemesan', 'alamat', 'created_at', 'jenis')->groupBy('no_invoice')->get();
        return view('invoice.listinvoice', ['data' => $data]);
    }

    function detail(Request $request)
    {
        // dd($request->id);
        $data = DB::table('invoice')->select('*')->whereno_invoice($request->id)->get();
        return view('invoice.detailinvoice', ['data' => $data]);
    }

    function setting_post(Request $request)
    {
        if ($request->hasFile('file_header')) {
            $allow = ['jpg', 'png', 'jpeg'];
            $files = $request->file('file_header');
            $extension = $files->getClientOriginalExtension();
            $filenames = $files->getClientOriginalName();

            $filename = pathinfo($filenames, PATHINFO_FILENAME) . '~' . date('ymdhis') . '.' . $extension;
            $folders = date('Y') . '/' . date('m') . '/' . date('d') . '/' . $request->type . '/' . 'header';
            $checkex = in_array($extension, $allow);

            if ($checkex) {
                $files->move(public_path('uploads/' . $folders), $filename);
                DB::table('invoice_param')->wheretype($request->type)->update([
                    'header' =>  'uploads/' . $folders . '/' . $filename,
                ]);
            } else {
                return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Periksa kembali data yang diinput', 'icon_a' => 'error']);
            }
        }

        if ($request->hasFile('file_footer')) {
            $allow = ['jpg', 'png', 'jpeg'];
            $files = $request->file('file_footer');
            $extension = $files->getClientOriginalExtension();
            $filenames = $files->getClientOriginalName();

            $filename = pathinfo($filenames, PATHINFO_FILENAME) . '~' . date('ymdhis') . '.' . $extension;
            $folders = date('Y') . '/' . date('m') . '/' . date('d') . '/' . $request->type . '/' . 'footer';
            $checkex = in_array($extension, $allow);

            if ($checkex) {
                $files->move(public_path('uploads/' . $folders), $filename);
                DB::table('invoice_param')->wheretype($request->type)->update([
                    'footer' =>  'uploads/' . $folders . '/' . $filename,
                ]);
            } else {
                return back()->with(['mysweet' => true, 'title_a' => 'Gagal', 'text_a' => 'Periksa kembali data yang diinput', 'icon_a' => 'error']);
            }
        }


        return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'File berhasil dirubah', 'icon_a' => 'success']);
    }

    function submit_invoice(Request $request)
    {
        // try {
        foreach ($request['deskripsi'] as $key => $value) {
            // dd(str_replace(".", "", $request['total_harga'][$key]));
            DB::table('invoice')->insert([
                'no_invoice' => $request->no_inv,
                'deskripsi' => $request['deskripsi'][$key],
                'qty' => $request['jumlah'][$key],
                'amount' => str_replace(".", "", $request['harga_pcs'][$key]),
                'total' => str_replace(".", "", $request['total_harga'][$key]),
                'jenis' => $request->jenis,
                'nama_pemesan' => $request->nama_pemesan,
                'perusahaan' => $request->perusahaan,
                'alamat' => $request->alamat_pemesan,
                'created_at' => Carbon::now()
            ]);

            DB::table('portal_journal')->insert([
                'code' => 'PRODUKSI',
                'detail' => $request['deskripsi'][$key],
                'debit' => 0,
                'credit' => str_replace(".", "", $request['total_harga'][$key]),
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now()
            ]);
        }
        //     //code...
        // } catch (\Throwable $th) {
        //     //throw $th;
        // }

        return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'Data berhasil diinput', 'icon_a' => 'success']);


        // dd($request->all());
        // $data = DB::table('invoice_param')->wheretype($request->jenis)->first();
        // // return view('invoice.invoicepdf', ['data' => $data]);
        // $pdf = PDF::loadView('invoice.invoicepdf', ['data' => $data, 'request' => $request->all()]);
        // // $pdf->setEncryption('P@ssw0rd');

        // return $pdf->setOptions(['dpi' => 100, 'defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true])->setWarnings(false)->stream('Invoice.pdf');
    }

    function cetak_invoice(Request $request)
    {
        $data_invoice = DB::table('invoice')->whereno_invoice($request->invoice);
        $data_all = DB::table('invoice')->whereno_invoice($request->invoice)->get();
        // dd($data_invoice->get());
        $data = DB::table('invoice_param')->wheretype($data_invoice->first()->jenis)->first();
        // return view('invoice.invoicepdf', ['data' => $data]);
        $pdf = PDF::loadView('invoice.invoicepdfcetak', ['data' => $data, 'request_all' => $data_all, 'data_one' => $data_invoice->first()]);
        // $pdf->setEncryption('P@ssw0rd');

        return $pdf->setOptions(['dpi' => 100, 'defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true])->setWarnings(false)->stream('Invoice.pdf');
    }

    function import_excel(Request $request)
    {
        $noInvoice = "INV/" . date('dm') . "/" . date('yhis');
        $dataImport = Excel::toArray(new InvoiceImport, $request->file('file')->store('files'));

        foreach ($dataImport[0] as $value) {
            DB::table('invoice')->insert([
                'no_invoice' => $noInvoice,
                'deskripsi' => $value['deskripsi'],
                'qty' => $value['qty'],
                'amount' => $value['amount'],
                'total' => $value['total'],
                'jenis' => $request->jenis,
                'nama_pemesan' => $request->nama_pemesan,
                'perusahaan' => $request->perusahaan,
                'alamat' => $request->alamat_pemesan,
                'created_at' => Carbon::now()
            ]);

            DB::table('portal_journal')->insert([
                'code' => 'PRODUKSI',
                'detail' => $value['deskripsi'],
                'debit' => 0,
                'credit' => $value['total'],
                'tanggal' => Carbon::now()->format('Y-m-d'),
                'created_at' => Carbon::now()
            ]);
        }
        // $data = InvoiceImport::class;
        return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'Data berhasil diinput', 'icon_a' => 'success']);
    }

    function delete(Request $request)
    {
        try {
            DB::table('invoice')->whereno_invoice($request->id)->delete();
            return response()->json(['mysweet' => true, 'title' => 'Berhasil', 'text' => 'Data berhasil dihapus.', 'icon' => 'success']);
        } catch (\Throwable $th) {
            return response()->json(['mysweet' => true, 'title' => 'Gagal', 'text' => 'Data gagal dihapus!', 'icon' => 'error']);
        }
    }

    function setting_bank_post(Request $request)
    {
        try {
            DB::table('invoice_param')->wheretype($request->type)->update([
                'nama_rekening' => $request->nama_rekening,
                'nomor_rekening' => $request->nomor_rekening,
                'bank' => $request->bank,
            ]);
            return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'Data berhasil dirubah', 'icon_a' => 'success']);
        } catch (\Throwable $th) {
            return back()->with(['mysweet' => true, 'title_a' => 'Sukses', 'text_a' => 'Data gagal dirubah', 'icon_a' => 'error']);
        }
        dd($request->all());
    }

    public static function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim(InvoiceController::penyebut($nilai));
        } else {
            $hasil = trim(InvoiceController::penyebut($nilai));
        }
        return $hasil;
    }

    function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = InvoiceController::penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = InvoiceController::penyebut($nilai / 10) . " puluh" . InvoiceController::penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . InvoiceController::penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = InvoiceController::penyebut($nilai / 100) . " ratus" . InvoiceController::penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . InvoiceController::penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = InvoiceController::penyebut($nilai / 1000) . " ribu" . InvoiceController::penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = InvoiceController::penyebut($nilai / 1000000) . " juta" . InvoiceController::penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = InvoiceController::penyebut($nilai / 1000000000) . " milyar" . InvoiceController::penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = InvoiceController::penyebut($nilai / 1000000000000) . " trilyun" . InvoiceController::penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }
}
