<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // protected $guarded = [];

    //post->comments

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function likes(){
        return $this->hasMany(Like::class)->where('isLiked',1);
    }

    public function scopeSearch($query, $value){
        $columns = ['title','description'];

        foreach($columns as $col){
            $query = $query->orWhere($col,'like','%'. $value . '%');
        }

        return $query;

    }

    public function getRouteKeyName()
    {
        return 'title_slug';
    }
}
