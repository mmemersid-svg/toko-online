<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;


class Kategori extends Model
{
    use HasUuids;
    protected $table = 'kategoris';
    protected $fillable = [
        'kategori',
    ];


    public function produk() {
        return $this->hasMany(produk::class);
    }
}
