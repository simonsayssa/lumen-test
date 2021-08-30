<?php

namespace Database\Seeders;

use App\Models\ToDoStatus;
use Illuminate\Database\Seeder;

class ToDoStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Completed',
            ],
            [
                'name' => 'Snoozed',
            ],
            [
                'name' => 'Overdue',
            ],
        ];
        ToDoStatus::insert($data); // Eloquent approach
    }
}
