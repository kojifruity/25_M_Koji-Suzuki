<html>

<head>
    <meta charset="utf-8">
    <title>課題テンプレート【アンケート】</title>
</head>

<body>
    <h1>学生情報入力</h1>
    <h5>在留カードと同じに入力すること。</h5>
    <h5>氏名の表記について、大文字・小文字は問わない。</h5>
    <h5>※プロダクトでは、在留カードを写真にとって、OCR機能で自動で以下の内容が埋まるようにする。</h5>
    <form action="write.php" method="post">
        番号: <input type="text" name="number"><br>
        氏名: <input type="text" name="name"><br>
        <!-- 名前の中（名字と名前）でスペースを入れると表に出力したときに崩れる。read.phpのexplodeがスペースで単語を判断しているため。他のinputtype=text部分でも同じ現象。解決が必要。 -->
        生年月日: <input type="text" name="birth" placeholder="半角数字8ケタ"><br>
        性別:
        <label for="m">男<input type="radio" value="男" name="sex" id=m required></label>
        <label for="f">女<input type="radio" value="女" name="sex" id=f required></label><br>
        国籍: <input type="text" name="nation"><br>
        住居地: <input type="text" name="address"><br>
        在留資格: 
        <label for="status1"><input type="radio" value="留学" name="status" id="status1" required>留学</label>
        <label for="status2"><input type="radio" value="短期滞在" name="status" id="status2" required>短期滞在</label>
        <label for="status3"><input type="radio" value="家族滞在" name="status" id="status3" required>家族滞在</label>
        <label for="status4"><input type="radio" value="特定活動" name="status" id="status4" required>特定活動</label>
        <label for="status5"><input type="radio" value="宗教" name="status" id="status5" required>宗教</label>
        <label for="status6"><input type="radio" value="その他" name="status" id="status6" required>その他</label><br>
        就労制限の有無:
        <label for="y">有<input type="radio" value="有" name="work" id=y required></label>
        <label for="n">無<input type="radio" value="無" name="work" id=n required></label><br>
        在留期間（満了日）: <input type="text" name="limit" placeholder="半角数字8ケタ"><br>
        <input type="submit" value="送信">
    </form>
</body>

</html>
