<?php


namespace App\Repository;


interface BaseRepository
{

    public function create($attributes);

    public function save($model);

    public function delete($model);

    public function all();

    public function find($id);

    public function count();

}
