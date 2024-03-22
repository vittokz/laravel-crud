<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Task;

class Empleado extends Model
{
    use HasFactory;

    protected $fillable = ['nombres','apellidos','telefono','email','status'];

    public function tasks(){
        return $this->hasMany(Task::class);
    }
}
