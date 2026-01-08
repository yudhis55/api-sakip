<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerjanjianKinerja extends Model
{
    use HasFactory;

    protected $table = 'dokumen_perjanjian_kinerja';

    protected $fillable = [
        'id_perangkat_daerah',
        'id_tahun',
        'file',
        'keterangan',
        'tanggapan',
        'tgl_publish',
        'status',
        'kategori',
        'id_user',
    ];

    protected $casts = [
        'tgl_publish' => 'date',
        'status' => 'integer',
    ];

    /**
     * Get the OPD that owns this document
     */
    public function opd()
    {
        return $this->belongsTo(Opd::class, 'id_perangkat_daerah');
    }

    /**
     * Get the tahun that owns this document
     */
    public function tahun()
    {
        return $this->belongsTo(TahunSakip::class, 'id_tahun');
    }

    /**
     * Get the user who created this document
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
