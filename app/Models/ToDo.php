<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    protected $table = 'to_do';

    protected $fillable = [
        'name',
        'description',
        'date_time',
        'status_id',
        'category_id',
        'user_id',
    ];

    public function category()
    {
        return $this->hasOne(ToDoCategory::class, 'id', 'category_id');
    }

    public function status()
    {
        return $this->hasOne(ToDoStatus::class, 'id', 'status_id');
    }
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

}
