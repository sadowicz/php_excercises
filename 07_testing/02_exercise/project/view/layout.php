<html>
<head>
    <title><?= $title ?? "Unnamed" ?></title>

    <link rel="stylesheet" type="text/css" href="style.css"/>
</head>
<body>
<?php require("old.php"); ?>
<?php require("menu.php"); ?>
<?php require("notice.php"); ?>

<?php require($file); ?>
</body>
</html>