<?php
// +----------------------------------------------------------------------
// | Title   : 新邮件提醒
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2020-05-21 14:33
// +----------------------------------------------------------------------


namespace ExmailQQ;


class ExmailMail extends ExmailQQCore
{

    /**
     * 获取邮件未读数
     * @param $token 调用接口凭证
     * @param $userid 成员UserID
     * @param $begin_date 开始日期。格式为2016-10-01
     * @param $end_date 结束日期。格式为2016-10-07
     * @return mixed
     */
    public function newCount($token, $userid, $begin_date, $end_date){
        $data = [
            'userid'     => $userid,
            'begin_date' => $begin_date,
            'end_date'   => $end_date
        ];
        return $this->post('newCountMail', $token, $data);
    }

    /**
     * 获取登录企业邮的url
     * @param $token 凭证
     * @param $userid 成员UserID
     * @return mixed
     */
    public function loginUrl($token, $userid){
        $data = [
            'userid' => $userid
        ];
        return $this->get('loginUrlMail', $token, $data);
    }

}