<?php
require_once('funcs.php'); //funcs.phpを呼び出す
//1. POSTデータ取得
//$name = filter_input( INPUT_GET, ","name" ); //こういうのもあるよ
//$email = filter_input( INPUT_POST, "email" ); //こういうのもあるよ

$name      = $_POST['name'];
$lid       = $_POST['lid'];
$lpw       = $_POST['lpw'];
$kanri_flg = $_POST["kanri_flg"];

// 簡単なバリデーション処理。
// 名前、ID.PWが空白の場合、$err配列に1が挿入される（もうちょっといい書き方あるけど、簡単に。）
if (trim($_POST["name"]) === '') {
  $err[] = 1;
}
if (trim($_POST["lid"]) === '') {
  $err[] = 1;
}
if (trim($_POST["lpw"]) === '') {
  $err[] = 1;
}
// もしerr配列に何か入っている場合はエラーなので、redirect関数でindexに戻す。その際、GETでerrを渡す。
if (count($err) > 0) {
  redirect("index.php?err=1");
}



// var_dump($_POST["kanri_flg"]);

/*
* ※管理フラグ(formのチェックボックス)について。
* var_dumpで`$_POST`を確認すると、
* チェックがない場合は何も送られてこない($_POST["kanri_flg"]が存在しない)
* チェックがついている場合は中身が、on（$_POST["kanri_flg"]に何かが入っている）
* で送られてくることがわかる。
* よって、下記にてif文で 0 or 1を振り分けてあげる。
* （他にも方法があるかと思いますが、一例です。）
*/
if (isset($_POST["kanri_flg"])) { //select.phpのtableで表示。
  $kanri_flg = 1;
} else {
  $kanri_flg = 0;
}

if (isset($_POST["life_flg"])) { //select.phpのtableで表示。
  $life_flg = 1;
} else {
  $life_flg = 0;
}

//2. DB接続します
$pdo = db_conn();

//３．データ登録SQL作成
$stmt = $pdo->prepare("INSERT INTO gs_user_table(name,lid,lpw,kanri_flg)
                                          VALUES(:name,:lid,:lpw,:kanri_flg)");
$stmt->bindValue(':name', h($name), PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', h($lid), PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', h($lpw), PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', h($kanri_flg), PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute(); //実行

//４．データ登録処理後
if($status==false){
  //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
  $error = $stmt->errorInfo();
  exit("ErrorMessage:".$error[2]);
}else{
  //５．書き込みが成功したら、index.phpへリダイレクト
  // header("Location: index.php");
  header("Location: login.php");
}
?>
