<?php
session_start();
date_default_timezone_set("Europe/Samara");
include("core/dbconf.php");

@$act = $_GET['act'];
@$subact = $_GET['subact'];

// Блок функций, значимых для задания
function getUsersList() {
    global $db;
    return $db->query("select `email`,`password` from `users`")->fetch_all(MYSQLI_ASSOC);
}

function existsUser($login) {
    global $db;
    $result = $db->query("select `id` from `users` where `email` = '$login' limit 1");
    if ($result->num_rows>0) {
        return true;
    } else {
        return false;
    }
}

function checkPassword($login, $password) {
    global $db;
    $pwd = $db->query("select `password` from `users` where `email`='$login' limit 1");
    if ($pwd->num_rows<1) {return false;}
    if (password_verify($password, $pwd->fetch_assoc()['password'])) {return true;} else {return false;}
}

function getCurrentUser() {
    if (!userLoggedIn()) {return false;}
    global $db;
    $session = htmlspecialchars(trim($_COOKIE['session']));
    return $db->query("select `name` from `users` where `sessions` like '%$session%' limit 1")->fetch_assoc()['name'];
}
// Конец блока значимых для задания функций

function getConfVar($param) {
    global $db;
    $result = $db->query("select `value` from `config` where `parameter`='$param' limit 1");
    if ($result->num_rows>0) {
        return $result->fetch_assoc()['value'];
    }
    return "Param not found";
}

function isMainpage() {
    if (empty($_GET['act']) and empty($_GET['subact'])) {
        return true;
    }
    return false;
}

function userLoggedIn() {
    global $db;
    if (!isset($_COOKIE['session']) or $_COOKIE['session'] == "") {unset($_COOKIE['session']); return false;}
    $session = htmlspecialchars(trim($_COOKIE['session']));
    $result = $db->query("select * from `users` where `sessions` like '%$session%' limit 1");
    if ($result->num_rows<1) {unset($_COOKIE['session']); return false;}
    return true;
}

function tryToRegister() {
    global $db;
    $email = substr(htmlspecialchars(trim($_POST['email'])),0,150);
    $password = substr(trim($_POST['password']),0,250);
    $name = substr(htmlspecialchars(trim($_POST['name'])),0,100);
    $birthday = substr(htmlspecialchars(trim($_POST['birthday'])),0,10);
    if($email == "") {$_SESSION['regerror'] = "Пустой адрес электронной почты"; return;}
    if($password == "") {$_SESSION['regerror'] = "Пустой пароль"; return;}
    if($name == "") {$_SESSION['regerror'] = "Пустое имя"; return;}
    if($birthday == "") {$_SESSION['regerror'] = "Пустая дата рождения"; return;}
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {$_SESSION['regerror'] = "Некорректный формат адреса электронной почты"; return;}
    if(strtotime($birthday)<strtotime("-150 years")) {$_SESSION['regerror'] = "Люди столько не живут. Вы - рептилоид?"; return;}

    if (existsUser($email)) {
        $_SESSION['regerror'] = "Пользователь с указанным адресом почты уже существует";
        return;
    }
    $birthday = strtotime($birthday);
    $password = password_hash($password, PASSWORD_DEFAULT);
    $key = md5(md5($email.$name.$birthday.date("dmYHis").rand(-100000000,100000000)));
    $time = time();
    $session = json_encode([$key => $time]);
    if ($db->query("insert into `users` (`email`,`password`,`name`,`sessions`,`regdate`,`lastlogin`,`birthday`) values ('$email','$password','$name','$session','$time','$time','$birthday')")) {
        setCookie("session", $key, time()+30*24*60*60);
        header("Location: /profile");
    } else {
        $_SESSION['regerror'] = "Ошибка БД: ".$db->error;
        return;
    }
}

function tryToLogin() {
    global $db;
    $email = substr(htmlspecialchars(trim($_POST['email'])),0,150);
    $password = substr(trim($_POST['password']),0,250);
    if($email == "") {$_SESSION['loginerror'] = "Пустой адрес электронной почты"; return;}
    if($password == "") {$_SESSION['loginerror'] = "Пустой пароль"; return;}
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {$_SESSION['loginerror'] = "Некорректный формат адреса электронной почты"; return;}
    if(!existsUser($email)) {$_SESSION['loginerror'] = "Пользователя с указанным адресом почты не существует"; return;}
    $pwd = $db->query("select `password` from `users` where `email`='$email' limit 1")->fetch_assoc()['password'];
    if(!password_verify($password, $pwd)) {$_SESSION['loginerror'] = "Неверный пароль"; return;}

    $usr = $db->query("select `id`,`sessions` from `users` where `email` = '$email' limit 1")->fetch_assoc();
    $id = $usr['id'];
    $sessions = json_decode($usr['sessions'],true);
    foreach ($sessions as $key => $date) {
        if ($date<strtotime("-1 month")) {unset($sessions[$key]);}
    }
    $key = md5(md5($email.$name.$birthday.date("dmYHis").rand(-100000000,100000000)));
    $sessions[$key] = time();
    $sessions = json_encode($sessions);
    $time = time();
    if ($db->query("update `users` set `sessions` = '$sessions',`lastlogin` = '$time' where `id` = '$id' limit 1")) {
        setCookie("session",$key,time()+30*24*60*60);
        header("Location: /profile");
    } else {
        $_SESSION['loginerror'] = "Ошибка БД: ".$db->error;
        return;
    }
}

function tryToLogout() {
    global $db;
    $session = htmlspecialchars(trim($_COOKIE['session']));
    $user = $db->query("select `id`,`sessions` from `users` where `sessions` like '%$session%' limit 1")->fetch_assoc();
    $sessions = json_decode($user['sessions'],true);
    unset($sessions[$session]);
    $id = $user['id'];
    $sessions = json_encode($sessions);
    $db->query("update `users` set `sessions`='$sessions' where `id` = '$id' limit 1");
    setCookie("session","");
    header("Location: /");
}

if(isset($_POST['register_request'])) {
    tryToRegister();
}

if(isset($_POST['login_request'])) {
    tryToLogin();
}

$newuser = false; $bday = false; $totaldiscount = 0;

if (userLoggedIn()) {
    $session = htmlspecialchars(trim($_COOKIE['session']));
    $currentUser = $db->query("select * from `users` where `sessions` like '%$session%' limit 1")->fetch_assoc();

    $newuserdiscount = 0; $bdaydiscount = 0;
    if (date("d.m", $currentUser['birthday']) == date("d.m")) {$bdaydiscount = 5; $bday = true;}
    if ($currentUser['regdate']>=time()-24*60*60) {$newuser = true; $newuserdiscount = 10;}
    $totaldiscount = $newuserdiscount + $bdaydiscount;
}

if ($act == "logout") {
    tryToLogout();
}