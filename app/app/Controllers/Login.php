<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\Email\Email;
use App\Models\UserModel;

class Login extends BaseController
{
    public $session;

    public function index()
    {
        helper(['cookie','form']);
        $data['error'] = "";
        $session = session();
        if ($session->has('isLoggedIn') && $session->get('isLoggedIn') == true) {
            return redirect()->to(base_url().'dashboard');
        }
        
        $email = get_cookie('email');
        // var_dump($email);
        if ($email) {
            $data['email'] = $email;
        }

        echo view('template/header');
        echo view('login/login', $data);
        echo view('template/footer');
    }

    public function login()
    {
        helper(['cookie', 'form']);
        // var_dump(base_url('dashboard'));
        if ($this->request->getMethod() == 'post') {

            $session = session();

            $user_id  = $this->request->getVar('user_id');
            $email    = $this->request->getVar('email');
            $remember = $this->request->getPost('remember');
            
            $model = new UserModel();
            $user = $model->where('email', $email)->first();

            if ($user) {
                if (password_verify(($this->request->getVar('password')), $user['password'])) {
                    //set cookie empty
                    $sessionData = [                        
                        'isLoggedIn'     => true,
                        'email'          => $user['email'],
                        'password'       => $user['password'],
                        'username'       => $user['username'],
                        'user_id'        => $user['user_id'],
                        'role'           => $user['role'],
                        'profilePicture' => $user['profile_picture']
                    ];
                    $session->set($sessionData);

                    if ($remember) {
                        // incase new cookie needs to be written, reset old cookie.
                        delete_cookie('email');
                        // set cookies for email and password - 30 days
                        setcookie('email', $email, time()+(3600*24*30), '/');
                        // setcookie('password', password_hash($password, PASSWORD_DEFAULT), time()+(3600*24*30), '/'); 
                    }
                    return redirect()->to(base_url().'dashboard');
                } else {
                    session()->setFlashdata('error', 'Invalid Username or Password!');
                    return redirect()->to(base_url().'login');
                }
            } else {
                session()->setFlashdata('error', 'Invalid Username or Password!');
                return redirect()->to(base_url().'login');
            }
        } else {
            session()->setFlashdata('error', 'Invalid Username or Password!');
            return redirect()->to(base_url().'login');
        }
    }
   
    public function logout()
    {
        helper(['cookie', 'form']);
        $session = session();
        $session->destroy();
        // delete_cookie('password');
        return redirect()->to(base_url().'login');
    }

    public function forgot_password()
    {
        helper(['form']);

        if ($this->request->getMethod() == 'post') {
            // retrieve receiver email from the fomr submit
            $receiver = $this->request->getVar('receiver');

            // Validate email address
            if (!filter_var($receiver, FILTER_VALIDATE_EMAIL)) {
                session()->setFlashdata('error', 'Invalid email address!');
                return redirect()->back();
            }

            $model = new UserModel();
            $user = $model->where('email', $receiver)->first();
            // var_dump($user['user_id']);
            if (!$user) {
                session()->setFlashdata('error', 'Email address not found!');
                return redirect()->back()->to(base_url().'forgot_password');
            }

            // Generate unique token
            $token = bin2hex(random_bytes(8));

            $db = \Config\Database::connect();
            $builder = $db->table('Password_resets');
            $data = [
                'email' => $receiver,
                'token' => $token,
                'created_at' => date('Y-M-D H:i:s')
            ];
            $builder->insert($data);
            
            $email = new Email();
            $emailConf = [
                'protocol' => 'smtp',
                'wordWrap' => true,
                'SMTPHost' => 'mailhub.eait.uq.edu.au',
                'SMTPPort' => 25
            ];
            $email->initialize($emailConf);
            
            $email->setTo($receiver);
            $email->setFrom('infs3202-2ac671c3@uqcloud.net');
            $email->setSubject('Token for temporary login');
            $email->setMessage('Your password has been reset to: '.$token.'
Please use the token as password to login.
NOTE: Change your password right-after.
This is an automated email. Please, do not reply.');
            
            if ($email->send()) {
                // as 
                $model->update_user($user['user_id'], [
                    'password' => password_hash($token, PASSWORD_DEFAULT)
                ]);
                session()->setFlashdata('success', 'An email has been sent to your email address with instructions on how to reset your password.');
            } else {
                session()->setFlashdata('error', 'Please re-try.');
            }
        }
        echo view('template/header');
        echo view('login/forgot_password');
        echo view('template/footer');
    }

}
