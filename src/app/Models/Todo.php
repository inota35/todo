<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Todo extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'catagory_id',
        ];

        public function category()
        {
            return $this->belongTo(Category::class);
        }
}
