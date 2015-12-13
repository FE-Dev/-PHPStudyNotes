# 常量
- 自定义常量
- 系统常量

通过函数 define() 定义。语法格式：  
bool define(string $constant_name,mixed $value[,$case_sensitive = true])  
constant_name 常量名，命名规则和变量一样但不带$  
value 常量值
第三个是可选的，指定是否大小写敏感，默认false，敏感。

# 系统常量

系统常量是PHP已经定义好的常量。  
- __FILE__:获取当前文件在服务器的物理位置。注意，前后各有两个下划线。
- __LINE__:它可以告诉我们，当前代码在第几行
- PHP_VERSION:当前解析器版本号
- PHP_OS:执行当前php版本的操作系统名称

# 如何获取常量值

1. 直接使用常量名
2. 使用constantly()函数