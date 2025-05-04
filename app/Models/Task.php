<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $primaryKey = 'idtask';

    protected $fillable = [
        'userid',
        'name',
        'deadline',
        'description',
        'status',
        'ispriority',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'userid');
    }

    public function listTasks()
    {
        return $this->hasMany(ListTask::class, 'idtask', 'idtask');
    }
}
