/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 50716
 Source Host           : localhost
 Source Database       : book_group

 Target Server Type    : MySQL
 Target Server Version : 50716
 File Encoding         : utf-8

 Date: 05/08/2018 10:41:18 AM
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `activity`
-- ----------------------------
DROP TABLE IF EXISTS `activity`;
CREATE TABLE `activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `desc` varchar(500) NOT NULL DEFAULT '',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `g_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `activity`
-- ----------------------------
BEGIN;
INSERT INTO `activity` VALUES ('2', '爬山团建', '公司活动。。。', '1', '2018-04-18 13:11:32', '2018-04-17', '2018-05-20', '0'), ('3', '桌游儿', '三国杀，狼人杀。。。', '1', '2018-04-19 19:13:12', '2018-04-19', '2018-05-01', '0');
COMMIT;

-- ----------------------------
--  Table structure for `article`
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
  `b_id` int(11) NOT NULL DEFAULT '0' COMMENT '书籍id',
  `title` varchar(100) NOT NULL DEFAULT '',
  `desc` text NOT NULL,
  `hot` int(11) NOT NULL DEFAULT '0',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `a_id` int(11) NOT NULL DEFAULT '0' COMMENT '活动id',
  `g_id` int(11) NOT NULL DEFAULT '0' COMMENT '书圈id',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `article`
