<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $fillable = ['vendedor_id', 'valor', 'data'];

    public function vendedor()
    {
        return $this->belongsTo(Vendedor::class);
    }

    public function getComissaoAttribute()
    {
        return $this->valor * 0.085;
    }
}
