<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Project extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $primaryKey =  'project_id';

    protected $fillable = [
        'name', 'emp_id',
    ];

    public function employee(): BelongsTo{
        return $this->belongsTo(Employee::class, 'emp_id', 'project_id');
    }
}
