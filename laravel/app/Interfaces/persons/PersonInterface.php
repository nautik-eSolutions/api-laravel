<?php

namespace App\Interfaces\persons;

use App\Models\persons\Person;
use App\Models\users\User;

interface PersonInterface
{

    public function showCaptainsByUser(User $user);
    public function showOwnersByUser(User $user);
    public function storeCaptain(Person $person, User $user);
    public function storeOwner(Person $person, User $user);
    public function updateCaptain(Person $person);
    public function destroyCaptain(Person $person, User $user);
    public function destroyOwner(Person $person, User $user);

}