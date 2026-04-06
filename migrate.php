<?php

require_once __DIR__ . '/src/ConfigHelpers.php';

// 2. Load Database Class
require_once __DIR__ . '/src/Database.php';

$pdo = Database::getInstance()->getConnection();

// 3. Ensure the 'migrations' tracking table exists
$pdo->exec("
    CREATE TABLE IF NOT EXISTS migrations (
        id INT AUTO_INCREMENT PRIMARY KEY,
        filename VARCHAR(255) NOT NULL UNIQUE,
        executed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )
");

// 4. Define Migration Directory
$migrationDir = __DIR__ . '/database/migrations/';

if (!is_dir($migrationDir)) {
    die("Error: Migration directory not found at: $migrationDir");
}

// 5. Get all .sql files
$files = glob($migrationDir . '*.sql');

if (empty($files)) {
    echo "No migration files found.\n";
    exit;
}

// Sort files alphabetically (ensure timestamp order)
sort($files);

echo "Starting migrations...\n";

$ranCount = 0;
$skipCount = 0;

foreach ($files as $file) {
    $filename = basename($file);

    // Check if already run
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM migrations WHERE filename = ?");
    $stmt->execute([$filename]);

    if ($stmt->fetchColumn() > 0) {
        echo "⏭️  Skipped (already ran): $filename\n";
        $skipCount++;
        continue;
    }

    // Run the migration
    try {
        echo "🚀 Running: $filename ... ";

        $sql = file_get_contents($file);

        $pdo->exec($sql);

        // Record success
        $insert = $pdo->prepare("INSERT INTO migrations (filename) VALUES (?)");
        $insert->execute([$filename]);

        echo "✅ Done.\n";
        $ranCount++;

    } catch (Exception $e) {
        echo "❌ FAILED: " . $e->getMessage() . "\n";
        exit(1);
    }
}

echo "\n---------------------------------\n";
echo "Migrations Complete.\n";
echo "Ran: $ranCount | Skipped: $skipCount\n";