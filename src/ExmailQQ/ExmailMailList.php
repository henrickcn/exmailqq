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


namespace Henrick\ExmailQQ;


class ExmailMailList extends ExmailQQCore
{

    /**
     * 创建部门
     * @param $token 凭证
     * @param $name  部门名称
     * @param int $parentid 父部门ID
     * @param int $order 排序
     * @return mixed
     */
    public function createDepartment($token, $name, $parentid=1, $order=0){
        $data = [
            'name'     => $name,
            'parentid' => $parentid,
            'order'    => $order
        ];
        return $this->post('createDept', $token, $data);
    }

    /**
     * 更新部门
     *@param $token 凭证
     * @param $id 部门ID
     * @param $name  部门名称
     * @param int $parentid 父部门ID
     * @param int $order 排序
     * @return mixed
     */
    public function updateDepartment($token, $id, $name, $parentid='', $order=''){
        $data = [
            'id'       => intval($id),
            'name'     => $name
        ];
        $parentid!=='' ? $data['parentid'] = intval($parentid):'';
        $order!==''    ? $data['order']    = intval($order)   :'';
        return $this->post('updateDept', $token, $data);
    }

    /**
     * 查询部门信息
     * @param $token 凭证
     * @param $name 部门名字
     * @param $fuzzy 是否模糊匹配
     */
    public function searchDepartment($token, $name, $fuzzy=1){
        $data = [
            'name'  => $name,
            'fuzzy' => intval($fuzzy)
        ];
        return $this->post('searchDept', $token, $data);
    }

    /**
     * 删除部门
     * @param $token 凭证
     * @param $id 部门ID
     * @return mixed
     */
    public function delDepartment($token, $id){
        return $this->get('delDept', $token, ['id' => intval($id)]);
    }

    /**
     * 获取部门
     * @param $token 凭证
     * @param $id 部门ID
     */
    public function getDepartmentList($token, $id=''){
        return $this->get('listDept', $token, ['id' => $id]);
    }

    /**
     * 添加成员
     * @param $token 调用接口凭证
     * @param $userid 企业邮帐号名，邮箱格式
     * @param $name 成员名称
     * @param $department 成员所属部门ID
     * @param $password 登录密码
     * @param string $position 职位信息
     * @param string $mobile 手机号码
     * @param string $tel 座机号码
     * @param string $extid 编号
     * @param string $gender 性别。1表示男性，2表示女性
     * @param string $slaves 别名列表
     * @param string $cpwd_login 用户重新登录时是否重设密码 0表示否，1表示是，缺省为0
     */
    public function createUser($token, $userid, $name, $department, $password, $position='', $mobile='', $tel='', $extid='', $gender='', $slaves='', $cpwd_login=''){
        $data = [
            'userid'     => $userid,
            'name'       => $name,
            'department' => $department,
            'password'   => $password
        ];
        $position!==''   ? $data['position']   = $position           : '';
        $mobile!==''     ? $data['mobile']     = $mobile             : '';
        $tel!==''        ? $data['tel']        = $tel                : '';
        $extid!==''      ? $data['extid']      = $extid              : '';
        $gender!==''     ? $data['gender']     = strval($gender)     : '';
        $slaves!==''     ? $data['slaves']     = $slaves             : '';
        $cpwd_login!=='' ? $data['cpwd_login'] = intval($cpwd_login) : '';
        return $this->post('createUser', $token, $data);
    }

    /**
     * 更新成员
     * @param $token 调用接口凭证
     * @param $userid 企业邮帐号名，邮箱格式
     * @param $name 成员名称
     * @param $department 成员所属部门ID
     * @param $password 登录密码
     * @param string $position 职位信息
     * @param string $mobile 手机号码
     * @param string $tel 座机号码
     * @param string $extid 编号
     * @param string $gender 性别。1表示男性，2表示女性
     * @param string $slaves 别名列表
     * @param string $cpwd_login 用户重新登录时是否重设密码 0表示否，1表示是，缺省为0
     * @param string $enable 启用/禁用成员 1表示启用成员，0表示禁用成员
     */
    public function updateUser($token, $userid, $name='', $department='', $password='', $position='', $mobile='', $tel='', $extid='', $gender='', $slaves='', $cpwd_login='', $enable=1){
        $data = [
            'userid'     => $userid,
        ];
        $name!==''       ? $data['name']       = $name               : '';
        $department!=='' ? $data['department'] = $department         : '';
        $password!==''   ? $data['password']   = $password           : '';
        $position!==''   ? $data['position']   = $position           : '';
        $mobile!==''     ? $data['mobile']     = $mobile             : '';
        $tel!==''        ? $data['tel']        = $tel                : '';
        $extid!==''      ? $data['extid']      = $extid              : '';
        $gender!==''     ? $data['gender']     = strval($gender)     : '';
        $slaves!==''     ? $data['slaves']     = $slaves             : '';
        $cpwd_login!=='' ? $data['cpwd_login'] = intval($cpwd_login) : '';
        $enable!==''     ? $data['enable'] = intval($enable)         : '';
        return $this->post('updateUser', $token, $data);
    }

    /**
     * 删除成员
     * @param $token
     * @param $userid
     */
    public function delUser($token, $userid){
        return $this->get('delUser', $token, [ 'userid' => $userid ]);
    }

