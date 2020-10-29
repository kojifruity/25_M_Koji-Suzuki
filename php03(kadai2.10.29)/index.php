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
    <div class="navbar-header"><a class="navbar-brand" href="select.php">ユーザー登録</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
   <legend>ユーザー登録</legend>
     <label>名前：<input type="text" name="name"></label><br>
     <label>ID：<input type="text" name="lid"></label><br>
     <label>PW：<input type="text" name="lpw"></label><br>

     <input type="hidden" name="kanri_flg"  value="0"></label><br><!--0が一般社員、1が管理者で登録。detail.phpで判定-->
     <label>管理者：<input type="checkbox" name="kanri_flg" checked="checked" value="1"><!--0が一般社員、1が管理者で登録。detail.phpで判定-->
     
     <input type="hidden" name="life_flg"  value="0"></label><br> <!--0が現職、1が退職で登録。detail.phpで判定-->

     <input type="submit" value="登録"><br>
     <a href="select.php"><input type="button" value="一覧へ"></a>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>
</html>