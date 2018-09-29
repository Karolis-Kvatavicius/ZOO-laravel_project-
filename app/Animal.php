<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    public function species() {
        return $this->belongsTo('App\Species');
    }

    public function manager() {
        return $this->belongsTo('App\Manager');
    }
}
