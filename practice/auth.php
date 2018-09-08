<?php
//認証ファイルに必要な機能をまとめたファイル

function connect_mysql(){
  return new mysqli('localhost','ebies','ebies001','test');
}
 ?>
