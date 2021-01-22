<?php
//1.POSTでそれぞれを取得
$name      = $_POST['name'];
$lid       = $_POST['lid'];
$lpw       = $_POST['lpw'];
$kanri_flg = $_POST['kanri_flg'];
$life_flg  = $_POST['life_flg'];
$id        = $_POST['id'];

//2.データベース接続
try {
    //ID MAMP ='root'
    //Password:MAMP='root',XAMPP=''
    $pdo = new PDO('mysql:dbname=gs_db;charset=utf8;host=localhost', 'root','root');
  } catch (PDOException $e) {
    exit('DBConnectError:' . $e->getMessage()); //データベース接続ができないときのエラー表示
  }

//3.UPDATE gs_bm_table SET name= , url= , comment= , WHERE id= の順で書く
$sql = 'UPDATE gs_user_table SET name=:name, lid=:lid, lpw=:lpw, kanri_flg=:kanri_flg, life_flg=:life_flg WHERE id=:id';
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
    //SQL実行時にエラーがある場合（エラーオブジェクト取得して表示）
    $error = $stmt->errorInfo();
    exit("ErrorMessage:".$error[2]);
  }else{
    //５．書き込みが成功したら、index.phpへリダイレクト
    header("Location: select.php");
  
  }

if($_POST['kanri_flg'] == "管理者"){echo 'checked="checked"';}

?>


<!-- 
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <title>データ登録画面</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <style>div{padding: 10px;font-size:16px;}</style>
</head>
<body> -->

<!-- Head[Start] -->
<!-- <header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
    <div class="navbar-header"><a class="navbar-brand" href="select.php"> データ登録画面</a></div>
    </div>
  </nav>
</header> -->
<!-- Head[End] -->

<!-- Main[Start] -->
<!-- <form method="POST" action="insert.php">
  <div class="jumbotron">
   <fieldset>
   <legend>データ登録【更新】</legend>
    <label>名前：<input type="text" name="name" value=<?= $result['name'] ?>></label><br>
     <label>ID：<input type="text" name="lid" value=<?= $result['lid'] ?>></label><br>
     <label>PW：<input type="text" name="lpw" value=<?= $result['lpw'] ?>></label><br>

     <input type="hidden" name="kanri_flg"  value="一般社員"></label><br>
     <label>管理者：<input type="checkbox" name="kanri_flg" value="管理者"></label><br>
     <label>退職<input type="checkbox" name="life_flg"></label><br>


     <input type="hidden" name="id" value=<?= $result['id'] ?>><br>
     <input type="submit" value="更新"><br>
     <a href="select.php"><input type="button" value="一覧へ"></a>
    </fieldset>
  </div>
</form> -->
<!-- Main[End] -->
<!-- 

</body>
</html> -->

