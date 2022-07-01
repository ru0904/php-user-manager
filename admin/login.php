<?php
 require_once __DIR__ . "/classes/Auther.class.php";
 $auther = new Auther();
 
$mail_address = isset($_POST['mail_address']) ? $_POST['mail_address'] : "";
$pass_word = isset($_POST['pass_word']) ? $_POST['pass_word'] : "";

  //ユーザ登録のバリデーションを入れる
  $errors = [
    'mail_address' => [] ,
    'pass_word' => [] ,
  ];
  //メールアドレスのバリデーション
  if( $mail_address === "" ) {
    $errors['mail_address'][] = "Mail Addressが未入力です。";
  }
  if (!preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $mail_address)) {
    $errors['mail_address'][] = "Mail Addressのフォーマットが不正です。";
  }
  //パスワードのバリデーション
  if( $pass_word === "" ) {
    $errors['pass_word'][] = "Passwordが未入力です。";
  }

  if( empty($errors['mail_address']) && empty($errors['pass_word']) ){
    //ログインチェック
    if($auther->login($mail_address, $pass_word)){
      $_SESSION[Auther::LOGIN_CHK_KEY] = true;
    }
  }
  $suther->login_chk(true);

?>
<!doctype html>
<html lang="en">

  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" 
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ログイン | 管理画面</title>
  </head>

  <body>
    <h1>ログイン画面</h1>
    <?php if( !empty($errors['mail_address']) || 
				      !empty($errors['pass_word']) ) { ?>
			<div class="alert alert-danger" role="alert">
				<?php foreach($errors['mail_address'] as $error) { ?>
					<?php echo $error; ?><br>
				<?php } ?>
				<?php foreach($errors['pass_word'] as $error) { ?>
					<?php echo $error; ?><br>
				<?php } ?>
			</div>
      <form method="POST" action="./login.php">
        <div class="mb-3">
					<label for="exampleInputEmail" class="form-label">Email address</label>
					<input type="email" class="form-control <?php if( !empty($errors['mail_address']) ) echo 'border-danger text-danger'; ?>" id="exampleInputEmail" name="mail_address" aria-describedby="emailHelp" value="<?php echo $mail_address; ?>">
				</div>
				<div class="mb-3">
					<label for="exampleInputPassword" class="form-label">Password</label>
					<input type="password" class="form-control <?php if( !empty($errors['pass_word']) ) echo 'border-danger text-danger'; ?>" id="exampleInputPassword" name="pass_word" value="<?php echo $pass_word; ?>">
				</div>
        <button type="submit" class="btn btn-success">ログイン</button>
      </form>
      <?php } else { ?>
			<form method="POST" action="./comp.php">
				<div class="mb-3">
					<label for="exampleInputName" class="form-label">User Name</label>
					<input type="text" class="form-control" readonly id="exampleInputName" name="user_name" aria-describedby="emailHelp" value="<?php echo $user_name; ?>">
				</div>
				<div class="mb-3">
					<label for="exampleInputEmail" class="form-label">Email address</label>
					<input type="email" class="form-control" readonly id="exampleInputEmail" name="mail_address" aria-describedby="emailHelp" value="<?php echo $mail_address; ?>">
				</div>
				<div class="mb-3">
					<label for="exampleInputPassword" class="form-label">Password</label>
					<input type="password" class="form-control" readonly id="exampleInputPassword" name="pass_word" value="<?php echo $pass_word; ?>">
				</div>
				<button type="submit" class="btn btn-primary">Submit</button>
			</form>
			<form method="POST" action="./input.php">
				<input type="hidden" class="form-control" readonly id="exampleInputName" name="user_name" aria-describedby="emailHelp" value="<?php echo $user_name; ?>">
				<input type="hidden" class="form-control" readonly id="exampleInputEmail" name="mail_address" aria-describedby="emailHelp" value="<?php echo $mail_address; ?>">
				<input type="hidden" class="form-control" readonly id="exampleInputPassword" name="pass_word" value="<?php echo $pass_word; ?>">
				<button type="submit" class="btn btn-primary">Back</button>
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