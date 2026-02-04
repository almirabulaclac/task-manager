<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $table = 'tbl_projects';

    protected $primaryKey = 'projectID';

    protected $fillable = [
        'userID', 'project_name', 'description', 'color'
    ];

    public function user()
    {
        return $this->belongsTo(User:: class, 'userID', 'userID');
    }

    public function tasks()
    {
        return $this->belongsTo(Task:: class, 'taskID', 'taskID');
    }

    public function getTaskCountByStatus(string $status)
    {
        return $this->tasks()->where('status', $status)->count();
    }

    public function getTotalTasksCount()
    {
        return $this->tasks()->count();
    }

    public function getCompletionPercentage()
    {
        $total = $this->getTotalTasksCount();
        if ($total === 0) return 0;

        $completed = $this->getTaskCountByStatus('dones');
        return round($completed / $total * 100);
    }
}
