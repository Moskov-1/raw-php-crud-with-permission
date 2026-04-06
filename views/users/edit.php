<!DOCTYPE html>
<html>
<body>
    <h1>Edit User</h1>
    <form method="POST" action="/users/edit">
        <input type="hidden" name="id" value="<?= htmlspecialchars($user['id']) ?>">
        
        <label>Name:</label><br>
        <input type="text" name="name" value="<?= htmlspecialchars($user['name']) ?>" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required><br><br>
        
        <button type="submit">Update</button>
    </form>
    <a href="/users">Back</a>
</body>
</html>