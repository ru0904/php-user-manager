<?php
  require_once __DIR__ . "/classes/Auther.class.php";
  require_once __DIR__ . "/classes/Users.class.php";

  $user_id = isset($_GET['user_id']) ?$_GET['user_id'] : '';
  $user_name = isset($_GET['user_name']) ?$_GET['user_name'] : '';
  $pass_word = isset($_GET['pass_word']) ?$_GET['pass_word'] : '';
  $mail_adress = isset($_GET['mail_adress']) ?$_GET['mail_adress'] : '';
  $create_dt = isset($_GET['create_dt']) ?$_GET['create_dt'] : '';
  $update_dt = isset($_GET['update_dt']) ?$_GET['update_dt'] : '';
  

  $auther = new Auther();
  $Users = new Users();
  $user = $Users->getDetail($user_id);
  $auther->login_chk();
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ユーザ詳細情報　| 管理画面</title>
  </head>
  <body>
    <h1>ユーザ管理画面</h1>
    <table class="table table-striped">
        <thead>
            <th>ユーザID</th>
            <th>ユーザ名</th>
            <th>パスワード</th>
            <th>メールアドレス</th>
            <th>作成日時</th>
            <th>更新日時</th>
        </thead>
        <tbody>
                <tr>
                    <td><?php echo $user[ 'user_id' ]; ?></td>
                    <td><?php echo $user[ 'user_name' ]; ?></td>
                    <td><?php echo str_repeat("・" ,6 )?></td>
                    <td><?php echo $user[ 'mail_adress' ]; ?></td>
                    <td><?php echo date("Y/m/d H時i分" , $user[ 'create_dt' ]); ?></td>
                    <td><?php echo date("Y/m/d H時i分" , $user[ 'update_dt' ]); ?></td>
                </tr>  
        </tbody>
        <form method="POST" action= "update.php">
            <input type="hidden" name="user_id" value="<?php echo $user[ 'user_id' ]; ?>">
            <button type="submit" class="btn btn-info">編集画面へ</button>
        </form>
        <form method="POST" action= "delete_check.php">
            <input type="hidden" name="user_id" value="<?php echo $user[ 'user_id' ]; ?>">
            <button type="submit" class="btn btn-danger">削除</button>
        </form>
    </table>
    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    -->
  </body>
</html>