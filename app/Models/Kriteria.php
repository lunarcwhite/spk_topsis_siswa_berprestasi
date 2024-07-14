<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = ['kode_kriteria', 'kriteria', 'bobot'];

    /**
     * Get all of the comments for the Kriteria
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subKriteria(): HasMany
    {
        return $this->hasMany(SubKriteria::class, 'kriteria_id');
    }
}
