<?php

namespace TaskTracker\Repositories;

use TaskTracker\Interfaces\TaskRepositoryInterface;
use TaskTracker\Models\Task;

class JsonTaskRepository implements TaskRepositoryInterface {
    private string $filePath;
    private array $tasks = [];

    public function __construct(string $filePath = 'tasks.json') {
        $this->filePath = $filePath;
        $this->loadTasks();
    }

    private function loadTasks(): void {
        if (file_exists($this->filePath)) {
            $content = file_get_contents($this->filePath);
            $data = json_decode($content, true) ?? [];
            $this->tasks = array_map(
                fn(array $taskData) => Task::fromArray($taskData),
                $data
            );
        }
    }

    private function saveTasks(): void {
        $data = array_map(
            fn(Task $task) => $task->toArray(),
            $this->tasks
        );
        file_put_contents($this->filePath, json_encode($data, JSON_PRETTY_PRINT));
    }

    public function getAll(): array {
        return $this->tasks;
    }

    public function getById(string $id): ?Task {
        foreach ($this->tasks as $task) {
            if ($task->getId() === $id) {
                return $task;
            }
        }
        return null;
    }

    public function save(Task $task): void {
        $this->tasks[] = $task;
        $this->saveTasks();
    }

    public function delete(string $id): bool {
        foreach ($this->tasks as $index => $task) {
            if ($task->getId() === $id) {
                array_splice($this->tasks, $index, 1);
                $this->saveTasks();
                return true;
            }
        }
        return false;
    }

    public function update(Task $task): bool {
        foreach ($this->tasks as $index => $existingTask) {
            if ($existingTask->getId() === $task->getId()) {
                $this->tasks[$index] = $task;
                $this->saveTasks();
                return true;
            }
        }
        return false;
    }

    public function getByStatus(string $status): array {
        return array_filter(
            $this->tasks,
            fn(Task $task) => $task->getStatus() === $status
        );
    }
}
