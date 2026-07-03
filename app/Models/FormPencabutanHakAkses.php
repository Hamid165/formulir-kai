<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FormPencabutanHakAkses extends Model
{
    protected $table = 'form_revocations';

    protected $fillable = [
        'no_ref',
        'tanggal',
        'business_area',
        'tanggal_permohonan',
        'nama_pemohon',
        'nip_pemohon',
        'bagian_fungsi',
        'kota_tanggal_pemohon',
        'status_persetujuan',
        'kota_tanggal_setuju',
        'mengetahui_nama',
        'jabatan_mengetahui',
    ];

    public function items()
    {
        return $this->hasMany(FormPencabutanHakAksesItem::class, 'form_revocation_id');
    }
}