-- ----------------------------
BEGIN;
INSERT INTO `article` VALUES ('2', '1', '0', '一篇文章', '<p>	qweqwe</p>', '0', '2018-04-17 15:53:56', '2018-04-17 15:53:56', '0', '0'), ('3', '2', '0', '叙利亚', '<p>	<strong>阿拉伯叙利亚共和国</strong>（<a href=\"https://baike.baidu.com/item/%E9%98%BF%E6%8B%89%E4%BC%AF%E8%AF%AD\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">阿拉伯语</a>：الجمهوريّة العربيّة السّوريّة‎；<a href=\"https://baike.baidu.com/item/%E8%8B%B1%E8%AF%AD/109997\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">英语</a>：The Syrian Arab Republic；<a href=\"https://baike.baidu.com/item/%E6%B3%95%E8%AF%AD\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">法语</a>：La République arabe syrienne），简称<strong>叙利亚</strong>，位于亚洲西部，<a href=\"https://baike.baidu.com/item/%E5%9C%B0%E4%B8%AD%E6%B5%B7\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">地中海</a>东岸，国土总面积（包括<a href=\"https://baike.baidu.com/item/%E6%88%88%E5%85%B0%E9%AB%98%E5%9C%B0\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">戈兰高地</a>）185180平方公里。北与<a href=\"https://baike.baidu.com/item/%E5%9C%9F%E8%80%B3%E5%85%B6/198448\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">土耳其</a>接壤，东同<a href=\"https://baike.baidu.com/item/%E4%BC%8A%E6%8B%89%E5%85%8B\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">伊拉克</a>交界，南与<a href=\"https://baike.baidu.com/item/%E7%BA%A6%E6%97%A6\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">约旦</a>毗连，西南与<a href=\"https://baike.baidu.com/item/%E9%BB%8E%E5%B7%B4%E5%AB%A9\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">黎巴嫩</a>、<a href=\"https://baike.baidu.com/item/%E4%BB%A5%E8%89%B2%E5%88%97\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">以色列</a>为邻，西与<a href=\"https://baike.baidu.com/item/%E5%A1%9E%E6%B5%A6%E8%B7%AF%E6%96%AF\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">塞浦路斯</a>隔地中海相望，首都<a href=\"https://baike.baidu.com/item/%E5%A4%A7%E9%A9%AC%E5%A3%AB%E9%9D%A9/644186\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">大马士革</a>。<span style=\"color: rgb(51, 102, 204);\">&nbsp;[1]</span><span style=\"color: rgb(19, 110, 194);\">&nbsp;</span></p><p>	叙利亚在公元前3000年时就有原始城邦国家存在，<span style=\"color: rgb(51, 102, 204);\">&nbsp;[2]</span><span style=\"color: rgb(19, 110, 194);\">&nbsp;</span>&nbsp;公元前8世纪起，先后被<a href=\"https://baike.baidu.com/item/%E4%BA%9A%E8%BF%B0%E5%B8%9D%E5%9B%BD\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">亚述帝国</a>、<a href=\"https://baike.baidu.com/item/%E9%A9%AC%E5%85%B6%E9%A1%BF%E5%B8%9D%E5%9B%BD\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">马其顿帝国</a>、<a href=\"https://baike.baidu.com/item/%E7%BD%97%E9%A9%AC%E5%B8%9D%E5%9B%BD/3059\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">罗马帝国</a>、<a href=\"https://baike.baidu.com/item/%E9%98%BF%E6%8B%89%E4%BC%AF%E5%B8%9D%E5%9B%BD/362701\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">阿拉伯帝国</a>、欧洲<a href=\"https://baike.baidu.com/item/%E5%8D%81%E5%AD%97%E5%86%9B/18872\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">十字军</a>、埃及<a href=\"https://baike.baidu.com/item/%E9%A9%AC%E7%A9%86%E9%B2%81%E5%85%8B%E7%8E%8B%E6%9C%9D\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">马穆鲁克王朝</a>和<a href=\"https://baike.baidu.com/item/%E5%A5%A5%E6%96%AF%E6%9B%BC%E5%B8%9D%E5%9B%BD\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">奥斯曼帝国</a>统治。<span style=\"color: rgb(51, 102, 204);\">&nbsp;[2]</span><span style=\"color: rgb(19, 110, 194);\">&nbsp;</span>&nbsp;<a href=\"https://baike.baidu.com/item/%E7%AC%AC%E4%B8%80%E6%AC%A1%E4%B8%96%E7%95%8C%E5%A4%A7%E6%88%98/68516\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">第一次世界大战</a>后沦为法国<a href=\"https://baike.baidu.com/item/%E5%A7%94%E4%BB%BB%E7%BB%9F%E6%B2%BB\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">委任统治</a>地。1946年4月17日获得独立。1963年起由<a href=\"https://baike.baidu.com/item/%E9%98%BF%E8%90%A8%E5%BE%B7%E5%AE%B6%E6%97%8F\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">阿萨德家族</a>领导的<a href=\"https://baike.baidu.com/item/%E9%98%BF%E6%8B%89%E4%BC%AF%E5%A4%8D%E5%85%B4%E7%A4%BE%E4%BC%9A%E5%85%9A\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">阿拉伯复兴社会党</a>执政至今。从2011年年初开始，爆发了叙利亚政府与叙利亚反对派之间旷日持久的冲突。<span style=\"color: rgb(51, 102, 204);\">&nbsp;[2]</span><span style=\"color: rgb(19, 110, 194);\">&nbsp;</span></p><p>	叙利亚是一个<a href=\"https://baike.baidu.com/item/%E4%B8%AD%E7%AD%89%E6%94%B6%E5%85%A5%E5%9B%BD%E5%AE%B6\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">中等收入国家</a>，地处世界<a href=\"https://baike.baidu.com/item/%E7%9F%B3%E6%B2%B9%E5%A4%A9%E7%84%B6%E6%B0%94\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">石油天然气</a>最丰富的<a href=\"https://baike.baidu.com/item/%E4%B8%AD%E4%B8%9C\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">中东</a>中心位置，经济来源主要是<a href=\"https://baike.baidu.com/item/%E5%86%9C%E4%B8%9A\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">农业</a>、<a href=\"https://baike.baidu.com/item/%E7%9F%B3%E6%B2%B9\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">石油</a>、<a href=\"https://baike.baidu.com/item/%E5%8A%A0%E5%B7%A5%E4%B8%9A\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">加工业</a>和<a href=\"https://baike.baidu.com/item/%E6%97%85%E6%B8%B8%E4%B8%9A\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">旅游业</a>，石油正面临枯竭的境况，人口增长过快，<a href=\"https://baike.baidu.com/item/%E5%A4%B1%E4%B8%9A%E7%8E%87\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">失业率</a>在逐步增高<span style=\"color: rgb(51, 102, 204);\">&nbsp;[2]</span><span style=\"color: rgb(19, 110, 194);\">&nbsp;</span>&nbsp;。</p><p>	2017年11月8日，<a href=\"https://baike.baidu.com/item/%E5%BE%B7%E5%9B%BD/147953\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">德国</a>波恩举行的新一轮联合国气候变化大会上，叙利亚代表宣布将尽快签署加入《<a href=\"https://baike.baidu.com/item/%E5%B7%B4%E9%BB%8E%E5%8D%8F%E5%AE%9A/19138374\" target=\"_blank\" style=\"color: rgb(19, 110, 194);\">巴黎协定</a>》并履行承诺，同时呼吁国际社会对其履行承诺予以支持<span style=\"color: rgb(51, 102, 204);\">&nbsp;[3]</span><span style=\"color: rgb(19, 110, 194);\">&nbsp;</span>&nbsp;。</p><p>	2017年12月，上合组织秘书长拉希德·阿利莫夫在莫斯科的俄科学院远东研究所学术委员会会议上表示，叙利亚申请加入上合组织。<span style=\"color: rgb(51, 102, 204);\">&nbsp;[4]</span><span style=\"color: rgb(19, 110, 194);\">&nbsp;</span></p>', '0', '2018-04-17 16:26:37', '2018-04-19 08:58:20', '0', '0'), ('4', '5', '0', '一篇文章', '<p>asdasd<span style=\"color: red;\">[upload error]</span></p>', '0', '2018-04-17 16:53:53', '2018-04-17 16:53:53', '0', '0'), ('6', '5', '0', '有图片', '<p><br></p><p><img src=\"/storage/images/article/201804/17/mBKlSlj2YfKN08BP8AyG6WUw96yDD5G9NT5kE3WH.jpeg\"></p>', '0', '2018-04-17 20:19:52', '2018-04-17 20:19:52', '0', '0'), ('7', '1', '0', '人生的香槟时刻', '<p>诺顿，你好呀。春风沉醉，傍晚我走在街上，风真的不冷了，当然，也不怎么暖和，有一丝凉意，但只会让人舒适。我住的地方，小孩和老人们，又走出门，到小区里活动，人一下子又多起来。我住的城市，在春天活过来了。</p><p>最近你还好吗？久久没有听到你的消息。我换了发型，烫鬈了头发，又穿上了新的大衣，生活好像还是老样子，只是我知道，一切都已经不一样了。每当时间过去，都会变成另外一个人，对去年此时的自己感到费解。</p><p>去年的你，和今年的你是同一个人吗？我想我不是了。不不不，我说的不是那些外形上的东西，这跟长发短发，直发鬈发没有任何关系，就是再次被春风吹拂时，我意识到，有些在我心里发生的事情，真正结束了。</p><p>某种意义上，我们现在的生活，不过是旧日的回响。直到今天，我们仍然被重要的事情影响着，这毫无疑问，但是诺顿先生，我们对旧日的眷念，也应该掩藏得更深一点。我之前跟你说过，我们只能活在此刻，稍稍回望或幻想未来，都只会给人徒增烦恼。此刻我窗外的白噪音依然响着，它日复一日，或许只有我听到了它的回响。</p><p>最近我总是在半夜醒来，诺顿先生，你知道的吧，那种睡了个好觉，大脑得到满足，醒来时神清气爽之感，可惜的是，这种时刻总是出现在凌晨三点，或者四点，等到五六点的时刻，我又会睡过去。这种不合时宜的清醒最近来得特别多。那个时候，我的记性总是变得很好，郑重地提醒过，时间正在流逝，一切都变得很遥远。我们总是忘记此刻的事情，钥匙放在哪，牙刷是什么颜色，对身边的事情毫无印象，可是那些遥远的记忆却无比清晰。</p><p>清晰，清晰就是尘埃落定，记忆为它敲上了一枚章。</p><p>午夜的清晰来得过于频繁，让我不堪其扰。诺顿先生，我还不想那么快忘记呢。时间却毫不留情面地关上了过往的大门。最近我好起来了，我的朋友们也说我好起来了。日渐繁忙的工作，越来越顺手的生活，我把这里的一切都处理得很好。好得我没什么可以抱怨。醒来的时候，我会从冰箱里拿出一瓶香槟，在屋子里砰的一声，推开木塞。我在庆祝什么呢？在凌晨三四点，感觉城市里只有我一个人。</p><p>我真的喜欢上这里了，诺顿先生。在空荡荡的屋子里，熟悉每件家具摆放的位置，在黑暗里知道在什么地方转弯，不碰到任何东西。有时候猫会跟着我，从这里走到那里，我们都习惯了这个地方，被我称为家的地方，真正填充进了我们的日常。</p><p>我记得在很小的时候，有一年夏天，我跟您说过吧，在我清晰的记忆里，所有的童年都是夏天，似乎我并没有在冬天长大过。我和朋友在乡下鱼塘边玩，突如其来一场暴雨，我们躲进土地庙里，好奇地望着这场大雨，土地里腾出新鲜的泥腥味，鱼塘中泛起万千水花。那天好热呀，但是我们淋了雨，躲在庙中，却感觉到很冷，有小孩突然哭了起来，想要回家。不知道为什么，诺顿先生，没过多久，我们都变得很害怕，对雨的新奇全然消失，恐惧它会永远下着，而我们不能回家。</p><p>有人安慰起了哭泣的小孩，将她搂在怀里。等了很久，那场雨淅淅沥沥地停了，太阳又露出来了，我们高兴地跑出来，踩在稀软的泥地上，走回家去。那一路，我们走了很久，久到每个人都有点消沉，诺顿先生，我总觉得那场雨就是某种开幕式，它告诉我们，没什么永远的快乐，也不会有永恒的悲伤。那丝躲在厚云深处，缓慢射出的阳光，就是人生的香槟时刻。</p><p>砰，一切都过去了，虽然你还是会不快乐，但是真的过去了。</p><p>我总是喝得很快，还不等冰凉的香槟有任何机会变温，几乎贪婪地大口喝完，凉意刺激口腔、透进身体，再浸入大脑，一切都变得很美好。诺顿先生，我们所期盼的和庆祝的，不过就是在午夜醒来，不期待任何事情发生，而事实上也没有任何事情发生，这多美妙，是不是这样？</p><p>这种香槟时刻只属于我一个人，此刻我只是自己，不是任何社会人，没有什么必须要做的事，直到我脑袋昏沉，而天色将明，世界又将重新开始，我睡过去，又醒过来，再次和世界相连。所有的实物又将开始喧闹，连窗外的白噪音也准时出现，我们又投入到闹哄哄的环境里，新的一天，新的一生，又开始了。</p><p>可是我们也知道，在某个晚上，我们又会迎来香槟时刻，大拇指用力推开木塞，等待着那砰的声响，一缕凉雾冒出，清澈的酒咕咕倒入玻璃杯中。</p><p>又是只属于自己的，一个人的，美妙时刻。</p><p class=\"ql-align-right\">您东半球官方指定唯一的女朋友</p><p class=\"ql-align-right\">苏更生</p><p><br></p>', '0', '2018-04-19 09:00:36', '2018-04-19 09:00:36', '0', '0');
COMMIT;

