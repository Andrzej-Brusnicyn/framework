<?php

if ($argc < 2) {
    echo "Usage: php create_migration.php <MigrationName>\n";
    exit(1);
}

$migrationName = $argv[1];
$migrationFileName = 'migrations/' . date('YmdHis') . '_' . $migrationName . '.php';

$template = <<<EOT
<?php

class Migration_$migrationName
{
    public function up(PDO \$conn): void
    {
        // Add your migration logic here
    }

    public function down(PDO \$conn): void
    {
        // Add your rollback logic here
    }
}
EOT;

if (!file_exists('migrations')) {
    mkdir('migrations', 0777, true);
}

file_put_contents($migrationFileName, $template);
echo "Migration $migrationName created successfully.\n";
