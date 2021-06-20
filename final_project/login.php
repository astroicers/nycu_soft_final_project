<?php
    class MyDB extends SQLite3
    {
        function __construct()
        {
            $this->open('/tmp/test.db');
        }
    }
    $db = new MyDB();
    // print_r($_POST);
    $update = $_POST['update'];
    if($update=='1')
        echo "<script>alert('Update Finish.');</script>";
    $account = $_POST['account'];
    $password = $_POST['password'];
    $sql =<<<EOF
        SELECT * from COMPANY where ACCOUNT="$account" and PASSWORD="$password";
    EOF;
    $ret = $db->query($sql);
    $tmp = $ret->fetchArray();
    if ($tmp == false)
        header('Location: nycu_index.php');
    $age=0;$sex=0;
    if($row = $tmp ){
        echo "<form method=\"post\" action=\"./chg.php\">";
        $id = $row['ID'];
        echo "user_ID: <input type=\"text\" name=\"_id\" value=\"$id\"/><br>";
        $name = $row['NAME'];
        echo "name: <input type=\"text\" name=\"name\" value=\"$name\"/><br>";
        if($row['AGE']<='0')
            $age = "secret";
        else
            $age = $row['AGE'];
        echo "age: <input type=\"text\" name=\"age\" value=\"$age\"/><br>";
        if($row['SEX']=='0')
            $sex = "secret";
        else if($row['SEX']=='1')
            $sex = "man";
        else if($row['SEX']=='2')
            $sex = "woman";
        echo "sex: <input type=\"text\" name=\"sex\" value=\"$sex\"/><br>";
        echo "Progession Note: <input type=\"text\" name=\"profession_note\" value=\"".$row['PROFESSION_NOTE']."\"/><br>";
        echo "INTRODUCTION: <br><textarea name=\"introduction\"rows=\"10\" cols=\"150\">".$row['INTRODUCTION'] ."</textarea><br>";
        echo "<input type=\"submit\" value=\"edit\"/></form>";
        echo "<form action='./nycu_index.php'>";
        echo "<input type='submit' value='logout'></form>";
    }
    $db->close();
    ?>
