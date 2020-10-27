<?php 
require_once('funcs.php'); //funcs.phpを呼び出す
//GETでid値を取得
$id = $_GET['id'];

//2.データベース接続
$pdo = db_conn();//はじめにrequire_once('funcs.php');しているため。


//３．データ削除
$sql = "DELETE FROM gs_user_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT); //削除したいidを渡す
$status = $stmt->execute();


//４．データ削除処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:".$error[2]);
  }else{
    //５．削除が成功したら、index.phpへリダイレクト
    header("Location: select.php");
  }




?>