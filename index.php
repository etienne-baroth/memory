<?php

error_reporting(E_ERROR | E_PARSE);

if(isset($_SESSION)) {
    session_unset();
    session_destroy(); 
} else {
    if (isset($_POST['start']) && (int) $_POST['start'] >= 2 && (int) $_POST['start'] <= 12) {
        session_start();
        $_SESSION['evenNb'] = (int) $_POST['start'];
        header('Location: game.php');
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memory Game</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>

<body>

    <div class="homepage">
        <div class="homepage-container">
            <h1>Memory India</h1>
            <?php if (isset($_POST['start']) && (gettype($_POST['start']) != 'integer' || $_POST['start'] > 12 || $_POST['start'] < 2)): ?>
            <p><i>Please type a number between 2 and 12</i></p>
            <?php endif;?>
            <h2>Please type a number between 2 and 12</h2>
            <form action="" method="post">
                <input type="text" name="start" class="start">
                <input type="submit" value="GO" class="start">
            </form>
        </div>
    </div>

</body>

</html>
