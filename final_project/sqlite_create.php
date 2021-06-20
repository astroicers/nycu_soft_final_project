<?php
   error_reporting(0);
   class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('/tmp/test.db');
      }
   }
   $db = new MyDB();
   if(!$db){
      echo $db->lastErrorMsg();
   } else {
      echo "Opened database successfully<br>";
   }

   $sql =<<<EOF
      CREATE TABLE COMPANY
      (ID INTEGER  PRIMARY KEY    AUTOINCREMENT,
      NAME TEXT    DEFAULT "No_name" NOT NULL,
      AGE            INT     NULL,
      SEX            INT     NULL,
      ACCOUNT        CHAR(64),
      PASSWORD        CHAR(64),
      PROFESSION_NOTE CHAR(64),
      INTRODUCTION    TEXT
      );
   EOF;

   $ret = $db->exec($sql);
   if(!$ret){
      echo $db->lastErrorMsg();
   } else {
      echo "Table created successfully<br>";
   }
   // $db->close();

