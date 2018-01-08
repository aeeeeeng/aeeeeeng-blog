<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = "blogs";
    public $primaryKey = "blog_id";

    public function category()
    {
      return $this->belongsTo("App\Category", "cat_id");
    }

    public function author()
    {
      return $this->belongsTo("App\Admin", "id");
    }
}
