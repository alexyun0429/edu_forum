<?php

namespace App\Models;

use CodeIgniter\Model;

class DashModel extends Model
{
    protected $table = 'Thread';

    public function searchThreads($query)
    {
        $builder = $this->db->table('Thread');
        $builder->select('Thread.*, Course.course_code');
        $builder->join('Course', 'Thread.course_id = Course.course_id');
        $builder->like('Thread.title', $query);
        return $builder->get()->getResult();
    }

}