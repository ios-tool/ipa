<?php
$key = 'aaabbb123';       //key参数具体和news中的key参数对应
$udid = $_POST['udid'];   //魔力签用户设备udid
$code = $_POST['code'];   //魔力签用户输入的解锁码

//这里您可以自行接入数据库

if ($code == '123') {   //这里我简单的写，只要用户输入解锁码为123，就解锁成功否则失败。
      
      echo  '{"data":"'.md5($key.$udid).'","msg":"解锁成功"}';   // msg为返回魔力签提示语
             
      } else {
      
    echo  '{"data":"'.md5($udid).'","msg":"解锁码不存在"}';  
}

?>
