<?php

error_reporting(E_ERROR | E_PARSE);
include('Card.php');
session_start();

if(!isset($_SESSION['count'])) {
    $_SESSION['count'] = 0;
} else {
    $_SESSION['count']++; 
}


if (!isset($_SESSION['order'])) {
    $_SESSION['order'] = [];

    for ($i = 0; $i < $_SESSION['evenNb']*2; $i++) {
        array_push($_SESSION['order'], $i);
    }
    
    shuffle($_SESSION['order']);    
}

if (isset($_POST['adduser'])) {
    adduser($_POST['username'], $_COOKIE['score']);
    showScore();    
}

$cards = [];

for ($i = 0; $i < $_SESSION['evenNb']*2; $i++) {
    $f = $i + 1;
    $cards[$i] = new Card($i, './img/img'.$i.'.jpg', 'https://images.unsplash.com/photo-1517330357046-3ab5a5dd42a1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTB8fGluZGlhfGVufDB8MXwwfHw%3D&auto=format&fit=crop&w=800&q=60');
    $cards[$f] = new Card($f, './img/img'.$i.'.jpg', 'https://images.unsplash.com/photo-1517330357046-3ab5a5dd42a1?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxzZWFyY2h8MTB8fGluZGlhfGVufDB8MXwwfHw%3D&auto=format&fit=crop&w=800&q=60');
    $i++;     
}

function verify($key, $evenNb)
{
    if (strlen($key) == 5) {
        $charToVerify = (int) $key[-1];

        if ($charToVerify % 2 != 0) {
            $lastChar = (int) $key[-1] + 1;
            $val = substr($key, 0, -1);
            $cellUp = $val . $lastChar;

            if (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                (!isset($_SESSION['verify']) || $_SESSION['verify'] != 'stanby')
            ) {
                $_SESSION[$key] = 'on';
                $_SESSION['verify'] = 'stanby';
            } elseif (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                isset($_SESSION['verify']) && $_SESSION['verify'] == 'stanby' &&
                isset($_SESSION[$cellUp]) && $_SESSION[$cellUp] == 'on'
            ) {
                $_SESSION[$key] = 'on';
                $_SESSION['verify'] = '';
            } elseif (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                isset($_SESSION['verify']) && $_SESSION['verify'] == 'stanby' &&
                ((isset($_SESSION[$cellUp]) && $_SESSION[$cellUp] != 'on') || !isset($_SESSION[$cellUp]))
            ) {

                for ($i = 1; $i <= $evenNb * 2; $i++) {
                    $_SESSION['cell' . $i] = '';
                }

                $_SESSION['verify'] = '';
            }

            if (
                isset($_SESSION[$key]) && $_SESSION[$key] == 'on' &&
                isset($_SESSION[$cellUp]) && $_SESSION[$cellUp] == 'on'
            ) {
                $_SESSION['corr' . $charToVerify . $lastChar] = 'yes';
            }

        } else {
            $lastChar = (int) $key[-1] - 1;
            $val = substr($key, 0, -1);
            $cellDown = $val . $lastChar;

            if (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                (!isset($_SESSION['verify']) || $_SESSION['verify'] != 'stanby')
            ) {
                $_SESSION[$key] = 'on';
                $_SESSION['verify'] = 'stanby';
            } elseif (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                isset($_SESSION['verify']) && $_SESSION['verify'] == 'stanby' &&
                isset($_SESSION[$cellDown]) && $_SESSION[$cellDown] == 'on'
            ) {
                $_SESSION[$key] = 'on';
                $_SESSION['verify'] = '';
            } elseif (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                isset($_SESSION['verify']) && $_SESSION['verify'] == 'stanby' &&
                ((isset($_SESSION[$cellDown]) && $_SESSION[$cellDown] != 'on') || !isset($_SESSION[$cellDown]))
            ) {

                for ($i = 1; $i <= $evenNb * 2; $i++) {
                    $_SESSION['cell' . $i] = '';
                }

                $_SESSION['verify'] = '';
            }

            if (
                isset($_SESSION[$key]) && $_SESSION[$key] == 'on' &&
                isset($_SESSION[$cellDown]) && $_SESSION[$cellDown] == 'on'
            ) {
                $_SESSION['corr' . $lastChar . $charToVerify] = 'yes';
            }
        }
    } elseif (strlen($key) == 6) {
        $charToVerify = (int) $key[-2]. (int) $key[-1];

        if ($charToVerify % 2 != 0) { 
            $lastChar = $charToVerify + 1;
            $val = substr($key, 0, -2);
            $cellUp = $val . $lastChar;

            if (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                (!isset($_SESSION['verify']) || $_SESSION['verify'] != 'stanby')
            ) {
                $_SESSION[$key] = 'on';
                $_SESSION['verify'] = 'stanby';
            } elseif (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                isset($_SESSION['verify']) && $_SESSION['verify'] == 'stanby' &&
                isset($_SESSION[$cellUp]) && $_SESSION[$cellUp] == 'on'
            ) {
                $_SESSION[$key] = 'on';
                $_SESSION['verify'] = '';
            } elseif (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                isset($_SESSION['verify']) && $_SESSION['verify'] == 'stanby' &&
                ((isset($_SESSION[$cellUp]) && $_SESSION[$cellUp] != 'on') || !isset($_SESSION[$cellUp]))
            ) {

                for ($i = 1; $i <= $evenNb * 2; $i++) {
                    $_SESSION['cell' . $i] = '';
                }

                $_SESSION['verify'] = '';
            }

            if (
                isset($_SESSION[$key]) && $_SESSION[$key] == 'on' &&
                isset($_SESSION[$cellUp]) && $_SESSION[$cellUp] == 'on'
            ) {
                $_SESSION['corr' . $charToVerify . $lastChar] = 'yes';
            }

        } else {
            $lastChar = $charToVerify - 1;
            $val = substr($key, 0, -2);
            $cellDown = $val . $lastChar;

            if (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                (!isset($_SESSION['verify']) || $_SESSION['verify'] != 'stanby')
            ) {
                $_SESSION[$key] = 'on';
                $_SESSION['verify'] = 'stanby';
            } elseif (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                isset($_SESSION['verify']) && $_SESSION['verify'] == 'stanby' &&
                isset($_SESSION[$cellDown]) && $_SESSION[$cellDown] == 'on'
            ) {
                $_SESSION[$key] = 'on';
                $_SESSION['verify'] = '';
            } elseif (
                isset($_POST[$key]) && $_POST[$key] == $key &&
                isset($_SESSION['verify']) && $_SESSION['verify'] == 'stanby' &&
                ((isset($_SESSION[$cellDown]) && $_SESSION[$cellDown] != 'on') || !isset($_SESSION[$cellDown]))
            ) {

                for ($i = 1; $i <= $evenNb * 2; $i++) {
                    $_SESSION['cell' . $i] = '';
                }

                $_SESSION['verify'] = '';
            }

            if (
                isset($_SESSION[$key]) && $_SESSION[$key] == 'on' &&
                isset($_SESSION[$cellDown]) && $_SESSION[$cellDown] == 'on'
            ) {
                $_SESSION['corr' . $lastChar . $charToVerify] = 'yes';
            }
        }
    }
}

