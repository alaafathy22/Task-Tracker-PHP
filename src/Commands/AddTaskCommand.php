<?php

namespace TaskTracker\Commands;

use TaskTracker\Interfaces\TaskRepositoryInterface;
use TaskTracker\Models\Task;

class AddTaskCommand implements CommandInterface {
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function execute(array $args): void {
        if (count($args) < 2) {
            throw new \InvalidArgumentException($this->getUsage());
        }

        $task = new Task($args[0], $args[1]);
        $this->repository->save($task);
        echo "Task added successfully!\n";
    }

    public function getUsage(): string {
        return "Usage: php task.php add <title> <description>";
    }
}
