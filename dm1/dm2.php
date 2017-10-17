<?php
/*----------------Считывание ввода----------------------*/
define("K_nu", 1.6);
define("K_tao", 1.4);
define("K_f", 1.05);
define("K_sigma", 1.5);
define("K_tao_d", 0.7);
define("K_sigma_b", 0.81);
define("P_tabl", 2);
define("sigma_b", 400);
$P = $_POST['P'];
$T1 = $_POST['T1'];
$T2 = $_POST['T2'];
$n1 = $_POST['n1'];
$n2 = $_POST['n2'];
$l1 = $_POST['l1'];
$l2 = $_POST['l2'];
$d1 = $_POST['d1'];
$d2 = $_POST['d2'];
/*-------------------------------------------------------*/

/*----------------Общие вычисления для 2-х колес------------*/
$F_t1 = (2 * $T1) / ($d1 * 0.001);
$F_t2 = (2 * $T2) / ($d2 * 0.001);
$F_r1 = $F_t1 * 0.363970;
$F_r2 = $F_t2 * 0.363970;
$R_a = pow(((pow($F_r1, 2)) + (pow($F_r2, 2))), 1 / 2);
/*-------------------------------------------------------*/

/*----------------ПРОВЕРКА ДИАМЕТРОВ для 2-х колес------------*/
$d2 = 130 * pow(($P / $n1), 0.333333);
$d4 = 130 * pow(($P / $n2), 0.333333);
    if ($d2 >= 20 || $d2 < 30){
        $d = 25;
    }
    elseif ($d2 >= 30 || $d2 < 40){
        $d = 35;
    }
    elseif ($d2 >= 40 || $d2 < 50){
        $d = 45;
    }
    elseif ($d2 >= 50 || $d2 < 60){
        $d = 55;
    }
    elseif ($d2 >= 60 || $d2 < 70){
        $d = 65;
    }
    elseif ($d2 >= 70 || $d2 < 80){
        $d = 75;
    }
    elseif ($d2 >= 80 || $d2 < 90){
        $d = 85;
    }
    elseif ($d2 >= 90 || $d2 < 100){
        $d = 95;
    }


    if ($d4 >= 22 ||  $d4 < 30){
        $d3 = 25;
    }
    elseif ($d4 >= 30 ||  $d4 < 40){
        $d3 = 35;
    }
    elseif ($d4 >= 40 ||  $d4 < 50){
        $d3 = 45;
    }
    elseif ($d4 >= 50 ||  $d4 < 60){
        $d3 = 55;
    }
    elseif ($d4 >= 60 ||  $d4 < 70){
        $d3 = 65;
    }
    elseif ($d4 >= 70 ||  $d4 < 80){
        $d3 = 75;
    }
    elseif ($d4 >= 80 ||  $d4 < 90){
        $d3 = 85;
    }
    elseif ($d4 >= 90 ||  $d4 < 100){
        $d3 = 95;
    }
/*-------------------------------------------------------*/

$sigma_sk = ($R_a * (($l1 + $l2) / 2)) / (0.1 * pow($d, 3));
/*---------------------------------------------------------*/

/*----------------Вычисление для 1-го колеса)------------*/
$tao_kr11 = $T1 / (0.2 * pow($d, 3) * pow(10, -3));
/*-------------------------------------------------------*/

/*----------------Вычисление для 2-го колеса)------------*/
$tao_kr12 = $T2 / (0.2 * pow($d3, 3) * pow(10, -3));
/*-------------------------------------------------------*/

/*----------------Общие вычисления для 2-х колес------------*/
$sigma_minus_1 = 0.55 * sigma_b;
$tao_minus_1 = 0.6 * $sigma_minus_1;
$K_sigma_d = (1 / K_nu) * ((K_sigma / K_sigma_b) * (K_f + 1));
$P_sigma_1 = $sigma_minus_1 / ($K_sigma_d * $sigma_sk);
/*-------------------------------------------------------*/

/*----------------Вычисление для 1-го колеса)------------*/
$P_tao_11 = $tao_minus_1 / (K_tao_d * $tao_kr11);
$P11 = ($P_sigma_1 * $P_tao_11) / (sqrt(pow($P_sigma_1, 2) + pow($P_tao_11, 2)));
/*-------------------------------------------------------*/

