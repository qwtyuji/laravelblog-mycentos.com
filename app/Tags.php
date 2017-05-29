<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Tags extends Model
{
    protected $fillable=['name','status'];

    public function tagsList()
    {
        $data = $this->where(['status'=>'T'])->get();
        $keyed = $data->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        return $keyed->all() ;
    }

    public function articles(){
        return $this->belongsToMany(Article::class)->withTimestamps();
    }
}
