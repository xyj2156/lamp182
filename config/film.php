<?php
/**
 * Created by PhpStorm.
 * User: JiefKing
 * Date: 2017/7/5
 * Time: 18:45
 */

return [
//    会员等级 权限
    'auth' => [
        '普通会员',
        '黄金会员',
        '钻石会员'
    ],
//    性别
    'sex' => [
        'x' => '保密',
        'm' => '男',
        'w' => '女'
    ],
    'nav' => [
        '首页' => 'admin/index',
        '前台用户管理' => [
            '添加用户' => 'admin/user/create',
            '查看用户' => 'admin/user'
        ],
        '演员管理' => [
            '添加演员' => 'admin/cast/create',
            '查看演员' => 'admin/cast'
        ],
        '分类管理' => [
            '添加分类' => 'admin/type/create',
            '查看分类' => 'admin/type'
        ],
        '网站配置' => [
            '修改配置' => 'admin/config',
            '轮播图' => 'admin/config/banner'
        ],
    ],
    'type' => [
        1 => '地区',
        '年份',
        '语言'
    ],
    'admin_face_path' => '/uploads/uface/admin',
    'home_face_path' => '/uploads/uface/home',
];