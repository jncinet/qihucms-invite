## 安装

```shell
$ composer require jncinet/qihucms-invite
```

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