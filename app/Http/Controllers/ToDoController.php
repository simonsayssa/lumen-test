<?php

namespace App\Http\Controllers;

use App\Http\Repositories\ToDoCategoryRepository;
use App\Http\Repositories\ToDoRepository;
use Illuminate\Http\Request;
use Laravel\Lumen\Routing\Controller as BaseController;

class ToDoController extends BaseController
{
    protected $to_do_repo;

    public function __construct(ToDoRepository $to_do_repo)
    {
        $this->middleware('auth');
        $this->to_do_repo = $to_do_repo;
    }

    /**
     * List ToDos
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $response = $this->to_do_repo->list($data);
        return api_json_response($response);
    }

    /**
     * Store ToDo
     * @param Request $request
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'date_time' => 'required|date_format:' . config('general.datetime_format'),
            'status_id' => 'required',
            'category_id' => 'required',
        ]);
        $data = $request->all();
        $response = $this->to_do_repo->create($data);
        return api_json_response($response);
    }

    /**
     * Update ToDo
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
        $response = $this->to_do_repo->update($id, $data);
        return api_json_response($response);
    }


    /**
     * Delete ToDo
     * @param $id
     * @return \Illuminate\Http\Response|\Laravel\Lumen\Http\ResponseFactory
     */
    public function destroy($id)
    {
        $response = $this->to_do_repo->delete($id);
        return api_json_response($response);
    }

}
