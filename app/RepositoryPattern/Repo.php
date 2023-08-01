<?php

namespace RepositoryPattern;

interface Repo
{
    /**
     * @param $request
     * @return mixed
     */
    public function store($request);
    public function getOne($id);
    public function all();
}
