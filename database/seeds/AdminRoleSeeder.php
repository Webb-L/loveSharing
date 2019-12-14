<?php

use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admin_role')->insert([
            [
                'role_name' => '会员管理员',
                'role_auth_ids' => '2,3,4,5,6,7,8',
            ],
            [
                'role_name' => '视频管理员',
                'role_auth_ids' => '10,11,12,13',
            ],
            [
                'role_name' => '展示图管理员',
                'role_auth_ids' => '15',
            ],
            [
                'role_name' => '管理管理员',
                'role_auth_ids' => '17,18,19,20,21,22,23',
            ],
            [
                'role_name' => '角色管理员',
                'role_auth_ids' => '25,26,27,28,29,30',
            ],
            [
                'role_name' => '权限管理员',
                'role_auth_ids' => '32',
            ],
            [
                'role_name' => '视频审核管理员',
                'role_auth_ids' => '34,35,36',
            ],
            [
                'role_name' => '回收站管理员',
                'role_auth_ids' => '38,39,40',
            ],
            [
                'role_name' => '信息管理员',
                'role_auth_ids' => '42,43,44,45',
            ],
        ]);
    }
}
