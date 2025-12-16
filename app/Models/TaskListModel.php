<?php
declare(strict_types=1);

namespace App\Models;

use Database\Factories\TaskListModelFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
 */
class TaskListModel extends Model
{
    /** @use HasFactory<TaskListModelFactory> */
    use HasFactory;

    protected $table = 'task_lists';
    protected $fillable = ['name'];

    public function tasks(): HasMany
    {
        return $this->hasMany(TaskModel::class);
    }
}
