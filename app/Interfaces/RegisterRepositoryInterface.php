<?php

namespace App\Interfaces;

interface RegisterRepositoryInterface
{
    public function create(array $info);
    public function find($request);
    public function get($email);
    public function getuserIn($groupId);
    public function getuser();
}
