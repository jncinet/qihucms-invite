<h1 align="center">站内支付货币管理</h1>

## 安装
```shell
$ composer require jncinet/qihucms-invite
```

## 开始
### 数据迁移
```shell
$ php artisan migrate
```

### 发布资源
```shell
$ php artisan vendor:publish --provider="Qihucms\Invite\InviteServiceProvider"
```

## 后台菜单
+ 会员关系 `invite/invites`

## 使用

### 路由能参数说明

#### 我的关系

```php
route('api.invite.my')
请求：GET
地址：/invite/my
返回值：
{
    'user_id' => 会员ID号,
    'parent' => {师父信息},
    'grandfather' => {师祖信息},
    'son_count' => 徒弟数,
    'grandson_count' => 徒孙数,
}

```

#### 我的徒弟列表

```php
route('api.invite.td')
请求：GET
地址：/invite/td
参数：
int $limit （选填）显示条数
返回值：
{
    data: [
        {
            user_id: 用户ID号
            user：{会员信息}
        },
        ...
    ],
    links:{},
    meta:{}
}
```

#### 我的徒孙列表

```php
route('api.invite.ts')
请求：GET
地址：/invite/ts
参数：
int $limit （选填）显示条数
返回值：
{
    data: [
        {
            user_id: 用户ID号
            user：{会员信息}
        },
        ...
    ],
    links:{},
    meta:{}
}
```

### 事件调用

```php
// 创建推荐关系
Qihucms\Invite\Events\Invited
```

# 数据库

### 关系表：invites

| Field             | Type      | Length    | AllowNull | Default   | Comment       |
| :----             | :----     | :----     | :----     | :----     | :----         |
| user_id           | bigint    |           |           |           | 会员ID         |
| parent_id         | bigint    |           |           |           | 师父ID         |
| grandfather_id    | bigint    |           |           |           | 太师ID         |
| son_count         | int       |           |           | 0         | 徒弟数         |
| grandson_count    | int       |           |           | 0         | 徒孙数         |
