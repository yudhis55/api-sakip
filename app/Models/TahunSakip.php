<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TahunSakip extends Model
{
    use HasFactory;

    protected $table = 'tahun_sakip';

    protected $fillable = [
        'id_periode',
        'tahun',
    ];

    protected $casts = [
        'tahun' => 'integer',
    ];

    /**
     * Get the periode that owns this tahun
     */
    public function periode()
    {
        return $this->belongsTo(PeriodeSakip::class, 'id_periode');
    }

    /**
     * Get all Renja documents for this tahun
     */
    public function renjas()
    {
        return $this->hasMany(Renja::class, 'id_tahun');
    }

    /**
     * Get all Perjanjian Kinerja documents for this tahun
     */
    public function perjanjianKinerjas()
    {
        return $this->hasMany(PerjanjianKinerja::class, 'id_tahun');
    }

    /**
     * Get all Rencana Aksi documents for this tahun
     */
    public function rencanaAksis()
    {
        return $this->hasMany(RencanaAksi::class, 'id_tahun');
    }

    /**
     * Get all LPPD documents for this tahun
     */
    public function lppds()
    {
        return $this->hasMany(Lppd::class, 'id_tahun');
    }

    /**
     * Get all LKJIP documents for this tahun
     */
    public function lkjips()
    {
        return $this->hasMany(Lkjip::class, 'id_tahun');
    }
}
