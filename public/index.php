<?php

use App\Calculator;

require (__DIR__ . '/../vendor/autoload.php');
?>
<h1>Введите выражение для расчёта:</h1>
<form action="/"  method="post">
    <input type="text" name="expression">
    <input type="submit">
</form>

<?php
    if(!empty($_POST)) {
        $calculator = new Calculator();
        $expression = $_POST['expression'];
        echo '<h2>Введённое выражение: ' . $expression . '</h2>';
        echo '<h2>Итог: ' . $calculator->calculateExpression($_POST['expression']) . '</h2>';
    }
?>