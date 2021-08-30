<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDoCategory extends Model
{
    protected $table = 'to_do_category';

    protected $fillable = [
        'id',
        'name',
    ];
}
