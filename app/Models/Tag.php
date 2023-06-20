<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use function Pest\Laravel\post;

class Tag extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function post()
    {
        return $this->belongsToMany(Post::class);
    }
}
