<?php

namespace App\Models;

class Task
{
    public const TABLE_NAME = 'tasks';

    public string $name;

    public string $description;

    public bool $completed;

    public function validate() {
        // To do - Add validations rules and Messages
    }
}