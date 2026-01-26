<?php

namespace App\Interfaces;

interface PersonInterface
{

    public function  store($params);

    public function update($params, $id);

    public function show($id);

    public function delete($id);


}