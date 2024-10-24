<?php
include 'database/Database.php';

$database = Database::getInstance();
$conn = $database->getConnection();

$stmt = $conn->query("SELECT * FROM migrations ORDER BY executed_at DESC LIMIT 1");
$lastMigration = $stmt->fetch(PDO::FETCH_ASSOC);

if ($lastMigration) {
    $migrationName = $lastMigration['migration_name'];
    $migrationFile = 'migrations/' . $migrationName . '.php';

    if (file_exists($migrationFile)) {
        include $migrationFile;

        $className = 'Migration_' . substr($migrationName, 15);

        if (class_exists($className)) {

            $migration = new $className();
            $migration->down($conn);

            $stmt = $conn->prepare("DELETE FROM migrations WHERE migration_name = :migration_name");
            $stmt->bindParam(':migration_name', $migrationName);
            $stmt->execute();

            echo "Migration $migrationName rolled back successfully.\n";
        } else {
            echo "Migration class $className not found.\n";
        }
    } else {
        echo "Migration file $migrationFile not found.\n";
    }
} else {
    echo "No migrations to rollback.\n";
}
