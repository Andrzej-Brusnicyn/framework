<?php

require_once 'database/DatabaseConnection.php';
use Database\DatabaseConnection;

$database = DatabaseConnection::getInstance();
$conn = $database->getConnection();

$query = "
CREATE TABLE IF NOT EXISTS migrations (
    id SERIAL PRIMARY KEY,
    migration_name VARCHAR(255) NOT NULL,
    executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
";
$conn->exec($query);

$migrationsDir = 'migrations';

$stmt = $conn->query("SELECT migration_name FROM migrations");
$executedMigrations = $stmt->fetchAll(PDO::FETCH_COLUMN);

$migrationFiles = glob($migrationsDir . '/*.php');

foreach ($migrationFiles as $migrationFile) {
    $migrationName = basename($migrationFile, '.php');

    if (!in_array($migrationName, $executedMigrations)) {
        include $migrationFile;

        $className = 'Migration_' . substr($migrationName, 15);

        if (class_exists($className)) {
            $migration = new $className();
            $migration->up($conn);

            $stmt = $conn->prepare("INSERT INTO migrations (migration_name) VALUES (:migration_name)");
            $stmt->bindParam(':migration_name', $migrationName);
            $stmt->execute();

            echo "Migration $migrationName executed successfully.\n";
        } else {
            echo "Migration class $className not found.\n";
        }
    } else {
        echo "Migration $migrationName already executed.\n";
    }
}
