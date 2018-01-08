<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "category";
    public $primaryKey = "cat_id";

    public function parent()
    {
      return $this->belongsTo("App\Category", "parent_of_category");
    }

    public function child()
    {
      return $this->hasMany("App\Category", "parent_of_category", "cat_id");
    }

    public function blog()
    {
      return $this->hasMany("App\Blog", "cat_id");
    }
}
