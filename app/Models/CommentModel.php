<?php

namespace App\Models;

use CodeIgniter\Model;

class CommentModel extends Model
{
    protected $table = 'Comment';
    protected $primaryKey = 'comment_id';

    public function getCommentsForThread($thread_id)
    {
        $builder = $this->db->table('Comment');
        $builder->select('Comment.*, User.username');
        $builder->join('User', 'Comment.user_id = User.user_id');
        $builder->where('thread_id', $thread_id);
        return $builder->get()->getResult();
    }

    public function getCommentWithUsername($comment_id) {
        $builder = $this->db->table('Comment');
        $builder->select('Comment.*, User.username');
        $builder->join('User', 'Comment.user_id = User.user_id');
        $builder->where('Comment.comment_id', $comment_id);
        $query = $builder->get();
        return $query->getRow();
    }
}