<?php
    class MyDB extends SQLite3
    {
        function __construct()
        {
            $this->open('/tmp/test.db');
        }
    }
    $db = new MyDB();

    $sql =<<<EOF
        SELECT * from COMPANY;
    EOF;

   $ret = $db->query($sql);
   while($row = $ret->fetchArray() ){
      echo "ID = ". $row['ID'] . "<br>";
      echo "NAME = ". $row['NAME'] ."<br>";
      echo "AGE = ". $row['AGE'] ."<br>";
      echo "SEX =  ".$row['SEX'] ."<br><br>";
   }
//    echo "Operation done successfully\n";
   $db->close();


//    $sql =<<<EOF
//    CREATE TABLE COMPANY
//    (ID INT PRIMARY KEY     NOT NULL,
//    NAME           TEXT    NOT NULL,
//    AGE            INT     NULL,
//    SEX            INT     NOT NULL,
//    ACCOUNT        CHAR(64),
//    PASSWORD        CHAR(64),
//    PROFESSION_NOTE CHAR(64),
//    INTRODUCTION    TEXT