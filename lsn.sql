-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-03-01 01:25:40
-- 服务器版本： 5.7.15-log
-- PHP Version: 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lsn`
--

-- --------------------------------------------------------

--
-- 表的结构 `lsn_new`
--

CREATE TABLE `lsn_new` (
  `new_id` int(20) NOT NULL COMMENT '新闻id',
  `new_title` varchar(256) NOT NULL COMMENT '新闻标题',
  `new_author` varchar(20) NOT NULL COMMENT '发布人',
  `new_summary` text NOT NULL COMMENT '新闻摘要',
  `new_time` datetime NOT NULL COMMENT '发布时间',
  `new_content` text NOT NULL COMMENT '内容'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lsn_new`
--

INSERT INTO `lsn_new` (`new_id`, `new_title`, `new_author`, `new_summary`, `new_time`, `new_content`) VALUES
(1, '国土局申请强制执行被法院驳回：处罚未集体研究', '澎湃新闻', '啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊啊', '2018-02-26 03:24:30', '原标题：陕西一县国土局申请强制执行被法院驳回：罚款决定未集体研究\r\n\r\n澎湃新闻记者 王健\r\n\r\n因行政处罚决定中的罚款事项未经集体研究决定，西安蓝田县国土资源局的强制执行申请被西安中院驳回。2月26日，中国裁判文书网公布的一份行政裁定书披露了这一案例。\r\n\r\n“（2018）陕0122行审6号”行政裁定书显示，2018年1月23日，蓝田县国土资源局向西安中院申请强制执行蓝国土罚字[2017]030号土地行政处罚决定。\r\n\r\n蓝田县国土资源局向西安中院申请执行的事项包括：拆除被执行人西安元泰旅游开发有限公司违法占地所建的窑洞267.54平方米，二层楼房342.91平方米，一层平房395.97平方米，走廊和鱼塘1348平方米，构筑物7747.23平方米，以及执行被执行人欠下的罚款65299.2元。\r\n\r\n判决书显示，蓝田县国土资源局查明，2011年4月，西安元泰旅游公司未经政府批准，在辋川镇山底村一组开发王维苑旅游项目，已建成王维纪念馆及餐饮住宿设施，占地21.619亩即14412.4平方米，其中占建设用地6.466亩（纪念馆126.44平方米、窑洞1244.76平方米、两层楼房451.49平方米、走廊34.98平方米、其他构筑物2453.08平方米）；占林业用地15.153亩（窑洞267.54平方米、两层楼房342.19平方米、一层楼房395.97平方米、走廊和鱼塘1348平方米、其他硬化道路和广场等构筑物7747.23平方米）。\r\n\r\n2017年6月13日，蓝田县国土资源局作出处罚决定：没收上述项目符合土地利用总体规划的6.466亩土地上所建建筑；限期拆除违反土地利用总体规划的15.153亩土地上所建建筑，并对西安元泰旅游公司违法占地处以每平米8元，共计115299.20元的罚款；当事人可在收到处罚决定之日起六十日内申请复议。\r\n\r\n蓝田县国土资源局称，在法定期限内，被申请执行人西安元泰旅游公司未提起复议或诉讼，亦未履行拆除的义务。2017年8月14日，被申请执行人缴纳了罚款5万元。至蓝田县国土资源局向西安中院申请强制执行时，西安元泰旅游公司尚有65299.2元罚款未缴纳。'),
(2, '1111', 'Admin', '1111', '2018-02-28 15:10:59', '<p>1111<br></p>'),
(4, '222', 'Admin', '222', '2018-02-28 15:13:32', '<p>222<br></p>'),
(5, '222', 'Admin', '222', '2018-02-28 15:14:20', '<p>222<br></p>'),
(6, '333', 'Admin', '333', '2018-02-28 15:14:37', '<p>333<br></p>'),
(7, '444', 'Admin', '4444', '2018-02-28 15:14:50', '<h1>4444<strong>4444444444444444444444444444444444444</strong></h1><p align="center">11111111111111111<br></p>'),
(8, '俄播放叙利亚作战视频再出乌龙 竟是游戏画面(图)', 'Admin', '近日，俄罗斯国营电视台第一频道（Channel One TV）播放的视频中，一幅一秒的画面闹了个大乌龙。', '2018-02-28 15:15:36', '<p>\n</p><h1 align="center">俄播放叙利亚作战视频再出乌龙 竟是游戏画面(图)</h1><h5 align="center">\n<font color="#1c487f"><span style="background-color: rgb(238, 236, 224);">2018年02月27日 15:57 新浪综合</span></font></h5><p>\n</p><p>[编译/观察者网 徐蕾]</p><p>近日，俄罗斯国营电视台第一频道（Channel One TV）播放的视频中，一幅一秒的画面闹了个大乌龙。</p><p>据美国有线电视新闻网（CNN）当地时间2月26日报道，第一频道最近在播出苏-25战机在叙利亚攻击的画面时，被网友发现，有一幅出现一秒的画面截取自电脑游戏“武装行动3”。第一频道现已承认错误。</p>\n\n\n\n'),
(9, '111', 'Admin', '近日，俄罗斯国营电视台第一频道（Channel One TV）播放的视频中，一幅一秒的画面闹了个大乌龙。', '2018-02-28 15:19:22', '<p>\n</p><h1 align="center">俄播放叙利亚作战视频再出乌龙 竟是游戏画面(图)</h1><h5 align="center">\n<font color="#1c487f"><span>2018年02月27日 15:57 新浪综合</span></font></h5><p>\n</p><p>[编译/观察者网 徐蕾]</p><p>近日，俄罗斯国营电视台第一频道（Channel One TV）播放的视频中，一幅一秒的画面闹了个大乌龙。</p><p>据美国有线电视新闻网（CNN）当地时间2月26日报道，第一频道最近在播出苏-25战机在叙利亚攻击的画面时，被网友发现，有一幅出现一秒的画面截取自电脑游戏“武装行动3”。第一频道现已承认错误。</p>\n\n'),
(10, '4444', 'Admin', '近日，俄罗斯国营电视台第一频道（Channel One TV）播放的视频中，一幅一秒的画面闹了个大乌龙。', '2018-02-28 15:21:05', '<p>\n</p><h1 align="center">俄播放叙利亚作战视频再出乌龙 竟是游戏画面(图)</h1><h5 align="center">\n<font color="#1c487f"><span>2018年02月27日 15:57 新浪综合</span></font></h5><p>\n</p><p>[编译/观察者网 徐蕾]</p><p>近日，俄罗斯国营电视台第一频道（Channel One TV）播放的视频中，一幅一秒的画面闹了个大乌龙。</p><p>据美国有线电视新闻网（CNN）当地时间2月26日报道，第一频道最近在播出苏-25战机在叙利亚攻击的画面时，被网友发现，有一幅出现一秒的画面截取自电脑游戏“武装行动3”。第一频道现已承认错误。</p>\n\n'),
(11, '2222', 'Admin', '近日，俄罗斯国营电视台第一频道（Channel One TV）播放的视频中，一幅一秒的画面闹了个大乌龙。', '2018-02-28 15:21:24', '<p>layer.msg(data.msg, {icon: 6});</p>'),
(12, '222', 'Admin', '近日，俄罗斯国营电视台第一频道（Channel One TV）播放的视频中，一幅一秒的画面闹了个大乌龙。', '2018-02-28 15:22:08', '<p><br></p>'),
(13, '111', 'Admin', '111', '2018-02-28 15:25:05', '<p>11<br></p>'),
(14, '1', 'Admin', '111', '2018-02-28 15:25:21', '<p>111<br></p>'),
(15, '1111', 'Admin', '111', '2018-02-28 15:26:54', '<p>1111<br></p>'),
(16, '范德萨发', 'Admin', '发撒的', '2018-02-28 15:29:02', '<p>说道<br></p>'),
(17, '222', 'Admin', '222', '2018-02-28 15:32:49', '<p>22<br></p>'),
(18, '1111', 'Admin', '1111', '2018-02-28 15:33:31', '<p>111<br></p>'),
(19, '发撒的', 'Admin', '范德萨发', '2018-02-28 15:34:45', '<p>发撒的<br></p>'),
(20, '说道', 'Admin', '多少', '2018-02-28 15:34:58', '<p>多少<br></p>'),
(21, '111', 'Admin', '111', '2018-02-28 15:35:46', '<p>111<br></p>'),
(22, '范德萨发', 'Admin', '多少', '2018-02-28 15:36:29', '<p>范德萨<br></p>'),
(23, '发撒旦法', 'Admin', '阿斯顿', '2018-02-28 15:37:43', '<p>撒旦<br></p>'),
(24, '11', 'Admin', '111', '2018-02-28 15:38:15', '<p>11<br></p>'),
(25, '11', 'Admin', '111', '2018-02-28 15:38:15', '<p>11<br></p>'),
(26, '26', 'Admin', '26', '2018-02-28 17:23:50', '<p>26<br></p>'),
(35, '35', 'Admin', '', '2018-02-28 17:37:52', '<p><br></p>'),
(36, '空', 'Admin', '', '2018-02-28 17:33:04', '<p><br></p>'),
(37, '36', 'Admin', '36', '2018-02-28 17:59:44', '<p>36<br></p>'),
(38, '11', 'Admin', '11', '2018-02-28 18:00:17', '<p>11<br></p>'),
(39, '111', 'Admin', '111', '2018-02-28 18:00:29', '<p>111<br></p>'),
(40, '111', 'Admin', '111', '2018-02-28 18:01:04', '<p>111<br></p>');

