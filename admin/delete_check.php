<?php
require_once __DIR__ . "/classes/Auther.class.php";
require_once __DIR__ . "/classes/Users.class.php";

$user_id = isset($_POST['user_id']) ?$_POST['user_id'] : '';

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

    <title>ユーザー登録</title>
  </head>
  <body>
    <h1>ユーザーサイト</h1>        
        <form method="POST" action="./delete_comp.php">
            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
            <div class="row mb-3">
                <label for="user_name" class="col-sm-2 col-form-label">User_Name</label>
                <div class="col-sm-10">
                <input type="text" readonly class="form-control <?php if( !empty($errors['user_name']) ) echo "border-danger text-danger"; ?>" id="name" name="user_name" value ="<?php echo $user['user_name'];?>">
                </div>
            </div>
            <div class="row mb-3">
                <label for="mail_adress" class="col-sm-2 col-form-label">Mail_Adress</label>
                <div class="col-sm-10">
                <input type="mail" readonly class="form-control <?php if( !empty($errors['mail_adress']) ) echo "border-danger text-danger"; ?>" id="mail" name="mail_adress" value ="<?php echo $user['mail_adress'];?>">
                </div>
            </div>
             <div class="row mb-3">
                <label for="pass_word" class="col-sm-2 col-form-label">PassWord</label>
                <div class="col-sm-10">
                <input type="password" readonly class="form-control <?php if( !empty($errors['pass_word']) ) echo "border-danger text-danger"; ?>" id="pass"name="pass_word" value ="<?php echo str_repeat("・", 6 ); ?>">
                </div>
            </div>
            
            <button type= "submit" class="btn btn-primary">更新</button>
           
        </form>
        <a href= "./detail.php?user_id=<?php echo $user_id; ?>"class="btn btn-primary">Back</a>
    
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