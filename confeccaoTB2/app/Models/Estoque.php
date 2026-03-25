<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Estoque extends Model
{
    protected $guarded = [];

    public function Produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
