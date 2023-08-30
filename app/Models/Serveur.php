<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Serveur extends Model
{
    use HasFactory;

    public function orders()
    {
        return $this->hasMany(ServeurOrder::class);
    }

    public function servir()
    {
        return $this->hasMany(Servir::class);
    }
}
