-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost:8889
-- 生成日時: 2020 年 10 月 29 日 14:33
-- サーバのバージョン： 5.7.30
-- PHP のバージョン: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- データベース: `gs_php_lesson`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `gs_bm_table`
--

CREATE TABLE `gs_bm_table` (
  `id` int(12) NOT NULL,
  `bookname` varchar(64) NOT NULL,
  `bookurl` text NOT NULL,
  `comment` text NOT NULL,
  `indate` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- テーブルのデータのダンプ `gs_bm_table`
--

INSERT INTO `gs_bm_table` (`id`, `bookname`, `bookurl`, `comment`, `indate`) VALUES
(6, '日本語をみがく小辞典 (角川ソフィア文庫) ', 'https://www.amazon.co.jp/%E3%82%A6%E3%82%A7%E3%83%BC%E3%83%AB%E3%82%BA%E3%81%AE%E6%95%99%E8%82%B2%E3%83%BB%E8%A8%80%E8%AA%9E%E3%83%BB%E6%AD%B4%E5%8F%B2%E2%80%95%E5%93%80%E3%82%8C%E3%81%AA%E6%B0%91%E3%80%81%E3%81%97%E3%81%9F%E3%81%9F%E3%81%8B%E3%81%AA%E6%B0%91-%E5%B9%B3%E7%94%B0-%E9%9B%85%E5%8D%9A/dp/4771027161?pd_rd_w=dJByF&pf_rd_p=18f36100-c0c1-4625-80b2-b3b9725403d2&pf_rd_r=9XKQFSSY60XVWA7E2DST&pd_rd_r=8ee3e33a-e7d5-4466-b2a4-2cc6ff2f3890&pd_rd_wg=8AYWH', '買う予定', '2020-10-22 00:57:27'),
(9, '村上世彰、高校生に投資を教える。', '', '読みたいよ', '2020-10-22 01:38:40'),
(25, '図説 剣技・剣術', 'https://www.amazon.co.jp/gp/product/4883173410?pf_rd_r=GJSBXRPM7P623TT3MJNC&pf_rd_p=7392bae8-7129-4d1a-96a9-1cfe0aa13ab3', 'ほしい', '2020-10-22 22:00:55');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルのAUTO_INCREMENT
--

--
-- テーブルのAUTO_INCREMENT `gs_bm_table`
--
ALTER TABLE `gs_bm_table`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
