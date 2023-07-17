<?php 

namespace App\Controllers;

use CodeIgniter\Email\Email;
  
class Register extends BaseController
{
    public function index()
    {
        //include helper form
        helper(['form']);
        $data = [];
        echo view('template/header');
        echo view('register/register', $data);
        echo view('template/footer');
    }
  
    public function save()
    {
        require_once '/var/www/htdocs/vendor/autoload.php';
        $data['errors'] = "";
        helper(['form']);
        $rules = [
            'username'      => [
                'rules'  =>'required|min_length[3]|max_length[20]|is_unique[User.username]',
                'errors' => [
                    'min_length[3]' => 'The Username must be more that 3 characters.',
                    'is_unique[User.username]' => 'Username already exist.',
                ]
            ],
            'email'         => 'required|min_length[6]|valid_email|is_unique[User.email]',
            'password'      => [
                'rules'  => 'required|min_length[7]|max_length[200]|alpha_numeric_punct',
                'errors' => [
                    'min_length[6]' => 'The password must be more that 5 characters.',
                    'alpha_numeric_punct' => 'Fails if field contains anything other than alphanumeric, space, or this limited set of punctuation characters: ~, !, #, $, %, & , *, -, _, +, =, |, :, ..',
                ]
            ],
            'confpassword'  => 'matches[password]',
            'role'          => 'required'
        ];

        if ($this->validate($rules)) {    
            $data = [
                'username'     => $this->request->getPost('username'),
                'email'        => $this->request->getPost('email'),
                'phone'        => $this->request->getPost('phone'),
                'password'     => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role'         => $this->request->getPost('role'),
            ];

            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $email    = $this->request->getPost('email');
            $phone    = $this->request->getPost('phone');
            $role     = $this->request->getPost('role');

            $model = model('App\Models\UserModel');
            $check = $model->upload($username, $password, $email, $phone, $role);
            if ($check) {
                $phone = $this->request->getPost('phone');

                $sid = "AC5795257afe682a6fd56ae4e462b0bdbb";
                $token = "c9039a026d2758bcdafc5c7f4556b96a";
                $twilio = new \Twilio\Rest\Client($sid, $token);

                $message = $twilio->messages
                                ->create($phone,
                                        [
                                            "body" => "Your verification code is: 123456",
                                            "from" => "+12524603786"
                                        ]
                                );
                
                $verification_email = new Email();
                $emailConf = [
                    'protocol' => 'smtp',
                    'wordWrap' => true,
                    'SMTPHost' => 'mailhub.eait.uq.edu.au',
                    'SMTPPort' => 25
                ];
                $verification_email->initialize($emailConf);

                $token = bin2hex(random_bytes(16));
                $verificationLink = base_url('verify-email?token=' . $token);

                $verification_email->setTo($email);
                $verification_email->setFrom('infs3202-2ac671c3@uqcloud.net');
                $verification_email->setSubject('Verify your email address');
                $verification_email->setMessage('Please click on the following link to verify your email address: ' . $verificationLink);

                if ($verification_email->send()) {
                    $db = \Config\Database::connect();
                    $db->table('User')->where('email', $email)->set(['verification_token' => $token])->update();
                } else {
                    // need codes for handle error
                }

                return redirect()->to(base_url().'login');
            } else {
                $data['errors'] = "<div class=\"alert alert-danger\" role=\"alert\"> Upload failed!! </div> ";
                echo view('template/header');
                echo view('register/register', $data);
                echo view('template/footer');
            }
        }else{
            $data['validation'] = $this->validator;
            echo view('template/header');
            echo view('register/register', $data);
            echo view('template/footer');
        }
    }

    public function verifyEmail()
    {
        $data = [];
        $token = $this->request->getGet('token');
        $db = \Config\Database::connect();
        $user = $db->table('User')->where('verification_token', $token)->get()->getRow();
        
        if ($user) {
            $db->table('User')->where('verification_token', $token)->set(['is_email_verified' => true])->update();
            echo 'Your email has been successfully verified. Please go back to your site and renew. Now you have full access to forum. ';
            // $data['success'] = "<div class=\"success \" role=\"success\"> Your email has been successfully verified. </div> ";
            // echo view('email_verification', $data);
        } else {
            echo 'error', 'Invalid verification token.';
        }
        
    }
}


















