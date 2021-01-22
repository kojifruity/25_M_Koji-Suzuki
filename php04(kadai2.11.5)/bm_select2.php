<?php
session_start();
include("funcs.php");
loginCheck(); //funcs.phpにあるLogin認証チェック関数


try {
  //ID MAMP ='root'
  //Password:MAMP='root',XAMPP=''
  $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root', 'root');
} catch (PDOException $e) {
  exit('DBConnectError:' . $e->getMessage());
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("select * from gs_bm_table");
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
    $view .= '<tr>';   //.=(ピリオドイコール)は、データを追加して表示。（つまり、データの上書きをしない。イコールだけだと、上書き。最新のデータだけ表示される）
      if ($result["kanri_flg"]) { //表示されるが、更新のリンクはない。
        $view .= '<td>';
        $view .= $result["indate"];
        $view .= '</td>';
      }else{
        $view .= '<td>';
        $view .= $result["indate"];
        $view .= '</td>';
      }

      if ($result["kanri_flg"]) { //表示されるが、更新のリンクはない。
        $view .= '<td>';
        $view .= $result["bookname"];
        $view .= '</td>';
      }else{
        $view .= '<td>';
        $view .= $result["bookname"];
        $view .= '</td>';
      }

      if ($result["kanri_flg"]) { //表示されるが、更新のリンクはない。
        $view .= '<td>';
        $view .= $result["comment"];
        $view .= '</td>';
      }else{
        $view .= '<td>';
        $view .= $result["comment"];
        $view .= '</td>';
      }
      
      if ($result["kanri_flg"]) { //表示されるが、更新のリンクはない。
        $view .= '<td>';
        $view .= '削除機能は使えません';
        $view .= '</td>';
      }else{
        $view .= '<td>';
        $view .= '削除機能は使えません';
        $view .= '</td>';
      }
      $view .='<tr>';

  }
}
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>書籍一覧</title>
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
      <a class="navbar-brand" href="select2.php">登録者一覧</a>
        <a class="navbar-brand" href="index.php">ユーザー登録</a>
        <a class="navbar-brand" href="login.php">ログイン</a>
        <a class="navbar-brand" href="logout.php">ログアウト</a>
      </div>
    </nav>
  </header>
  <!-- Head[End] -->
  <!-- Main[Start] -->
  <?php
        // 修正処理から戻ってきたときにURLにsuccessがあれば、この処理。
        if ($success) {
            echo '<p class="text-success">更新されました😄👍</p>';
        }

        if ($_SESSION["kanri_flg"]==1) {
          echo '<h4>あなたは管理者権限があります。</h4>';
        }else{
          echo '<h4>あなたは管理者権限がありません。更新はできません。</h4>';
        }
  ?>
  <div>
    <div class="container jumbotron">
    <table class="table">
                <thead>
                    <tr>
                        <th>登録日時</th>
                        <th>書籍名</th>
                        <th>コメント</th>
                        <th>削除</th>
                    </tr>
                </thead>
                <tbody>
                    <?= $view ?>
                </tbody>
      </table>
    </div>
  </div>
  <!-- Main[End] -->
</body>
</html>