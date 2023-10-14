<?php

namespace App\Models;

use CodeIgniter\Model;

class ThreadModel extends Model
{
    protected $table = 'Thread';
    protected $primaryKey = 'thread_id';

    public function findThreadsForCourse($course_id)
    {
        $builder = $this->db->table('Thread');
        $builder->where('course_id', $course_id);
        return $builder->get()->getResultArray();
    }

    public function getThreadWithUsername($thread_id) 
    {
        $builder = $this->db->table('Thread');
        $builder->select('Thread.*, User.username');
        $builder->join('User', 'Thread.user_id = User.user_id');
        $builder->where('Thread.thread_id', $thread_id);
        $query = $builder->get();
        return $query->getRowArray();
    }
    
    public function getCommentById($comment_id)
    {
        $builder = $this->db->table('Comment');
        $builder->select('Comment.*, User.username');
        $builder->join('User', 'Comment.user_id = User.user_id');
        $builder->where('Comment.comment_id', $comment_id);
        $query = $builder->get();

        $comment = $query->getRowArray();
        return $comment;
    }

    public function getAttachmentsForThread($thread_id)
    {
        $builder = $this->db->table('Attachment');
        $builder->where('thread_id', $thread_id);
        return $builder->get()->getResultArray();
    }

    public function addComment($thread_id, $comment)
    {
        $data = [
            'thread_id' => $thread_id,
            'content' => $comment,
            'created_at' => date('Y-m-d H:i:s'),
            'user_id' => session()->get('user_id')
        ];

        $this->db->table('Comment')->insert($data);
        return $this->db->insertID();
    }
    
    public function addThread($title, $content, $created_at, $tag, $user_id, $course_id, $attachments)
    {
        $data = [
            'title' => $title,
            'content' => $content,
            'created_at' => $created_at,
            'tag' => $tag,
            'user_id' => $user_id,
            'course_id' => $course_id,
        ];
    
        $this->db->transStart();
    
        if (!$this->db->table('Thread')->insert($data)) {
            exit;
        }
        $thread_id = $this->db->insertID();
        
        if (!empty($attachments)) {
            if (!empty($attachments) && is_array($attachments)) {
                $attachmentData = [];
                foreach ($attachments as $attachment) {
                    $attachmentData[] = [
                        'filename' => $attachment['filename'],
                        'filetype' => $attachment['filetype'],
                        'thread_id' => $thread_id
                    ];
                }
                if (!$this->db->table('Attachment')->insertBatch($attachmentData)) {
                    log_message('error', 'Database error: ' . print_r($this->db->error(), true));
                    // var_dump($this->db->error());
                    exit;
                }
            }
        }
        $this->db->transComplete();
    
        if ($this->db->transStatus() === false) {
            return false;
        }
    
        return $thread_id;
    }

    public function getThreadsForCourseByPage($course_id, $page, $per_page) {
        $offset = ($page - 1) * $per_page;
        $builder = $this->db->table('Thread');
        $builder->where('course_id', $course_id);
        $builder->orderBy('created_at', 'DESC');
        $builder->limit($per_page, $offset);
        return $builder->get()->getResultArray();
    }
    
}
