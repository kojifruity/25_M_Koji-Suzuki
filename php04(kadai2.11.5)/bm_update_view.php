<?php
//GETでid値を取得
$id = $_GET['id'];
// echo $id;
// exit;

//２．データベース接続
try {
    //ID MAMP ='root'
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root');
  } catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage()); //データベース接続ができないときのエラー表示
  }

//３．データ更新
$sql = "SELECT * FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT);
$status = $stmt->execute();

//4．データ表示
$view = "";
if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:" . $error[2]);

} else {
    $row = $stmt->fetch();  // 1データのみの抽出の場合はwhileループで取り出さない
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>書籍データ【更新】画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php"> 書籍データ【更新】</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>書籍データ【更新】</legend>
     <label>書籍名:<input type="text" name="bookname" value = "<?=$row["bookname"]?>"></label><br>
     <label>書籍URL:<input type="text" name="bookurl" value = "<?=$row["bookurl"]?>"></label><br>
     <label>コメント:<textArea name="text" rows="4" cols="40"><?=$row["comment"]?></textArea></label><br>
     <input type="hidden" name="id" value="<?=$row["id"]?>">
     <input type="submit" value="更新する"><br>
     <a href="bm_select.php"><input type="button" value="リスト一覧へ"></a>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>