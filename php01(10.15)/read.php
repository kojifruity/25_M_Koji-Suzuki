<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/jquery-3.5.1.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script></script>
    <!-- jQuery UI -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
            integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
            crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <title>Document</title>
</head>

<body>
<table border="1" style="border-collapse: collapse" align="center">
        <tr bgcolor="lightblue">
            <th width="10%">番号</th>
            <th width="15%">氏名</th>
            <th width="10%">生年月日</th>
            <th width="5%">性別</th>
            <th width="5%">国籍</th>
            <th width="20%">住居地</th>
            <th width="10%">在留資格</th>
            <th width="10%">就労制限の有無</th>
            <th width="18%">在留期間（満了日）</th>
        </tr>
        </thead>


<?php
// ファイルを開く
$openFile = fopen('./data/data.txt','r');  //rで読み込み

// ファイル内容を1行ずつ読み込んで出力
// fgets=1行ずつ読み込む
// while文にすると行が終わるまでやる
while ($str_base = fgets($openFile)){
    echo nl2br($str); // \nをbrへ変換してhtmlで使う
    $str = explode(" ", $str_base);
    echo '<tbody id="sortdata">';//JQueryUI・tbodyのid設定でドラッグアンドドロップで行を動かせる
    echo '<tr>';
    echo '<td>'.$str[0].'</td>';
    echo '<td>'.$str[1].'</td>';
    echo '<td>'.$str[2].'</td>';
    echo '<td>'.$str[3].'</td>';
    echo '<td>'.$str[4].'</td>';
    echo '<td>'.$str[5].'</td>';
    echo '<td>'.$str[6].'</td>';
    echo '<td>'.$str[7].'</td>';
    echo '<td>'.$str[8].'</td>';
    echo '</tr>';
    echo '</tbody>';

}

// // ファイルを閉じる
fclose($openFile);
?> 
</table>

<script>
    //JQueryUI・テーブル行のドラッグ＆ドロップ
    $('#sortdata').sortable();

    // sortstopイベントをバインド
    $('#sortdata').bind('sortstop',function(){
    // 番号を設定している要素に対しループ処理
    $(this).find('[name="num_data"]').each(function(idx){
    // タグ内に通し番号を設定（idxは0始まりなので+1する）
    $(this).html(idx+1);
  });
});
</script>

</body>
</html>
