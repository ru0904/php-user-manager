<?php

class DBMySQLi{

    protected $db_link = null;

    public function __construct()
    { 
        //MySQLiコネクタを生成
        $this->db_link = mysqli_connect("localhost", "root", "", "test");

        //DBコネクションを確立
        if(!$this->db_link){
            throw new Exceotion("コネクションエラー");
        }
    }

}