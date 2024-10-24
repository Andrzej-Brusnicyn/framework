<?php

class Migration_AddPostsTable {
    public function up($conn) {
        $query = "
            CREATE TABLE IF NOT EXISTS posts (
                id SERIAL PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            );
        ";
        $conn->exec($query);
    }

    public function down($conn) {
        $query = "DROP TABLE IF EXISTS posts;";
        $conn->exec($query);
    }
}
