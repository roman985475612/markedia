<?php

namespace App\Models;

use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Post extends Model
{
    use HasFactory;

    use Sluggable;

    const UPLOAD_FOLDER = 'public/uploads/';

    const UPLOAD_URL = '/storage/uploads/';

    protected $fillable = ['title', 'description', 'content', 'category_id'];

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
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    public function getThumbnail()
    {
        if (is_null($this->thumbnail)) {
            return self::UPLOAD_URL . 'no-image.png';
        } else {
            if (substr($this->thumbnail, 0, 4) == 'http') {
                return $this->thumbnail;
            } else {
                return self::UPLOAD_URL . $this->thumbnail;
            }
        }
    }

    public function uploadFile($file)
    {
        $this->removeFile();
        $this->thumbnail = self::filename($file);
        $this->save();
    }

    public static function filename($file)
    {
        $filename = date('Y-m-d') . '/' . md5_file($file) . '.' . $file->extension();

        $file->storeAs(self::UPLOAD_FOLDER, $filename);

        return $filename;
    }

    public function removeFile()
    {           
        if (!is_null($this->thumbnail)) {
            Storage::delete(self::UPLOAD_FOLDER . $this->thumbnail);
        }
    }

    public function remove()
    {
        $this->removeFile();
        return $this->delete();
    }

    public function getTagsTitle()
    {
        return $this->tags->pluck('title')->all();
    }

    public function getTags()
    {
        return json_encode($this->tags->pluck('id')->all());
    }

    public function setTags($tags_list)
    {
        $this->tags()->sync($tags_list);
    }

    public function getDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)
            ->format('d F, Y');
    }

    public function increaseViewCount()
    {
        $this->views += 1;
        $this->update();
    }

    public static function findBySlug($slug)
    {
        return static::where('slug', $slug)->firstOrFail();
    }

    public static function getPopular($count = 3)
    {
        $key = "popular_posts";
        if (Cache::has($key)) {
            $value = Cache::get($key);
        } else {
            $value = static::orderBy('views', 'desc')->take($count)->get();
            Cache::put($key, $value, 60);
        }
        return $value;
    }

    public static function getRecent($count = 3)
    {
        $key = "recent_posts";
        if (Cache::has($key)) {
            $value = Cache::get($key);
        } else {
            $value = static::orderBy('updated_at', 'desc')->take($count)->get();
            Cache::put($key, $value, 60);
        }
        return $value;
    }

    public static function findByTitle($s, $page = 2)
    {
        return static::where('title', 'LIKE', "%{$s}%")->with('category')->paginate($page);
    }

    public function hasPrev()
    {
        return static::where('id', '<', $this->id)->max('id');
    }

    public function hasNext()
    {
        return static::where('id', '>', $this->id)->min('id');
    }

    public function hasComments()
    {
        return $this->comments()->count() > 0;
    }

    public function countComments()
    {
        return $this->comments()->count();
    }

    public function getComments()
    {
        return $this->comments()->where('status', Comment::ALLOW)->get();
    }
}
