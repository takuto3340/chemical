<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8"/>
  <link rel="stylesheet" type="text/css" href="style.css">
  <title>POSTsample</title>
</head>
<body>
  <?php
  //commentがPOSTされているなら
  if(isset($_POST["comment"])){
    //エスケープしてから表示
    $comment = htmlspecialchars($_POST["comment"]);
    print("あなたのコメントは「${comment}です。");
  }else{
  ?>
    <p>コメントください</p>
    <div class="form">
      <form method = "POST" action = "post.php">
        <input name= "name" placeholder="名前"/><br>
        <input name = "comment" placeholder="comment"><br>
        <input class="btn" type = "submit" value = "送信"/>
      </form>
    </div>
  <?php
  }
   ?>
 </body>
</html>
