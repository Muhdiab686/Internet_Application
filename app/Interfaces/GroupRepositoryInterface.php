<?php

namespace App\Interfaces;

interface GroupRepositoryInterface
{
    public function create(array $info);
    public function getgroups();
}
