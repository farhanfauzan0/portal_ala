<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

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
        // dd($request->all());
        $data = DB::table('invoice_param')->wheretype($request->jenis)->first();
        // return view('invoice.invoicepdf', ['data' => $data]);
        $pdf = PDF::loadView('invoice.invoicepdf', ['data' => $data, 'request' => $request->all()]);
        // $pdf->setEncryption('P@ssw0rd');

        return $pdf->setOptions(['dpi' => 100, 'defaultFont' => 'sans-serif', 'isHtml5ParserEnabled' => true])->setWarnings(false)->stream('Invoice.pdf');
    }
}
