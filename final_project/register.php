<?php
    class MyDB extends SQLite3
    {
        function __construct()
        {
            $this->open('/tmp/test.db');
        }
    }
    $db = new MyDB();
    $account = $_POST['account'];
    $exist = 0;
    $sql =<<<EOF
        SELECT * from COMPANY where ACCOUNT="$account";
    EOF;
    $ret = $db->query($sql);
    $password = $_POST['password'];

    while($row = $ret->fetchArray() ){
        if($row['ACCOUNT']==$account){
            $exist = 1;
            $db->close();
            echo "account is exist.<br>";
            exit();
        }
    }
    if ($exist==0){
        if(strlen($password)<8){
            $db->close();
            echo "password too short.<br>";
            exit();
        }
    }
    
    $sql =<<<EOF
    INSERT INTO COMPANY (ACCOUNT,PASSWORD,AGE,SEX)
    VALUES ("$account","$password",0,0);
    EOF;

    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        echo "account created successfully\n";
    }
    $db->close();
    header('Location: nycu_index.php');
?>

