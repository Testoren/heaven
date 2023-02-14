<?php
$email = $_POST['email'] or "test@test.ru";
$password = $_POST['password'] or "1111";
if ($password=="") {$password = "1111";}
?>

<div class="page_heading">
    Проверка функций
</div>
<div class="content loginpage container">

    <form method="post">
        <b>E-mail:</b>
        <br>
        <input type="text" name="email" placeholder="E-mail" value="<?=$email;?>"><br>
        <b>Пароль:</b>
        <br>
        <input type="text" name="password" placeholder="Пароль" value="<?=$password;?>">
        <input type="submit">
    </form>
<hr>

    Проверка функции getUsersList():<br>
    <? var_dump(getUsersList()); ?>
    <hr>

    Проверка функции existsUser("<?=$email;?>"): <br>
    <? var_dump(existsUser($email)); ?>
    <hr>

    Проверка функции checkPassword("<?=$email;?>", "<?=$password;?>"):<br>
    <? var_dump(checkPassword($email, $password)); ?>
    <hr>

    Проверка функции getCurrentUser():<br>
    <? var_dump(getCurrentUser()); ?>
</div>