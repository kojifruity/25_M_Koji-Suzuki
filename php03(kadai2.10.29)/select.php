<?php
try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
  exit('DBConnectError:' . $e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();

//３．データ表示
$view = "";
if ($status == false) {
  //execute（SQL実行時にエラーがある場合）
  $error = $stmt->errorInfo();
  exit("ErrorQuery:" . $error[2]);
} else {
  //Selectデータの数だけ自動でループしてくれる
  //FETCH_ASSOC=http://php.net/manual/ja/pdostatement.fetch.php
  while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $view .= '<p>';
    $view .= '<a href="detail.php?id=' . $result["id"] . '">'; //?をつけるとGETで送るのと同じ意味。
    $view .= $result["kanri_flg"] . "：" . $result["name"] . "：" . $result["life_flg"];
    $view .= '</a>';
    $view .= '<a href="delete.php?id=' . $result["id"] . '">'; //?をつけるとGETで送るのと同じ意味。
    $view .= '    [ 削除 ]';
    $view .= '</a>';
    $view .= '</p>';
  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>登録データ【一覧】</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
    }
  </style>
</head>
<body id="main">
  <!-- Head[Start] -->
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <a class="navbar-brand" href="index.php">登録データ【一覧】</a>
        </div>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->
  <!-- Main[Start] -->
  <a href="index.php"><input type="button" value="〈新規登録〉画面へ"></a>
  <h4>☆内容を変更する場合は、変更したいリスト名をクリック</h4>
  <h4>※削除をクリックすると、即削除されますので、注意してください。データベースからも削除されます</h4>
  <div>
    <div class="container jumbotron"><?= $view ?></div>
  </div>
  <a href="index.php"><input type="button" value="〈新規登録〉画面へ"></a>
  <!-- Main[End] -->
</body>
</html>