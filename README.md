# 腾讯企业邮箱开放平台SDK-PHP版

说明：本SDK依赖于curl/curl类，使用SDK时，请先加载curl类，如果使用composer包安装，无需关注次说明

如果你有什么使用问题及bug，你可以到本SDK的github issues提交 [提交问题](https://github.com/henrickcn/exmailqq/issues).

## 安装方法

在终端进入对应的项目目录，输入以下命令:

```sh
composer require henrick/exmailqq
```

或者在composer.json文件追加此行

```json
"henrick/exmailqq": "^2.0"
```

## 使用方法

```php
$ = new Curl\Curl();
$curl->get('http://www.example.com/');
```

```php
$corpid     = "test0001";  //公司ID
$corpsecret = "ii5Q4jihb1CcfyiT1TcIIq0ecmQKvRm"; //应用秘钥

//通讯录接口
$exmail = new ExmailQQ\ExmailQQMailList($corpid, $corpsecret);
$token = $exmail->getAccessToken(); //获取access_token
$department = $exmail->getDepartmentList($token);
```

## 类型接口方法列表
