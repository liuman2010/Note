<?php

---------------------------数据库常用存储类型------------------------------

字符串类型：   
CHAR(M)                M      M为(0~255之间的整数)      储存小量 
VARCHAR(M)             M      M为(0~65535之间的整数)    储存大量 可变的数据

TEXT系列：
TINYTEXT		0~255 	
TEXT  			0~65535
MEDIUMTEXT      0~167772150
LONGTEXT        0~4294967295


整数类型：
TINYINT          1      0-255	 	    无符号
SMALLINT         2      0-255 65535 	无符号
MEDIUMINT        3      0-1677215       无符号
INT或者INTEGER   4      0-4294967295    无符号
BIGINT           8      


浮点类型
FLOAT 			 4      
DOUBLE			 8

日期类型：
DATE             4  	1000-01-01			        9999-12-31
DATETIME		 8 		1000-01-01 00:00:00			9999-12-31 23:59:59
TIMESTAMP		 4 		1970 0101 08 00 01 			2038年的某个时刻
TIME  			 3 		-835:59:59 				    835:59:59
YEAR             1      1901 						2155


--------------------------------数据定义DDL---------------------------------------

数据库操作
CREATE DATABASE test;

删除数据库
DROP DATABASE test;

修改表名字
ALTER TABLE nx_djkk rename nx_user;

删除一个表
DROP TABLE nx_user;

清空数据表的数据
DELETE   FROM nx_user;
TRUNCATE nx_user;


复制一个表和结构
CREATE TABLE nx_info LIKE nx_user;


复制一个表的数据
INSERT INTO nx_info(username,email) SELECT username,email FROM nx_user;

Oracle,DB2,SQL Server mysql ,SyBase LnFoxmix



查看创建表SQL语句
SHOW CREATE TABLE nx_user;

增加一个字段
ALTER TABLE nx_user ADD age VARCHAR(2);

在表的最前位置增加一个字段 status
ALTER TABLE nx_user ADD status TINYINT NOT NULL DEFAULT 1 FIRST;

在id字段后增加一个字段
ALTER TABLE nx_user ADD uid INT NOT NULL DEFAULT 0 AFTER id;

删除一个字段
ALTER TABLE nx_user DROP status;

修改一个字段的数据类型
ALTER TABLE nx_user MODIFY username VARCHAR(20);

修改一个字段的名称
ALTER TABLE nx_user CHANGE password pwd VARCHAR(20);

调整字段的位置
ALTER TABLE nx_user MODIFY views SMALLINT(5) UNSIGNED FIRST;


创建索引
ALTER TABLE nx_article ADD INDEX index_title(title);
ALTER TABLE nx_article ADD UNIQUE(title);   唯一索引
ALTER TABLE nx_article ADD PRIMARY KEY(id);

CREATE INDEX index_title ON nx_article(title);
CREATE UNIQUE INDEX index_title ON nx_article(title);

删除索引
DROP INDEX;

查看索引
ALTER TABLE nx_user DROP INDEX index_username;
SHOW INDEX FROM nx_user;



创建视图(频繁查询的中间表)
CREAT VIEW v_user as SELECT * FROM nx_user WHERE id>6;

删除视图
DROP VIEW v_user;


修改数据表结构
ALTER TABLE nx_user engine=innodb;

操作表的约束
UNSIGNED         无符号
NOT NULL         非空
DEFAULT          默认
UNIQUE           唯一
PRIMARY KEY      主键
AUTO_INCREMENT   自增

创建用户表
CREATE TABLE nx_user(
	id 		  	INT  			NOT NULL 	AUTO_INCREMENT PRIMARY KEY,
	username 	VARCHAR(20)		NOT NULL 	DEFAULT '',
	password 	VARCHAR(32)		NOT NULL	DEFAULT '46f94c8de14fb36680850768ff1b7f2a',
	email		VARCHAR(50)		NOT NULL	DEFAULT 'test@qq.com'
);


