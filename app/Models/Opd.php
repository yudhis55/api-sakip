<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Opd extends Model
{
    use HasFactory;

    protected $table = 'perangkat_daerah';

    protected $fillable = [
        'name',
        'id_simonev',
        'id_lapdu',
    ];

    /**
     * Get all users belonging to this OPD
     */
    public function user()
    {
        return $this->hasMany(User::class, 'id_perangkat_daerah');
    }

    /**
     * Get all RPJMD documents for this OPD
     */
    public function rpjmd()
    {
        return $this->hasMany(Rpjmd::class, 'id_perangkat_daerah');
    }

    /**
     * Get all Proses Bisnis documents for this OPD
     */
    public function prosesBisni()
    {
        return $this->hasMany(ProsesBisnis::class, 'id_perangkat_daerah');
    }

    /**
     * Get all Pohon Kinerja (Cascading) documents for this OPD
     */
    public function pohonKinerja()
    {
        return $this->hasMany(PohonKinerja::class, 'id_perangkat_daerah');
    }

    /**
     * Get all Renstra documents for this OPD
     */
    public function renstra()
    {
        return $this->hasMany(Renstra::class, 'id_perangkat_daerah');
    }

    /**
     * Get all Renja documents for this OPD
     */
    public function renja()
    {
        return $this->hasMany(Renja::class, 'id_perangkat_daerah');
    }

    /**
     * Get all IKU documents for this OPD
     */
    public function iku()
    {
        return $this->hasMany(Iku::class, 'id_perangkat_daerah');
    }

    /**
     * Get all Perjanjian Kinerja documents for this OPD
     */
    public function perjanjianKinerja()
    {
        return $this->hasMany(PerjanjianKinerja::class, 'id_perangkat_daerah');
    }

    /**
     * Get all Rencana Aksi documents for this OPD
     */
    public function rencanaAksi()
    {
        return $this->hasMany(RencanaAksi::class, 'id_perangkat_daerah');
    }

    /**
     * Get all LPPD documents for this OPD
     */
    public function lppd()
    {
        return $this->hasMany(Lppd::class, 'id_perangkat_daerah');
    }

    /**
     * Get all LKJIP documents for this OPD
     */
    public function lkjip()
    {
        return $this->hasMany(Lkjip::class, 'id_perangkat_daerah');
    }
}
