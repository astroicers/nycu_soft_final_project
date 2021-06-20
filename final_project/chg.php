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
    $id = $_POST['_id'];
    $sql =<<<EOF
    SELECT * from COMPANY where id="$id";
    EOF;
    $ret = $db->query($sql);
    if ($ret->fetchArray() == NULL){
        echo "<script>alert('you need logining first.');</script>";
        sleep(5);
        header('Location: nycu_index.php');
        exit();
    }
    // header('Location: nycu_index.php');
    $name = $_POST['name'];
    if ((int)$_POST['age']<=0)
        $age = 0;
    else
        $age = (int)$_POST['age'];
    if ($_POST['sex']=='man')
        $sex = 1;
    else if ($_POST['sex']=='woman')
        $sex = 2;
    else 
        $sex = 0;
    $pro_note = $_POST['profession_note'];
    $intro = $_POST['introduction'];


    $sql =<<<EOF
        UPDATE COMPANY set NAME="$name",AGE=$age,SEX=$sex,PROFESSION_NOTE="$pro_note",INTRODUCTION="$intro" where ID=$id;
    EOF;
    $ret = $db->exec($sql);
    if(!$ret){
        echo $db->lastErrorMsg();
    } else {
        echo $db->changes(), "[$id - $name] data updated successfully\n";
    }
    
    $sql =<<<EOF
    SELECT * from COMPANY where id="$id";
    EOF;
    $ret = $db->query($sql);
    $account="";
    $password="";
    while($row = $ret->fetchArray() ){
        $account = $row['ACCOUNT'];
        $password = $row['PASSWORD'];
    }
?>
<form name="fr" action="./login.php" method="POST">
<input type="hidden" name="account" value="<?php echo $account;?>">
<input type="hidden" name="password" value="<?php echo $password;?>">
<input type="hidden" name="update" value="1">
</form>
<script type="text/javascript">
document.fr.submit();
</script>