<!DOCTYPE html>
<html lang="ja">
    <head>
        <title>ログイン画面</title>
        <link rel="stylesheet" href="login.css">
    </head>
    <body>
        <h2>
            ログイン画面
        </h2>
        <hr>
        <div>
            <table border="0">
                <form action="session1.php" method = "post">
                    <tr>
                        <th>
                            ユーザーネーム
                        </th>
                        <td>
                            <input type ="text" name="username" value = ""><br/>
                        </td>
                    </tr>
                    <tr>
                        <th> 
                            パスワード
                        </th>
                        <td>
                            <input type = "text" name="pass" value = ""><br/>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name ="login" value = "ログイン">
                        </td>
                    </tr>
                </form>
            </table>
        </div>
    </body>
</html>