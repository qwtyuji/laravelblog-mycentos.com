<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['name','keywords','description','pic','pid','status','show_home'];

    /**
     * 返回分类列表
     * @param null $top
     * @return array
     */
    public function cateList($top=null)
    {
        $data = $this->where(['status'=>'1'])->get();
        $keyed = $data->mapWithKeys(function ($item) {
            return [$item['id'] => $item['name']];
        });
        if ($top=="true"){
            $rs =array_merge(['0'=>"顶级分类"],$keyed->all());
        }else{
            $rs = $keyed->all();
        }
        return $rs ;
    }

    /**
     * 返回包含当前分类的子分类的数组
     * @param $category_id
     * @return array
     */
    public function category_id_and_son($category_id)
    {
        $category  = $this->where('pid',$category_id)->get();
        if ($category->count() >0){
            $ids = $category->pluck('id')->all();
            return array_merge([$category_id],$ids);
        }else{
            return [$category_id];
        }
    }

    /**
     * 返回面包屑数组
     * @param $article
     * @return array
     */
    public function cateCrumbs($article)
    {
        $cate['pid'] =$article->category_id;
        $cate['name'] =$article->category->name;
        $cate['id'] =$article->category->id;
        $category_url = [];
        $i = 0;
        while($cate['pid']!=0){
            $i++;
            $cate = $this->get_category_by_category_id($cate['pid']);
            $category_url[$i]['name'] = $cate['name'];
            $category_url[$i]['id'] = $cate['id'];
        }
        krsort($category_url);
        return $category_url;
    }
    public function get_category_by_category_id($id)
    {
        return $this->find($id);
    }
}
