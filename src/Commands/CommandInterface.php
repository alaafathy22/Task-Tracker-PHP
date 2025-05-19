<?php

namespace TaskTracker\Commands;

interface CommandInterface {
    public function execute(array $args): void;
    public function getUsage(): string;
}
