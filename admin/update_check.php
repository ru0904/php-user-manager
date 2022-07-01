<?php
require_once __DIR__ . "/classes/Auther.class.php";
$auther = new Auther();

$user_id = isset($_POST['user_id']) ?$_POST['user_id'] : '';
$user_name = isset($_POST['user_name']) ?$_POST['user_name'] : '';
$mail_adress = isset($_POST['mail_adress']) ?$_POST['mail_adress'] : '';
$pass_word = isset($_POST['pass_word']) ?$_POST['pass_word'] : '';

$auther->login_chk();

$errors = [
    'user_name' => [] , 
    'mail_adress' => [] , 
    'pass_word' => [] , 
];
if($user_name === "") {
    $errors['user_name'][] = "UserNameが未入力です。";
}
if($mail_adress === "") {
    $errors['mail_adress'][] = "MailAddressが未入力です。";
}
if (!preg_match('|^[0-9a-z_./?-]+@([0-9a-z-]+\.)+[0-9a-z-]+$|', $mail_adress)) {
    $errors['mail_adress'][] = "MailAdressのフォーマットが不正です。";
}


?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>ユーザー登録</title>
  </head>
  <body>
    <h1>ユーザーサイト</h1>
    <?php if( !empty($errors['user_name'])  ||
              !empty($errors['mail_adress'])  ||
              !empty($errors['pass_word'])  )  { ?>
        <div class="alert alert-danger" role="alert">
            <?php foreach($errors['user_name'] as $error) { ?>
                <?php echo $error; ?><br>
            <?php } ?>
            <?php foreach($errors['mail_adress'] as $error) { ?>
                <?php echo $error; ?><br>
            <?php } ?>
            <?php foreach($errors['pass_word'] as $error) { ?>
                <?php echo $error; ?><br>
            <?php } ?>
        </div>

        <form method="POST" action="./update_check.php">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="row mb-3">
                <label for="user_name" class="col-sm-2 col-form-label">User_Name</label>
                <div class="col-sm-10">
                <input type="text" class="form-control <?php if( !empty($errors['user_name']) ) echo "border-danger text-danger"; ?>" id="name" name="user_name" value ="<?php echo $user_name;?>">
                </div>
            </div>
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
        <form method="POST" action="./update_comp.php">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="row mb-3">
                <label for="user_name" class="col-sm-2 col-form-label">User_Name</label>
                <div class="col-sm-10">
                <input type="text" readonly class="form-control <?php if( !empty($errors['user_name']) ) echo "border-danger text-danger"; ?>" id="name" name="user_name" value ="<?php echo $user_name;?>">
                </div>
            </div>
             <div class="row mb-3">
                <label for="mail_adress" class="col-sm-2 col-form-label">Mail_Adress</label>
                <div class="col-sm-10">
                <input type="mail" readonly class="form-control <?php if( !empty($errors['mail_adress']) ) echo "border-danger text-danger"; ?>" id="mail" name="mail_adress" value ="<?php echo $mail_adress;?>">
                </div>
            </div>
             <div class="row mb-3">
                <label for="pass_word" class="col-sm-2 col-form-label">PassWord</label>
                <div class="col-sm-10">
                <input type="password" readonly class="form-control <?php if( !empty($errors['pass_word']) ) echo "border-danger text-danger"; ?>" id="pass"name="pass_word" value ="<?php echo $pass_word;?>">
                </div>
            </div>
           
            <button type= "submit" class="btn btn-primary">更新</button>
           
        </form>

        <form method="POST" action="./update.php">
            <input type="hiddne" class="form-control" readonly id="mail" name="user_name" value ="<?php echo $user_name;?>">
            <input type="hiddne" class="form-control" readonly id="pass"name="pass_word" value ="<?php echo $pass_word;?>"> 
            <input type="hiddne" class="form-control" readonly  id="name" name="mail_adress" value ="<?php echo $mail_adress;?>">
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