<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>ユーザー登録</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <a class="navbar-brand" href="logout.php">ログアウト</a>
      <a class="navbar-brand" href="login.php">ログイン</a>
    </div>
  </nav>
</header>
<?php

  // 簡単なバリデーション。どれか空白（管理者チェックは空白ok）の場合、insert.phpから戻される。
  if ($_GET['err']) {
    echo ('<p class="text-danger">名前、ID、PWには必ず入力してください。</p>');
  }
  // 登録できた場合は↓
  if ($_GET['success']) {
      echo ('<p class="text-success">登録できました！</p>');
  }

?>



<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>ユーザー登録</legend>
     <label>名前  ：  <input type="text" name="name"></label><br>
     <label>ID  ：  <input type="text" name="lid"></label><br>
     <label>PW  ：  <input type="text" name="lpw"></label><br>
     <label>管理者  ：  <input type="checkbox" name="kanri_flg"></label><br> <!--insert.phpにif文。select.phpで表示 -->
     <input type="submit" value="ユーザー登録する"><br>
     <!-- <a href="bm_select.php"><input type="button" value="書籍一覧へ"></input></a><br>
     <a href="select.php"><input type="button" value="登録者一覧へ"></input></a> -->
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>