<?php

namespace App\Models;

use CodeIgniter\Model;

class VoteModel extends Model
{
    protected $table = 'Vote';
    protected $primaryKey = 'vote_id';
    protected $allowedFields = ['thread_id', 'user_id'];


    public function countVotesForThread($thread_id)
    {
        return $this->where('thread_id', $thread_id)
        ->countAllResults();
    }

    public function getLikeForThread($thread_id, $user_id)
    {
        return $this->where('thread_id', $thread_id)
        ->where('user_id', $user_id)
        ->first();
    }

    public function addLike($thread_id, $user_id)
    {
        $data = [
            'thread_id' => $thread_id,
            'user_id' => $user_id,
        ];

        return $this->insert($data);
    }
    
    public function dislike() {
        
    }
  
}
