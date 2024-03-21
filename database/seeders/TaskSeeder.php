<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userFirst = User::query()->find(1);

        $taskOne = new Task([
            'name' => 'Finish homework (Math)',
            'description' => 'Finish the homework from the Math subject',
            'priority' => Task::HIGH,
            'due_date' => now()->addDays(9)
        ]);

        $taskTwo = new Task([
            'name' => 'Buy groceries',
            'description' => 'The list is on the refrigerator',
            'priority' => Task::MEDIUM,
            'due_date' => now()->addDays(7)
        ]);

        $taskThree = new Task([
            'name' => 'Clean the house',
            'description' => 'Start from your room',
            'priority' => Task::VERY_HIGH,
            'due_date' => now()->addDays(4)
        ]);

        $taskOne->user()->associate($userFirst);
        $taskTwo->user()->associate($userFirst);
        $taskThree->user()->associate($userFirst);

        $taskOne->save();
        $taskTwo->save();
        $taskThree->save();


        $userSecond = User::query()->find(2);


        $taskOneCopy = new Task([
            'name' => 'Finish homework (Biology)',
            'description' => 'Finish the homework from the Biology subject',
            'priority' => Task::HIGH,
            'due_date' => now()->addDays(9)
        ]);

        $taskTwoCopy = new Task([
            'name' => 'Change the bulb',
            'description' => 'Use the bulb from the kitchen or buy a new one',
            'priority' => Task::LOW,
            'due_date' => now()->addDays(7)
        ]);

        $taskThreeCopy = new Task([
            'name' => 'Clean the pool',
            'description' => 'Yesterday was windy and the pool is very dirty',
            'priority' => Task::VERY_HIGH,
            'due_date' => now()->addDays(4)
        ]);

        $taskOneCopy->user()->associate($userSecond);
        $taskTwoCopy->user()->associate($userSecond);
        $taskThreeCopy->user()->associate($userSecond);

        $taskOneCopy->save();
        $taskTwoCopy->save();
        $taskThreeCopy->save();
    }
}
