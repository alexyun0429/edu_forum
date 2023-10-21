<?php namespace App\Validation;

class MyRules
{
    public function check_password(string $str): bool
    {
        return preg_match('/[A-Z]/', $str) && preg_match('/\d/', $str) && preg_match('/[^a-zA-Z\d]/', $str);
    }
}