-- ----------------------------
--  Table structure for `article_comment`
-- ----------------------------
DROP TABLE IF EXISTS `article_comment`;
CREATE TABLE `article_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `a_id` int(11) NOT NULL DEFAULT '0',
  `content` varchar(500) NOT NULL DEFAULT '',
  `hot` smallint(6) NOT NULL DEFAULT '0',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `article_comment`
-- ----------------------------
BEGIN;
INSERT INTO `article_comment` VALUES ('1', '6', '书评！', '0', '2018-04-18 08:40:49', '0', '2');
COMMIT;

-- ----------------------------
--  Table structure for `book`
-- ----------------------------
DROP TABLE IF EXISTS `book`;
CREATE TABLE `book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `desc` varchar(500) NOT NULL DEFAULT '',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` varchar(50) NOT NULL DEFAULT '',
  `c_id` smallint(6) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `u_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `s_id` int(11) NOT NULL DEFAULT '0' COMMENT '分享id',
  `status` tinyint(4) NOT NULL DEFAULT '0' COMMENT '0：未被借出；1：借出',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `book`
-- ----------------------------
BEGIN;
INSERT INTO `book` VALUES ('1', '父与子', '这本长篇连环漫画溢满了卜劳恩对三岁儿子克里斯蒂安的爱子之情，可以说是世界上流传最广的亲情漫画。作品中一个个生动幽默的小故事都是来自于漫画家在生活中的真实感受，父与子实际上就是卜劳恩与儿子克里斯蒂安的真实写照。', '2018-04-16 17:56:09', '埃·奥·卜劳恩', '7', '1', '2018-04-19 04:50:26', '1', '1'), ('2', '宏观经济学原理', '本书作为宏观经济学入门水平的教材，适合大专院校经济管理各相关专业用做教材，也可作为普通读者了解宏观经济学的读物。', '2018-04-16 20:38:39', '罗伯特·弗兰克', '4', '1', '2018-04-11 12:51:05', '1', '0');
COMMIT;

