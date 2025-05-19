<?php

namespace TaskTracker\Commands;

use TaskTracker\Interfaces\TaskRepositoryInterface;

class ListTasksCommand implements CommandInterface {
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(array $args): void {
        $status = $args[0] ?? null;
        $tasks = $status ? $this->repository->getByStatus($status) : $this->repository->getAll();

        if (empty($tasks)) {
            echo "No tasks found!\n";
            return;
        }

        foreach ($tasks as $task) {
            echo "\nID: {$task->getId()}\n";
            echo "Title: {$task->getTitle()}\n";
            echo "Description: {$task->getDescription()}\n";
            echo "Status: {$task->getStatus()}\n";
            echo "Created: {$task->getCreatedAt()}\n";
            echo "------------------------\n";
        }
    }

    public function getUsage(): string {
        return "Usage: php task.php list [status]";
    }
}
