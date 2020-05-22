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
"henrick/exmailqq": "v1.0.0"
```

## 使用方法

```php
$corpid     = "test0001";  //公司ID
$corpsecret = "ii5Q4jihb1CcfyiT1TcIIq0ecmQKvRm"; //应用秘钥

//通讯录接口
$exmail = new \Henrick\ExmailQQ\ExmailQQMailList($corpid, $corpsecret);
$token = $exmail->getAccessToken(); //获取access_token
$department = $exmail->getDepartmentList($token);
```
## 开发注意事项
* access_token获取后，需要开发者自行保存维护，建议存储到redis或者其他缓存中。

## 类文件说明
* ExmailQQCore.php
> SDK公共文件，封装了curl方法及获取access_token方法
* ExmailMailList.php
> 通讯录接口，包括：管理部门、管理成员、管理标签、管理邮件群组
* ExmailUserOption.php
> 功能设置，包括：获取功能属性，更改功能属性
* ExmailLog.php
> 系统日志，包括：查询邮件概况、查询邮件、查询成员登录、查询批量任务、查询操作记录
* ExmailMail.php
> 新邮件提醒，单点登录，包括：获取邮件未读数、获取登录企业邮的url

如果觉得有帮助到你，也欢迎各路大佬打赏！
<img src="https://henrickcn.github.io/exmailqq/img/wechat-pay.jpeg" width = "300" height = "300" div align=left />
