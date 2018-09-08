<?php
//mysqliクラスのオブジェクトを作成
$mysqli = new mysqli('localhost','ebies','ebies001','test');
//if error
if($mysqli->connect_error){
  print("connected faled：".$mysqli->connected_error);
  exit();
}
//プリペアドステートメントを作成ユーザー入力する箇所は？にする
$stmt = $mysqli->prepare("INSERT INTO test (name,message)VALUES(?,?)");
//$_POST["name"]に名前、$_PODT["message"]に本文が格納
//?の位置に値を割り当てる
$stmt->bind_param('ss',$_POST['name'],$_POST["message"]);
//実行
$stmt->execute();

//datesテーブルから日付の降順でデータを取得
$result = $mysqli->query("SELECT*FROM test ORDER BY created DESC");
if($result){
  //１行づつ取り出し
  while($row = $result->fetch_object()){
    //エスケープして表示
    $name = htmlspecialchars($row->name);
    $message = htmlspecialchars($row->message);
    $created = htmlspecialchars($row->created);
    print("$name:$message($created)<br>");
  }
}
//切断
$mysqli->close();
 ?>
