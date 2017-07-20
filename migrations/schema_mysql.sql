CREATE TABLE `shop` (
  `shop_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商户表',
  `shop_name` varchar(60) NOT NULL COMMENT '商户名',
  `shop_address` varchar(200) NOT NULL COMMENT '商户地址',
  `shop_author_id` int(11) NOT NULL,
  PRIMARY KEY (`shop_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `author_name` varchar(40) NOT NULL,
  `author_sex` tinyint(2) DEFAULT NULL,
  `author_tel` varchar(20) DEFAULT NULL,
  `author_phone` varchar(20) DEFAULT NULL,
  `author_mail` varchar(100) DEFAULT NULL,
  `author_qq` varchar(20) DEFAULT NULL,
  `author_like_name` varchar(40) DEFAULT NULL,
  `author_pwd` varchar(40) NOT NULL,
  `author_level` int(11) DEFAULT NULL,
  `author_wechat` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
