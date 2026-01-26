<?php

namespace App\Interfaces;

interface CaptainInterface
{
    public function indexByUser($userId);

    public function show($id);

    public function store($params, $userid);

    public function update($params, $id);

    public function delete($id);
}