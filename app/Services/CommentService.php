<?php
namespace App\Services;
use App\Repositories\Comments\CommentRepo;
use App\Comment;
use JWTAuth;
use App\Http\Requests\CommentRequest;

class CommentService{
    protected $comment;

    public function __construct(CommentRepo $comment)
    {
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->comment = $comment;
        
    }
    public function all(){
        return $this->user->comments()->limit(5)->get();
    }
    
    public function create(CommentRequest $request)
    {
        $params = $request->only('title', 'content');
        $comment = new Comment();
        $comment->title = $params['title'];
        $comment->content = $params['content'];
        return $result = $this->user->comments()->save($comment);
    }
    public function show($id){
        return $this->user->comments()->findOrFail($id);
    }
}