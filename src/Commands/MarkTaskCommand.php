<?php

namespace TaskTracker\Commands;

use TaskTracker\Interfaces\TaskRepositoryInterface;

class MarkTaskCommand implements CommandInterface {
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(array $args): void {
        if (count($args) < 2) {
            throw new \InvalidArgumentException($this->getUsage());
        }

        $task = $this->repository->getById($args[0]);
        if (!$task) {
            throw new \RuntimeException("Task not found!");
        }

        try {
            $task->setStatus($args[1]);
            if ($this->repository->update($task)) {
                echo "Task marked as {$args[1]}!\n";
            } else {
                throw new \RuntimeException("Failed to update task status!");
            }
        } catch (\InvalidArgumentException $e) {
            throw new \InvalidArgumentException("Invalid status! Use: pending, in_progress, or done");
        }
    }

    public function getUsage(): string {
        return "Usage: php task.php mark <id> <status>";
    }
}
