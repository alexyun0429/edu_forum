<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\ThreadModel;
use App\Models\VoteModel;
use App\Models\CourseModel;

class Forum extends BaseController
{
    public function index($course_name, $course_code)
    {
        $session = session();
        $user_id = $session->get('user_id');
        
        $Usermodel = new UserModel();
        $courseModel = new CourseModel();
        $voteModel = new VoteModel();
        $threadModel = new ThreadModel();
        
        $user = $Usermodel->find($user_id);
        $data['user'] = $Usermodel->get_user_data($user_id);
        $course_id = $courseModel->findCourseIdByCode($course_code);
        $threads = $threadModel->findThreadsForCourse($course_id);
        // $threads = $threadModel->getThreadsForCourseByPage($course_id, 1, 2);
    
        foreach ($threads as &$thread) {
            $thread['vote_count'] = $voteModel->countVotesForThread($thread['thread_id']);
            $thread['tag_name'] = $thread['tag'];
        }

        $tag = $this->request->getGet('tag');
        
        if ($tag) {
            $threads = array_filter($threads, function($thread) use ($tag) {
                return $thread['tag_name'] === $tag;
            });
        }
        
        if (isset($_GET['sort']) && $_GET['sort'] == 'most_liked') {
            $threads = array_filter($threads, function($thread) {
                return $thread['vote_count'] > 0;
            });
            usort($threads, function($a, $b) {
                return ($a['vote_count'] > $b['vote_count']) ? -1 : 1;
            });
        } else {
            usort($threads, function($a, $b) {
                $aTimestamp = $a['updated_at'] ?? $a['created_at'];
                $bTimestamp = $b['updated_at'] ?? $b['created_at'];
                return ($aTimestamp > $bTimestamp) ? -1 : 1;
            });
        }

        $allThreads = $threadModel->findAll();

        $availableTags = [
            "General",
            "Lecture",
            "Practical",
            "Assignment",
            "Most Liked"
        ];

        foreach ($allThreads as $eachThread) {
            $availableTags[] = $eachThread['title'];
            $availableTags[] = $eachThread['content'];
        }

        $availableTags = array_unique($availableTags);
        sort($availableTags);

        $data = [
            'user_id'          => $user_id,
            'username'         => $session->get('username'),
            'course_name'      => $course_name,
            'course_code'      => $course_code,
            'profilePicture'   => $user['profile_picture'],
            'threads'          => $threads,
            'allThreads'       => $allThreads,
            'availableTags'    => $availableTags,
            // 'threadss'         => $this->threadModel->paginate(8),
            // 'pager'            => $this->threadModel->pager
        ];

        $verified = $user['is_email_verified'];

        // var_dump($verified);
        if ($verified == TRUE)
        {
            echo view('template/header', $data);
            echo view('forum/forum', $data);
            echo view('template/footer', $data);
        }
        else
        {
            $session->setFlashdata('error', 'Email needs to be verified.'); 
            return redirect()->to(base_url().'/dashboard');
        }
    }

    public function thread($course_code, $thread_id)
    {
        $session = session();
        $user_id = $session->get('user_id');
        
        $Usermodel = new UserModel();
        $user = $Usermodel->find($user_id);
        $data['user'] = $Usermodel->get_user_data($user_id);

        $courseModel = new CourseModel();
        $course_id = $courseModel->findCourseIdByCode($course_code);

        $threadModel = new ThreadModel();
        $voteModel = new VoteModel();
        $threads = $threadModel->findThreadsForCourse($course_id);

        foreach ($threads as &$thread) {
            $thread['vote_count'] = $voteModel->countVotesForThread($thread['thread_id']);
            $thread['tag_name'] = $thread['tag'];
        }

        $data = [
            'user_id'          => $user_id,
            'username'         => $session->get('username'),
            'course_name'      => $course_name,
            'course_code'      => $course_code,
            'profilePicture'   => $user['profile_picture'],
            'threads'          => $threads
        ];
        $threadModel = new ThreadModel();
        $thread = $threadModel->find($thread_id);

        return view('forum/thread', ['thread' => $thread]);
    }

    public function load_more_threads($course_code, $page) {
        $per_page = 5;
        $offset = ($page - 1) * $per_page;
        $courseModel = new CourseModel();
        $course = $courseModel->findCourseByCode($course_code);
        $course_id = $course->course_id;
        $threads = (new ThreadModel())->getThreadsForCourseByPage($course_id, $page, $per_page);
       
        // Add tag_name and vote_count properties to each thread
        $voteModel = new VoteModel();
        foreach ($threads as &$thread) {
        $thread['vote_count'] = $voteModel->countVotesForThread($thread['thread_id']);
        $thread['tag_name'] = $thread['tag'];
        }
       
        echo json_encode($threads);
       }
    
   
}