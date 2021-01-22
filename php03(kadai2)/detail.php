<?php
require_once("funcs.php"); //funcs.phpから読み込むよの意味。
//１．PHP
//select.phpのPHPコードをマルっとコピーしてきます。
//※SQLとデータ取得の箇所を修正します。
$id = $_GET['id'];

// var_dump($id);


//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table WHERE id=" .$id);
$status = $stmt->execute();


//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    $result = $stmt->fetch();
}
// if ($status == false) {
//     sql_error($status);
// } else {
//     while ($result = $stmt->fetch()) {
//         //GETデータ送信リンク作成
//         // <a>で囲う。
//         $view .= '<p>';
//         $view .= '<a href="detail.php?id=' . $result["id"] . '">'; //?をつけるとGETで送るのと同じ意味。
//         $view .= $result["indate"] . "：" . $result["name"];
//         $view .= '</a>';
//     }
// }
?>


<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>データ登録【更新】</title>
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
                    <a class="navbar-brand" href="index.php">データ登録【更新】</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <!-- <div>
        <div class="container jumbotron">
            <a href="detail.php"></a>
            <?= $view ?>
        </div>
    </div> -->
    <!-- Main[End] -->


<!--
２．HTML
以下にindex.phpのHTMLをまるっと貼り付ける！
理由：入力項目は「登録/更新」はほぼ同じになるからです。
※form要素 input type="hidden" name="id" を１項目追加（非表示項目）
※form要素 action="update.php"に変更
※input要素 value="ここに変数埋め込み"
-->

<!-- Main[Start] -->
<form method="POST" action="update.php">
  <div class="jumbotron">
   <fieldset>
   <legend>データ登録【更新】</legend>
     <label>名前：<input type="text" name="name" value=<?= $result['name'] ?>></label><br>
     <label>ID：<input type="text" name="lid" value=<?= $result['lid'] ?>></label><br>
     <label>PW：<input type="text" name="lpw" value=<?= $result['lpw'] ?>></label><br>
     <label>管理者：<input type="checkbox" name="kanri_flg" <?= $result['kanri_flg']==1 ? 'checked' : '' ?>></label><br>
     <label>退職者：<input type="checkbox" name="life_flg" <?= $result['life_flg']==0 ? 'checked' : '' ?>></label><br>
     <input type="submit" value="更新"><br>
     <a href="select.php"><input type="button" value="一覧へ"></a>
    </fieldset>
  </div>
</form>
<!-- Main[End] -->

</body>

</html>

