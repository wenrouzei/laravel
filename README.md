# laravel
laravel前后台登录表分离测试

###添加admin-lte后台模板

进入public目录输入

        bower install admin-lte

###前端第三方登录认证（github）

        laravel依赖 composer require laravel/socialite 需对应注入app.php
    
###pusher实现事件广播、聊天室等

        laravel依赖 composer require vinkla/pusher 需对应注入app.php
  
###nodejs express socket.io redis(ioredis) 实现事件广播、聊天室等
    
        需安装redis，并配置redis驱动
        
        
        laravel依赖 composer require predis/predis
        
    
    
        npm insall 各前端js框架 --save
        
        
        
        需要实现双http服务器
