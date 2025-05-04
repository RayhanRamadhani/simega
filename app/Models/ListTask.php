<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\Has;

class ListTask extends Model
{

    use HasFactory;

    protected $fillable = [
        'idtask',
        'listname',
        'date',
        'time',
        'description',
        'isdone'
    ];

    public function task()
    {
        return $this->belongsTo(Task::class, 'idtask');
    }
}
