<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MinorCategory extends Model
{
    use HasFactory;

    protected $fillable = ['minor_category_name'];
}