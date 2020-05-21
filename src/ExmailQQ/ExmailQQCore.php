<?php
// +----------------------------------------------------------------------
// | Title   : 腾讯企业邮箱开放平台SDK
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2020-05-21 11:23
// +----------------------------------------------------------------------


namespace ExmailQQ;


use Curl\Curl;

class ExmailQQCore
{
    private $corpid     = ""; //企业ID
    private $corpsecret = ""; //应用的凭证密钥
    const API_DOMAIN  = "https://api.exmail.qq.com"; //api域名
    private $apiUrl = [
        'accessToken'=> '/cgi-bin/gettoken', //获取ACCESS_TOKEN
        //通讯录接口 - 部门
        'listDept'   => '/cgi-bin/department/list', //获取部门列表
        'createDept' => '/cgi-bin/department/create', //创建部门
        'updateDept' => '/cgi-bin/department/update', //更新部门
        'delDept'    => '/cgi-bin/department/delete', //删除部门
        'searchDept' => '/cgi-bin/department/search', //查询部门信息
        //通讯录接口 - 成员
        'createUser'     => '/cgi-bin/user/create', //创建成员
        'updateUser'     => '/cgi-bin/user/update', //更新成员
        'delUser'        => '/cgi-bin/user/delete', //删除成员
        'getUser'        => '/cgi-bin/user/get', //获取成员
        'simplelistUser' => '/cgi-bin/user/simplelist', //获取部门成员
        'listUser'       => '/cgi-bin/user/list', //获取部门成员（详情）
        'batchcheckUser' => '/cgi-bin/user/batchcheck', //批量检查帐号
        //通讯录接口 - 标签
        'createTag'   => '/cgi-bin/tag/create', //创建标签
        'updateTag'   => '/cgi-bin/tag/update', //更新标签名字
        'delTag'      => '/cgi-bin/tag/delete', //删除标签
        'getTag'      => '/cgi-bin/tag/get', //获取标签成员
        'addTagUsers' => '/cgi-bin/tag/addtagusers', //增加标签成员
        'delTagUsers' => '/cgi-bin/tag/deltagusers', //删除标签成员
        'listTag'     => '/cgi-bin/tag/get', //获取标签列表
        //通讯录接口 - 邮件群组
        'createGroup' => '/cgi-bin/group/create', //创建邮件群组
        'updateGroup' => '/cgi-bin/group/update', //更新邮件群组
        'delGroup'     => '/cgi-bin/group/delete', //删除邮件群组
        'getGroup'     => '/cgi-bin/group/get', //获取邮件群组信息
    ];

    /**
     * ExmailQQ constructor.
     * @param $corpid 企业ID
     * @param $corpsecret 应用的凭证密钥
     */
    public function __construct($corpid, $corpsecret) {
        $this->corpid     = $corpid;
        $this->corpsecret = $corpsecret;
    }

    /**
     * 获取access_token
     */
    public function getAccessToken(){
        $data = $this->http($this->getUrl(), ['corpid'=>$this->corpid, 'corpsecret'=>$this->corpsecret]);
        $data = $this->dataFormat($data);
        return $data;
    }

    protected function dataFormat($data){
        if($data['errcode']){
            return $data;
        }
        return json_decode($data['data'], true);
    }

    protected function getUrl($type='accessToken'){
        return self::API_DOMAIN.$this->apiUrl[$type];
    }

    /**
     * 发起请求
     * @param $url
     * @param array $data
     * @param string $type
     */
    public function http($url, $data=[], $type='get'){
        $curl = new Curl();
        switch (strtolower($type)){
            case 'get':
                $curl->get($url, $data);
                break;
            case 'post':
                $curl->post($url,$data);
                break;
            default:
                return ['errcode' => 1, 'errmsg'=> $type."请求方式不支持"];
        };
        if($curl->error){
            return ['errcode' => 1, 'errmsg'=>$curl->error_message];
        }
        return ['errcode' => 0, 'errmsg'=>'返回成功', 'data'=> $curl->response];
    }

    /**
     * 发送post请求
     * @param string $apiType
     * @param $token
     * @param array $data
     * @return mixed
     */
    protected function post($apiType='createDept', $token, $data=[]){
        $data = $this->http(
            $this->getUrl($apiType)."?access_token=".$token,
            json_encode($data, 256),
            'post'
        );
        return $this->dataFormat($data);
    }

    /**
     * 发送get请求
     * @param string $apiType
     * @param array $data
     * @return mixed
     */
    protected function get($apiType='createDept', $token, $data=[]){
        $data['access_token'] = $token;
        $data = $this->http(
            $this->getUrl($apiType),
            $data,
            'get'
        );
        return $this->dataFormat($data);
    }
}