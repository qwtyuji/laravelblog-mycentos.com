<?php

namespace App\Http\Controllers;

use App\Article;
use App\Comments;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $article;
    protected $user;
    protected $comment;

    /**
     * HomeController constructor.
     * @param $article
     * @param $user
     * @param $comment
     */
    public function __construct(Article $article,User $user,Comments $comment)
    {
        $this->article = $article;
        $this->user = $user;
        $this->comment = $comment;
    }


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $totalVist = $this->article->sum('count');
        $totalComment =$this->comment->count();
        $totalUser = $this->user->count();
        $article = $this->article->with('category','tags')->orderBy('count','desc')->limit('10')->get();
        return view('home',compact('totalVist','totalComment','totalUser','article'));
    }
}
