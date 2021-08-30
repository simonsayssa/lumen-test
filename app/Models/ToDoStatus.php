<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ToDoStatus extends Model
{
    protected $table = 'to_do_status';
    protected $timestamp = false;
    protected $fillable = [
        'id',
        'name',
    ];
}
