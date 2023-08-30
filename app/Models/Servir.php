<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servir extends Model
{
    use HasFactory;

    public function table()
    {
        return $this->belongsTo(Table::class);
    }

    public function orderGroup()
    {
        return $this->belongsTo(OrderGroup::class);
    }
    public function serveur()
    {
        return $this->belongsTo(Serveur::class);
    }
}
