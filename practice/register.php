<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');

//read to auth.php
require_once("auth.php");
$mysqli = connect_mysql();

//initialize status
$status = "none";

if(!empty($_POST["mail"])&& !empty($_POST["password"])){
  //正規表現でメールアドレスのチェック（簡易版）
  if (!preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/',$_POST["mail"]))
    $status = "error_mail";
  //check to PASSWORD
  elseif(!preg_match('/^[0-9a-zA-Z]{8,32}$/',$_POST["password"]))
    $status = "error_password";
  else{
    //passwordのハッシュ化
    $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
    //ユーザー入力を使用するのでプリぺアドステートメントの利用
    $stmt = $mysqli->prepare("INSERT INTO usersInfo VALUES(?,?)");
    $stmt->bind_param('ss',$_POST["mail"],$password);

      if($stmt->execute())
        $status = "ok";
      else
        //既に存在するユーザー名だった場合はINSERTを失敗にする
        $status = "failed";
  }
}
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <title>新規登録</title>
  <script src="http://code.jquery.com/jquery-2.0.0.min.js"></script>
  <script src="register_check.js"></script>
</head>
<body>
  <h1>新規登録</h1>
  <?php if($status == "ok"): ?>
    <p>登録完了</p>
  <?php elseif($status == "failed"): ?>
    <p>エラー：既に存在するユーザー名です</p>
  <?php elseif($status == "none"): ?>
    <form method = "POST" action = "register.php">
      ユーザー名：<input type="text" name="mail"/>
      パスワード:<input type="password" name="password"/>
      <input type="submit" value="登録"/>
    </form>
  <?php else: ?>
    <!--PHPでのエラーチェック-->
    <p>入力が正しくありません。<br>再度入力を行ってください。</p>
  <?php endif;?>
</body>
</html>
