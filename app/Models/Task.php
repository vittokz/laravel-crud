<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Empleado;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'due_date', 'status','empleado_id'];

    public function empleado()
    {
      return $this->belongsTo(Empleado::class);
    }

    public static function laratables()
    {
        return [
            'title',
            'description',
            'due_date',
            'status',
            'empleado_id'
        ];
    }

}
