/*
Navicat MySQL Data Transfer

Source Server         : 阿里云
Source Server Version : 50715
Source Host           : rm-uf6lotk1aye60i2hro.mysql.rds.aliyuncs.com:3306
Source Database       : xxoo_

Target Server Type    : MYSQL
Target Server Version : 50715
File Encoding         : 65001

Date: 2017-09-14 16:52:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for xxoo_admins
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_admins`;
CREATE TABLE `xxoo_admins` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户唯一id',
  `username` varchar(20) NOT NULL COMMENT '用户登陆名',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `uface` varchar(255) NOT NULL,
  `ltime` int(10) unsigned NOT NULL COMMENT '用户最后一次登陆时间',
  `ctime` int(10) unsigned NOT NULL COMMENT '注册时间',
  `token` varchar(50) NOT NULL COMMENT '用户 token',
  `phone` varchar(11) NOT NULL COMMENT '用户手机',
  `email` varchar(20) NOT NULL COMMENT '用户邮箱',
  `auth` tinyint(4) NOT NULL DEFAULT '0' COMMENT '管理员权限 1 非管理员 0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_admins
-- ----------------------------
INSERT INTO `xxoo_admins` VALUES ('1', 'xyj2156', 'eyJpdiI6InlMU3o2NUhJV3BNUDA2dlwvcnpwMGtRPT0iLCJ2YWx1ZSI6Im15UTYyMjdLcWNsWjNUK203Z1VSQ2c9PSIsIm1hYyI6Ijk0YTE1YjVhMGI3Yzg3NzQ0YzRlMzRjZmQzZWRkMzE4MzEyZjRmOTcwODJkZmYxMzZiNjhlMGUzNjg0ZTJlZjgifQ==', '/uploads/uface/admin/2017-07-21-14-44-10-5971a2ba200c8.jpg', '1500989679', '1499230642', '', '13835058919', '2343242@q.c3', '1');
INSERT INTO `xxoo_admins` VALUES ('2', 'yangpengliang', 'eyJpdiI6IndKUkY4M1IrYVBka3VtRyt6bjZFdWc9PSIsInZhbHVlIjoiakhKYXBQcGxndFlTTFFTR05PNks3Zz09IiwibWFjIjoiNTdlMzBmZmI3MDc0YzA2MDYxYWQ1OGRiYjc5Y2U3NWJjMzViZGQwZGJmMGI4NTIyODc3MDJjY2MzMTZkMWVkNCJ9', '/uploads/uface/admin/2017-07-21-14-44-52-5971a2e491404.jpg', '1505308250', '1499761834', '', '13835058919', '397177782@qq.com', '1');
INSERT INTO `xxoo_admins` VALUES ('4', 'huangxiaokang', 'eyJpdiI6IkxjRjVPVlJlc2FJNHJpYTR5K1EzM3c9PSIsInZhbHVlIjoiRWJFekF5QTFURFRtNU1Jb3I0RVJWdz09IiwibWFjIjoiMjM3MmJiZDE0ZDZmNjJjZTgxNDFlNjhiMWEyYWNkNzg2MDkwOGJjYmI2YmY0OTdjYTQwNzkyYjNiODNhYjUyNCJ9', '/uploads/uface/admin/2017-07-21-14-40-34-5971a1e2e3b4e.jpg', '1504574546', '1499761893', '', '13835058919', '39711111@qq.com', '0');
INSERT INTO `xxoo_admins` VALUES ('28', 'yangpengliang', 'eyJpdiI6Imo3eEcwXC9nRklKaWorQ0VlRXIrZENRPT0iLCJ2YWx1ZSI6ImJlRGxTNXg0XC8wazRHeldhSnNJNTZ3PT0iLCJtYWMiOiJkZDFjZWE1OThjMzViNGJhMTM5MGFjZmNkM2MwZGUxNDk2NGYxOWQyOTNkMTVlZGIxN2I5NTEwZDY3M2FiZDE2In0=', '/uploads/uface/admin/2017-07-21-14-42-06-5971a23e3c6ec.jpg', '0', '1500619328', '', '13833065868', '39717772@qq.com', '0');
INSERT INTO `xxoo_admins` VALUES ('29', 'phpcms6', 'eyJpdiI6IndvTE1YZmRRVW9Lb2loUEl1M2VBYVE9PSIsInZhbHVlIjoiUUpTTGZNZ3hTeVNMYkh6bk9YcXhLUT09IiwibWFjIjoiYjliODZlMzUwZmFkZDU5MmQwOTc5NmRiMTBhMmEzMDBkZDIwY2M0NTYzMzgyODAzYmQwNzA5NWFmMTY3YzhhNiJ9', '/uploads/uface/admin/2017-07-21-14-46-02-5971a32ad3ce1.jpg', '0', '1500619564', '', '13535058980', '397177782@qq.com', '0');

-- ----------------------------
-- Table structure for xxoo_banners
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_banners`;
CREATE TABLE `xxoo_banners` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '轮播图唯一ID',
  `title` varchar(52) NOT NULL COMMENT '轮播图名字',
  `pic` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `order` tinyint(4) unsigned NOT NULL DEFAULT '1' COMMENT '顺序',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_banners
-- ----------------------------
INSERT INTO `xxoo_banners` VALUES ('1', 'xxoooo', '/uploads/banner_thumb/2017-07-21-14-23-02-59719dc672a20.jpg', 'http://baidu.com/', '1', '2017-07-21 14:23:06', '2017-07-21 15:54:12');
INSERT INTO `xxoo_banners` VALUES ('2', 'oooxx', '/uploads/banner_thumb/2017-07-21-14-23-21-59719dd9e6dda.jpg', 'http://baidu.com', '6', '2017-07-21 14:23:23', '2017-07-21 15:53:59');
INSERT INTO `xxoo_banners` VALUES ('3', '项英杰', '/uploads/banner_thumb/2017-07-21-14-23-51-59719df765394.jpg', 'http://xiangyingjie.com', '3', '2017-07-21 14:23:53', '2017-07-21 14:24:36');
INSERT INTO `xxoo_banners` VALUES ('4', '黄小康', '/uploads/banner_thumb/2017-07-21-14-24-25-59719e1986b0d.jpg', 'http://huangxiaokang.com', '4', '2017-07-21 14:24:27', '2017-07-21 14:24:52');

-- ----------------------------
-- Table structure for xxoo_casts
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_casts`;
CREATE TABLE `xxoo_casts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL COMMENT '演员名字',
  `uface` varchar(255) NOT NULL COMMENT '演员头像 可能也是一对多关系',
  `sex` enum('x','m','w') NOT NULL DEFAULT 'x' COMMENT '演员性别',
  `fid` int(11) unsigned NOT NULL COMMENT '演员 -=》 电影ID 一对多关系',
  `ctime` int(10) unsigned NOT NULL,
  `utime` int(10) unsigned NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '暂无描述。',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_casts
-- ----------------------------
INSERT INTO `xxoo_casts` VALUES ('1', '小萝莉1号', '', 'x', '0', '1499230642', '1499230642', '萝莉控专属');
INSERT INTO `xxoo_casts` VALUES ('2', '御姐', '', 'x', '0', '1499230642', '1499230642', '秒杀宅男');
INSERT INTO `xxoo_casts` VALUES ('3', '少妇', '', 'x', '0', '1499230642', '1499230642', '暂无描述。');
INSERT INTO `xxoo_casts` VALUES ('4', '宅女', '', 'x', '0', '1499230642', '1499230642', '暂无描述。');
INSERT INTO `xxoo_casts` VALUES ('5', '黄大康', '', 'x', '0', '1499354543', '1499354543', '老年男女的杀手');
INSERT INTO `xxoo_casts` VALUES ('6', '解放', '', 'm', '0', '1499669466', '1499669466', '一个测试数据');
INSERT INTO `xxoo_casts` VALUES ('7', '吴雯雯', '', 'w', '0', '1500339898', '1500339898', '一盒女演员');

-- ----------------------------
-- Table structure for xxoo_configs
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_configs`;
CREATE TABLE `xxoo_configs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '网站配置id',
  `title` varchar(52) NOT NULL COMMENT '网站前台标题',
  `keywords` varchar(110) NOT NULL COMMENT '关键字',
  `descroption` varchar(110) NOT NULL COMMENT '网站描述',
  `webstatistics` varchar(110) NOT NULL COMMENT '网站统计代码',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_configs
-- ----------------------------

-- ----------------------------
-- Table structure for xxoo_consumes
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_consumes`;
CREATE TABLE `xxoo_consumes` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '消费记录表唯一id',
  `mid` int(11) unsigned NOT NULL COMMENT '对应的用户ID',
  `oid` varchar(68) NOT NULL COMMENT '对应的订单ID',
  `ctime` int(32) unsigned NOT NULL COMMENT '消费时间',
  `money` decimal(8,2) unsigned NOT NULL COMMENT '总额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_consumes
-- ----------------------------
INSERT INTO `xxoo_consumes` VALUES ('1', '6', '13', '1499862158', '25.00');
INSERT INTO `xxoo_consumes` VALUES ('2', '6', '14', '1499862158', '23.00');
INSERT INTO `xxoo_consumes` VALUES ('3', '15', '8', '0', '200.00');
INSERT INTO `xxoo_consumes` VALUES ('4', '15', '8', '0', '199.98');
INSERT INTO `xxoo_consumes` VALUES ('5', '15', '8', '1500306426', '199.98');
INSERT INTO `xxoo_consumes` VALUES ('6', '15', '9', '1500307458', '299.97');
INSERT INTO `xxoo_consumes` VALUES ('24', '15', '13', '1500348809', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('25', '15', '13', '1500348952', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('26', '15', '13', '1500349020', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('27', '15', '13', '1500349075', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('28', '15', '13', '1500349166', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('29', '15', '13', '1500349242', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('30', '15', '13', '1500349268', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('31', '15', '13', '1500349298', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('32', '15', '13', '1500349410', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('33', '15', '13', '1500349434', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('34', '15', '13', '1500349575', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('35', '15', '13', '1500350091', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('36', '15', '1', '1500350602', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('37', '15', '2', '1500367334', '46.00');
INSERT INTO `xxoo_consumes` VALUES ('38', '15', '3', '1500374984', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('39', '15', '3', '1500375093', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('40', '15', '6', '1500427844', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('41', '15', '7', '1500427954', '224.00');
INSERT INTO `xxoo_consumes` VALUES ('42', '15', '8', '1500428318', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('47', '15', '9', '1500429917', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('48', '15', '10', '1500429982', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('49', '15', '11', '1500430233', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('50', '15', '12', '1500430321', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('51', '15', '13', '1500430410', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('52', '15', '14', '1500431748', '56.00');
INSERT INTO `xxoo_consumes` VALUES ('53', '18', '15', '1500608368', '56.00');
INSERT INTO `xxoo_consumes` VALUES ('54', '18', '16', '1500608595', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('55', '18', '17', '1500608881', '56.00');
INSERT INTO `xxoo_consumes` VALUES ('56', '18', '18', '1500609203', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('57', '18', '19', '1500609288', '49.28');
INSERT INTO `xxoo_consumes` VALUES ('58', '21', '21', '1500609582', '56.00');
INSERT INTO `xxoo_consumes` VALUES ('59', '21', '22', '1500609690', '56.00');
INSERT INTO `xxoo_consumes` VALUES ('60', '21', '23', '1500609790', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('61', '21', '24', '1500610013', '56.00');
INSERT INTO `xxoo_consumes` VALUES ('62', '21', '26', '1500610299', '46.00');
INSERT INTO `xxoo_consumes` VALUES ('64', '21', '30', '1500611843', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('65', '21', '31', '1500612293', '56.00');
INSERT INTO `xxoo_consumes` VALUES ('66', '22', '32', '1500612445', '53.76');
INSERT INTO `xxoo_consumes` VALUES ('67', '23', '33', '1500614038', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('73', '23', '36', '1500614639', '56.00');
INSERT INTO `xxoo_consumes` VALUES ('75', '22', '35', '1500614654', '107.52');
INSERT INTO `xxoo_consumes` VALUES ('76', '1', '1', '1500620558', '112.00');
INSERT INTO `xxoo_consumes` VALUES ('77', '1', '2', '1500622108', '26.88');
INSERT INTO `xxoo_consumes` VALUES ('78', '1', '3', '1500623866', '107.52');
INSERT INTO `xxoo_consumes` VALUES ('79', '2', '7', '1504171037', '112.00');

-- ----------------------------
-- Table structure for xxoo_films
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_films`;
CREATE TABLE `xxoo_films` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '电影主表唯一ID',
  `name` varchar(50) NOT NULL COMMENT '电影的名字',
  `play` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '播放次数',
  `click` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '电影点击量',
  `film_cast_id` int(10) unsigned NOT NULL COMMENT '与演员对应表的ID',
  `film_pic` varchar(255) NOT NULL COMMENT '电影缩略图',
  `price` decimal(8,2) NOT NULL COMMENT '票价',
  `_type` tinyint(3) unsigned NOT NULL DEFAULT '3' COMMENT '电影类型',
  `area_type` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '地域类型（内陆，欧美）',
  `year` smallint(5) unsigned NOT NULL DEFAULT '2' COMMENT '年份类型',
  PRIMARY KEY (`id`),
  KEY `click` (`click`) COMMENT '点击量索引',
  KEY `year` (`year`),
  KEY `type` (`_type`) USING BTREE COMMENT '类型索引',
  KEY `area` (`area_type`) USING BTREE COMMENT '地区索引'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_films
-- ----------------------------
INSERT INTO `xxoo_films` VALUES ('2', ' 绣春刀II：修罗战场', '78', '88917', '0', '/uploads/film_thumbail/2017-07-21-14-16-43-59719c4b5aec1.jpg', '28.00', '8', '7', '4');
INSERT INTO `xxoo_films` VALUES ('3', '悟空传', '1000000', '13', '0', '/uploads/film_thumbail/2017-07-21-14-18-23-59719cafbda4e.jpg', '38.00', '6', '7', '4');
INSERT INTO `xxoo_films` VALUES ('5', '卡丁车', '0', '6', '0', '/uploads/film_thumbail/2017-07-21-15-49-21-5971b201b19b5.jpg', '16.00', '6', '7', '4');

-- ----------------------------
-- Table structure for xxoo_film_casts
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_film_casts`;
CREATE TABLE `xxoo_film_casts` (
  `fid` int(11) unsigned NOT NULL COMMENT '电影id',
  `cid` int(11) unsigned NOT NULL COMMENT '演员ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_film_casts
-- ----------------------------

-- ----------------------------
-- Table structure for xxoo_film_details
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_film_details`;
CREATE TABLE `xxoo_film_details` (
  `id` int(10) unsigned NOT NULL COMMENT '电影副表唯一ID',
  `director` varchar(20) NOT NULL COMMENT '导演',
  `actor` varchar(255) NOT NULL COMMENT '演员',
  `description` varchar(50) NOT NULL,
  `keywords` varchar(50) NOT NULL,
  `time` varchar(10) NOT NULL COMMENT '片长',
  `prevue` varchar(255) NOT NULL COMMENT '预告片',
  `uptime` int(10) unsigned NOT NULL COMMENT '上映时间',
  `film_detail_full` text NOT NULL,
  `film_detail` tinytext NOT NULL COMMENT '电影简介',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_film_details
-- ----------------------------
INSERT INTO `xxoo_film_details` VALUES ('2', '陆阳', '沈炼,北斋,陆文昭,裴纶', '', '绣', '02:00', '', '1500393600', '讲述了明朝天启七年，北镇抚司锦衣卫沈炼（张震 饰）在追查案件中身陷阴谋，为了证明清白，沈炼与少女北斋（杨幂 饰），同僚裴纶（雷佳音 饰）协力查明真相的故事。', '同僚裴纶（雷佳音 饰）协力查明真相的故事。');
INSERT INTO `xxoo_film_details` VALUES ('3', '郭子健', '孙悟空,阿紫,杨戬,天蓬', '', '悟空', '02:30', '', '1500393600', '电影《悟空传》改编自今何在同名小说，讲述了在大闹天宫的五百年前，未成为齐天大圣的孙悟空，不服天命，向天地诸神发起抗争的故事。这不是西游记的任何章节，这是悟空（彭于晏 饰）的故事，彼时孙悟空还不是震撼天地的齐天大圣，他只是只桀傲不驯的猴子。天庭毁掉他的花果山以掌控众生命运，他便决心跟天庭对抗，毁掉一切戒律。在天庭，孙悟空遇到不能爱的阿紫（倪妮 饰），一生的宿敌杨戬（余文乐 饰），和思念昔日爱人阿月（郑爽 饰）的天蓬（欧豪 饰），他们的身份注定永生相杀，但其实不甘命运摆布的又何止孙悟空一人？却没想到反抗却带来更大的浩劫。他们所做的一切，究竟是不知天高地厚的热血轻狂，还是无奈宿命难改的压抑绝望？难道命运真的早已注定？悟空不服，他再次挥动金箍棒，要让这诸佛都烟消云散！', '讲述了在大闹天宫的五百年前，未成为齐天大圣的孙悟空，不服天命，向天地诸神发起抗争的故事');
INSERT INTO `xxoo_film_details` VALUES ('5', 'asd ', 'asd', '', '卡丁车', '01:30', '', '1500566400', 'asdasdasd', '啊实打实的');

-- ----------------------------
-- Table structure for xxoo_film_plays
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_film_plays`;
CREATE TABLE `xxoo_film_plays` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `rid` int(10) unsigned NOT NULL,
  `fid` int(10) unsigned NOT NULL,
  `start_time` int(10) unsigned NOT NULL,
  `end_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_film_plays
-- ----------------------------
INSERT INTO `xxoo_film_plays` VALUES ('1', '3', '1', '1500705440', '1500709040');
INSERT INTO `xxoo_film_plays` VALUES ('2', '2', '2', '1500637249', '1500644269');
INSERT INTO `xxoo_film_plays` VALUES ('4', '1', '1', '1502126870', '1502130110');
INSERT INTO `xxoo_film_plays` VALUES ('5', '1', '1', '1504178124', '1504181664');

-- ----------------------------
-- Table structure for xxoo_film_reviews
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_film_reviews`;
CREATE TABLE `xxoo_film_reviews` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '电影评论表唯一id',
  `mid` varchar(20) NOT NULL COMMENT '用户id',
  `fid` int(10) unsigned NOT NULL COMMENT '电影id',
  `content` text NOT NULL COMMENT '评论内容',
  `time` int(10) unsigned DEFAULT NULL COMMENT '评论时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_film_reviews
-- ----------------------------
INSERT INTO `xxoo_film_reviews` VALUES ('1', '1', '1', '测试', '1500620436');
INSERT INTO `xxoo_film_reviews` VALUES ('2', '1', '1', 'sdfsfwerewtt', '1500622946');

-- ----------------------------
-- Table structure for xxoo_film_rooms
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_film_rooms`;
CREATE TABLE `xxoo_film_rooms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '影厅表 ID',
  `name` varchar(15) NOT NULL COMMENT '影厅号码 名字',
  `seat` varchar(500) NOT NULL COMMENT '影厅座位表',
  `row` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '座位行数',
  `col` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT '座位列数',
  `created_at` datetime NOT NULL COMMENT '结束放映时间',
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_film_rooms
-- ----------------------------
INSERT INTO `xxoo_film_rooms` VALUES ('1', '天字号', '_aaaa_aaaaa,aaaaa_aaaaa,aaaaa_aaaaa,aaaaa_aaaaa,aaaaa_aaaaa,aaaaa_aaaaa,aaa_____aaa,aaaaa_aaaaa,aaaaa_aaaaa,aaaaa_aaaaa,aaaaa_aaaaa,aaaaa_aaaaa,aaaaa_aaaaa', '13', '11', '2017-07-21 14:12:11', '2017-07-21 16:12:32');
INSERT INTO `xxoo_film_rooms` VALUES ('2', '地字号', 'aa_aa_aaaaa,a_a_a_aaaaa,_aaa__aaaaa,a_aaa_aaaaa,aa_aa__aaaa,aaa_a_a_aaa,aaaa___a_aa,___________,aa_a___aa_a,aa__a_a_aaa,aa_aa__aaa_,aaaaa_a_a_a,aaaaa_aa_aa', '13', '11', '2017-07-21 14:12:59', '2017-07-21 16:13:19');
INSERT INTO `xxoo_film_rooms` VALUES ('3', '人字号', '_aaa_aaa_,aaaa_aaaa,aaaa_aaaa,aaaa_aaaa,aaaa_aaaa,_________,aaaa_aaaa,aaaa_aaaa,aaaa_aaaa,aaaa_aaaa,aa_a_a_aa', '11', '9', '2017-07-21 14:13:32', '2017-07-21 14:39:47');

-- ----------------------------
-- Table structure for xxoo_film_types
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_film_types`;
CREATE TABLE `xxoo_film_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `pid` int(11) NOT NULL,
  `path` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_film_types
-- ----------------------------
INSERT INTO `xxoo_film_types` VALUES ('1', '地区', '0', '0,');
INSERT INTO `xxoo_film_types` VALUES ('2', '年份', '0', '0,');
INSERT INTO `xxoo_film_types` VALUES ('3', '类型', '0', '0,');
INSERT INTO `xxoo_film_types` VALUES ('4', '2017', '2', '0,2,');
INSERT INTO `xxoo_film_types` VALUES ('5', '2018', '2', '0,2,');
INSERT INTO `xxoo_film_types` VALUES ('6', '科幻', '3', '0,3,');
INSERT INTO `xxoo_film_types` VALUES ('7', '内陆', '1', '0,1,');
INSERT INTO `xxoo_film_types` VALUES ('8', '爱情', '3', '0,3,');
INSERT INTO `xxoo_film_types` VALUES ('9', '美国', '1', '0,1,');
INSERT INTO `xxoo_film_types` VALUES ('10', '印度', '1', '0,1,');
INSERT INTO `xxoo_film_types` VALUES ('11', '德国', '1', '0,1,');

-- ----------------------------
-- Table structure for xxoo_links
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_links`;
CREATE TABLE `xxoo_links` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '友情链接表唯一ID',
  `linkname` varchar(32) NOT NULL COMMENT '友情链接显示的名字',
  `linktitle` varchar(32) NOT NULL COMMENT '友情链接指向时 的 title属性值',
  `order` tinyint(3) unsigned NOT NULL DEFAULT '255' COMMENT '友情连接排序',
  `linkthumb` varchar(110) NOT NULL COMMENT '友情链接图片',
  `linkurl` varchar(110) NOT NULL COMMENT '友情链接地址',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_links
-- ----------------------------
INSERT INTO `xxoo_links` VALUES ('1', '美团', '美团', '1', '/uploads/thumbnail/2017-07-21-14-26-14-59719e86d11d5.png', 'http://bj.meituan.com/?utm_source=wwwmaoyan');
INSERT INTO `xxoo_links` VALUES ('3', '美团', '123', '255', '/uploads/thumbnail/2017-07-21-15-56-45-5971b3bdd3fc5.png', 'http://www.meituan.com.com');

-- ----------------------------
-- Table structure for xxoo_members
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_members`;
CREATE TABLE `xxoo_members` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户唯一id',
  `username` varchar(20) NOT NULL COMMENT '用户登陆名',
  `password` varchar(255) NOT NULL COMMENT '用户密码',
  `ltime` int(10) unsigned NOT NULL COMMENT '用户最后一次登陆时间',
  `ip` varchar(15) NOT NULL COMMENT '用户登陆ip',
  `token` varchar(50) NOT NULL COMMENT '用户 token',
  `phone` varchar(11) NOT NULL COMMENT '用户手机',
  `email` varchar(20) NOT NULL COMMENT '用户邮箱',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '账号状态,0未激活,1激活',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_members
-- ----------------------------
INSERT INTO `xxoo_members` VALUES ('1', 'asdfghgh', 'eyJpdiI6ImJSYlB6MExKV29YZEpudWxXK21yQ0E9PSIsInZhbHVlIjoiREE1Rmk1ZTBYbkx1MXpmOUZPK3ROZz09IiwibWFjIjoiMWVlM2E1OTA0YTNlNGJkYzQxNzFhODM2NzBmNzNkOTJlODc3ZjI5ODViZjMyNjg3MmRkOTA1MWMzZTAwY2FiYyJ9', '1500622929', '', 'gt5P2BkOCxknmJtEpmoedETxf4KNGgK2YDzv6Go1ycA6oPhcLu', '13711309550', '506907958@qq.com', '1');
INSERT INTO `xxoo_members` VALUES ('2', 'SHg0M', 'eyJpdiI6IlhObjZQdlwvaWlKUHBCZkoxdmpPQmJ3PT0iLCJ2YWx1ZSI6IlZ3U0ZROW1VNHRacXBFekNna2tMaUE9PSIsIm1hYyI6IjcwOThlYWI2YThiOTYzM2FmNmQzNDEzN2Q3ZjdhMmU0NWRkMWJhZjQ3Y2ZlM2ZlZTE4MGFjOTVkZTA2ZDJkNWYifQ==', '1504170941', '192.168.182.42', '', '13835058919', '', '1');
INSERT INTO `xxoo_members` VALUES ('3', 'R3mZF', 'eyJpdiI6IllybFwvTVwva1FMckZDN3pXN09SUkE4UT09IiwidmFsdWUiOiJxS1wvOXpyTllGSGxGajl1TmtJQTdBZz09IiwibWFjIjoiY2FmNmU1ZGQ2MjAwMGQxYzEyMTM1MzlmM2VjMzU0MzBjM2RjNTBhNGQzMmMzNDg2Yjk2MTIyZjZkZGM1ZGRhYyJ9', '1500624204', '192.168.182.42', 'xFUqVobPdOEIlHsVd7ZNS5dw59cBltSHcb26SkLaGSzYMNaHGm', '', '13835058919@163.com', '1');
INSERT INTO `xxoo_members` VALUES ('5', 'lwfzi', 'eyJpdiI6IlF0Unkxc29qb1wvQ0lMcSsyYm9UVEFnPT0iLCJ2YWx1ZSI6ImE0U2hlM0prNTBZNlEwa3FDV0Y4XC9vSTlJNWs5eTd5M2JGWGJLSGkraU9FPSIsIm1hYyI6IjcwMDU4ZjQ1MWRmYTZiMDUzMTBmOWQxNGZhOTA0MTAxYWRmMWY5NzU3OTEzZmY2YjUyOWE0ODI4MjNjYjMyMGYifQ==', '1504791775', '127.0.0.1', 'hRFjU1EE98mvxZ6imAzA30r5IUFrEUWfVXtna9ML7zePm7uHHq', '', '137337343@qq.com', '1');
INSERT INTO `xxoo_members` VALUES ('6', 'xiaozhuzhu', 'eyJpdiI6IjZVZlF2azF6TzEwb3dJcnVkV2xNVGc9PSIsInZhbHVlIjoibEJuWHdMYjZENmYzZkNBZ25ra2VHUT09IiwibWFjIjoiNTJmZTVjNjJhZWFhM2RkOTk3NTg4MmQ1MGFhM2I5ZGY0NDI2N2Y1YjVkNzE0NzRhZmU1NDFkNThjYjMyMTkzNyJ9', '1505128993', '127.0.0.1', '2uYfYlDOqbQ1jMXllACfQ5fE4IYDoeNGLj0gXD0fu53cre6N90', '18796252327', '407426425@qq.com', '0');
INSERT INTO `xxoo_members` VALUES ('7', 'OyyjV', 'eyJpdiI6IlRNY2pEWE1MQkZ4MFBsbUllMGd3QVE9PSIsInZhbHVlIjoielRGVlBlYkZEV1pDUEVhb3N1OWpuRm52ZjhxQzgxNnFra3lcL3lrZGZ6Qmc9IiwibWFjIjoiMGJjZDMzZjQ5NzFhNzEyZTBhZWNmNjZjNWY3NGFhMDE3NmIzMzJkZTIzMjhkZjYwMGQ3ZWNjNDBjODMxNDVkOSJ9', '0', '127.0.0.1', 'OMpSr05Zkri3LewB1LoubX35GysN45ejb8HAHJH2wMys3bA8mY', '', '123456789@qq.com', '0');

-- ----------------------------
-- Table structure for xxoo_member_details
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_member_details`;
CREATE TABLE `xxoo_member_details` (
  `id` int(10) unsigned NOT NULL COMMENT '用户唯一id',
  `name` varchar(20) NOT NULL COMMENT '用户昵称',
  `age` int(11) NOT NULL COMMENT '用户年龄',
  `sex` enum('m','w','x') NOT NULL DEFAULT 'x' COMMENT '用户性别,默认 保密 w 女,m 男, x 保密',
  `uface` varchar(255) NOT NULL COMMENT '用户头像',
  `auth` varchar(20) NOT NULL COMMENT '用户级别 0 普通用户, 1 vip 票价95折, 3 钻石 vip 票价优惠 85折',
  `ctime` int(11) NOT NULL COMMENT '用户注册时间',
  `money` decimal(8,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '用户余额',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_member_details
-- ----------------------------
INSERT INTO `xxoo_member_details` VALUES ('1', 'asdh', '14', 'w', '/uploads/uface/home/2017-07-21-15-44-07-5971b0c7e0a4e.jpg', '1', '0', '999640.60');
INSERT INTO `xxoo_member_details` VALUES ('2', 'tg7KR', '0', 'x', '', '0', '0', '888.00');
INSERT INTO `xxoo_member_details` VALUES ('3', 'Hc4Hm', '0', 'x', '', '0', '0', '1000.00');
INSERT INTO `xxoo_member_details` VALUES ('5', 'ct1A4', '0', 'x', '', '0', '0', '0.00');
INSERT INTO `xxoo_member_details` VALUES ('6', 'WWRLLSDH', '19', 'x', '', '2', '1505128993', '0.00');
INSERT INTO `xxoo_member_details` VALUES ('7', 'BnexL', '0', 'x', '', '0', '0', '0.00');

-- ----------------------------
-- Table structure for xxoo_orders
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_orders`;
CREATE TABLE `xxoo_orders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '订单id',
  `name` varchar(50) NOT NULL COMMENT '订单号',
  `pid` int(10) unsigned NOT NULL COMMENT '播放信息的id',
  `fid` int(10) unsigned NOT NULL,
  `mid` int(10) unsigned NOT NULL COMMENT '用户ID',
  `ctime` int(10) unsigned NOT NULL COMMENT '订单创建时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态 1.未付款 2.已付款 3.已发货 4.订单完成 5. 订单废除',
  `rid` int(10) NOT NULL,
  `seat` varchar(30) NOT NULL COMMENT '订购的座位表',
  `price` decimal(5,2) NOT NULL COMMENT '单价',
  `num` int(10) unsigned NOT NULL COMMENT '数量',
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_orders
-- ----------------------------
INSERT INTO `xxoo_orders` VALUES ('1', '2017072115021781f495b8c28085ab92b8c81d0abc48b9', '1', '1', '1', '1500620538', '2', '3', '4_9,5_9', '56.00', '2');
INSERT INTO `xxoo_orders` VALUES ('2', '20170721152822595aa9615b4522e013b6c6ff52a481b6', '2', '2', '1', '1500622103', '2', '2', '1_1', '28.00', '1');
INSERT INTO `xxoo_orders` VALUES ('3', '20170721155735cb28697bb621520abead8c17ae9b78c6', '1', '1', '1', '1500623856', '2', '3', '1_4,2_4', '56.00', '2');
INSERT INTO `xxoo_orders` VALUES ('4', '201707211604513bd1cb8005992a6738b59f28b2966c2c', '1', '1', '3', '1500624292', '1', '3', '4_8,4_9', '56.00', '2');
INSERT INTO `xxoo_orders` VALUES ('5', '20170721161410f2d1a408fae70c2d4a3db9d1ced415a3', '2', '2', '1', '1500624851', '1', '2', '10_1,10_2,11_1,11_2', '28.00', '4');
INSERT INTO `xxoo_orders` VALUES ('6', '20170808002348cefbf7fb043f924877b97f6064d425a2', '4', '1', '2', '1502123029', '1', '1', '7_9,7_10', '56.00', '2');
INSERT INTO `xxoo_orders` VALUES ('7', '20170831171632cb4f45c804a398617587fb232d349cd1', '5', '1', '2', '1504170994', '2', '1', '1_2,1_5', '56.00', '2');

-- ----------------------------
-- Table structure for xxoo_webconfigs
-- ----------------------------
DROP TABLE IF EXISTS `xxoo_webconfigs`;
CREATE TABLE `xxoo_webconfigs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL COMMENT '网站名称',
  `tel` varchar(32) NOT NULL COMMENT '电话信息',
  `email` varchar(255) NOT NULL COMMENT '邮箱',
  `logo` varchar(255) NOT NULL,
  `count` varchar(255) NOT NULL COMMENT '网站统计代码',
  `icp` varchar(50) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `keywords` varchar(30) NOT NULL COMMENT '关键字',
  `description` varchar(100) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of xxoo_webconfigs
-- ----------------------------
INSERT INTO `xxoo_webconfigs` VALUES ('1', '小新在线卖票', '18888888888', '506907958@qq.com', '/uploads/logo_thumb/2017-07-21-14-21-33-59719d6d60a2a.png', '<script>layer.msg(\"测试---------------统计脚本\")</script>', '鲁ICP备11016544号', 'CopyRight © xxxx oooo公司 保留所有权利。', '天气,电影,卖票,便捷卖票', '测试描述');
