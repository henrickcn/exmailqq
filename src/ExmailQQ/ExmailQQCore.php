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
        'accessToken'    => '/cgi-bin/gettoken' , //获取ACCESS_TOKEN
        'departmentList' => '/cgi-bin/department/list' , //获取部门列表
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
                break;
            default:
                return ['errcode' => 1, 'errmsg'=> $type."请求方式不支持"];
        };
        if($curl->error){
            return ['errcode' => 1, 'errmsg'=>$curl->error_message];
        }
        return ['errcode' => 0, 'errmsg'=>'返回成功', 'data'=> $curl->response];
    }
}