function isEnd() {
    $corrNumber = 0;

    for ($i = 1; $i <= $_SESSION['evenNb']*2; $i = $i + 2) {
        $f = $i + 1;
        $verifVar = 'corr' . $i . $f;
        if ($_SESSION[$verifVar] == 'yes') {
            $corrNumber++;
        }        
    }
    
    if ($corrNumber == $_SESSION['evenNb']) {
        $_SESSION['end'] = 'yes';
        setcookie('score', round($_SESSION['evenNb'] / ($_SESSION['count'] != 0 ? $_SESSION['count'] : 1)  * 100));
    }
}

function adduser($username, $final) {    
    $mysqli = new mysqli('localhost', 'root', '', 'memory');
    $query = "INSERT INTO topscore (id, name, score) VALUES (null, '$username', '$final')";
    $mysqli->query($query);    
}

function showScore() {
    $mysqli = new mysqli('localhost', 'root', '', 'memory');
    $query = "SELECT name, score FROM topscore ORDER BY score DESC LIMIT 10";
    $result = $mysqli->query($query);
    $result = $result->fetch_all();
    return $result;
}


foreach ($_POST as $key => $val) {
    verify($val, $_SESSION['evenNb']); 
}

isEnd();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Game</title>
    <link rel="stylesheet" href="./style/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>

<body>     

    <?php if ($_SESSION['end'] == 'yes'):
        $finalCount = (int) round($_SESSION['evenNb'] / ($_SESSION['count'] != 0 ? $_SESSION['count'] : 1)  * 100); 
        session_unset();
        session_destroy();
        session_abort();
        session_register_shutdown(); ?>

        <div class="end-game__container">

            <div class="end-ann_container">
                <h1>CONGRATS !</h1>
                <?php if ($finalCount != 0): ?>
                <h3>Your score : <?=$finalCount?></h3>
                <div class="end-ann_container__add-block">
                    <form action="" method="post">
                        <h4>Please enter your name : </h4>
                        <input type="text" name="username">
                        <input type="submit" class="restart" name="adduser" value="Add User">
                    </form>
                </div>                
                <?php endif;?>                 
                <div class="end-ann_container__btn-block">
                    <form action="index.php" method="post">
                        <input type="submit" class="restart" name="reset" value="LET'S DO IT AGAIN">
                    </form>
                </div>
                <div class="topscorers">
                    <h4>Top Score : </h4>
                    <ul>
                        <?php foreach (showScore() as $val): ?>
                            <li>                                
                                <span><?=$val[0]?></span><span><?=$val[1]?></span>
                            </li>
                        <?php endforeach;?>
                    </ul>
                </div>
            </div>

        </div>

</body>

    <?php else: ?>

    <div>                
        <div class="game">    
            <?php foreach ($cards as $key=>$val): ?>

            <div class="game-cell" style="order: <?=$_SESSION['order'][$key]?>;">
                <form action="" method="post" style="<?= isset($_SESSION[$val->generateNum()]) && $_SESSION[$val->generateNum()] == 'yes' ? 'display: none' : ''?>">
                    <input type="submit" name=<?=$val->cellNumber()?> value=<?=$val->cellNumber()?>>
                </form>

                <?php if(!isset($_SESSION[$val->cellNumber()]) || ( $_SESSION[$val->cellNumber()] == '' && $_SESSION[$val->generateNum()] != 'yes')):?>
                <div class="game-cell__img1">
                    <img src=<?=$val->backSide?> alt="">
                </div>

                <?php elseif((isset($_SESSION[$val->generateNum()]) && $_SESSION[$val->generateNum()] == 'yes') || $_SESSION[$val->cellNumber()] == 'on'): ?>
                <div class="game-cell__img2">
                    <img src=<?=$val->img?> alt="">
                </div>
                
                <?php endif; ?> 
            </div>

            <?php endforeach;?>
        </div>        
    </div>
    <?php endif; ?>

</body>

</html>