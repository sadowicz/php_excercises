<!DOCTYPE HTML>
<html>
    <body>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $user = $_POST["user"];
            $password = $_POST["password"];

            if($user == "" || $password == "")
            {
                echo 'EMPTY';
            }
            elseif($user != "foo" || $password != "foo123")
            {
                echo 'ERROR';
            }
            else
            {
                echo 'OK';
            }
        }
        else
        {
            echo '
            <form method="post" action="'.htmlspecialchars($_SERVER["PHP_SELF"]).'">
                <label for="user">User: </label>
                <input type="text" id="user" name="user"><br>
                <label for="password">Password: </label>
                <input type="password" id="password" name="password"><br>
                <input type="submit" value="Login">
            </form>';
        }
        ?>
    </body>
</html>

