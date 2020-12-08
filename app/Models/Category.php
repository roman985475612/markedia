<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    use Sluggable;

    protected $fillable = ['title'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function remove()
    {
        $cnt = $this->posts()->count();
        if ($cnt > 0) {
            return false;
        }
        $this->delete();
        return true;
    }
}
