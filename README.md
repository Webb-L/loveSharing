# 爱分享安装教程
### 因为突发奇想想开发一个视频分享的网站，所以我就利用laravel进行开发出来，可能程序会有不安全或者不稳定，请见谅。
## 1.首先我们先从GitHub下上载项目到本地

```bash
# 从github上下载到本地
git clone https://github.com/Webb-L/loveSharing.git

#下载成功结果
Cloning into 'loveSharing'...
remote: Enumerating objects: 2199, done.
remote: Counting objects: 100% (2199/2199), done.
remote: Compressing objects: 100% (1576/1576), done.
remote: Total 2199 (delta 576), reused 2199 (delta 576), pack-reused 0
Receiving objects: 100% (2199/2199), 17.09 MiB | 17.00 KiB/s, done.
Resolving deltas: 100% (576/576), done.
Updating files: 100% (1967/1967), done.
```

## 2.安装项目依赖

```bash
composer install
# 如果composer 下载慢请配置好国内镜像
npm install
# 如果npm 下载慢请配置好国内镜像
```

## 3.修改配置信息

+ 打开\config\database.php，修改连接数据库信息

	+  ```php
        'mysql' => [
              'driver' => 'mysql',
              'url' => env('DATABASE_URL'),
              'host' => env('DB_HOST', '你的服务器IP地址'),
              'port' => env('DB_PORT', '3306'),
              'database' => env('DB_DATABASE', '数据库名'),
              'username' => env('DB_USERNAME', '数据库用户名'),
              'password' => env('DB_PASSWORD', '数据库密码'),
              'unix_socket' => env('DB_SOCKET', ''),
              'charset' => 'utf8',
              'collation' => 'utf8_general_ci',
              'prefix' => '',
              'prefix_indexes' => true,
              'strict' => true,
              'engine' => null,
              'options' => extension_loaded('pdo_mysql') ? array_filter([
                  PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
              ]) : [],
          ],
        ```

+ 打开\config\mail.php，修改用户验证邮箱

	 + ```php
        <?php
            return [
            // 邮箱服务器类型
            'driver' => env('MAIL_DRIVER', 'smtp'),
            // 邮箱服务器地址
            'host' => env('MAIL_HOST', 'smtp.qq.com'),
            // 邮箱服务器端口
            'port' => env('MAIL_PORT', 25),
            // 邮箱和发送人
            'from' => [
                'address' => env('MAIL_FROM_ADDRESS', '822028533@qq.com'),
                'name' => env('MAIL_FROM_NAME', '爱分享'),
            ],
            // 邮箱加密协议
            'encryption' => env('MAIL_ENCRYPTION', 'tls'),
            // 邮箱账号
            'username' => env('MAIL_USERNAME'),
            // 邮箱密码
            'password' => env('MAIL_PASSWORD'),
            
            'sendmail' => '/usr/sbin/sendmail -bs',
            'markdown' => [
                'theme' => 'default',
                'paths' => [
                    resource_path('views/vendor/mail'),
                ],
            ],
            'log_channel' => env('MAIL_LOG_CHANNEL'),
        ];
        ```
+ 打开\public\js\oss.js，修改云存储只支持阿里云。

  + ```javascript
    const client = new OSS({
        region: '<阿里云oss 地区>',
        accessKeyId: '<您的accessKeyId>',
        accessKeySecret: '<您的accessKeySecret>',
        bucket: '<您的存储桶名称>'
    });
    ```
    
+ 打开\resources\js\bootstrap.js，修改云存储只支持阿里云。

  + ```javascript
    // 和上面的信息请保持一样，这里的是用于前台图片和视频上传'
    window.client = new OSS({
        region: '<阿里云oss 地区>',
        accessKeyId: '<您的accessKeyId>',
        accessKeySecret: '<您的accessKeySecret>',
        bucket: '<您的存储桶名称>'
    });
    ```
    ```bash
    # 打包文件
    npm run watch
    
    # 打包成功后
         Asset       Size   Chunks             Chunk Names
       /css/app.css  188 bytes  /js/app  [emitted]  /js/app
         /js/app.js   5.61 MiB  /js/app  [emitted]  /js/app
    \css\element-ui.css    227 KiB           [emitted]
    # 按两次 ctrl+c，结束打包。
    ```
## 4.上传文件到服务器上
   把文件压缩成压缩包，上传到phpstudy然后解压文件，
   解压成功后/storage目录权限为777。
   
## 5.导入数据库信息
在本地根目录打开cmd
```bash
php artisan migrate:install
# 成功后
Migration table created successfully.

# 创建数据表
php artisan migrate
**************************************
*     Application In Production!     *
**************************************

 Do you really wish to run this command? (yes/no) [no]:
 > y

Migrating: 2014_10_12_000000_create_users_table
Migrated:  2014_10_12_000000_create_users_table (0.21 seconds)
Migrating: 2014_10_12_100000_create_password_resets_table
Migrated:  2014_10_12_100000_create_password_resets_table (0.2 seconds)
Migrating: 2019_08_19_000000_create_failed_jobs_table
Migrated:  2019_08_19_000000_create_failed_jobs_table (0.1 seconds)
Migrating: 2019_12_02_164427_create_video_list_table
Migrated:  2019_12_02_164427_create_video_list_table (0.11 seconds)
Migrating: 2019_12_05_154222_create_news_table
Migrated:  2019_12_05_154222_create_news_table (0.1 seconds)
Migrating: 2019_12_08_101908_create_admin_user_table
Migrated:  2019_12_08_101908_create_admin_user_table (0.21 seconds)
Migrating: 2019_12_10_105507_create_admin_role_table
Migrated:  2019_12_10_105507_create_admin_role_table (0.1 seconds)
Migrating: 2019_12_10_111240_create_admin_auth_table
Migrated:  2019_12_10_111240_create_admin_auth_table (0.1 seconds)

# 填充管理员信息和权限

php artisan db:seed
**************************************
*     Application In Production!     *
**************************************

 Do you really wish to run this command? (yes/no) [no]:
 > y

Seeding: AdminUserSeeder
Seeded:  AdminUserSeeder (0.5 seconds)
Seeding: AdminRoleSeeder
Seeded:  AdminRoleSeeder (0.08 seconds)
Seeding: AdminAuthSeeder
Seeded:  AdminAuthSeeder (0.08 seconds)
Database seeding completed successfully.

```
## 完成
