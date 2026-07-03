<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterCctv;

class MasterCctvController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'id_cctv' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        MasterCctv::create($request->all());

        return back()->with('success', "ID {$request->id_cctv} berhasil ditambahkan.");
    }

    public function update(Request $request, MasterCctv $master_cctv)
    {
        $request->validate([
            'id_cctv' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        $master_cctv->update($request->all());

        return back()->with('success', "ID {$request->id_cctv} berhasil diperbarui.");
    }

    public function destroy(MasterCctv $master_cctv)
    {
        $id_cctv = $master_cctv->id_cctv;
        $master_cctv->delete();
        return back()->with('success', "ID {$id_cctv} berhasil dihapus.");
    }
}
