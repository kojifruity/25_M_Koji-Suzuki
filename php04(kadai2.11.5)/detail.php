<?php
session_start();
include("funcs.php");
loginCheck();

require_once("funcs.php"); //funcs.phpから読み込むよの意味。
$pdo = db_conn();
$id = $_GET['id'];

// 編集処理の際に、エラーが有る場合は↓の処理
if ($_GET['err']) {
  $err = $_GET['err'];
}

//２．データ登録SQL作成
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
<?php
    // 編集処理の際に、エラーが有る場合は↓の処理
    if ($_GET['err']) {
        echo '<p class="text-danger">名前 / ID / PWは、何か入力してください</p>';
    }
    ?>

<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
    <legend>データ登録【更新】</legend>
    <label>名前：<input type="text" name="name" value=<?= $result['name'] ?>></label><br>
     <label>ID：<input type="text" name="lid" value=<?= $result['lid'] ?>></label><br>
     <label>PW：<input type="text" name="lpw" value=<?= $result['lpw'] ?>></label><br>

     <label>管理者：<input type="checkbox" name="kanri_flg" value="1"  <?php if ($result['kanri_flg']) {
      echo 'checked';
     }?>></label><br>

     <label>退職<input type="checkbox" name="life_flg" value="1" <?php if ($result['life_flg']) {
       echo 'checked';
     }?> ></label><br>

     <input type="hidden" name="id" value=<?= $result['id'] ?>><br>

     <input type="submit" value="更新"><br>
     <a href="select.php"><input type="button" value="一覧へ"></a>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->


</body>
</html>