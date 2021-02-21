<?php

namespace TeamPro\TranslateScanner\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Translation extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $fillable=[
        'lang',
        'lang_key',
        'lang_value',
      ];
}
