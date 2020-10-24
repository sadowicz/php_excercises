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
    //Set up initial coords
    if(!isset($_SESSION["sx"])){
        $_SESSION["sx"] = 10;
    }

    if(!isset($_SESSION["sz"])){
        $_SESSION["sz"] = 10;
    }

    if(!isset($_SESSION["startX"])) {
        $_SESSION["startX"] = -1;
    }

    if(!isset($_SESSION["startZ"])) {
        $_SESSION["startZ"] = -1;
    }

    if(!isset($_SESSION["endX"])) {
        $_SESSION["endX"] = -1;
    }

    if(!isset($_SESSION["endZ"])) {
        $_SESSION["endZ"] = -1;
    }

    //Set up initial color
    $color = "gray";
    $colorFromPOST = "";

    //Get info from POST method
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST["sx"]) && isset($_POST["sz"])){
            $_SESSION["sx"] = $_POST["sx"];
            $_SESSION["sz"] = $_POST["sz"];
        }

        if(isset($_POST["color"])){
            setcookie("color", $_POST["color"], time() + (86400 * 2), "/");
            $color = $colorFromPOST = $_POST["color"];
        }
    }

    //Update color based on cookies
    if(isset($_COOKIE["color"]) && $colorFromPOST == ""){
        $color = $_COOKIE["color"];
    }

    //Set up patternArray

    if(!isset($_SESSION["patternArr"])){    // Initialize
        $_SESSION["patternArr"] = array_fill(0, $_SESSION["sz"],
            array_fill(0, $_SESSION["sx"], $color)); // 2D array with colors of each <a> block
    }
    else{   //when initialized
        for($row = 0; $row < $_SESSION["sz"]; $row++){
            for($col = 0; $col < $_SESSION["sx"]; $col++){
                if($_SESSION["patternArr"][$row][$col] != "white"){
                    $_SESSION["patternArr"][$row][$col] = $color;
                }
            }
        }
    }

    //Get info from GET method

    if($_SERVER["REQUEST_METHOD"] == "GET"){
        if(isset($_GET["x"]) && isset($_GET["z"])){
            if ($_SESSION["startX"] == -1 && $_SESSION["startZ"] == -1){
                $_SESSION["startX"] = $_GET["x"];
                $_SESSION["startZ"] = $_GET["z"];
            }
            else{
                $_SESSION["endX"] = $_GET["x"];
                $_SESSION["endZ"] = $_GET["z"];
            }
        }
    }

    //Pattern drawing

    if($_SESSION["startX"] != -1 && $_SESSION["startZ"] != -1 && $_SESSION["endX"] != -1 && $_SESSION["endZ"] != -1){
        // Draw line into patternArr:
        $x1 = $_SESSION["startX"];
        $z1 = $_SESSION["startZ"];

        $x2 = $_SESSION["endX"];
        $z2 = $_SESSION["endZ"];

        if($x1 <= $x2){
            $kx = 1;
            $dx = $x2 - $x1;
        }
        else{
            $kx = -1;
            $dx = $x1 - $x2;
        }

        if($z1 <= $z2){
            $kz = 1;
            $dz = $z2 - $z1;
        }
        else{
            $kz = -1;
            $dz = $z1 - $z2;
        }

        $_SESSION["patternArr"][$z1][$x1] = "white";

        if($dx >= $dz){
            $e = $dx / 2;
            for($i = 0; $i < $dx; $i++){
                $x1 += $kx;
                $e -= $dz;
                if($e < 0){
                    $z1 += $kz;
                    $e += $dx;
                }
                $_SESSION["patternArr"][$z1][$x1] = "white";
            }
        }
        else{
            $e = $dz / 2;
            for($i = 0; $i < $dz; $i++){
                $z1 += $kz;
                $e -= $dx;
                if($e < 0){
                    $x1 += $kx;
                    $e += $dz;
                }
                $_SESSION["patternArr"][$z1][$x1] = "white";
            }
        }

        //Reset line start and end coords to -1
        $_SESSION["startX"] = -1;
        $_SESSION["startZ"] = -1;
        $_SESSION["endX"] = -1;
        $_SESSION["endZ"] = -1;
    }

    //Draw chessboard

    for($rows = 0; $rows < $_SESSION["sz"]; $rows++){
        echo "<div>";
        for($cols = 0; $cols < $_SESSION["sx"]; $cols++){
            echo '<a class="block '.$_SESSION["patternArr"][$rows][$cols].'" href="?x='.$cols.'&z='.$rows.'"></a>';
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