-- ----------------------------
--  Table structure for `bookGroup`
-- ----------------------------
DROP TABLE IF EXISTS `bookGroup`;
CREATE TABLE `bookGroup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `desc` varchar(500) NOT NULL DEFAULT '',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `c_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0' COMMENT '书圈作者id',
  `hot` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `bookGroup`
-- ----------------------------
BEGIN;
INSERT INTO `bookGroup` VALUES ('2', '科恩兄弟', '《老无所依》，《醉乡名谣》', '2018-04-18 02:34:29', '2018-04-18 02:34:29', '3', '1', '1'), ('3', '选购手机指南', '选购手机指南...小米，华为', '2018-04-19 10:43:28', '2018-04-19 10:43:28', '1', '2', '1');
COMMIT;

-- ----------------------------
--  Table structure for `bookGroup_cate`
-- ----------------------------
DROP TABLE IF EXISTS `bookGroup_cate`;
CREATE TABLE `bookGroup_cate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `bookGroup_cate`
-- ----------------------------
BEGIN;
INSERT INTO `bookGroup_cate` VALUES ('1', '科技圈', '2018-04-18 10:23:22'), ('2', '朋友圈', '2018-04-18 10:23:32'), ('3', '电影圈', '2018-04-18 10:23:46'), ('4', '摄影圈', '2018-04-18 10:23:56'), ('5', '戏精圈', '2018-04-18 10:24:10'), ('6', '动漫圈', '2018-04-18 10:24:21'), ('7', '老乡圈', '2018-04-18 10:24:32');
COMMIT;

-- ----------------------------
--  Table structure for `book_cate`
-- ----------------------------
DROP TABLE IF EXISTS `book_cate`;
CREATE TABLE `book_cate` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `book_cate`
-- ----------------------------
BEGIN;
INSERT INTO `book_cate` VALUES ('1', '科技', '2018-04-16 17:41:52'), ('2', '文学', '2018-04-16 17:41:52'), ('3', '计算机', '2018-04-16 17:41:52'), ('4', '金融', '2018-04-16 17:41:52'), ('5', '农业', '2018-04-16 17:41:52'), ('6', '机械', '2018-04-16 17:41:52'), ('7', '儿童', '2018-04-16 17:41:52'), ('8', '冶金', '2018-04-16 17:41:52'), ('9', '天文', '2018-04-16 17:43:23'), ('10', '地理', '2018-04-16 17:43:23'), ('11', '音乐', '2018-04-16 17:43:23'), ('12', '宗教', '2018-04-19 12:57:33');
COMMIT;

-- ----------------------------
--  Table structure for `book_comment`
-- ----------------------------
DROP TABLE IF EXISTS `book_comment`;
CREATE TABLE `book_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `b_id` int(11) NOT NULL DEFAULT '0',
  `content` varchar(500) NOT NULL DEFAULT '',
  `hot` smallint(6) NOT NULL DEFAULT '0',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `p_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `book_comment`
-- ----------------------------
BEGIN;
INSERT INTO `book_comment` VALUES ('1', '1', '这是本好书！', '0', '2018-04-17 09:00:50', '0', '2'), ('2', '1', '这书不错！', '0', '2018-04-17 09:01:25', '0', '2');
COMMIT;

-- ----------------------------
--  Table structure for `file`
-- ----------------------------
DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(10) NOT NULL DEFAULT 'image' COMMENT 'image, voice, video, annex, file',
  `path` varchar(255) NOT NULL DEFAULT '' COMMENT '文件路径',
  `mime_type` char(30) NOT NULL DEFAULT '' COMMENT '文件mimeType',
  `md5` char(32) NOT NULL DEFAULT '',
  `title` varchar(100) NOT NULL DEFAULT '' COMMENT '文件标题',
  `folder` char(20) NOT NULL DEFAULT '' COMMENT '文件对象类型',
  `object_id` varchar(64) NOT NULL DEFAULT '' COMMENT '文件对象ID',
  `size` int(11) NOT NULL DEFAULT '0' COMMENT '文件大小',
  `width` smallint(6) NOT NULL DEFAULT '0' COMMENT '宽度',
  `height` smallint(6) NOT NULL DEFAULT '0' COMMENT '高度',
  `downloads` int(11) NOT NULL DEFAULT '0' COMMENT '下载次数',
  `public` smallint(6) NOT NULL DEFAULT '0' COMMENT '是否公开',
  `editor` smallint(6) NOT NULL DEFAULT '0' COMMENT '富编辑器图片',
  `status` smallint(6) NOT NULL DEFAULT '0' COMMENT '附件状态',
  `created_op` int(11) NOT NULL DEFAULT '0' COMMENT '创建人',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `file`
-- ----------------------------
BEGIN;
INSERT INTO `file` VALUES ('5', 'image', 'public/images/article/201804/17/mBKlSlj2YfKN08BP8AyG6WUw96yDD5G9NT5kE3WH.jpeg', 'image/jpeg', '7e0dde301b060bfaaf88c3fcf94ce40b', '631523427423_.pic副本.jpg', 'article', '0', '90703', '1024', '576', '0', '0', '0', '0', '0', '2018-04-17 12:18:55', '2018-04-17 12:18:55');
COMMIT;

-- ----------------------------
--  Table structure for `jobs`
-- ----------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Table structure for `logs`
-- ----------------------------
DROP TABLE IF EXISTS `logs`;
CREATE TABLE `logs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作人的ID',
  `user_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作人的名字，方便直接查阅',
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '当前操作的URL',
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '当前操作的请求方法',
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '当前操作的事件，create,update,delete',
  `table` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '操作的表',
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='操作日志表';

-- ----------------------------
--  Table structure for `migrations`
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `migrations`
-- ----------------------------
BEGIN;
INSERT INTO `migrations` VALUES ('1', '2018_03_19_012817_create_logs_table', '1'), ('2', '2018_04_22_071821_create_jobs_table', '1'), ('3', '2018_05_07_020819_create_sessions_table', '2');
COMMIT;

-- ----------------------------
--  Table structure for `rental`
-- ----------------------------
DROP TABLE IF EXISTS `rental`;
CREATE TABLE `rental` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from_id` int(11) NOT NULL DEFAULT '0',
  `u_id` int(11) NOT NULL DEFAULT '0',
  `b_id` int(11) NOT NULL DEFAULT '0',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `start_time` date NOT NULL,
  `end_time` date NOT NULL,
  `mark` varchar(255) NOT NULL DEFAULT '' COMMENT '备注',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `rental`
