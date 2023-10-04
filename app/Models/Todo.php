<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Todo extends Model
{
    use SoftDeletes;

    protected $connection = 'mongodb';
    protected $collection = 'todos';

    protected $fillable = ['title', 'description', 'date', 'completed', 'user_id'];

    protected $dates = ['date', 'deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
