<?php 

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\DashModel;
  
class Dashboard extends BaseController
{
    public function index()
    {
        $session = session();
        $session->get('isLoggedIn', true);
        $user_id = $session->get('user_id');
        $username = $session->get('username');
    
        $model = new UserModel();
        $enrolled_courses = $model->getEnrolledCourses($user_id);

        $data['user'] = $model->get_user_data($user_id);
        $user = $model->find($user_id);
        

        // Initialize the threads variable to an empty array
        $threads = [];
    
        // Check if the request contains a search query
        $query = $this->request->getGet('query');
        if (!empty($query)) {
            // Retrieve the threads from the database
            $dashModel = new DashModel();
            $threads = $dashModel->searchThreads($query);
        }
    
        $data = [
            'username' => $username,
            'enrolled_courses' => $enrolled_courses,
            'profilePicture' => $user['profile_picture'],
            'threads' => $threads
        ];
    
        echo view('template/header', $data);
        echo view('dashboard/dashboard', $data);
        echo view('template/footer');
    }
    

    public function join()
    {
        $session = session();
        $user_id = $session->get('user_id');

        $model = new UserModel();
        $enrolled_courses = $model->getEnrolledCourses($user_id);
        $data['user'] = $model->get_user_data($user_id);
        $data['user']['enrolled_courses'] = $model->get_user_enrolled_courses($user_id);
        $data['courses'] = $model->get_courses();
        $user = $model->find($user_id);
        $data['profilePicture'] = $user['profile_picture'];

        if ($this->request->getMethod() === 'post') {
            // Get the selected course IDs from the form data
            $selected_courses = $this->request->getPost('course_name');
            
            // Enroll the user in each selected course
            foreach ($selected_courses as $selected_course) {
                if (!empty($selected_course)) {
                    $model->enroll_user_in_course($user_id, $selected_course);
                }
            }
            session()->setFlashdata('success', 'You have successfully enrolled in the selected courses.');
        
            // Redirect back to the join page
            return redirect()->to(base_url().'join_course');
        }
        echo view('template/header', $data);
        echo view('dashboard/join_course', $data);
        echo view('template/footer');
    }

    public function search()
    {
        $query = $this->request->getPost('query');

        $model = new DashModel();
        $threads = $model->searchThreads($query);

        // Check if any threads were found
        if (count($threads) > 0) {
            // Pass the threads to the view
            $data['threads'] = $threads;
            echo view('dashboard/search_results', $data);
        } else {
            // No threads were found, display an alert
            session()->setFlashdata('error', 'No threads were found matching your search query.');
            return redirect()->back();
        }
    }

}