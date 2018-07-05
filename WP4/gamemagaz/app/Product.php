<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function categorie()
    {
        return $this->belongsTo('App\Categorie');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
