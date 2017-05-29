<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Http\Requests\CommentRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;

/**
 * Class CommentsCotroller
 * @package App\Http\Controllers
 */
class CommentsController extends Controller
{
    /**
     * @var Comments
     */
    protected $comments;

    /**
     * CommentsCotroller constructor.
     * @param $comments
     */
    public function __construct(Comments $comments)
    {
        $this->comments = $comments;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $comments = $this->comments->with('user','article')->orderBy('article_id','sec')->get();
        return view('comment.index',compact('comments'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comments = $this->comments->find($id);
        return view('comment.show', compact('comments'));
    }

    public function update(Request $request,$id)
    {
        $comments = $this->comments->find($id);
        $data =$request->all();
        $comments->update($data);
        return redirect()->action('CommentsController@show',$id);

    }
    public function edit($id)
    {
        $comments = $this->comments->find($id);
        return view('comment.edit', compact('comments'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tags = $this->comments->find($id);
        $tags->delete();
        return redirect()->action('CommentsController@index');

    }


    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getArticleComments($id)
    {
        $data =$this->comments->where('article_id',$id)->with('user')->get();
        return response()->json($data);
    }

    /**
     * @param CommentRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function addComments(CommentRequest $request)
    {
       $data = $request->all();
       $rs = $this->comments->create($data);
       $json =['status'=>1,'data'=>$rs];
           return response()->json($json);
    }

}