创建牌具产品表
CREATE TABLE nx_article(
	id 		   INT      	    NOT NULL    AUTO_INCREMENT PRIMARY KEY,
	title      VARCHAR(50)      NOT NULL    DEFAULT '',
	pid		   TINYINT(2)       NOT NULL    DEFAULT '0',
	path       VARCHAR(100)     NOT NULL    DEFAULT '',
	status     TINYINT(1)       NOT NULL    DEFAULT 1,
	list       VARCHAR(50)      NOT NULL    DEFAULT 'list',
	article    VARCHAR(50)      NOT NULL    DEFAULT 'article'
);



--------------------------------数据查询语言DQL&数据操纵语言DML-----------------------------
插入一条数据 
INSERT INTO nx_article(title,pid,path,status,list,article) VALUES("三公分析仪",0,'','','','');

插入多条数据，注意 VALUES后面不要有括号
INSERT INTO nx_article(title,pid,path,status,list,article) VALUES
	("aaaaa",0,'','','',''),
	("bbbbb",0,'','','',''),
	("ccccc",0,'','','',''),
	("ddddd",0,'','','',''),
	("eeeee",0,'','','',''),
	("fffff",0,'','','','');



插入数据
INSERT INTO nx_user(username,password,email) VALUES 
("xiaozhou",md5("123456"),"liuman@qq.com"),
("xiaowu",md5("123456"),"liuman@qq.com"),
("xiaoqiu",md5("123456"),"liuman@qq.com"),
("xiaoguan",md5("123456"),"liuman@qq.com"),
("xiaomo",md5("123456"),"liuman@qq.com"),
("xiaoyan",md5("123456"),"liuman@qq.com"),
("xiaohuang",md5("123456"),"liuman@qq.com"),
("xiaomiao",md5("123456"),"liuman@qq.com");


按条件删除数据
DELETE FROM nx_user where id=2;


修改一条数据
UPDATE test.nx_user SET username="djkk" where username="xiaomo"; 




查询所有数据
SELECT * FROM nx_user;

选择字段查询
SELECT username,password FROM nx_user where id > 5;


起别名查询
SELECT username as 客服名字, password as 客服密码 FROM nx_user;
SELECT id,title as 产品标题,views as 浏览次数 from nx_article;


查询后排序  desc倒序     asc顺序
SELECT id,title FROM nx_article order by id desc;



-----------------------------------数据库常用函数-----------------------------------
【字符串操作函数】
使用CONCAT 链接字符串函数
SELECT CONCAT("hello"," ","world!") as myname;

转换成小写
SELECT LCASE("HELLO WORLD ! DJKK ") as test;

转换成大写
SELECT UCASE("hello world ! DJKK ") as test;

string长度
SELECT LENGTH("hello world ! DJKK ") as test;

去除前端空格

SELECT LTRIM("    hello world ! DJKK ") as test;

去除后端空格
SELECT RTRIM("    hello world ! DJKK ") as test;

重复N次
SELECT REPEAT("dj-",8) as test;


搜索替换
SELECT REPLACE("dj kk REMIX!","kk","liuman") as test;


字符串截取
PHP    的substr 开始位置是0
MYSQL  的substr 开始位置是1
SELECT SUBSTR("dj kk REMIX!",1,2) as test;

生成N个空格
SELECT CONCAT("dj",SPACE(2),"liuman")as test;


使用md5加密
SELECT id ,md5(title),pid FROM nx_article;


【日期函数】
SELECT curdate() as test; 		   返回当前日期

SELECT curtime() as test; 		   返回当前时间

SELECT now() as test;     		   返回当前的日期时间

SELECT UNIX_TIMESTAMP(curdate());  返回当前日期的时间戳





【数学函数】
bin
转二进制
SELECT bin(520);


CEILING 
向上取整
SELECT CEILING(99.9);


FLOOR 
向下取整
SELECT FLOOR(99.9);


开平方
SELECT SQRT(32);


返回0-1内的随机值
RAND
SELECT CEILING(RAND()*100) as number;


【mysql预处理语句】
1、首先定义预处理语句
prepare test from 'SELECT * FROM nx_user WHERE id >?';

