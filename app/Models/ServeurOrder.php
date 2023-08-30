<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServeurOrder extends Model
{
    use HasFactory;

    public function serveur()
    {
        return $this->belongsTo(Serveur::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
