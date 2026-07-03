<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormCctvController;
use App\Http\Controllers\FormPencabutanHakAksesController;

Route::get('/', function () {
    $totalKategori = 1; // Dummy untuk saat ini
    $totalJenisFormulir = 2; // Baru ada CCTV dan Pencabutan Hak Akses
    
    $totalFormulirBulanIni = \App\Models\FormCctv::whereMonth('created_at', date('m'))
                                ->whereYear('created_at', date('Y'))
                                ->count() + \App\Models\FormPencabutanHakAkses::whereMonth('created_at', date('m'))
                                ->whereYear('created_at', date('Y'))
                                ->count();
                                
    $totalPengguna = 2; // Dummy: Pitra, Hamid (sebelum ada auth)

    $recentForms = collect()
        ->concat(\App\Models\FormCctv::latest()->take(5)->get()->map(function($item) {
            $item->type = 'CCTV';
            $item->route = route('form-cctv.show', $item->id);
            $item->title = "Formulir CCTV - {$item->id_cctv}";
            return $item;
        }))
        ->concat(\App\Models\FormPencabutanHakAkses::latest()->take(5)->get()->map(function($item) {
            $item->type = 'Pencabutan Hak Akses';
            $item->route = route('form-pencabutan-hak-akses.show', $item->id);
            $item->title = "Pencabutan Hak Akses - {$item->nama_pemohon}";
            return $item;
        }))
        ->sortByDesc('created_at')
        ->take(5);

    return view('dashboard', compact('totalKategori', 'totalJenisFormulir', 'totalFormulirBulanIni', 'totalPengguna', 'recentForms'));
})->name('dashboard');

Route::get('/formulir', function () {
    return view('formulir');
})->name('formulir.index');

Route::get('form-cctv/create-v2', [FormCctvController::class, 'createV2'])->name('form-cctv.create-v2');
Route::resource('form-cctv', FormCctvController::class);

Route::resource('form-pencabutan-hak-akses', FormPencabutanHakAksesController::class);
