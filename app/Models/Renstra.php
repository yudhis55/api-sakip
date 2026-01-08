<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Renstra extends Model
{
    use HasFactory;

    protected $table = 'dokumen_renstra';

    protected $fillable = [
        'id_perangkat_daerah',
        'id_periode',
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
     * Get the periode that owns this document
     */
    public function periode()
    {
        return $this->belongsTo(PeriodeSakip::class, 'id_periode');
    }

    /**
     * Get the user who created this document
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
