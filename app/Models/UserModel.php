<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'User';
    protected $allowedFields = ['username', 'email', 'password', 'role'];
    protected $primaryKey = 'user_id';

    public function login($email, $password)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('User');
        $builder->where('email', $email);
        $builder->where('password', $password);
        $query = $builder->get();
        if ($query->getRowArray()) {
            return true;
        } else {
            return false;
        }
    }

    public function getUser($email, $password)
    {
        $query = $this->where('email', $email)->where('password', $password)->get();
        if ($query->getRow()) return true;
        else return false;
    }

    public function upload($username, $password, $email, $phone, $role)
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $new_user = [
            'username' => $username,
            'password' => $hashed_password,
            'email'    => $email,
            'role'     => $role,
            'phone'    => $phone,
        ];
        $db = \Config\Database::connect();
        $builder = $db->table('User');
        if ($builder->insert($new_user)) {
            return true;
        } else {
            print_r($db->error());
            return false;
        }
    }

    public function getEnrolledCourses($user_id)
    {
        $builder = $this->db->table('users_courses');
        $builder->join('Course', 'Course.course_id = users_courses.course_id');
        $builder->where('users_courses.user_id', $user_id);
        $query = $builder->get();
        return $query->getResult();
    }

    public function get_user_data($user_id)
    {
        // Fetch the user's data from the database
        $user = $this->where('user_id', $user_id)->first();
        return $user;
    }

    public function getUserEnrolledCourses_profile($user_id)
    {
        $enrolled_courses = $this->db->table('users_courses')
                                    ->select('Course.course_id, Course.course_name')
                                    ->join('Course', 'users_courses.course_id = Course.course_id')
                                    ->where('users_courses.user_id', $user_id)
                                    ->get()
                                    ->getResultArray();
        
        return $enrolled_courses;
    }

    public function get_user_enrolled_courses($user_id)
    {
        $enrolled_courses = $this->db->table('users_courses')
                                    ->join('Course', 'users_courses.course_id = Course.course_id')
                                    ->where('users_courses.user_id', $user_id)
                                    ->get()
                                    ->getResultArray();
        
        // Extract the course IDs from the enrolled courses
        $enrolled_course_ids = array_column($enrolled_courses, 'course_id');
        
        return $enrolled_course_ids;
    }

    public function get_courses()
    {
        // Fetch the list of available courses from the database
        $courses = $this->db->table('Course')->get()->getResultArray();
        
        return $courses;
    }

    public function enroll_user_in_course($user_id, $course_id)
    {
        // Check if the user is already enrolled in the course
        $enrollment = $this->db->table('users_courses')
                            ->where('user_id', $user_id)
                            ->where('course_id', $course_id)
                            ->get()
                            ->getRow();
        
        if (!$enrollment) {
            // Enroll the user in the course
            $this->db->table('users_courses')->insert([
                'user_id' => $user_id,
                'course_id' => $course_id,
            ]);
        }
    }

    public function update_user($user_id, $data)
    {
        $builder = $this->db->table('User');
        $builder->where('user_id', $user_id);
        $builder->update($data);
    }

    public function updatePicture($user_id, $imageURL)
    {
        $data = [
            'profile_picture' => $imageURL
        ];
        return $this->update_user($user_id, $data);
    }

    public function verify_password($user_id, $current_password)
    {
        $builder = $this->db->table('User');
        $builder->select('password');
        $builder->where('user_id', $user_id);
        $query = $builder->get();
        $row = $query->getRow();

        if (isset($row)) {
            return password_verify($current_password, $row->password);
        } else {
            return false;
        }
    }

    public function drop_course($user_id, $course_id)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('users_courses');
        $builder->where('user_id', $user_id);
        $builder->where('course_id', $course_id);
        $builder->delete();
    }
}