<?php

namespace App\Interfaces\boats;

use App\Models\boats\Boat;
use App\Models\persons\Person;
use App\Models\users\User;

interface BoatsInterface
{
    public function showBoatsByOwner(Person $owner);

    public function showBoatsByUser(User $user);

    public function show($id);

    public function store(Boat $boat);

    public function update(Boat $boat);

    public function delete($id);


}