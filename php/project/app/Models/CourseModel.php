<?php

namespace App\Models;

use CodeIgniter\Model;

class CourseModel extends Model
{
    protected $table = 'Course';

    public function findCourseIdByCode($course_code)
    {
        $builder = $this->db->table('Course');
        $builder->where('course_code', $course_code);
        $course = $builder->get()->getRowArray();

        if ($course === null) {
            throw new \Exception('No course found with course code: ' . $course_code);
        }

        return $course['course_id'];
    }
    public function getCourseById($course_id)
    {
        $builder = $this->db->table('Course');
        $builder->where('course_id', $course_id);
        $course = $builder->get()->getRow();

        if ($course === null) {
            throw new \Exception('No course found with course id: ' . $course_id);
        }

        return $course;
    }

    public function findCourseByCode($course_code)
    {
        $builder = $this->db->table('Course');
        $builder->where('course_code', $course_code);
        $course = $builder->get()->getRow();

        if ($course === null) {
            throw new \Exception('No course found with course code: ' . $course_code);
        }

        return $course;
    }

}