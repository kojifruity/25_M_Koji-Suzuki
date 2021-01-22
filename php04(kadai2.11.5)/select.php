<?php
session_start();

if (!isset($_SESSION["chk_ssid"]) || $_SESSION["chk_ssid"]!=session_id()) {
  echo "LOGIN Error";
  exit();
}

include("funcs.php");
loginCheck(); //funcs.phpにあるLogin認証チェック関数
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
require_once("funcs.php");
$pdo = db_conn();

// 修正処理から戻ってきたときにURLにsuccessがあれば、この処理。
if ($_GET['success']) {
  $success = $_GET['success'];
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
      // GETデータ送信リンク作成
      // 編集対応する場合
      $view .= '<tr>';
      if ($result["kanri_flg"]) { //insert.phpにif文。
          $view .= '<td> 管理者 </td>';
      }else{
          $view .= '<td> 一般 </td>';
      }

      $result["kanri_flg"];
      $view .= '<td><a href="detail.php?id=' . $result["id"] . '">'; //?をつけるとGETで送るのと同じ意味。
      $view .= $result["name"];
      $view .= '</a>';
      $view .= '</td>';
    

      // 削除の処理
      $result["kanri_flg"];
      $view .= '<td><a href="delete.php?id=' . $result["id"] . '">'; //?をつけるとGETで送るのと同じ意味。
      $view .= '<input type="button" value = 削除>';
      $view .= '</a>';
      $view .= '<td>';
      $view .= '</tr>';
    }

    }
?>



<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>登録者【一覧】</title>
  <link rel="stylesheet" href="css/range.css">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
  <style>
    div {
      padding: 10px;
      font-size: 16px;
        }
        th,
        td {
            text-align: center;
        }
  </style>
</head>
<body id="main">
  <!-- Head[Start] -->
  <header>
    <nav class="navbar navbar-default">
      <div class="container-fluid">
          <a class="navbar-brand" href="bm_index.php">書籍登録</a>
          <a class="navbar-brand" href="bm_select.php">書籍一覧</a>
          <a class="navbar-brand" href="index.php">ユーザー登録</a>
          <a class="navbar-brand" href="logout.php">ログアウト</a>
          <a class="navbar-brand" href="login.php">ログイン</a>
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
  ?>

  <h4>☆内容を変更する場合は、変更したい名前をクリック</h4>
  <h4>※削除をクリックすると、即削除されますので、注意してください。データベースからも削除されます</h4>
  <div>
    <div class="container jumbotron">
      <table class="table">
                <thead>
                    <tr>
                        <th>管理者</th>
                        <th>名前</th>
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