<?php

namespace TaskTracker\Commands;

use TaskTracker\Interfaces\TaskRepositoryInterface;

class DeleteTaskCommand implements CommandInterface {
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(array $args): void {
        if (count($args) < 1) {
            throw new \InvalidArgumentException($this->getUsage());
        }

        if ($this->repository->delete($args[0])) {
            echo "Task deleted successfully!\n";
        } else {
            throw new \RuntimeException("Task not found!");
        }
    }

    public function getUsage(): string {
        return "Usage: php task.php delete <id>";
    }
}
