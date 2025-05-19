<?php

namespace TaskTracker\Services;

use TaskTracker\Interfaces\TaskRepositoryInterface;
use TaskTracker\Models\Task;

class TaskService {
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository) {
        $this->repository = $repository;
    }

    public function createTask(string $title, string $description): Task {
        $task = new Task($title, $description);
        $this->repository->save($task);
        return $task;
    }

    public function updateTask(string $id, string $title, string $description): bool {
        $task = $this->repository->getById($id);
        if (!$task) {
            return false;
        }

        $task->setTitle($title);
        $task->setDescription($description);
        return $this->repository->update($task);
    }

    public function deleteTask(string $id): bool {
        return $this->repository->delete($id);
    }

    public function markTaskStatus(string $id, string $status): bool {
        $task = $this->repository->getById($id);
        if (!$task) {
            return false;
        }

        $task->setStatus($status);
        return $this->repository->update($task);
    }

    public function listTasks(?string $status = null): array {
        if ($status) {
            return $this->repository->getByStatus($status);
        }
        return $this->repository->getAll();
    }
}
