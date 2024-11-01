<?php

namespace App\Models;

class Job
{
    public static function all(): array
    {
        return [
            [
                'id' => 1,
                'title' => 'Job 1',
                'description' => 'Job 1 description',
            ],
            [
                'id' => 2,
                'title' => 'Job 2',
                'description' => 'Job 2 description',
            ],
            [
                'id' => 3,
                'title' => 'Job 3',
                'description' => 'Job 3 description',
            ]
        ];
    }
}
