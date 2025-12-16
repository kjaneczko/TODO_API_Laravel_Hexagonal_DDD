<?php
declare(strict_types=1);

namespace App\Models;

use App\Domain\Task\Task;
use App\Domain\Task\TaskId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static find(int $id)
 * @method static take(float|int $offset)
 * @method static orderBy(string $string)
 * @method static skip(float|int $offset)
 * @method static create(array $array)
 * @method static where(string $string, int $toInt)
 * @method static whereKey(int $toInt)
 * @property int $id
 * @property string $name
 * @property int $position
 * @property bool $completed
 * @property int|null $task_list_id
 */
class TaskModel extends Model
{
    /** @use HasFactory<\Database\Factories\TaskModelFactory> */
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = ['name', 'position', 'completed', 'task_list_id'];

    public function taskList(): BelongsTo
    {
        return $this->belongsTo(TaskListModel::class);
    }
}
