<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>書籍〈新規登録〉画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <a class="navbar-brand" href="bm_index.php">書籍一覧</a>
      <a class="navbar-brand" href="index.php">ユーザー登録</a>
      <a class="navbar-brand" href="select.php">登録者一覧</a>
      <a class="navbar-brand" href="login.php">ログイン</a>
      <a class="navbar-brand" href="logout.php">ログアウト</a>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍データ〈新規登録〉</legend>
     <label>書籍名  :    <input type="text" name="bookname" value = "<?=$row["bookname"]?>"></label><br>
     <label>書籍URL  :  <input type="text" name="bookurl" value = "<?=$row["bookurl"]?>"></label><br>
     <label>コメント:<br><textArea name="text" rows="4" cols="40" value = "<?=$row["comment"]?>"></textArea></label><br>
     <input type="submit" value="書籍登録する"><br>
     <a href="select.php"><input type="button" value="書籍一覧を見る"></input></a>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
