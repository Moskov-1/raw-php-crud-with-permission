<!DOCTYPE html>
<html>
<body>
    <h1>Create User</h1>
    <form method="POST" action="/users/create">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>
        
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        
        <button type="submit">Save</button>
    </form>
    <a href="/users">Back</a>
</body>
</html>