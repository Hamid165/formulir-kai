<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FormCctv\FormCctvController;
use App\Http\Controllers\FormPencabutanHakAksesController;
use App\Http\Controllers\FormCctv\MasterCctvController;
use App\Http\Controllers\FormCctv\MasterSignerController;

Route::get('/', function () {
    $totalKategori = 1; // Dummy untuk saat ini
    $totalJenisFormulir = 2; // Baru ada CCTV dan Pencabutan Hak Akses
    
    $totalFormulirBulanIni = \App\Models\FormCctv\FormCctv::whereMonth('created_at', date('m'))
                                ->whereYear('created_at', date('Y'))
                                ->count() + \App\Models\FormPencabutanHakAkses::whereMonth('created_at', date('m'))
                                ->whereYear('created_at', date('Y'))
                                ->count();
                                
    $totalPengguna = 2; // Dummy: Pitra, Hamid (sebelum ada auth)

    $recentForms = collect()
        ->concat(\App\Models\FormCctv\FormCctv::latest()->take(5)->get()->map(function($item) {
            $item->type = 'CCTV';
            $item->route = route('form-cctv.show', $item->id);
            $item->title = "Pemeliharaan CCTV - {$item->id_cctv}";
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

use App\Http\Controllers\FormTemplateController;

Route::put('/formulir/template/{id}', [FormTemplateController::class, 'update'])->name('formulir.template.update');

Route::get('/formulir', function (\Illuminate\Http\Request $request) {
    $kategori = $request->query('kategori', 'All');
    
    $templates = \App\Models\FormTemplate::all();
    
    $formulirs = collect();
    foreach ($templates as $template) {
        $total = 0;
        if ($template->nama === 'Pemeliharaan CCTV') {
            $total = \App\Models\FormCctv\FormCctv::count();
        } elseif ($template->nama === 'Permohonan Pencabutan Hak Akses') {
            $total = \App\Models\FormPencabutanHakAkses::count();
        }
        
        $formulirs->push([
            'id' => $template->id,
            'nama' => $template->nama,
            'kategori' => $template->kategori,
            'route' => route($template->route_name),
            'total' => $total,
            'no_dokumen' => $template->no_dokumen,
            'tanggal_dokumen' => $template->tanggal_dokumen,
            'versi_dokumen' => $template->versi_dokumen
        ]);
    }

    if ($kategori !== 'All') {
        $formulirs = $formulirs->where('kategori', $kategori);
    }

    $perPage = 10;
    $currentPage = \Illuminate\Pagination\Paginator::resolveCurrentPage() ?: 1;
    $currentItems = $formulirs->slice(($currentPage - 1) * $perPage, $perPage)->all();
    
    $paginated = new \Illuminate\Pagination\LengthAwarePaginator(
        $currentItems, 
        $formulirs->count(), 
        $perPage, 
        $currentPage, 
        ['path' => \Illuminate\Pagination\Paginator::resolveCurrentPath()]
    );
    $paginated->appends(['kategori' => $kategori]);

    return view('formulir', [
        'formulirs' => $paginated,
        'activeTab' => $kategori
    ]);
})->name('formulir.index');

Route::get('form-cctv/create-v2', [FormCctvController::class, 'createV2'])->name('form-cctv.create-v2');
Route::post('form-cctv/parse-excel', [FormCctvController::class, 'parseExcel'])->name('form-cctv.parse-excel');
Route::get('form-cctv/template-items', [FormCctvController::class, 'downloadTemplateItems'])->name('form-cctv.template-items');
Route::resource('form-cctv', FormCctvController::class);

Route::resource('form-pencabutan-hak-akses', FormPencabutanHakAksesController::class);

Route::post('master-cctv/import', [MasterCctvController::class, 'import'])->name('master-cctv.import');
Route::get('master-cctv/template', [MasterCctvController::class, 'downloadTemplate'])->name('master-cctv.template');
Route::resource('master-cctv', MasterCctvController::class)->only(['store', 'update', 'destroy']);

Route::resource('master-signer', MasterSignerController::class)->only(['store', 'update', 'destroy']);
