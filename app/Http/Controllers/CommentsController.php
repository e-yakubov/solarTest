<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Repositories\CommentsRepository;
use Illuminate\Http\Request;

class CommentsController extends Controller
{

    private $commentsRepo;

    public function __construct(Comment $comment)
    {
        $this->commentsRepo = new CommentsRepository($comment);
    }


    public function index()
    {
        $comments =  $this->commentsRepo->withReplies();
        return view('welcome', ['comments' => $comments]);
    }

    public function create(Request $request)
    {
        return $this->commentsRepo->create($request->all());
    }

    public function update($id, Request $request)
    {
        return $this->commentsRepo->update($id, $request->all());
    }

    public function delete($id)
    {
        return $this->commentsRepo->delete($id);
    }

    public function show($id){
        return $this->commentsRepo->getById($id);
    }
}
