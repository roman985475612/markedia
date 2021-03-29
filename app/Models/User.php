<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const UPLOAD_FOLDER = 'public/uploads/';
    
    const UPLOAD_URL = '/storage/uploads/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function getDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)
            ->format('d F, Y');
    }

    public function generatePassword($password)
    {
        if ($password != null) {
            $this->password = Hash::make($password);
            $this->save();
        }
        return $this;
    }

    public function getThumbnail()
    {
        if (is_null($this->thumbnail)) {
            return '/storage/' . 'no-image.jpg';
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
        $filename = date('Y-m-d') . '/' . md5_file($file) . '_' . time() . '.' . $file->extension();

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
        $cnt = $this->posts()->count();
        if ($cnt > 0) {
            return false;
        }
        $this->removeFile();
        return $this->delete();
    }

}
