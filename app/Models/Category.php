<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public const  CATEGORIES = ['AM', 'A1', 'A2', 'A', 'B1', 'B', 'B+E', 'C', 'C1', 'C1+E', 'C+E', 'D', 'D1', 'D1+E', 'D+E', 'T', 'Tramwaj',];

    public $timestamps = false;
}
