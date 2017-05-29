<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class IndexController extends Controller
{
    protected $article;
    protected $category;

    /**
     * IndexController constructor.
     * @param $article
     * @param $category
     */
    public function __construct(Article $article,Category $category)
    {
        $this->article = $article;
        $this->category = $category;
    }

    /**
     * 搜索文章
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(Request $request)
    {
        $rules = [
            'q'=>'required|min:2',
        ];
        $data = [
            'q.required'=>"请输入要搜索的内容",
            'q.min'=>"搜索的内容不少于两个字符",
        ];
        $this->validate($request,$rules,$data);
        $q = $request->get('q');
        $category_id = "0";
        $article =$this->article->with('category','tags')->orderby('id','sec')->where('title','like','%'.$q.'%')->get();
        $count = $article->count();
        return view('index.blog',compact('article','count','category_id'));

    }

    /**
     * 显示首页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $category_id = "0";
        $article = Cache::remember('article', 10, function() {
            return $this->article->with('category','tags','comments')->orderby('id','sec')->get();
        });
        return view('index.blog',compact('article','category_id'));
    }
    /**
     * 显示列表页
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function category($category_id)
    {
        $category_id_array = $this->category->category_id_and_son($category_id);
        $article =$this->article->whereIn('category_id',$category_id_array)->orderby('id','sec')->with('category','tags')->get();
        return view('index.blog',compact('article','category_id'));
    }

    /**
     * 显示文章详细
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {

        $article = $this->article->with('category','tags','comments','comments.user')->find($id);
        $commentData = $article->comments->sortByDesc('id');
        $commentDataArray = $commentData->toArray();
        $comments = $this->getTree($commentDataArray,'id','parent_id');
        $cateTree = $this->category->cateCrumbs($article);
        return view('index.show',compact('article','cateTree','comments'));

    }
    /**
     * @param array $data
     * @param $field_id
     * @param $field_pid
     * @param int $pid
     * @return array
     */
    public function getTree(array $data, $field_id, $field_pid, $pid = 0) {
        $arr = array();
        foreach ($data as $v) {
            if ($v[$field_pid] == $pid) {
                $v['children'] = self::getTree($data, $field_id, $field_pid, $v[$field_id]);
                if($v['children'] == null){
                    unset($v['children']);
                }
                $arr[] = $v;
            }
        }
        return $arr;
    }
    /**
     *文章访问数自增
     */
    public function count($id)
    {
        $article = $this->article->find($id);
        $article->increment('count');
    }
}
