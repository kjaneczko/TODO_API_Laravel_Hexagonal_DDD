<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static find(int $id)
 * @property string $value
 * @property int $id
 */
class TaskModel extends Model
{
    /** @use HasFactory<\Database\Factories\TaskModelFactory> */
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = ['value'];
}
