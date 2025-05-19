<?php

namespace TaskTracker\Commands;

use TaskTracker\Interfaces\TaskRepositoryInterface;

class UpdateTaskCommand implements CommandInterface {
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(array $args): void {
        if (count($args) < 3) {
            throw new \InvalidArgumentException($this->getUsage());
        }

        $task = $this->repository->getById($args[0]);
        if (!$task) {
            throw new \RuntimeException("Task not found!");
        }

        $task->setTitle($args[1]);
        $task->setDescription($args[2]);
        
        if ($this->repository->update($task)) {
            echo "Task updated successfully!\n";
        } else {
            throw new \RuntimeException("Failed to update task!");
        }
    }

    public function getUsage(): string {
        return "Usage: php task.php update <id> <title> <description>";
    }
}
