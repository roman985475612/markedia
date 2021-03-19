<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

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
    public function sluggable(): array
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
    
    public static function getPopular($count = 7)
    {
        $key = "cats{$count}";
        
        if (Cache::has($key)) {
            $value = Cache::get($key);
        } else {
            $value = static::withCount('posts')
                ->orderBy('posts_count', 'desc')
                ->take($count)
                ->get();
            Cache::put($key, $value, 60);
        }

        return $value;
    }

}
