<?php
//【重要】
//insert.phpを修正（関数化）してからselect.phpを開く！！
require_once("funcs.php"); //funcs.phpから読み込むよの意味。

$pdo = db_conn();


//２．データ登録SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();


//３．データ表示
$view = "";
if ($status == false) {
    sql_error($status);
} else {
    while ($result = $stmt->fetch(PDO::FETCH_ASSOC)) {
        //GETデータ送信リンク作成
        // <a>で囲う。
        $view .= '<p>';
        $view .= '<a href="detail.php?id=' . $result["id"] . '">'; //?をつけるとGETで送るのと同じ意味。
        $view .= $result["kanri_flg"] . "：" . $result["name"];
        $view .= '</a>';
        $view .= '<a href="delete.php?id=' . $result["id"] . '">'; //?をつけるとGETで送るのと同じ意味。
        $view .= '  /  [ 削除 ]';
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
    <title>データ登録【一覧】</title>
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
                    <a class="navbar-brand" href="index.php">データ登録【一覧】</a>
                </div>
            </div>
        </nav>
    </header>
    <!-- Head[End] -->

    <!-- Main[Start] -->
    <a href="index.php"><input type="button" value="〈新規登録〉画面へ"></a>
    <h4>☆内容を変更する場合は、変更したいリスト名をクリック</h4>
    <h4>※削除をクリックすると、即削除されますので、注意してください。データベースからも削除されます</h4>
        <div class="container jumbotron">
            <a href="detail.php"></a>
            <?= $view ?>
        </div>
    </>
    <a href="index.php"><input type="button" value="〈新規登録〉画面へ"></a>
    <!-- Main[End] -->

</body>

</html>
