<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $table = 'posts';

    // protected $primaryKey = 'post_id';

    protected $fillable = [
        'title',
        'content',
        'is_admin'
    ];
    

    use SoftDeletes;

    protected $dates = ['deleted_at'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function photos(){
        return $this->morphMany('App\Models\Photo', 'imageable');
    }
}
