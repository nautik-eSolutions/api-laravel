<?php

namespace App\Interfaces\boats;

use App\Models\boats\Boat;

interface BoatsInterface
{
    public function show($id);

    public function store(Boat $boat);

    public function update(Boat $boat);

    public function delete($id);


}