<?php

use App\Calculator;

require (__DIR__ . '/../vendor/autoload.php');

$calculator = new Calculator();
$calculator->calculateExpression($_POST['expression']);
?>
<h1>Введите выражение для расчёта:</h1>
<form action="/"  method="post">
    <input type="text" name="expression">
    <input type="submit">
</form>
