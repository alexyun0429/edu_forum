<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use App\Models\UserModel;
use Mpdf\Mpdf;
use App\ThirdParty\fpdf\fpdf;

class Profile extends BaseController
{

    public function index() 
    {
        $session = session();
        $user_id           = $session->get('user_id');
        $username          = $session->get('username');
        $is_email_verified = $session->get('is_email_verified');
    
        $model = new UserModel();
        $enrolled_courses = $model->getEnrolledCourses($user_id);
    
        // Retrieve the user's data from the database
        $user = $model->find($user_id);
        $data['user'] = $model->get_user_data($user_id);
        $data['profilePicture'] = $user['profile_picture'];
        $data['is_email_verified'] = $user['is_email_verified'];
        $data['is_phone_verified'] = $user['is_phone_verified'];
        
        // Fetch the user's enrolled courses from the database
        $data['user']['enrolled_courses'] = $model->getUserEnrolledCourses_profile($user_id);
    
        echo view('template/header', $data);
        echo view('profile/profile', $data);
        echo view('template/footer');
    }

   

    public function generateProfilePDF()
    {
        $session = session();
        $user_id = $session->get('user_id');

        $model = new UserModel();
        $user = $model->find($user_id);
        $data['user'] = $model->get_user_data($user_id);
        $data['profilePicture'] = $user['profile_picture'];
        $data['is_email_verified'] = $user['is_email_verified'];
        $data['is_phone_verified'] = $user['is_phone_verified'];
        $model = new UserModel();
        $enrolled_courses = $model->getEnrolledCourses($user_id);
        $data['user']['enrolled_courses'] = $model->getUserEnrolledCourses_profile($user_id);
    
        $pdf = new fpdf();

        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);

        $context = 
            "User ID: ". $user_id. "\n".
            "Name: ". $user['username'] . "\n".
            "Email: ".  $user['email'] . "\n".
            "Username: ". $user['username'];

        $pdf->MultiCell( 200, 40, $context, 1);

        $pdf->Output('D', 'ProfilePdf.pdf');
        
    }

    public function edit()
    {
        $session = session();
        $user_id = $session->get('user_id');

        $model = new UserModel();
        $user = $model->find($user_id);
        $data['user'] = $model->get_user_data($user_id);
        $data['user'] = $model->get_user_data($user_id);

        $data['profilePicture'] = $user['profile_picture'];

        // Fetch the user's enrolled courses from the database
        $data['user']['enrolled_courses'] = $model->getUserEnrolledCourses_profile($user_id);

        echo view('template/header', $data);
        echo view('profile/profile_edit', $data);
        echo view('template/footer');
    }

    public function phoneVerify()
    {
        helper(['form']);
        $session = session();
        $user_id = $session->get('user_id');
        $model = new UserModel();
        $user = $model->find($user_id);

        if ($this->request->getPost('phoneVerify') != '123456') {
            return redirect()->to(base_url().'profile')->with('error', 'Incorrect.');
        }

        $model->update_user($user['user_id'], [
            'is_phone_verified' => '1'
        ]);
        return redirect()->to(base_url().'profile')->with('success', 'Phone number verified successfully.');  
    }

    public function upload_picture()
    {
        $session = session();
        $user_id = $session->get('user_id');
        helper(['url']);

        $validation = \Config\Services::validation();
        $validationRules = [
            'profile_picture' => [
                'rules' => 'max_size[profile_picture,1999]|mime_in[profile_picture,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'max_size' => 'The profile picture must not exceed 1MB in size.',
                    'mime_in' => 'The profile picture must be of type jpg, jpeg, gif or png.'
                ]
            ]
        ];

        if  ($this->request->getMethod() == 'post'){
            $image = $this->request->getFile('profile_picture');
            
            if ($image->isValid() && !$image->hasMoved()) {
                if ($validation->setRules($validationRules)->withRequest($this->request)->run()) {
                    $newName = $image->getRandomName();

                    $image->move(WRITEPATH . 'uploads/', $newName);
                    $imageURL = base_url('writable/uploads/'.$newName);

                    $model = new UserModel();
                    $model->updatePicture($user_id, $imageURL);
                
                    $session->setFlashdata('success', 'Profile picture uploaded successfully.');
                    return redirect()->to(base_url().'profile_edit');
                } else{
                    $session->setFlashdata('error', 'Not a valid image file.');
                }
            } else {
                $session->setFlashdata('error', 'Error uploading profile picture.');
            }
        }
        return redirect()->to(base_url().'profile_edit');
            
    }

    public function change_password()
    {
        //include helper form
        helper(['form']);
        $session = session();
        $user_id = $session->get('user_id');
        $model = new UserModel();
        $user = $model->find($user_id);

        $rules = [
            'current_password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Current password is required.'
                ]
            ],
            'new_password' => [
                'rules'  => 'required|min_length[7]|max_length[200]|alpha_numeric_punct|',
                'errors' => [
                    'required' => 'New password is required.',
                    'min_length' => 'New password must be at least 6 characters long.'
                ]
            ],
            'confirm_new_password' => [
                'rules' => 'required|matches[new_password]',
                'errors' => [
                    'required' => 'Confirm new password is required.',
                    'matches' => 'Confirm new password does not match new password.',
                ]
            ]
        ];

        if ($this->validate($rules)) {
            if (!$model->verify_password($user_id, $this->request->getPost('current_password'))) {
                return redirect()->to(base_url() . 'profile_edit')->with('error', 'Current password is incorrect.');
            }

            $model->update_user($user['user_id'], [
                'password' => password_hash($this->request->getPost('new_password'), PASSWORD_DEFAULT)
            ]);
            return redirect()->to(base_url().'profile_edit')->with('success', 'Password changed successfully.');
        }
        return redirect()->to(base_url().'profile_edit')->with('error', validation_errors());
    }

    public function drop_course()
    {
        $session = session();
        $user_id = $session->get('user_id');
        $course_id = $this->request->getPost('course_select');

        $model = new UserModel();
        $model->drop_course($user_id, $course_id);

        // redirect back to the profile edit page with a success message
        return redirect()->to(base_url().'profile_edit')->with('success', 'Course dropped successfully');
    }
}   
