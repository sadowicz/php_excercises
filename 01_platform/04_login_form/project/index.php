<!DOCTYPE HTML>
<html>
    <body>
        <?php
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $user = $_POST["usr"];
            $password = $_POST["passwd"];

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
                <label for="usr">User: </label>
                <input type="text" id="usr" name="usr"><br>
                <label for="passwd">Password: </label>
                <input type="password" id="passwd" name="passwd"><br>
                <input type="submit" value="Login">
            </form>';
        }
        ?>
    </body>
</html>

