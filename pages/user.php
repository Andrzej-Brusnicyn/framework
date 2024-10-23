<?php

$user = $database->getUserById($userId);
?>

<?php if ($user): ?>
    <h1>User: <?= $user['name'] ?></h1>
    <p>Email: <?= $user['email'] ?></p>
    <p>Gender: <?= $user['gender'] ?></p>
    <p>Status: <?= $user['status'] ?></p>
<?php else: ?>
    <p>User not found.</p>
<?php endif; ?>
