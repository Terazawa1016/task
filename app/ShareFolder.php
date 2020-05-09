<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShareFolder extends Model
{
    protected $fillable = [
        'title', 'updated_at',
    ];
    public function shareTask()
    {
      return $this->hasMany('App\ShareTask');
    }

}
