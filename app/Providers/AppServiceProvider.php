<?php
declare(strict_types=1);

namespace App\Providers;

use App\Architecture\Task\Interface\TaskServiceInterface;
use App\Architecture\Task\TaskService;
use App\Architecture\TaskList\Interface\TaskListServiceInterface;
use App\Architecture\TaskList\TaskListService;
use App\Domain\Task\Interface\TaskRepositoryInterface;
use App\Domain\TaskList\Interface\TaskListRepositoryInterface;
use App\Infrastructure\Task\TaskEloquentRepository;
use App\Infrastructure\TaskList\TaskListEloquentRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TaskRepositoryInterface::class, TaskEloquentRepository::class);
        $this->app->bind(TaskServiceInterface::class, TaskService::class);
        $this->app->bind(TaskListServiceInterface::class, TaskListService::class);
        $this->app->bind(TaskListRepositoryInterface::class, TaskListEloquentRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
