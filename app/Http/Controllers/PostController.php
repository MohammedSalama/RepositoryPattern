<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RepositoryPattern\Repo;

class PostController extends Controller
{
    public function __construct(Repo $repo)
    {
        $this->repo = $repo;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
      return $this->repo->store($request);
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function all()
    {
        return $this->all();
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getOne($id)
    {
        return $this->getOne($id);
    }
}
