<?php

namespace App\Interfaces\persons;

use App\Models\persons\Captain;
use App\Models\persons\Person;
use App\Models\users\User;

interface CaptainInterface
{
    public function indexByUser($userId);

    public function show($id);

    public function store(Captain $captain,Person $person, User $user);

    public function update($params, $id);

    public function delete($id);
}