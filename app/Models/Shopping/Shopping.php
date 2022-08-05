<?php

namespace App\Models\Shopping;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shopping extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'shopping';

    protected $fillable = [
        'name',
        'created_at',
    ];
}
