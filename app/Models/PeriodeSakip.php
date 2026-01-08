<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeriodeSakip extends Model
{
    use HasFactory;

    protected $table = 'periode_sakip';

    protected $fillable = [
        'tahun_mulai',
        'tahun_selesai',
        'periode',
    ];

    /**
     * Get all tahun for this periode
     */
    public function tahuns()
    {
        return $this->hasMany(TahunSakip::class, 'id_periode');
    }

    /**
     * Get all RPJMD documents for this periode
     */
    public function rpjmds()
    {
        return $this->hasMany(Rpjmd::class, 'id_periode');
    }

    /**
     * Get all Proses Bisnis documents for this periode
     */
    public function prosesBisnis()
    {
        return $this->hasMany(ProsesBisnis::class, 'id_periode');
    }

    /**
     * Get all Pohon Kinerja documents for this periode
     */
    public function pohonKinerjas()
    {
        return $this->hasMany(PohonKinerja::class, 'id_periode');
    }

    /**
     * Get all Renstra documents for this periode
     */
    public function renstras()
    {
        return $this->hasMany(Renstra::class, 'id_periode');
    }

    /**
     * Get all IKU documents for this periode
     */
    public function ikus()
    {
        return $this->hasMany(Iku::class, 'id_periode');
    }
}
