<?php

namespace App\Http\Repositories;


use App\Models\ToDoCategory;
use Illuminate\Support\Facades\Auth;

class ToDoCategoryRepository
{

    /**
     * Create Category
     * @param $data
     * @return ToDoCategory|array
     */
    public function create($data)
    {
        try {
            $category = new ToDoCategory();
            $category->user_id = Auth::user()->id;
            $category->name = $data['name'];
            $category->save();
            return $category;
        } catch (\Exception $e) {
            return [
                "error" => 500,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * Update Category
     * @param $id
     * @param $data
     * @return string[]
     */
    public function update($id, $data)
    {
        try {
            $category = ToDoCategory::find($id);
            if (is_null($category)) {
                return [
                    'error' => '404',
                    'message' => 'Category Not Found!',
                ];
            }
            $category->name = $data['name'];
            $category->save();
            return $category;
        } catch (\Exception $e) {
            return [
                "error" => 500,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * List User Categories
     * @param $data
     * @return ToDoCategory|array
     */
    public function list($data)
    {
        try {
            return ToDoCategory::where('user_id', Auth::user()->id)->get();
        } catch (\Exception $e) {
            return [
                "error" => 500,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * Delete User Category
     * @param $id
     * @return string|array
     */
    public function delete($id)
    {
        try {
            ToDoCategory::destroy($id);
            return "Category Delete Successfully";
        } catch (\Exception $e) {
            return [
                "error" => 500,
                "message" => $e->getMessage(),
            ];
        }
    }
}
