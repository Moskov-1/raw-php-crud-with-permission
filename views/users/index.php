<!DOCTYPE html>
<html>
<head><title>User List</title></head>
<body>
    <h1>Users</h1>
    <a href="/users/create">Create New User</a> | 
    <?php if (isset($_SESSION['user_id'])): ?>
        <a href="/logout">Logout</a> (<?= htmlspecialchars($_SESSION['user_name']) ?>)
    <?php else: ?>
        <a href="/login">Login</a>
    <?php endif; ?>
    
    <table border="1" cellpadding="10">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td>
                <a href="/users/edit?id=<?= $user['id'] ?>">Edit</a>
                <form method="POST" action="/users/delete" style="display:inline;">
                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                    <button type="submit" onclick="return confirm('Are you sure?')">Delete</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>