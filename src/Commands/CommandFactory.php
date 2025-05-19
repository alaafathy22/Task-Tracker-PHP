<?php

namespace TaskTracker\Commands;

use TaskTracker\Interfaces\TaskRepositoryInterface;

class CommandFactory {
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function createCommand(string $commandName): CommandInterface {
        return match ($commandName) {
            'add' => new AddTaskCommand($this->repository),
            'update' => new UpdateTaskCommand($this->repository),
            'delete' => new DeleteTaskCommand($this->repository),
            'mark' => new MarkTaskCommand($this->repository),
            'list' => new ListTasksCommand($this->repository),
            default => throw new \InvalidArgumentException("Unknown command: $commandName")
        };
    }
}
