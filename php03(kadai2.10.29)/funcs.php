<?php
//XSS対応（ echoする場所で使用！それ以外はNG ）
function h($str){
    return htmlspecialchars($str, ENT_QUOTES);
}

//DB接続関数：db_conn()
function db_conn(){
    try {
        $db_name = "gs_db";    //データベース名
        $db_id   = "root";      //アカウント名
        $db_pw   = "root";      //パスワード：XAMPPはパスワード無しに修正してください。
        $db_host = "localhost"; //DBホスト
        $pdo = new PDO('mysql:dbname='.$db_name.';charset=utf8;host='.$db_host, $db_id, $db_pw);
        return $pdo;//funcs.phpでここを追加した
    } catch (PDOException $e) {
        exit('DB Connection Error:'.$e->getMessage());
    }
}



//SQLエラー関数：sql_error($stmt)
function sql_error($stmt){      //第一引数に$stmt。これはinsert.phpから入って来るよという意味。
    $error = $stmt->errorInfo();
    exit("SQLError:".$error[2]);
}


//リダイレクト関数: redirect($file_name)
function redirect($file_name){ //第一引数に$file_nameとすると、リダイレクト後に指定したファイル名に飛ぶ設定が作れる。
    header("Location:" . $file_name);
    exit();
}





?>