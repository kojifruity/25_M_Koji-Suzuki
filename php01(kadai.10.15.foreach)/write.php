<?php
$number = $_POST['number'];
$name = $_POST['name'];
$birth = $_POST['birth'];
$sex = $_POST['sex'];
$nation = $_POST['nation'];
$address = $_POST['address'];
$status = $_POST['status'];
$work = $_POST['work'];
$limit = $_POST['limit'];


// ファイルに書き込み
$time = date("Y-m-d H:i:s");
$str = $number .' ' . $name .' ' . $birth .' '. $sex .' '. $nation .' '. $address .' '. $status .' '. $work .' '. $limit; //見やすくするため '. .'がある。
//文字作成

$file  = fopen('./data/data.txt','a'); //（書き込む場所,書き込む方法の順。方法は授業のPDF参照）
fwrite($file,$str. "\n");//（何に、何を）書く。"\n"は「.txtで改行する」のいみ。
fclose($file);//$fileを閉じる
?>


<html>

<head>
    <meta charset="utf-8">
    <title>File書き込み</title>
</head>

<body>

    <h1>書き込みしました。</h1>
    <p><?= $str ?></P>
    <h2>./data/data.txt にデータを格納しました。</h2>
    <!-- <table>
        <tr>
            <th><?= $number ?></th>
            <th><?= $name ?></th>
            <th><?= $birth ?></th>
            <th><?= $sex ?></th>
            <th><?= $nation ?></th>
            <th><?= $address ?></th>
            <th"><?= $status ?></th>
            <th><?= $work ?></th>
            <th><?= $limit ?></th>
        </tr>
    </table> -->
    <ul>
        <li><a href="input.php">戻る</a></li>
    </ul>
</body>

</html>
