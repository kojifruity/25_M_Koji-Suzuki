<?php
require_once('funcs.php');

//1.POSTでそれぞれを取得
$name      = $_POST['name'];
$lid       = $_POST['lid'];
$lpw       = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg  = $_POST['life_flg'];
$id        = $_POST['id'];

$err = [];
if (trim($_POST["name"]) === '') {
    $err[] = 1;
}
if (trim($_POST["lid"]) === '') {
    $err[] = 1;
}
if (trim($_POST["lpw"]) === '') {
    $err[] = 1;
}
if (count($err) > 0) {
    redirect("detail.php?id=${id}&err=1");
}

// 空白がなければ、$_POST["kanri_flg"]と、$_POST["life_flg"]をチェック
if (isset($_POST["kanri_flg"])) {
    $kanri_flg = 1;
} else {
    $kanri_flg = 0;
}

if (isset($_POST["life_flg"])) {
    $life_flg = 1;
} else {
    $life_flg = 0;
}


//2.データベース接続
$pdo = db_conn();

//3.UPDATE gs_bm_table SET name= , url= , comment= , WHERE id= の順で書く
$sql = 'UPDATE 
          gs_user_table 
        SET name=:name, 
          lid=:lid, 
          lpw=:lpw, 
          kanri_flg=:kanri_flg, 
          life_flg=:life_flg 
        WHERE 
          id=:id';

$stmt = $pdo->prepare($sql);
$stmt->bindValue(':name', $name, PDO::PARAM_STR);      //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lid', $lid, PDO::PARAM_STR);    //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':lpw', $lpw, PDO::PARAM_STR);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':kanri_flg', $kanri_flg, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':life_flg', $life_flg, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$stmt->bindValue(':id', $id, PDO::PARAM_INT);        //Integer（数値の場合 PDO::PARAM_INT)
$status = $stmt->execute();


//４．データ登録処理後
if($status==false){
    $error = $stmt->errorInfo(); //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    exit("ErrorMessage:".$error[2]);
  }else{
    redirect("select.php?id=${id}&success=1");
        //５．書き込みが成功したら、index.phpへリダイレクト  
  }
?>

