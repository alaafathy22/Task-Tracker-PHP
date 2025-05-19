<?php

namespace TaskTracker\Interfaces;

use TaskTracker\Models\Task;

interface TaskRepositoryInterface {
    public function getAll(): array;
    public function getById(string $id): ?Task;
    public function save(Task $task): void;
    public function delete(string $id): bool;
    public function update(Task $task): bool;
    public function getByStatus(string $status): array;
}
