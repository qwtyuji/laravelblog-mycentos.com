<?php

namespace App\Http\Controllers;

use App\Article;
use App\Category;
use App\Tags;
use Illuminate\Http\Request;
class ArticleController extends Controller
{
    protected $article;
    protected $category;
    protected $tags;

    /**
     * ArticleController constructor.
     * @param $article
     */
    public function __construct(Article $article, Category $category, Tags $tags)
    {
        $this->article = $article;
        $this->category = $category;
        $this->tags = $tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $article = $this->article->with('category', 'tags')->orderby('id', 'sec')->get();
        return view('article.index', compact('article'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function recycle()
    {
        $article = $this->article->with('category', 'tags')->orderby('id', 'sec')->onlyTrashed()->get();
        return view('article.recycle', compact('article'));
    }
    
    public function restore($id){
        $article = $this->article->withTrashed()->find($id);
        $article->restore();
        return redirect()->action('ArticleController@recycle');
    }

    public function forceDelete($id)
    {
        $article = $this->article->withTrashed()->find($id);
        $article->forceDelete();
        return redirect()->action('ArticleController@recycle');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cateList = $this->category->cateList();
        $tagsList = $this->tags->tagsList();
        return view('article.add', compact('cateList', 'tagsList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $tags = $this->normalizeTags($request->get('tags'));
        $data = $request->all();
        $article = $this->article->create($data);
        $article->tags()->attach($tags);
        return redirect()->action('ArticleController@index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $article = $this->article->with('tags')->find($id);
        return view('index.show', compact('article'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $article = $this->article->with('category', 'tags')->find($id);
        $cateList = $this->category->cateList();
        $tagsList = $this->tags->tagsList();
        return view('article.edit', compact('article', 'cateList', 'tagsList'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Article $article)
    {
        $tags = $this->normalizeTags($request->get('tags'));
        $data = $request->all();
        $article->update($data);
        $article->tags()->detach();
        $article->tags()->attach($tags);
        return redirect()->action('ArticleController@index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Article $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return redirect()->action('ArticleController@index');
    }

    /**
     * @param array|null $tags
     * @return array
     */
    protected function normalizeTags(array $tags = null)
    {
        return collect($tags)->map(function ($tag) {
            if (is_numeric($tag)) {
                return (int)$tag;
            }
            $newTag = $this->tags->create(['name' => $tag]);
            return $newTag->id;
        })->toArray();
    }

}