/*----------------Вычисление для 2-го колеса)------------*/
$P_tao_12 = $tao_minus_1 / (K_tao_d * $tao_kr12);
$P12 = ($P_sigma_1 * $P_tao_12) / (sqrt(pow($P_sigma_1, 2) + pow($P_tao_12, 2)));
/*-------------------------------------------------------*/
if ($P11 >= P_tabl) {
    $result1 = 'Все посчитано верно,d1 = ' . $d;
} else $result1 = 'Все посчитано не верно';

if ($P12 >= P_tabl) {
    $result2 = 'Все посчитано верно,d2 = ' . $d3;
} else $result2 = 'Все посчитано не верно';

?>


<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Лабораторная работа №3</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h3>Ввод исходных данных</h3>
    <form action="" method="POST" name="form">
        <div class="col-md-4">
            <!-------------------ВВОД ДАННЫХ------------>
            <label>P = <input type="text" name="P" value="<?= $_POST['P'] ?>" required></label>
            <label>T1 = <input type="text" name="T1" value="<?= $_POST['T1'] ?>" required></label>
            <label>T2 = <input type="text" name="T2" value="<?= $_POST['T2'] ?>" required></label>
            <label>n1 = <input type="text" name="n1" value="<?= $_POST['n1'] ?>" required></label>
            <label>n2 = <input type="text" name="n2" value="<?= $_POST['n2'] ?>" required></label>
            <label>l1 = <input type="text" name="l1" value="<?= $_POST['l1'] ?>" required></label>
            <label>l2 = <input type="text" name="l2" value="<?= $_POST['l2'] ?>" required></label>
            <label>d1 = <input type="text" name="d1" value="<?= $_POST['d1'] ?>" required></label>
            <label>d2 = <input type="text" name="d2" value="<?= $_POST['d2'] ?>" required></label>
            <p><input type="submit" class="btn btn-primary" value="Расчет"/></p>
        </div>
        <div class="col-md-4">
            <!--------------------РАССЧЕТЫ-------------->
            <p>Расчеты диаметра для 1-го колеса </p>
            <pre>F_t1 = <?= $F_t1 ?></pre>
            <pre>F_t2 = <?= $F_t2; ?></pre>
            <pre>F_r1 = <?= $F_r1 ?></pre>
            <pre>F_r2 = <?= $F_r2; ?> </pre>
            <pre>R_a= <?= $R_a; ?> </pre>
            <pre>sigma_sk = <?= $sigma_sk; ?> </pre>
            <pre>tao_kr11= <?= $tao_kr11 ?></pre>
            <pre>sigma_minus_1= <?= $sigma_minus_1 ?></pre>
            <pre>tao_minus_1= <?= $tao_minus_1 ?></pre>
            <pre>K_sigma_d= <?= $K_sigma_d ?></pre>
            <pre>P_sigma_1= <?= $P_sigma_1 ?></pre>
            <pre>P_tao_11= <?= $P_tao_11 ?></pre>
            <pre>P_11= <?= $P11 ?></pre>
            <pre>Результат:<?= $result1 ?></pre>
        </div>
        <div class="col-md-4">
            <p>Расчеты диаметра для 2-го колеса </p>
            <pre>F_t1 = <?= $F_t1 ?></pre>
            <pre>F_t2 = <?= $F_t2; ?></pre>
            <pre>F_r1 = <?= $F_r1 ?></pre>
            <pre>F_r2 = <?= $F_r2; ?> </pre>
            <pre>R_a= <?= $R_a; ?> </pre>
            <pre>sigma_sk = <?= $sigma_sk; ?> </pre>
            <pre>tao_kr12= <?= $tao_kr12 ?></pre>
            <pre>sigma_minus_1= <?= $sigma_minus_1 ?></pre>
            <pre>tao_minus_1= <?= $tao_minus_1 ?></pre>
            <pre>K_sigma_d= <?= $K_sigma_d ?></pre>
            <pre>P_sigma_1= <?= $P_sigma_1 ?></pre>
            <pre>P_tao_12= <?= $P_tao_12 ?></pre>
            <pre>P_12= <?= $P12 ?></pre>
            <pre>Результат:<?= $result2 ?></pre>
        </div>
    </form>
</div>
<script src="http://test/dm1/js/jquery.min.js"></script>
<script src="http://test/dm1/js/bootstrap.min.js"></script>
</body>
</html>
