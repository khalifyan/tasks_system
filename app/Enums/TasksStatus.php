<?php

namespace App\Enums;

enum TasksStatus: string
{
    case new = 'new';
    case in_progress = 'in_progress';
    case completed = 'completed';
}
