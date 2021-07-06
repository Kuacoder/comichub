<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistic extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'day_create','chapter_price'
    ];
    protected $primaryKey = "id_statistical";
    protected $table = "tbl_chapterunlock";
}