2、设置变量
SET @i = 5;

3、执行语句
execute test using @i;

DROP prepare test;



【事务处理】MyIsam不支持事务  InnoDb才支持
1、首先关闭自动提交语句执行
SET AUTOCOMMIT = 0;

2、从表中删除一条记录
DELETE FROM nx_user where id=6;

3、此时做一个p1还原点
savepoint p1;

4、再次再表中删除一条数据
DELETE FROM nx_user WHERE id=9;

5、savepoint p2;

恢复到p1的还原点，同时注销之后的其它还原点
6、rollback tp p1;


7、退回到最原始的还原点
rollback



【创建存储】
简单的执行代码段
\d //
create procedure p2()
bengin
set @i=0;
while @i<10 do
insert into nx_user VALUES('',CONCAT("djkk",@i),'1'); 
set @i = @i+1;
end while;
//

DROP PROCEDURE p2;



【触发器】修改一个表，同时另一个表也被修改
create trigger nx_info before insert on nx_user for each row
begin
insert into nx_info(name) values ('',new.name,'1');
end//

\d ;







-----------------------------------PHP常用函数-----------------------------------
【字符串操作函数】
substr($str,0,5)								字符串截取



【数组操作函数】
array_keys()							获得数组的键名
array_values()							获得数组的键值
in_array()		    					判断数组中是否存在某个值
array_flip()							交换数组中的健和值
array_reverse()     					数组中的元素顺序翻转
sizeof() 								统计数组中的元素个数
count()   								统计数组中的元素个数
array_count_values()					统计数组中的元素出现的次数
array_unique()      					去除数组中重复出现的值
array_filter()      					用回调函数过滤数组中的元素
array_walk()        					对数组中的每个元素应用到回调函数处理
array_map()         					每个元素应用到回调函数处理 可以处理多个数组
array_column()      					返回$arrs数组中键值为column_key的列
sort()									按值由小到大
rsort() 								按值由大到小
asort() 								按键由小到大
arsort()    							按键由大到小
usort() 								按回调函数
uasort()            					按回调函数 保持索引不变
natsort()								按自然排序
natcasesort()   						按自然排序 不区分大小写
array_multisort()   					对多个数组或二维数组进行排序
array_​slice()       					根据条件取出一段值并返回
array_​splice()        					选择一系列元素并删除或者替换
end()  									取得数组最后的一个元素
array_​column()  						取得多维数组的某个元素列
array_​combine() 						合并两个数组组成一个新数组
array_​change_​key_​case() 				将数组的键都转为大写字母或者小写字母
array_​chunk()							将数组按N个元素切割变成二维数组，不是平均分割
array_​diff_​assoc()                      函数用于比较两个（或更多个）数组的键名和键值 ，并返回差集。
array_​diff_​key()                        比较两个数组的键名，并返回差集
array_​diff_​uassoc()                     !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
array_​diff_​ukey()
array_​diff()
array_​fill_​keys()
array_​fill()
array_​intersect_​assoc()
array_​intersect_​key()
array_​intersect_​uassoc()
array_​intersect_​ukey()
array_​intersect()
array_​key_​exists()
array_​merge_​recursive()
array_​merge()
array_​multisort()
array_​pad()
array_​pop()
array_​product()
array_​push()
array_​rand()
array_​reduce()
array_​replace_​recursive()
array_​replace()
array_​search()
array_​shift()
array_​splice()
array_​sum()
array_​udiff_​assoc()
array_​udiff_​uassoc()
array_​udiff()
array_​uintersect_​assoc()
array_​uintersect_​uassoc()
array_​uintersect()
array_​unshift()
array_​walk_​recursive()
compact
current
each($arrs)										遍历数组, 返回一个数字索引的数组和key,value的下标数组

extract
in_​array
key_​exists
key
list
natcasesort
natsort
next
pos
prev
range
reset
shuffle




【服务器环境相关函数】
【正则函数】
【文件操作函数】
【时间日期函数】
date()
time()
strtotime();






















?>