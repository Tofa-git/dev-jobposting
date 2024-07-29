<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class verification_code extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'tbl_verification_code';
    protected $primaryKey = 'id';
    protected $guarded = [];
    
}
