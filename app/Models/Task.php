<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tbl_tasks';

    protected $primaryKey = 'taskID';

    protected $fillable = [
        'projectID', 'title', 'description', 'status', 'priority', 'due_date', 'position'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function project()
    {
        return $this->belongsTo(Project:: class, 'projectID', 'projectID');
    }

    public function isOverDue()
    {
        if (!$this->due_date || $this->status === 'done') {
            return false;
        }

        return $this->due_date->isPast();
    }

    public function getPriorityColor()
    {
        return match($this->priority){
            'low' => 'bg-gray-100 text-gray-800',
            'medium' => 'bg-yellow-100 text-yellow-800',
            'high' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }

    public function getStatusColor()
    {
        return match($this->status) {
            'todo' => 'bg-blue-100 text-blue-800',
            'in_progress' => 'bg-purple-100 text-purple-800',
            'done' => 'bg-green-100 text-green-800',
            default => 'bg-gray-100 text-gray-800',
        };
    }
}
