# 魔力签软件源制作教程

魔力签软件源旨在构建一个ipa分享生态圈，采用json格式规范。制作软件源无需使用自己独立的服务器，可将软件源文件，和相关资源（如ipa包，图片素材等）上传至公开的公共平台，如Github等 (直接支持蓝奏云的链接，请看以下例子)
如下载为蓝奏云地址注意事项
https://myipa.lanzous.com/iSPqzghedch 错误格式
https://myipa.lanzous.com/tp/iSPqzghedch 正确格式
（蓝奏地址必须加/tp/才能正常解析）

- #### 软件源制作流程
1. 新建一个空文本文件，按规下文范编写软件源json文件，例子如下:
```
{
"news": {
      "title":"软件源名称", 
      "caption":"温馨提示：公告内容提示语，留空则不显示",
      "date":"2020-03-28 12:30",
      "key":"aaabbb123",
      "tintColor":"10b6ff",
      "isUnlock":1,
      "imageURL":"图片URL地址",
      "url":"授权解锁URL接口地址",
      "pay":"购买解锁码URL地址，留空则不显示。"
      },
           
 "apps": [
     {
         "name":"App名字",
         "versionDate":"2020-11-21 11:55:10",
         "version":"v1",
         "iconURL":"图片URL地址",
         "downloadURL":"图片IPA下载地址",
         "size":"文件大小，留空不显示",
         "isNeedlock":0,
         "appType":1,
         "localizedDescription":"软件介绍内容"
      },
      {
          "name":"App名字-2",
          "versionDate":"2020-11-21 11:55:10",
          "version":"v1",
          "iconURL":"图片URL地址",
          "downloadURL":"图片IPA下载地址",
          "size":"58M",
          "isNeedlock":0,
          "appType":1,
          "localizedDescription":"软件介绍内容"
      },
      {
            "name":"App名字-3",
            "versionDate":"2020-11-21T11:55:19+00:00",
            "version":"v9",
            "iconURL":"图片URL地址",
            "downloadURL":"https://ios-tool.com/app.plist",
            "size":"4M",
            "isNeedlock":"0",
            "appType":3,
            "localizedDescription":"软件介绍内容"
      }
      ]
      
}
```

2. 所编写的源内容必须为合法json，可以使用 [json.cn](https://www.json.cn/) 进行语法检测

3. 软件源加密(为了保护自身劳动成果，您可以把编译好的JSON内容进行加密转换)加密不是必须的
- ### JSON加密地址[https://sign.iostool.pro/json/json.php](https://sign.iostool.pro/json/json.php) 

4. 软件源参数

"news":参数说明注意事项：
1 · key值：用于配制授权接口，news中的key配置值必须和接口中的值一致，否则无法成功解锁。
2 · isUnlock值：保持默认值为1 
3 · url值：用于请求验证地址接口。
4 · pay值：购买卡密地址，留空则不显示。
5 · apps参数中isNeedlock

"apps":参数说明
1 · isNeedlock值：0 代表免费下载 1 代表用户需要授权解锁才能下载。#如果应用中有加锁您必须配置url授权接口和key
2 · appType值：1 代表ipa直连下载地址 2 代表跳转浏览器地址 3 代表直接安装无需签名后缀.plist格式

```
{
"news": {
      "title":"软件源名称",
      "caption":"温馨提示：公告内容提示语，留空则不显示",
      "date":"2020-03-28 12:30",
      "key":"aaabbb123",                       #key用于配置授权接口建议8位数以上
      "tintColor":"10b6ff",
      "isUnlock":1,                            #isUnlock保持默认1
      "imageURL":"图片URL地址",
      "url":"授权解锁URL接口地址",                #url是请求验证解锁APP，具体参考api教程
      "pay":"购买解锁码URL地址，留空则不显示。"     #购买解锁码地址如：发卡地址
      },
           
 "apps": [
     {
         "name":"App名字",
         "versionDate":"2020-11-21 11:55:10",
         "version":"v1",
         "iconURL":"图片URL地址",
         "downloadURL":"图片IPA下载地址",
         "size":"文件大小，留空不显示",
         "isNeedlock":0,                         # 0 代表免费下载 1 代表用户需要授权解锁才能下载，如果应用中有加锁您必须配置url授权接口和key
         "appType":1,                            # 1 代表ipa直连下载地址 2 代表跳转浏览器地址 3 代表直接安装无需签名后缀.plist格式
         "localizedDescription":"软件介绍内容"
      }
      ]
      
}

```

5. (url授权接口说明) 
如果您的应用有参数isNeedlock为1代表用户下载时需先解锁，您必须配置url授权解锁接口和key，具体参数如下。
```
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

```


