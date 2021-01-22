<?php
//1.POSTでid.bookname.bookurl.textを取得
$id      = $_POST['id'];
$name    = $_POST['bookname'];
$url     = $_POST['bookurl'];
$comment = $_POST['text'];

//2.データベース接続
try {
    //ID MAMP ='root'
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_php_lesson;charset=utf8;host=localhost', 'root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage()); //データベース接続ができないときのエラー表示
  }

//3.UPDATE gs_bm_table SET name= , url= , comment= , WHERE id= の順で書く
$sql = 'UPDATE gs_bm_table SET bookname=:bookname,bookurl=:url,comment=:text WHERE id=:id';
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':bookname', $name,    PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':url',  $url,     PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':text', $comment, PDO::PARAM_STR);  //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id',   $id,      PDO::PARAM_INT);  //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:".$error[2]);
  }else{
    //５．書き込みが成功したら、index.phpへリダイレクト
    header("Location: select.php");
  
  }
?>




<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>書籍データ登録画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php"> 書籍データ登録画面</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍データベース</legend>
     <label>書籍名:<input type="text" name="bookname" value = "<?=$row["bookname"]?>"></label><br>
     <label>書籍URL:<input type="text" name="bookurl" value = "<?=$row["bookurl"]?>"></label><br>
     <label>コメント:<textArea name="text" rows="4" cols="40">value = "<?=$row["text"]?>"</textArea></label><br>
     <input type="submit" value="登録"><br>
     <a href="select.php">リスト一覧へ</a>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>