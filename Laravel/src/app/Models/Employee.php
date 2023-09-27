<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = "employees";
    protected $primaryKey = "emp_id";

    protected $fillable = [
        'name', 'email',
    ];

    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'emp_id');
    }
}
