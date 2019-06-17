<?php namespace App\Repositories\Comments;

interface CommentInterface
{
    public function all();
    
    public function create(array $data);

    public function update($id, array $data);

    public function delete($id);

    public function show($id);
}