<?php

namespace App\Interfaces\persons;

interface CaptainInterface
{
    public function indexByUser($userId);

    public function show($id);

    public function store($params,$personId, $userId);

    public function update($params, $id);

    public function delete($id);
}