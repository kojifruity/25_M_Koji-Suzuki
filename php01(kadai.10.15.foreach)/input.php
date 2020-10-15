<html>

<head>
    <meta charset="utf-8">
    <title>課題テンプレート【アンケート】</title>
</head>

<body>
    <form action="write.php" method="post">
        番号: <input type="text" name="number"><br>
        氏名: <input type="text" name="name"><br>
        生年月日: <input type="text" name="birth"><br>
        性別:
        <label for="m">男<input type="radio" value="男" name="sex" id=m required></label>
        <label for="f">女<input type="radio" value="女" name="sex" id=f required></label><br>
        国籍: <input type="text" name="nation"><br>
        住居地: <input type="text" name="address"><br>
        在留資格: <input type="text" name="status"><br>
        就労制限の有無:
        <label for="y">有<input type="radio" value="有" name="work" id=y required></label>
        <label for="n">無<input type="radio" value="無" name="work" id=n required></label><br>
        在留期間（満了日）: <input type="text" name="limit"><br>
        <input type="submit" value="送信">
    </form>
</body>

</html>
