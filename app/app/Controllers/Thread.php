<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ThreadModel;
use App\Models\VoteModel;
use App\Models\CommentModel;
use App\Models\CourseModel;


class Thread extends BaseController
{
    protected $db;
    public function show($thread_id)
    {
        $session = session();

        $user_id = $session->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($user_id);
        $data['user'] = $userModel->get_user_data($user_id);

        $threadModel = new ThreadModel();
        $thread = $threadModel->getThreadWithUsername($thread_id);
        $attachments = $threadModel->getAttachmentsForThread($thread_id);
        $thread['tag_name'] = $thread['tag'];

        $Coursemodel = new CourseModel();
        $course = $Coursemodel->getCourseById($thread['course_id']);
        $course_code = $course->course_code;
        $course_name = $course->course_name;

        $voteModel = new VoteModel();
        $thread['vote_count'] = $voteModel->countVotesForThread($thread['thread_id']);

        $commentModel = new CommentModel();
        $comments = $commentModel->getCommentsForThread($thread_id);
        // $comment = $commentModel->getCommentWithUsername($comment_id);

        $data = [
            'thread'         => $thread,
            'user_id'        => $user_id,
            'username'       => $session->get('username'),
            'profilePicture' => $user['profile_picture'],
            'comments'       => $comments,
            'course_code'    => $course_code,
            'course_name'    => $course_name,
            'attachments' => $attachments,
        ];

        echo view('template/header', $data);
        echo view('thread/thread', $data);
        echo view('template/footer', $data);
    }

    public function add_comment($thread_id)
    {
        $session = session();

        $comment = $this->request->getPost('content');
        // var_dump($comment); 
        // var_dump($thread_id);

        if (empty($comment)) {
            $response = array(
                'success' => false,
                'error' => 'Comment cannot be empty'
            );
        } else {
            $threadModel = new ThreadModel();
            $comment_id = $threadModel->addComment($thread_id, $comment);

            if ($comment_id!== false) {
                $comment = $threadModel->getCommentById($comment_id);
                if ($comment !== null) {
                    $comment['username'] = session()->get('username');
                    $comment['created_at'] = date('Y-m-d H:i:s', strtotime($comment['created_at']));
                    $response = array(
                        'success' => true,
                        'comment' => array(
                            'content' => $comment['content'],
                            'created_at' => $comment['created_at'],
                            'username' => $comment['username']
                        )
                    );
                    return $this->response->setJSON($response);
                } else {
                    $response = array(
                        'success' => false,
                        'error' => 'An error occurred while retrieving the comment'
                    );
                }
            } else {
                $response = array(
                    'success' => false
                );
            }
        }
        return $this->response->setJSON($response);
    }   

    public function add_thread($course_code)
    {
        $session = session();
        $user_id = $session->get('user_id');
        $userModel = new UserModel();
        $user = $userModel->find($user_id);
        $data['user'] = $userModel->get_user_data($user_id);
    
        $courseModel = new CourseModel();
        try {
            $course = $courseModel->findCourseByCode($course_code);
            $course_name = $course->course_name;
        } catch (\Exception $e) {
            return redirect()->back()->to(base_url('forum/'.$course_code.'/thread/add_thread'))->withInput()->with('error', $e->getMessage());
        }
        
        $data = [
            'user_id' => $user_id,
            'username' => $session->get('username'),
            'profilePicture' => $user['profile_picture'],
            'course_code' => $course_code,
            'course_name' => $course_name,
        ];
    
        if ($this->request->getMethod() === 'post') {
            $rules = [
                'title'         => 'required',
                'content'       => 'required',
                'tag'           => 'required',
                'attachments.*' => 'max_size[attachments,1999]|ext_in[attachments,png,jpeg,jpg]',
            ];
    
            if (!$this->validate($rules)) {
                // var_dump($this->validator->getErrors());
                // exit;
                return redirect()->back()->to(base_url('forum/'.$course_code.'/thread/add_thread'))->withInput()->with('error', 'Please fill in all the required fields.');
            }
            
            $title = $this->request->getPost('title');
            $content = $this->request->getPost('content');
            $tag = $this->request->getPost('tag');
            $created_at = date('Y-m-d H:i:s');
            $course_id = $course->course_id;
    
            $attachments = [];

        if ($files = $this->request->getFiles()) {
            foreach ($files['attachments'] as $attachment) {
                if ($attachment->isValid() && !$attachment->hasMoved()) {
                    $newName = $attachment->getRandomName();
                    if ($attachment->move(WRITEPATH . 'uploads/', $newName)) {
                        $attachments[] = [
                            'filename' => basename($attachment->getName()),
                            'filetype' => basename($attachment->getClientMimeType()),
                            'filepath' => base_url('writable/uploads/' . $newName)
                        ];
                    } else {
                        log_message('error', 'File upload error: ' . $attachment->getErrorString());
                    }
                }
            }
        }
        
        $threadModel = new ThreadModel();
        log_message('debug', 'user_id: ' . $user_id);
        if ($thread_id = $threadModel->addThread($title, $content, $created_at, $tag, $user_id, $course_id, $attachments)) {
            log_message('debug', 'Attachment data: ' . print_r($attachments, true));
            return redirect()->to(base_url("forum/$course_name/$course_code"));
        } else {
            return redirect()->back()->to(base_url('forum/'.$course_code.'/thread/add_thread'))->withInput()->with('error', 'Failed to add thread.');
        }
    }
    
        echo view('template/header', $data);
        echo view('thread/add_thread', $data);
        echo view('template/footer');
    }

    public function like($course_code, $thread_id)
    {
        $user_id = session()->get('user_id');

        $voteModel = new VoteModel();
        $like = $voteModel->getLikeForThread($thread_id, $user_id);
        // Log the value of $like to see if it is being set correctly
        log_message('debug', 'Value of $like in like function: ' . print_r($like, true));

        if ($like) {
            $this->removeLike($course_code, $thread_id);
            $new_likes = $voteModel->countVotesForThread($thread_id);
        } else {
            $voteModel->addLike($thread_id, $user_id);
            $new_likes = $voteModel->countVotesForThread($thread_id);
        }

        return $this->response->setJSON([
            'success' => true,
            'likes' => $new_likes,
        ]);
    }

    public function removeLike($course_code, $thread_id)
    {
        $user_id = session()->get('user_id');
    
        $voteModel = new VoteModel();
        $like = $voteModel->getLikeForThread($thread_id, $user_id);
        // var_dump($like);
        // Log the value of $like to see if it is being set correctly
        log_message('debug', 'Value of $like in removeLike function: ' . print_r($like, true));
    
        if ($like) {
            // var_dump($like);
            // print_r($like);
            $voteModel->delete($like);
            $new_likes = $voteModel->countVotesForThread($thread_id);
        } else {
            $new_likes = $voteModel->countVotesForThread($thread_id);
        }
    
        return $this->response->setJSON([
            'success' => true,
            'likes' => $new_likes,
        ]);
    }
}