<?php
error_reporting(-1);
ini_set("display_errors", "On");
session_start();
?>
<html lang="en">
<head>
    <title>Superglobals</title>

    <style type="text/css">
        .block {
            display: inline-block;
            width: 30px;
            height: 30px;
            padding: 0;
            margin: 0;
        }

        .block:hover {
            background-color: lightgray;
        }

        .red {
            background-color: red;
        }

        .blue {
            background-color: blue;
        }

        .green {
            background-color: green;
        }

        .gray {
            background-color: gray;
        }

        .white {
            background-color: white;
        }
    </style>
</head>
<body>

<?php

    if(!isset($_SESSION["sx"])){
        $_SESSION["sx"] = 10;
    }

    if(!isset($_SESSION["sz"])){
        $_SESSION["sz"] = 10;
    }

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["sx"]) && isset($_POST["sz"])){
            $_SESSION["sx"] = $_POST["sx"];
            $_SESSION["sz"] = $_POST["sz"];
        }

        if(isset($_POST["color"])){
            setcookie("color", $_POST["color"], time() + (86400 * 2), "/");
        }
    }

    $color = "gray";
    if(isset($_COOKIE["color"])){
        //setcookie("color", "gray", time() + (86400 * 2), "/");
        $GLOBALS["color"] = $_COOKIE["color"];
    }

    for($rows = 0; $rows < $_SESSION["sz"]; $rows++){
        echo "<div>";
        for($cols = 0; $cols < $_SESSION["sx"]; $cols++){
            echo "<a class=\"block ".$GLOBALS["color"]."\" href=\"?x=".$cols."&z=".$rows."\"></a>";
        }
        echo "</div>";
    }
?>
<br/>
<form method="post">
    <label>
        Columns:
        <input type="text" name="sx">
    </label>
    <label>
        Rows:
        <input type="text" name="sz">
    </label>
    <input type="submit" value="Change">
</form>

<form method="post">
    <label>
        Color:
        <select name="color">
            <option value="gray">Gray</option>
            <option value="red">Red</option>
            <option value="green">Green</option>
            <option value="blue">Blue</option>
        </select>
    </label>
    <input type="submit" value="Change">
</form>

</body>
</html>