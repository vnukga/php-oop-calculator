<?php
if(!empty($_POST)) {
    var_dump($_POST);
}
?>
<h1>Введите выражение для расчёта:</h1>
<form action="/">
    <input type="text" name="expression">
    <input type="submit">
</form>
