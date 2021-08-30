<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ToDoCategoryRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class ToDoCategoryController extends BaseController
{
    protected $to_do_category_repo;

    public function __construct(ToDoCategoryRepository $to_do_category_repo)
    {
        $this->middleware('auth');
        $this->to_do_category_repo = $to_do_category_repo;
    }

    /**
     * List Categories
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $response = $this->to_do_category_repo->list($data);
        return api_json_response($response);
    }

    /**
     * Store Category
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = $request->all();
        $response = $this->to_do_category_repo->create($data);
        return api_json_response($response);
    }

    /**
     * Update Category
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update($id, Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
        ]);
        $data = $request->all();
        $response = $this->to_do_category_repo->update($id, $data);
        return api_json_response($response);
    }


    /**
     * Delete Category
     * @param $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function destroy($id)
    {
        $response = $this->to_do_category_repo->delete($id);
        return api_json_response($response);
    }

}
