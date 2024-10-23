<?php

$users = $database->getAllUsers();
?>
<h1>List of Users</h1>
<ul>
<?php if ($users): ?>
    <?php foreach ($users as $user): ?>
        <li><a href="/users/<?= $user['id'] ?>"><?= $user['name'] ?></a></li>
    <?php endforeach; ?>
<?php else: ?>
    <p>No users found.</p>
<?php endif; ?>
</ul>
