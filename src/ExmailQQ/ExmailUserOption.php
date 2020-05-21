<?php
// +----------------------------------------------------------------------
// | Title   : 功能设置
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2020-05-21 14:33
// +----------------------------------------------------------------------


namespace ExmailQQ;


class ExmailUserOption extends ExmailQQCore
{

    /**
     * 获取功能属性
     * @param $token 凭证
     * @param $userid 成员UserID
     * @param string $type1 强制启用安全登录
     * @param string $type2 IMAP/SMTP服务
     * @param string $type3 POP/SMTP服务
     * @param string $type4 是否启用安全登录
     * @return mixed
     */
    public function get($token, $userid, $type1='', $type2='', $type3='', $type4=''){
        $data = [
            'userid' => $userid,
            'type'   => []
        ];
        $type1? $data['type'][] = 1 : '';
        $type2? $data['type'][] = 2 : '';
        $type3? $data['type'][] = 3 : '';
        $type4? $data['type'][] = 4 : '';
        return $this->post('getUserOption', $token, $data);
    }

    /**
     * 更新功能属性
     * @param $token 凭证
     * @param $userid 成员UserID
     * @param string $type1 强制启用安全登录
     * @param string $type2 IMAP/SMTP服务
     * @param string $type3 POP/SMTP服务
     * @param string $type4 是否启用安全登录
     * @return mixed
     */
    public function update($token, $userid, $type1='', $type2='', $type3='', $type4=''){
        $data = [
            'userid' => $userid,
            'option'   => []
        ];
        $type1!=='' ? $data['option'][] = ['type'=>1,'value' => strval($type1)] : '';
        $type2!=='' ? $data['option'][] = ['type'=>2,'value' => strval($type2)] : '';
        $type3!=='' ? $data['option'][] = ['type'=>3,'value' => strval($type3)] : '';
        $type4!=='' ? $data['option'][] = ['type'=>4,'value' => strval($type4)] : '';
        return $this->post('updateUserOption', $token, $data);
    }

}