<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class produk extends Model
{
    use HasUuids;
    protected $table = 'produks';
    protected $fillable = [
        ''
    ];
}
