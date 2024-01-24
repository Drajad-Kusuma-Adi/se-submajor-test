<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class borrows extends Model
{
    use HasFactory;

    protected $table = 'borrows';

    public $timestamps = false;

    protected $fillable = [
        'student_id',
        'book_id'
    ];
}
