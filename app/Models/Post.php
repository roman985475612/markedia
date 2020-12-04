<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
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
            return self::UPLOAD_URL . $this->thumbnail;
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

}
