<?php

namespace TaskTracker\Models;

class Task {
    private string $id;
    private string $title;
    private string $description;
    private string $status;
    private string $createdAt;

    public function __construct(string $title, string $description) {
        $this->id = uniqid();
        $this->title = $title;
        $this->description = $description;
        $this->status = 'pending';
        $this->createdAt = date('Y-m-d H:i:s');
    }

    public function getId(): string {
        return $this->id;
    }

    public function getTitle(): string {
        return $this->title;
    }

    public function setTitle(string $title): void {
        $this->title = $title;
    }

    public function getDescription(): string {
        return $this->description;
    }

    public function setDescription(string $description): void {
        $this->description = $description;
    }

    public function getStatus(): string {
        return $this->status;
    }

    public function setStatus(string $status): void {
        if (!in_array($status, ['pending', 'in_progress', 'done'])) {
            throw new \InvalidArgumentException('Invalid status');
        }
        $this->status = $status;
    }

    public function getCreatedAt(): string {
        return $this->createdAt;
    }

    public function toArray(): array {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'status' => $this->status,
            'created_at' => $this->createdAt
        ];
    }

    public static function fromArray(array $data): self {
        $task = new self($data['title'], $data['description']);
        $task->id = $data['id'];
        $task->status = $data['status'];
        $task->createdAt = $data['created_at'];
        return $task;
    }
}
