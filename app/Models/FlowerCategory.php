<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlowerCategory extends Model
{
    use HasFactory;

    public function season(){
        return $this->belongsTo(Season::class,'season_id');
    }
    public function type(){
        return $this->belongsTo(Type::class,'type_id');
    }
}