-- ----------------------------
BEGIN;
INSERT INTO `rental` VALUES ('1', '2', '1', '1', '2018-04-18 13:18:17', '2018-04-18', '2018-04-19', '借一天');
COMMIT;

-- ----------------------------
--  Table structure for `sessions`
-- ----------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(10) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  UNIQUE KEY `sessions_id_unique` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
--  Records of `sessions`
-- ----------------------------
BEGIN;
INSERT INTO `sessions` VALUES ('EGzT6Ur7XfqDhuFs3wgfSW9Qx9zX9bG8o13CNmr7', '1', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiTm92YWRKdUE4Tzk1U0dQY2lPZWVnMHZPdk9uOUxiaFUwM25sOFcydCI7czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', '1525659179'), ('gjOBx4B9nddtAnhjEZXoKzfdtvMlOmul3bQ6XyzX', '1', '127.0.0.1', 'Mozilla/5.0 (iPhone; CPU iPhone OS 10_3_1 like Mac OS X) AppleWebKit/603.1.30 (KHTML, like Gecko) Version/10.0 Mobile/14E304 Safari/602.1', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZ2lKSW5EMzFQeGFnaGdtNnVRczEweWFLYTRpTjMwSDN5VjJUM1h6biI7czo3OiJjYXB0Y2hhIjtzOjQ6IkhTbVIiO3M6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjEwMjoiaHR0cDovLzEyNy4wLjAuMTo4MDAwLy9oNS9zaWduL2NhcHRjaGE/dD1Nb24lMjBNYXklMjAwNyUyMDIwMTglMjAxMCUzQTEyJTNBNDglMjBHTVQlMjAwODAwJTIwJTI4Q1NUJTI5Ijt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', '1525659169');
COMMIT;

