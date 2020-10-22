<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>書籍データ〈新規登録〉画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php"> 書籍データ〈新規登録〉</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍データ〈新規登録〉</legend>
     <label>書籍名　:　　<input type="text" name="bookname" value = "<?=$row["bookname"]?>"></label><br>
     <label>書籍URL　:　<input type="text" name="bookurl" value = "<?=$row["bookurl"]?>"></label><br>
     <label>コメント:<br><textArea name="text" rows="4" cols="40" value = "<?=$row["comment"]?>"></textArea></label><br>
     <input type="submit" value="登録する"><br>
     <a href="select.php"><input type="button" value="リスト一覧を見る"></input></a>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
