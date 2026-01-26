<?php

namespace App\Interfaces;

use App\Models\users\User;

interface UserInterface
{
    public function show($id);
    public function store(User $user);
    public function update(User $user);
    public function delete($id);

}