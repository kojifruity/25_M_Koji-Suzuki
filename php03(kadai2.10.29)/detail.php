<?php
// require_once("funcs.php"); //funcs.phpから読み込むよの意味。
//GETでid値を取得
$id = $_GET['id'];
// echo $id;
// exit;

// $pdo = db_conn();

//２．データベース接続
try {
    //ID MAMP ='root'
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root');
  } catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage()); //データベース接続ができないときのエラー表示
  }

//３．データ更新
// $sql = "SELECT * FROM gs_user_table WHERE id=:id";
// $stmt = $pdo->prepare($sql);
// $stmt->bindValue(':id',$id, PDO::PARAM_INT);
// $status = $stmt->execute();

$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=" .$id);
$status = $stmt->execute();

//4．データ表示
$view = "";
if ($status == false) {
  $error = $stmt->errorInfo();
  exit("ErrorQuery:" . $error[2]);  //execute（SQL実行時にエラーがある場合）

} else {
    $result = $stmt->fetch();  // 1データのみの抽出の場合はwhileループで取り出さない
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録【更新】画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body>

<!-- Head[Start] -->
<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="index.php"> データ登録【更新】</a></div>
    </div>
  </nav>
</header>
<!-- Head[End] -->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>データ登録【更新】</legend>
    <label>名前：<input type="text" name="name" value=<?= $result['name'] ?>></label><br>
     <label>ID：<input type="text" name="lid" value=<?= $result['lid'] ?>></label><br>
     <label>PW：<input type="text" name="lpw" value=<?= $result['lpw'] ?>></label><br>
     <label>管理者：<input type="checkbox" name="kanri_flg"  <?= $result['kanri_flg']==1 ? 'checked' : ''?>></label><br>
            <!-- ↑ 0が一般社員、1が管理者で、phpの部分で処理-->
     <label>退職<input type="checkbox" name="life_flg"  <?= $result['life_flg']==0 ? '' : '' ?> ></label><br>
            <!-- ↑ 0が現職、1が退職で、phpの部分で処理-->

     <input type="hidden" name="id" value=<?= $result['id'] ?>><br>

     <input type="submit" value="更新"><br>
     <a href="select.php"><input type="button" value="一覧へ"></a>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>
<!-- 
<?php if($_POST['kanri_flg'] == 1){echo 'checked="checked"';}?> -->