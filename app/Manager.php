<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    public function animals() {
        return $this->hasMany('App\Animal');
    }

    public function qualification() {
        return $this->belongsTo('App\Species', 'animals_type', 'id');
    }
}
