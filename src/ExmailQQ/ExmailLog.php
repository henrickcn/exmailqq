<?php
// +----------------------------------------------------------------------
// | Title   : 系统日志
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2020-05-21 14:33
// +----------------------------------------------------------------------


namespace Henrick\ExmailQQ;


class ExmailLog extends ExmailQQCore
{

    /**
     * 查询邮件概况
     * @param $token 凭证
     * @param $domain 域名
     * @param string $end_date 开始日期。格式为2016-10-01
     * @param string $end_date 结束日期。格式为2016-10-07
     * @return mixed
     */
    public function mailStatus($token, $domain, $begin_date, $end_date){
        $data = [
            'domain'     => $domain,
            'begin_date' => $begin_date,
            'end_date'   => $end_date
        ];
        return $this->post('mailStatusLog', $token, $data);
    }

    /**
     * 查询邮件
     * @param $token 调用接口凭证
     * @param $begin_date 开始日期。格式为2016-10-01
     * @param $end_date 开始日期。格式为2016-10-07
     * @param $mailtype 邮件类型。0:收信+发信 1:发信 2:收信
     * @param $userid 筛选条件：指定成员帐号
     * @param $subject 筛选条件：包含指定主题内容
     */
    public function mail($token, $begin_date, $end_date, $mailtype, $userid='', $subject=''){
        $data = [
            'mailtype'   => $mailtype,
            'begin_date' => $begin_date,
            'end_date'   => $end_date,
            'userid'     => $userid,
            'subject'    => $subject,
        ];
        return $this->post('mailLog', $token, $data);
    }

    /**
     * 查询成员登录日志
     * @param $token 调用接口凭证
     * @param $begin_date 开始日期。格式为2016-10-01
     * @param $end_date 结束日期。格式为2016-10-07
     * @param $userid 成员UserID。企业邮帐号名，邮箱格式
     * @return mixed
     */
    public function login($token, $begin_date, $end_date, $userid){
        $data = [
            'begin_date' => $begin_date,
            'end_date'   => $end_date,
            'userid'     => $userid,
        ];
        return $this->post('loginLog', $token, $data);
    }

    /**
     * 查询成员登录日志
     * @param $token 调用接口凭证
     * @param $begin_date 开始日期。格式为2016-10-01
     * @param $end_date 结束日期。格式为2016-10-07
     * @return mixed
     */
    public function batchJob($token, $begin_date, $end_date){
        $data = [
            'begin_date' => $begin_date,
            'end_date'   => $end_date,
        ];
        return $this->post('batchJobLog', $token, $data);
    }

    /**
     * 查询操作记录
     * @param $token 调用接口凭证
     * @param $type type    类型
                            1：all
                            2：开放协议同步
                            3：编辑管理员帐号
                            4：设置分级管理员
                            5：编辑企业信息
                            6：收信黑名单设置
                            7：邮件转移设置
                            8：成员与群组管理
                            9：邮件备份管理
                            10：成员权限控制
     * @param $begin_date 开始日期。格式为2016-10-01
     * @param $end_date 结束日期。格式为2016-10-07
     * @return mixed
     */
    public function operation($token, $type, $begin_date, $end_date){
        $data = [
            'type'       => $type,
            'begin_date' => $begin_date,
            'end_date'   => $end_date,
        ];
        return $this->post('operationLog', $token, $data);
    }

}