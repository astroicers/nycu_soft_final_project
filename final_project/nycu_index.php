<form method="post" action="./register.php">
account: <input type="text" name="account"/><br>
password: <input type="text" name="password"/><br>
<input type="submit" value="register"/>
</form>
<br><br>
<form method="post" action="./login.php">
account: <input type="text" name="account"/><br>
password: <input type="text" name="password"/><br>
<input type="hidden" name="update" value="0">
<input type="submit" value="login"/>
</form>