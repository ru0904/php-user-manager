<?php

require_once __DIR__ ."/DBMySQLi.class.php";

class Users extends DBMySQLi{

    public function __construct()
    {
        parent::__construct();
    }

    public function getList()
    {
     $returnAry = [];
     $query = "SELECT user_id , user_name , create_dt , update_dt  FROM users ORDER BY user_id";
     $stmt = mysqli_prepare($this->db_link, $query);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_bind_result($stmt, $user_id ,$user_name ,$create_dt ,$update_dt);
        while(mysqli_stmt_fetch($stmt)) {
            $returnAry[] = [
                'user_id' => $user_id ,
                'user_name' => $user_name ,
                'create_dt' => strtotime($create_dt) ,
                'update_dt' => strtotime($update_dt) ,
            ];
        }  
     
     if(empty($returnAry)) {
         return [];
        }else{
         return $returnAry;
        }
    }

    public function getDetail($user_id)
    {
     if(empty($user_id)) {
         throw new Exception("ユーザIDが空です。");
        }  

     $query = "SELECT user_id FROM users WHERE user_id = ? LIMIT 1";
     $stmt = mysqli_prepare($this->db_link, $query);
     mysqli_stmt_bind_param($stmt, 'd', $user_id);
     mysqli_stmt_execute($stmt);
     mysqli_stmt_bind_result($stmt, $user_id,$user_name,$mail_address,$pass_word,$create_dt,$update_dt);
     mysqli_stmt_fetch($stmt);

        return [
         'user_id' => $user_id ,
         'user_name' => $user_name ,
         'mail_address' => $mail_address ,
         'pass_word' => $pass_word ,
         'create_dt' => strtotime($create_dt) ,
         'update_dt' => strtotime($update_dt) ,
        ];
    }

    public function isDiolication($mail_address,$user_id =null)
    {
        // メールアドレスの重複チェック
        $query = "SELECT user_id FROM users WHERE mail_address = ?AND user_id !=? LIMIT 1";
        $stmt = mysqli_prepare($this->db_link, $query);
        mysqli_stmt_bind_param($stmt, 'sd', $mail_addres,user_id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $district);
        mysqli_stmt_fetch($stmt);

        if(empty($district)) {
            return true;
        }else{
            return false;
        }
    }

    public function updateUser($user_id,$user_name,$mail_addres,$pass_word =null)
    {
        // ユーザー更新
     if(!empty($pass_word)){
         $query = "UPDATE SET user_name =? ,mali_address =? update_dt =?, FROM users WHERE user_id =?";
         // パスワードを不可逆変換する
         $cry_pass_word = md5($pass_word);
         // 現在日程を所得
         $now_dt = date("Y-m-d H:i:s");

         $stmt = mysqli_prepare($this->db_link, $query);
         mysqli_stmt_bind_param($stmt, 'ssssd', $user_name, $mail_addres, $cry_pass_word, $now_dt, $now_dt);
         mysqli_stmt_execute($stmt);

        }else{
         $query = "UPDATE user SET user_name =? ,mali_address =? update_dt =?, FROM users WHERE user_id =?";
         $stmt = mysqli_prepare($this->db_link, $query);
         // 現在日程を所得
         $now_dt = date("Y-m-d H:i:s");
         mysqli_stmt_bind_param($stmt, 'ssssd', $user_name, $mail_addres, $cry_pass_word, $now_dt, $now_dt);
         mysqli_stmt_execute($stmt);
        }
    }

    public function deleteUser($user_id)
    {
        $query = "DELETE FROM user WHERE user_id = ? LIMIT 1";
         $stmt = mysqli_prepare($this->db_link, $query);
         mysqli_stmt_bind_param($stmt, 'd', $user_id);
         mysqli_stmt_execute($stmt);
    }
}