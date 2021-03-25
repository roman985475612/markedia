<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    const DISALLOW = 0;
    const ALLOW = 1;

    protected $fillable = ['text', 'post_id', 'user_id'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function allow()
    {
        $this->status = Comment::ALLOW;
        $this->save();

        return $this->status;
    }

    public function disAllow()
    {
        $this->status = Comment::DISALLOW;
        $this->save();

        return $this->status;
    }

    public function toggleStatus()
    {
        if ($this->status == Comment::DISALLOW) {
            $this->status = Comment::ALLOW;
        } else {
            $this->status = Comment::DISALLOW;
        }
        $this->save();
        return $this->status;
    }

    public static function newCommentsCount()
    {
        return Comment::where('status', Comment::DISALLOW)->count();
    }

    public function remove()
    {
        $this->delete();
    }

    public function getDate()
    {
        return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)
            ->format('d F, Y');
    }
}