    /**
     * 获取成员
     * @param $token
     * @param $userid
     */
    public function getUser($token, $userid){
        return $this->get('getUser', $token, [ 'userid' => $userid ]);
    }

    /**
     * 获取部门成员
     * @param $token
     * @param $departmentid
     * @param int $fetchChild
     */
    public function getSimpleListUser($token, $departmentid, $fetchChild=1){
        return $this->get('simplelistUser', $token, [ 'department_id' => $departmentid, 'fetch_child' => $fetchChild ]);
    }

    /**
     * 获取部门成员-详情
     * @param $token
     * @param $departmentid
     * @param int $fetchChild
     */
    public function getListUser($token, $departmentid, $fetchChild=1){
        return $this->get('listUser', $token, [ 'department_id' => $departmentid, 'fetch_child' => $fetchChild ]);
    }

    /**
     * 批量检查帐号
     * @param $token
     * @param $departmentid
     * @param int $fetchChild
     */
    public function batchCheck($token, $userlist=[]){
        return $this->post('batchcheckUser', $token, ['userlist' => $userlist]);
    }

    /**
     * 创建标签
     * @param $token
     * @param $departmentid
     * @param int $fetchChild
     */
    public function createTag($token, $tagname, $tagid=''){
        $data = [
            'tagname' => $tagname
        ];
        $tagid !== '' ? $data['tagid'] = intval($tagid) : '';
        return $this->post('createTag', $token, $data);
    }

    /**
     * 更新标签名字
     * @param $token
     * @param $departmentid
     * @param int $fetchChild
     */
    public function updateTag($token, $tagname, $tagid=''){
        $data = [
            'tagname' => $tagname
        ];
        $tagid !== '' ? $data['tagid'] = intval($tagid) : '';
        return $this->post('updateTag', $token, $data);
    }

    /**
     * 获取标签列表
     * @param $token
     * @return mixed
     */
    public function listTag($token){
        return $this->get('listTag', $token);
    }

    /**
     * 删除标签
     * @param $token
     * @return mixed
     */
    public function delTag($token, $tagid){
        return $this->get('delTag', $token, [ 'tagid' => $tagid ]);
    }

    /**
     * 获取标签成员
     * @param $token
     * @return mixed
     */
    public function getTag($token, $tagid){
        return $this->get('getTag', $token, [ 'tagid' => $tagid ]);
    }

    /**
     * 增加标签成员
     * @param $token
     * @return mixed
     */
    public function addTagUsers($token, $tagid, $userlist=[], $partylist){
        $data = [
            'tagid' => $tagid
        ];
        if(!empty($userlist))
            $data['userlist'] = $userlist;
        if(!empty($partylist))
            $data['partylist'] = $partylist;

        return $this->post('addTagUsers', $token, $data);
    }

    /**
     * 删除标签成员
     * @param $token
     * @return mixed
     */
    public function delTagUsers($token, $tagid, $userlist=[], $partylist){
        $data = [
            'tagid' => $tagid
        ];
        if(!empty($userlist))
            $data['userlist'] = $userlist;
        if(!empty($partylist))
            $data['partylist'] = $partylist;

        return $this->post('delTagUsers', $token, $data);
    }

    /**
     * 创建邮件群组
     * @param $token
     * @param $groupid
     * @param $groupname
     * @param int $allow_type
     * @param array $userlist
     * @param array $grouplist
     * @param array $department
     * @param array $allow_userlist
     * @return mixed
     */
    public function createGroup($token, $groupid, $groupname, $allow_type=0, $userlist=[], $grouplist=[], $department=[], $allow_userlist=[]){
        $data = [
            'groupid'        => $groupid,
            'groupname'      => $groupname,
            'allow_type'     => $allow_type,
            'userlist'       => $userlist,
            'grouplist'      => $grouplist,
            'department'     => $department,
            'allow_userlist' => $allow_userlist
        ];
        return $this->post('createGroup', $token, $data);
    }

    /**
     * 更新邮件群组
     * @param $token
     * @param $groupid
     * @param $groupname
     * @param string $allow_type
     * @param array $userlist
     * @param array $grouplist
     * @param array $department
     * @param array $allow_userlist
     * @return mixed
     */
    public function updateGroup($token, $groupid, $groupname, $allow_type='', $userlist=[], $grouplist=[], $department=[], $allow_userlist=[]){
        $data = [
            'groupid'        => $groupid,
            'groupname'      => $groupname,
        ];

        $allow_type!== ''              ? $data['allow_type']     = intval($allow_type) : '';
        !empty($grouplist)             ? $data['grouplist']      = $grouplist : '';
        !empty($userlist)              ? $data['userlist']       = $userlist  : '';
        !empty($department)            ? $data['department']     = $department : '';
        !empty($allow_userlist)        ? $data['allow_userlist'] = $allow_userlist : '';
        return $this->post('updateGroup', $token, $data);
    }

    /**
     * 删除群组
     * @param $token
     * @param $groupid
     * @return mixed
     */
    public function delGroup($token, $groupid){
        return $this->get('delGroup', $token, ['groupid' => $groupid]);
    }

    /**
     * 获取邮件群组信息
     * @param $token
     * @param $groupid
     * @return mixed
     */
    public function getGroup($token, $groupid){
        return $this->get('getGroup', $token, ['groupid' => $groupid]);
    }

}