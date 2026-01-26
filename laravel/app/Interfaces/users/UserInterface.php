<?php

namespace App\Interfaces\users;

use App\Models\users\User;

interface UserInterface
{
    public function show($id);
    public function store(User $user);
    public function update($params, $id);
    public function delete($id);

}