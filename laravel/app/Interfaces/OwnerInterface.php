<?php

namespace App\Interfaces;

interface OwnerInterface
{
public function indexByUser($userId);
public function show($id);
public function update($params, $id);

public function store($params);
public function delete($id);


}