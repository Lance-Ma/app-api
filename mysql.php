<?php
$con = mysqli_connect("192.168.1.104","root","root123456");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }else{
  	echo "数据库连接正常";
  }