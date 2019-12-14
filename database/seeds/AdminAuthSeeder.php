<?php

use Illuminate\Database\Seeder;

class AdminAuthSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_c = 'Admin\UserController';
        $video_c = 'Admin\UserController';
        $admin_c = 'Admin\AdminUserController';
        $role_c = 'Admin\RoleController';
        $examine_c = 'Admin\ExamineController';
        $recovery_c = 'Admin\RecoveryController';
        $info_c = 'Admin\InfoController';
        DB::table('admin_auth')->insert([
            [
                'auth_pid' => 0,
                'auth_c' => '',
                'auth_a' => '',
                'auth_d' => '会员管理',
            ],
            [
                'auth_pid' => 1,
                'auth_c' => $user_c,
                'auth_a' => 'index',
                'auth_d' => '列表',
            ],
            [
                'auth_pid' => 1,
                'auth_c' => $user_c,
                'auth_a' => 'create',
                'auth_d' => '创建',
            ],
            [
                'auth_pid' => 1,
                'auth_c' => $user_c,
                'auth_a' => 'store',
                'auth_d' => '添加',
            ],
            [
                'auth_pid' => 1,
                'auth_c' => $user_c,
                'auth_a' => 'edit',
                'auth_d' => '修改',
            ],
            [
                'auth_pid' => 1,
                'auth_c' => $user_c,
                'auth_a' => 'update',
                'auth_d' => '更新',
            ],
            [
                'auth_pid' => 1,
                'auth_c' => $user_c,
                'auth_a' => 'destroy',
                'auth_d' => '删除',
            ],
            [
                'auth_pid' => 1,
                'auth_c' => 'Admin\AvatarController',
                'auth_a' => 'index',
                'auth_d' => '头像列表',
            ],
            [
                'auth_pid' => 0,
                'auth_c' => '',
                'auth_a' => '',
                'auth_d' => '视频管理',
            ],
            [
                'auth_pid' => 9,
                'auth_c' => $video_c,
                'auth_a' => 'index',
                'auth_d' => '列表',
            ],
            [
                'auth_pid' => 9,
                'auth_c' => $video_c,
                'auth_a' => 'edit',
                'auth_d' => '修改',
            ],
            [
                'auth_pid' => 9,
                'auth_c' => $video_c,
                'auth_a' => 'update',
                'auth_d' => '更新',
            ],
            [
                'auth_pid' => 9,
                'auth_c' => $video_c,
                'auth_a' => 'destroy',
                'auth_d' => '删除',
            ],
            [
                'auth_pid' => 0,
                'auth_c' => '',
                'auth_a' => '',
                'auth_d' => '展示图管理',
            ],
            [
                'auth_pid' => 14,
                'auth_c' => 'Admin\ImageController',
                'auth_a' => 'index',
                'auth_d' => '列表',
            ],
            [
                'auth_pid' => 0,
                'auth_c' => '',
                'auth_a' => '',
                'auth_d' => '管理员管理',
            ],
            [
                'auth_pid' => 16,
                'auth_c' => $admin_c,
                'auth_a' => 'index',
                'auth_d' => '列表',
            ],
            [
                'auth_pid' => 16,
                'auth_c' => $admin_c,
                'auth_a' => 'create',
                'auth_d' => '创建',
            ],
            [
                'auth_pid' => 16,
                'auth_c' => $admin_c,
                'auth_a' => 'store',
                'auth_d' => '添加',
            ],
            [
                'auth_pid' => 16,
                'auth_c' => $admin_c,
                'auth_a' => 'edit',
                'auth_d' => '修改',
            ],
            [
                'auth_pid' => 16,
                'auth_c' => $admin_c,
                'auth_a' => 'update',
                'auth_d' => '更新',
            ],
            [
                'auth_pid' => 16,
                'auth_c' => $admin_c,
                'auth_a' => 'destroy',
                'auth_d' => '删除',
            ],
            [
                'auth_pid' => 16,
                'auth_c' => 'Admin\AvatarController',
                'auth_a' => 'adminIndex',
                'auth_d' => '头像列表',
            ],
            [
                'auth_pid' => 0,
                'auth_c' => '',
                'auth_a' => '',
                'auth_d' => '角色管理',
            ],
            [
                'auth_pid' => 24,
                'auth_c' => $role_c,
                'auth_a' => 'index',
                'auth_d' => '列表',
            ],
            [
                'auth_pid' => 24,
                'auth_c' => $role_c,
                'auth_a' => 'create',
                'auth_d' => '创建',
            ],
            [
                'auth_pid' => 24,
                'auth_c' => $role_c,
                'auth_a' => 'store',
                'auth_d' => '添加',
            ],
            [
                'auth_pid' => 24,
                'auth_c' => $role_c,
                'auth_a' => 'edit',
                'auth_d' => '修改',
            ],
            [
                'auth_pid' => 24,
                'auth_c' => $role_c,
                'auth_a' => 'update',
                'auth_d' => '更新',
            ],
            [
                'auth_pid' => 24,
                'auth_c' => $role_c,
                'auth_a' => 'destroy',
                'auth_d' => '删除',
            ],
            [
                'auth_pid' => 0,
                'auth_c' => '',
                'auth_a' => '',
                'auth_d' => '权限管理',
            ],
            [
                'auth_pid' => 31,
                'auth_c' => 'Admin\AuthController',
                'auth_a' => 'index',
                'auth_d' => '列表',
            ],
            [
                'auth_pid' => 0,
                'auth_c' => '',
                'auth_a' => '',
                'auth_d' => '视频审核',
            ],
            [
                'auth_pid' => '33',
                'auth_c' => $examine_c,
                'auth_a' => 'index',
                'auth_d' => '列表',
            ],
            [
                'auth_pid' => 33,
                'auth_c' => $examine_c,
                'auth_a' => 'success',
                'auth_d' => '通过',
            ],
            [
                'auth_pid' => 33,
                'auth_c' => $examine_c,
                'auth_a' => 'delete',
                'auth_d' => '删除',
            ],
            [
                'auth_pid' => 0,
                'auth_c' => '',
                'auth_a' => '',
                'auth_d' => '回收站',
            ],
            [
                'auth_pid' => 37,
                'auth_c' => $recovery_c,
                'auth_a' => 'index',
                'auth_d' => '列表',
            ],
            [
                'auth_pid' => 37,
                'auth_c' => $recovery_c,
                'auth_a' => 'recovery',
                'auth_d' => '还原',
            ],
            [
                'auth_pid' => 37,
                'auth_c' => $recovery_c,
                'auth_a' => 'delete',
                'auth_d' => '删除',
            ],
            [
                'auth_pid' => 0,
                'auth_c' => $info_c,
                'auth_a' => '',
                'auth_d' => '信息',
            ],
            [
                'auth_pid' => 41,
                'auth_c' => $info_c,
                'auth_a' => 'index',
                'auth_d' => '列表',
            ],
            [
                'auth_pid' => 41,
                'auth_c' => $info_c,
                'auth_a' => 'create',
                'auth_d' => '创建',
            ],
            [
                'auth_pid' => 41,
                'auth_c' => $info_c,
                'auth_a' => 'store',
                'auth_d' => '添加',
            ],
            [
                'auth_pid' => 41,
                'auth_c' => $info_c,
                'auth_a' => 'destroy',
                'auth_d' => '删除',
            ],
        ]);
    }
}
