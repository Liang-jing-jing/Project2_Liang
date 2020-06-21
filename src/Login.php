<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Log in</title>
    <link rel="stylesheet" href="css/Main.css">
    <link rel="stylesheet" href="css/Login.css">
</head>
<body>
<?php
session_start();

unset($_SESSION['user']);

?>
<form action="../php/LoginCheck.php" method="post">
    <div class="log_in">
        <h1>Log in</h1>
        <label><span class="label">User name:</span>
            <input type="text" name="username" required>
        </label><br>
        <label><span class="label">Password:</span>
            <input type="password" name="password" required>
        </label><br>
        <input type="submit" value="Log in" name="submit" class="submit"><br>
        <p style="color: gray;font-size: 0.5em">Have no account?</p>
        <a href="Register.html">Register</a>
    </div>
</form>
<footer id="footer">
    <p>@肥仔阿亮</p>
    <p>Email:19302010061@fudan.edu.cn</p>
    <p>Tel:15901984704</p>
</footer>

</body>

</html>