-- --------------------------------------------------------

--
-- 表的结构 `lsn_user`
--

CREATE TABLE `lsn_user` (
  `userid` smallint(4) NOT NULL COMMENT '用户id',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(256) NOT NULL COMMENT '密码',
  `nickname` varchar(20) NOT NULL COMMENT '昵称'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lsn_user`
--

INSERT INTO `lsn_user` (`userid`, `username`, `password`, `nickname`) VALUES
(1, 'admin', 'eyJpdiI6IkdMRmZIekdjQXVCRUFoN0ZrNE1rV1E9PSIsInZhbHVlIjoidHBTTDBaZkdnbTJVZkc4VUp0bUsyUT09IiwibWFjIjoiMzdmZTQzZWIwZWY2MzAwYWQ3ZDFjZjYxZWMyOTMwMGQ2NGQ0OTkzOGRhZGE1NTNlOWM5NDYxNjdmMTRmMTNkYSJ9', 'admin'),
(2, 'admin1', 'eyJpdiI6IkdMRmZIekdjQXVCRUFoN0ZrNE1rV1E9PSIsInZhbHVlIjoidHBTTDBaZkdnbTJVZkc4VUp0bUsyUT09IiwibWFjIjoiMzdmZTQzZWIwZWY2MzAwYWQ3ZDFjZjYxZWMyOTMwMGQ2NGQ0OTkzOGRhZGE1NTNlOWM5NDYxNjdmMTRmMTNkYSJ9', 'admin1');

-- --------------------------------------------------------

--
-- 表的结构 `lsn_video`
--

CREATE TABLE `lsn_video` (
  `video_id` int(20) NOT NULL COMMENT '视频id',
  `video_title` varchar(256) NOT NULL COMMENT '视频标题',
  `video_time` datetime NOT NULL COMMENT '视频发布日期',
  `video_path` varchar(256) NOT NULL COMMENT '视频存储路径'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `lsn_video`
--

INSERT INTO `lsn_video` (`video_id`, `video_title`, `video_time`, `video_path`) VALUES
(2, '222', '2018-02-28 11:28:12', 'uploads/videos/20180228112829679.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lsn_new`
--
ALTER TABLE `lsn_new`
  ADD PRIMARY KEY (`new_id`);

--
-- Indexes for table `lsn_user`
--
ALTER TABLE `lsn_user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `lsn_video`
--
ALTER TABLE `lsn_video`
  ADD PRIMARY KEY (`video_id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `lsn_new`
--
ALTER TABLE `lsn_new`
  MODIFY `new_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '新闻id', AUTO_INCREMENT=41;
--
-- 使用表AUTO_INCREMENT `lsn_user`
--
ALTER TABLE `lsn_user`
  MODIFY `userid` smallint(4) NOT NULL AUTO_INCREMENT COMMENT '用户id', AUTO_INCREMENT=3;
--
-- 使用表AUTO_INCREMENT `lsn_video`
--
ALTER TABLE `lsn_video`
  MODIFY `video_id` int(20) NOT NULL AUTO_INCREMENT COMMENT '视频id', AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
