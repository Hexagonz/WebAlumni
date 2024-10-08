<?php

namespace App\Http\Controllers\Admin;  // Pastikan namespace sesuai dengan folder tempat controller ini berada

use App\Http\Controllers\Controller;  // Pastikan juga controller ini extends ke Controller yang benar
use App\Models\Perusahaan;
use Illuminate\Http\Request;

class PerusahaanController extends Controller
{
    public function index()
    {
        // Fetch all companies with status 'diterima'
        $perusahaanDiterima = Perusahaan::where('status', 'diterima')->get();
        // Return view inside the 'admin' folder
        return view('pages.admin.perusahaan-diterima', compact('perusahaanDiterima'));
    }

    public function divalidasi()
    {
        // Fetch all companies with status 'divalidasi'
        $perusahaanDivalidasi = Perusahaan::where('status', 'divalidasi')->get();
        // Return view inside the 'admin' folder
        return view('pages.admin.perusahaan-divalidasi', compact('perusahaanDivalidasi'));
    }

    public function terima($id)
    {
        // Find the company and update its status to 'diterima'
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->status = 'diterima';
        $perusahaan->save();

        // Redirect to the validation page with a success message
        return redirect()->route('perusahaan-diterima')->with('success', 'Perusahaan berhasil diterima');
    }

    public function tolak($id)
    {
        // Find the company and delete it
        $perusahaan = Perusahaan::findOrFail($id);
        $perusahaan->delete();

        // Redirect to the validation page with a success message
        return redirect()->route('admin.perusahaan.divalidasi')->with('success', 'Perusahaan berhasil ditolak');
    }
}
