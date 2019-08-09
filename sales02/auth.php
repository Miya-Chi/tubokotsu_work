<?php
session_start();
//セッションにアカウント情報がある場合
if(isset($_SESSION['USER'])){
//    認証処理
    $user = authCheck($_SESSION['user']['email'], $_SESSION['user']['password']);
    if(isset($user)){
//        ログインフラグをtrueにする
        $login = true;
//        セッションにユーザー情報を格納
        $_SESSION['user'] = $user;
    } else {
//        ログインフラグをfalseにする
        $login = false;
//        セッションを破棄
        unset($_SESSION['user']);
    }
//    セッションにアカウント情報がない場合
} else {
//    ログインフラグをfalseにする
    $login = false;
}