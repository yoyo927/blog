<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
   //每一篇文章都有一個作者
    protected $fillable = ['title', 'content'];
    
    public function user(){
        return $this->belongsTo(related:'App\Models\User');
    }
}
