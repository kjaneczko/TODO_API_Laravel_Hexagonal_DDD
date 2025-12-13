<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 * @method static take(float|int $offset)
 * @method static orderBy(string $string)
 * @method static skip(float|int $offset)
 * @method static create(array $array)
 * @method static where(string $string, int $toInt)
 * @method static whereKey(int $toInt)
 * @property string $name
 * @property int $id
 */
class TaskModel extends Model
{
    /** @use HasFactory<\Database\Factories\TaskModelFactory> */
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = ['name'];
}
