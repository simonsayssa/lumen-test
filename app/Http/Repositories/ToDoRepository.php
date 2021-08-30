<?php

namespace App\Http\Repositories;


use App\Models\ToDo;
use Illuminate\Support\Facades\Auth;

class ToDoRepository
{

    /**
     * Create Category
     * @param $data
     * @return ToDo|array
     */
    public function create($data)
    {
        try {
            $to_do = new ToDo();
            $to_do->user_id = Auth::user()->id;
            $to_do->name = $data['name'];
            $to_do->description = isset($data['description']) ? $data['description'] : "";
            $to_do->date_time = dbDateTimeParse($data['date_time']);
            $to_do->category_id = $data['category_id'];
            $to_do->status_id = $data['status_id'];
            $to_do->save();
            return $to_do;
        } catch (\Exception $e) {
            return [
                "error" => 500,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * Update To Do
     * @param $id
     * @param $data
     * @return string[]
     */
    public function update($id, $data)
    {
        try {
            $to_do = ToDo::find($id);
            if (is_null($to_do)) {
                return [
                    'error' => '404',
                    'message' => 'To Do Not Found!',
                ];
            }
            $to_do->name = $data['name'];
            $to_do->description = isset($data['description']) ? $data['description'] : "";
            $to_do->date_time = dbDateTimeParse($data['date_time']);
            $to_do->category_id = $data['category_id'];
            $to_do->status_id = $data['status_id'];
            $to_do->save();
            return $to_do;
        } catch (\Exception $e) {
            return [
                "error" => 500,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * List To Do
     * @param $data
     * @return ToDo|array
     */
    public function list($data)
    {
        try {
            $to_do = ToDo::where('user_id', Auth::user()->id);
            if (isset($data['day'])) {
                $to_do->where('date_time', '>=', dbDateTimeParse($data['day']));
                $to_do->where('date_time', '<', dbDateTimeParse($data['day'], ' + 1 day'));
            }
            if (isset($data['month'])) {
                $to_do->where('date_time', '>=', dbDateTimeParse("01-" . $data['month']));
                $to_do->where('date_time', '<', dbDateTimeParse("01-" . $data['month'], ' + 1 month'));
            }
            if (isset($data['status_id'])) {
                $to_do->where('status_id', $data['status_id']);
            }
            if (isset($data['category_id'])) {
                $to_do->where('category_id', $data['category_id']);
            }

            $to_do = $to_do->with('category')
                ->with('status')
                ->get();
            return $to_do;
        } catch (\Exception $e) {
            return [
                "error" => 500,
                "message" => $e->getMessage(),
            ];
        }
    }

    /**
     * Delete To Do
     * @param $id
     * @return string|array
     */
    public function delete($id)
    {
        try {
            ToDo::destroy($id);
            return "To Do Deleted Successfully";
        } catch (\Exception $e) {
            return [
                "error" => 500,
                "message" => $e->getMessage(),
            ];
        }
    }
}