-- ----------------------------
--  Table structure for `share`
-- ----------------------------
DROP TABLE IF EXISTS `share`;
CREATE TABLE `share` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lat` double NOT NULL DEFAULT '0',
  `lng` double NOT NULL DEFAULT '0',
  `info` varchar(100) NOT NULL DEFAULT '',
  `c_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `loc` varchar(100) NOT NULL,
  `name` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `share`
-- ----------------------------
BEGIN;
INSERT INTO `share` VALUES ('1', '31.31798737', '120.61990712', 'test', '2018-05-02 20:12:24', '2018-05-02 20:12:24', 'test test', '苏州'), ('2', '40.058692', '116.30799', '北京 测试 哈哈啊', '2018-05-03 01:47:35', '2018-05-03 01:47:35', '北京市海淀区上地10街', '北京');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `password` varchar(100) NOT NULL,
  `remember_token` char(80) NOT NULL DEFAULT '' COMMENT 'token',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', 'admin', '2018-04-15 14:29:00', '$2y$10$VnCo3XQ4XmDVUYNKEsYT.OTvp58zXmV2lOGhf4bqNTpwbXZePrnLa', 'HdqIY9tG67QKwxtvF2HIUrcNgcbxqg2kgxD9MbvyaI6NrvGmyUeiEEoXtujn'), ('2', 'dekay', '2018-04-16 14:12:01', '$2y$10$VnCo3XQ4XmDVUYNKEsYT.OTvp58zXmV2lOGhf4bqNTpwbXZePrnLa', ''), ('5', '孔德凯', '2018-04-19 10:49:57', '$2y$10$CEnng93pEighCxMMf5dotOMSF5fK32LRH.ejgiY2kzoETOLugYN0G', ''), ('6', 'maoyao', '2018-04-20 16:05:25', '$2y$10$noSCfia6L1l2Uir8hlTzaOr9sztC7QBz.As.BNu0bLC54zXnyoDSu', '');
COMMIT;

-- ----------------------------
--  Table structure for `user_activity`
-- ----------------------------
DROP TABLE IF EXISTS `user_activity`;
CREATE TABLE `user_activity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL DEFAULT '0',
  `a_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `user_book`
-- ----------------------------
DROP TABLE IF EXISTS `user_book`;
CREATE TABLE `user_book` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL,
  `b_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user_book`
-- ----------------------------
BEGIN;
INSERT INTO `user_book` VALUES ('1', '2', '1');
COMMIT;

-- ----------------------------
--  Table structure for `user_group`
-- ----------------------------
DROP TABLE IF EXISTS `user_group`;
CREATE TABLE `user_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL DEFAULT '0',
  `g_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `user_info`
-- ----------------------------
DROP TABLE IF EXISTS `user_info`;
CREATE TABLE `user_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `u_id` int(11) NOT NULL DEFAULT '0',
  `integral` int(11) NOT NULL DEFAULT '0',
  `c_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `u_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;
