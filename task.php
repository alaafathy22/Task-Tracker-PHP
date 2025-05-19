<?php

require_once __DIR__ . '/vendor/autoload.php';

use TaskTracker\Commands\CommandFactory;
use TaskTracker\Repositories\JsonTaskRepository;

if ($argc < 2) {
    echo "Usage: php task.php <command> [arguments...]\n";
    echo "Commands:\n";
    echo "  add <title> <description>\n";
    echo "  update <id> <title> <description>\n";
    echo "  delete <id>\n";
    echo "  mark <id> <status>\n";
    echo "  list [status]\n";
    exit(1);
}

try {
    $repository = new JsonTaskRepository();
    $commandFactory = new CommandFactory($repository);
    
    $commandName = $argv[1];
    $command = $commandFactory->createCommand($commandName);
    
    // Remove the script name and command name from arguments
    $args = array_slice($argv, 2);
    $command->execute($args);
} catch (\InvalidArgumentException $e) {
    echo $e->getMessage() . "\n";
    exit(1);
} catch (\RuntimeException $e) {
    echo $e->getMessage() . "\n";
    exit(1);
} catch (\Exception $e) {
    echo "An unexpected error occurred: {$e->getMessage()}\n";
    exit(1);
}
