<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plancategory extends Model {
    protected $table = "plan_category";
    protected $guarded = [];

    public function cated()
    {
        return $this->belongsTo('App\Models\Plans','cat_id');
    }    
    public function scated()
    {
        return $this->belongsTo('App\Models\Plans','cat_id');
    }
}
