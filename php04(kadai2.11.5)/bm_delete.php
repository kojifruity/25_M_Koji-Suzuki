<?php
//GETでid値を取得
$id = $_GET['id'];

//2.データベース接続
try {
    //ID MAMP ='root'
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage()); //データベース接続ができないときのエラー表示
  }


//３．データ削除
$sql = "DELETE FROM gs_bm_table WHERE id=:id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':id',$id, PDO::PARAM_INT); //削除したいidを渡す
$status = $stmt->execute();


//４．データ削除処理後
if($status==false){
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:".$error[2]);
  }else{
    //５．削除が成功したら、リダイレクト
    header("Location: bm_select.php");
  
  }

?>