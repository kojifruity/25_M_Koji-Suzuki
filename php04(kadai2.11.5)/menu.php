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

if ($_GET['success']) {
  $success = $_GET['success'];
}

//２．データ取得SQL作成
$stmt = $pdo->prepare("SELECT * FROM gs_user_table");
$status = $stmt->execute();


// print $_SESSION["kanri_flg"];  //管理者にチェックが入っている=1,管理者にチェックが入っていない=0
if ($_SESSION["kanri_flg"]==1) {
 echo '<p>あなたは管理者権限があります。</p>';
}else{
 echo '<p>ユーザー登録がない方は、閲覧のみができます。</p>';
 echo '<p>登録と更新をするためには、管理者権限をもらってください。ユーザー登録画面で管理者へ✔を入れて登録してください。</p>';
}
//ログイン画面でIDとパスワード空欄だと0なので、この画面（menu.php）に飛んでくる。

//$_SESSION["kanri_flg"]が、1の場合、以下４つのリンクが使える
if ($_SESSION["kanri_flg"]) {
  echo '<a href="index.php">ユーザー登録</a> <a href="select.php">登録者一覧</a> <a href="bm_index.php">書籍登録</a> <a href="bm_select.php">書籍一覧</a>';
  echo '<br>';
  echo '<br>';
  echo '<a href="logout.php">ログアウト</a>';

}
//$_SESSION["kanri_flg"]が、0の場合、以下２つのリンクが使える
if ($_SESSION["kanri_flg"]==0) {
  echo '<a href="index.php">ユーザー登録</a> <a href="bm_select2.php">書籍一覧</a>';
}
print '<br>';
print '<br>';
print '<a href="login.php">ログイン画面へ戻る</a>';
print '<br>';


?>

<!-- <header> -->
    <!-- <nav class="navbar navbar-default">
      <div class="container-fluid">
          <a class="navbar-brand" href="bm_index.php">書籍登録</a>
          <a class="navbar-brand" href="bm_select.php">書籍一覧</a>
          <a class="navbar-brand" href="index.php">ユーザー登録</a>
          <a class="navbar-brand" href="logout.php">ログアウト</a>
          <a class="navbar-brand" href="login.php">ログイン</a>
      </div>
    </nav>
  </header> -->