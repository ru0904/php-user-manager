<?php
  require_once __DIR__ . "/classes/Auther.class.php";
  $auther = new Auther();

  $mail_adress = isset($_POST['mail_adress']) ?$_POST['mail_adress'] : '';
  $pass_word = isset($_POST['pass_word']) ?$_POST['pass_word'] : '';


  //ユーザ登録のバリエーションを入れる
  $errors = [
    'mail_adress' => [] ,
    'pass_word' => [] ,
  ];
  //メールアドレスのバリエーション
  if($mail_adress === "") {
    $errors['mail_adress'][] = "MailAddressが未入力です。";
  }
  if (!preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $mail_adress)) {
    $errors['mail_adress'][] = "MailAdressのフォーマットが不正です。";
  }
  //パスワードのバリエーション
  if($pass_word === "") {
    $errors['pass_word'][] = "PassWordが未入力です。";
  }

  if( empty($errors['mail_adress']) && empty($errors['pass_word']) ) {
    //ログインチェック
    if($auther->login($mail_adress, $pass_word)) {
      $_SESSION[Auther::LOGIN_CHK_KEY] = true;
    }
  }
  $auther->login_chk(true);
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Hello, world!</title>
  </head>
  <body>
    <h1>ログイン画面</h1>
    <?php if(!empty($errors['mail_adress'])  ||
             !empty($errors['pass_word'])  )  { ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach($errors['mail_adress'] as $error) { ?>
                <?php echo $error; ?><br>
            <?php } ?>
            <?php foreach($errors['pass_word'] as $error) { ?>
                <?php echo $error; ?><br>
            <?php } ?>
        </div>

    <form class= "container" method="POST" action="./login.php">
            <div class="row mb-3">
                <label for="mail_adress" class="col-sm-2 col-form-label">Mail_Adress</label>
                <div class="col-sm-10">
                <input type="mail" class="form-control <?php if( !empty($errors['mail_adress']) ) echo "border-danger text-danger"; ?>" id="mail" name="mail_adress" value ="<?php echo $mail_adress;?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="pass_word" class="col-sm-2 col-form-label">PassWord</label>
                <div class="col-sm-10">
                <input type="password" class="form-control <?php if( !empty($errors['pass_word']) ) echo "border-danger text-danger"; ?>" id="pass"name="pass_word" value ="<?php echo $pass_word;?>">
                </div>
            </div>
            <button type= "submit" class="btn btn-primary">Sign in</button>
    </form>
    <?php } else { ?>
        <form method="POST" action="./comp.php">
            <input type="hiddne" class="form-control" readonly  id="name" name="user_name" value ="<?php echo $user_name;?>">
            <input type="hiddne" class="form-control" readonly id="mail" name="mail_adress" value ="<?php echo $mail_adress;?>">
            <input type="hiddne" class="form-control" readonly id="pass"name="pass_word" value ="<?php echo $pass_word;?>">  
            <button type= "submit" class="btn btn-primary">Back</button>
        </form>
    
    <?php } ?>
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