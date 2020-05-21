<?php
// +----------------------------------------------------------------------
// | Title   : 通讯录接口
// +----------------------------------------------------------------------
// | Created : Henrick (me@hejinmin.cn)
// +----------------------------------------------------------------------
// | From    : Shenzhen wepartner network Ltd
// +----------------------------------------------------------------------
// | Date    : 2020-05-21 14:33
// +----------------------------------------------------------------------


namespace ExmailQQ;


class ExmailMailList extends ExmailQQCore
{
    public function getDepartmentList($accessToken){
        $data = $this->http($this->getUrl('departmentList'), ['access_token'=>$accessToken]);
        $data = $this->dataFormat($data);
        print_r($data);exit;
    }
}