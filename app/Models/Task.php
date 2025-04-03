<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\TasksStatus;
use Carbon\CarbonInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property-read int $id
 * @property string $title
 * @property int $user_id
 * @property TasksStatus $status
 * @property null|string $description
 * @property User $user
 * @property null|CarbonInterface $created_at
 * @property null|CarbonInterface $updated_at
 */

class Task extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'tasks';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
