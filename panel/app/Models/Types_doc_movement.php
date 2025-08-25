<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Types_doc_movement extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = 'types_doc_movement';
    protected $primaryKey = 'id';
    protected $keyType = 'integer';
    public $autoincrement = true;
    public $timestamps = true;
    public $guarded = [];
}
