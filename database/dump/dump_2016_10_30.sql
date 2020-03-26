-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 30, 2016 at 11:07 PM
-- Server version: 5.6.28
-- PHP Version: 7.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `demoagileapis_first`
--
CREATE DATABASE IF NOT EXISTS `demoagileapis_first` DEFAULT CHARACTER SET ascii COLLATE ascii_general_ci;
USE `demoagileapis_first`;

-- --------------------------------------------------------

--
-- Table structure for table `access_token`
--

CREATE TABLE `access_token` (
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `access_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `api_discount`
--

CREATE TABLE `api_discount` (
  `monthNo` int(10) UNSIGNED NOT NULL,
  `discount%` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `api_discount`
--

INSERT INTO `api_discount` (`monthNo`, `discount%`) VALUES
(4, '10'),
(12, '25');

-- --------------------------------------------------------

--
-- Table structure for table `api_resource`
--

CREATE TABLE `api_resource` (
  `basePathKey` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(3) UNSIGNED NOT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `checkout_flow`
--

CREATE TABLE `checkout_flow` (
  `step` double(2,1) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `checkout_flow`
--

INSERT INTO `checkout_flow` (`step`, `path`) VALUES
(1.0, '/api/create/provider'),
(2.0, '/api/create/source'),
(3.0, '/api/create/mode'),
(4.0, '/api/create/filter'),
(4.1, '/api/create/content'),
(4.2, '/api/create/partial'),
(5.0, '/api/create/settings'),
(6.0, '/api/create/review'),
(7.0, '/api/checkout');

-- --------------------------------------------------------

--
-- Table structure for table `fb_api_full_mode`
--

CREATE TABLE `fb_api_full_mode` (
  `id_api` int(10) UNSIGNED NOT NULL,
  `base` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endPath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `response` longtext COLLATE utf8_unicode_ci NOT NULL,
  `info` longtext COLLATE utf8_unicode_ci NOT NULL,
  `groupApi` int(10) UNSIGNED NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_api_full_mode`
--

INSERT INTO `fb_api_full_mode` (`id_api`, `base`, `endPath`, `response`, `info`, `groupApi`, `created_at`) VALUES
(1, '360094627500262', 'admins', '[{"id":"752252208147728","name":"Davide"}]', '', 4, '2016-10-30'),
(2, '360094627500262', 'feed', '[{"story":"Davide added an event.","updated_time":"2014-09-01T10:50:29+0000","id":"360094627500262_360094630833595"}]', '', 4, '2016-10-30'),
(3, '360094627500262', 'interested', '[]', '', 4, '2016-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `fb_api_group_full_mode`
--

CREATE TABLE `fb_api_group_full_mode` (
  `id_api_group` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `whiteListDomain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `whiteListStagingIP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageEdge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `basePathKey` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `paymentID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `missingDaysToWhiteList` int(10) UNSIGNED DEFAULT NULL,
  `totalUpdates` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'full',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_api_group_full_mode`
--

INSERT INTO `fb_api_group_full_mode` (`id_api_group`, `user`, `whiteListDomain`, `whiteListStagingIP`, `pageEdge`, `name`, `basePathKey`, `paymentID`, `missingDaysToWhiteList`, `totalUpdates`, `source`, `mode`, `created_at`, `updated_at`) VALUES
(1, 2, 'http://www.beatboxfamily.it/', '', 'events', 'BeatBox family', '8LKvfO2WbmUAbmrX8ibfETbeVmv4v9yG', 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX', 0, 0, 'italianbeatboxfamily', 'full', '2016-07-17 19:03:47', '2016-10-30 20:52:02'),
(2, 2, '', '', 'posts', '', 'N9jxmLlUmxPB0L3D0jPbAbrIjUwqgxHU', 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX', 0, 0, 'farmacia.amazzone', 'full', '2016-08-24 15:32:01', '2016-10-30 20:52:02'),
(3, 2, '', '', 'posts', '', 'Zp4ez8hi3BmSQ4GC7HkmyZ7ZCwDaahzo', 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX', 0, 0, 'allaredenzionetrieste', 'full', '2016-09-02 16:31:31', '2016-10-30 20:52:02'),
(4, 3, '', '', 'events', 'portfoliodavide.com', 'k62KsmibYCIl76ylTEVdihCQCHOy3PuD', 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX', 7, 4, 'portfoliodavide', 'full', '2016-10-30 21:00:13', '2016-10-30 21:00:18');

-- --------------------------------------------------------

--
-- Table structure for table `fb_api_group_full_mode_source`
--

CREATE TABLE `fb_api_group_full_mode_source` (
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apiGroup` int(10) UNSIGNED NOT NULL,
  `info` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_api_group_full_mode_source`
--

INSERT INTO `fb_api_group_full_mode_source` (`source`, `apiGroup`, `info`, `created_at`, `updated_at`) VALUES
('360094627500262', 4, '{"description":"questa \\u00e8 una prova","name":"Bella yo","place":{"name":"Udine","location":{"city":"Udine","country":"Italy","latitude":46.0619,"longitude":13.2422},"id":"112321655453042"},"start_time":"2014-09-01T22:00:00+0200","id":"360094627500262"}', '2016-10-30 21:00:14', '2016-10-30 21:00:14');

-- --------------------------------------------------------

--
-- Table structure for table `fb_api_group_partial_mode`
--

CREATE TABLE `fb_api_group_partial_mode` (
  `id_api_group` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `whiteListDomain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `whiteListStagingIP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pageEdge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `basePathKey` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `paymentID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `missingDaysToWhiteList` int(10) UNSIGNED DEFAULT NULL,
  `totalUpdates` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `info` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'partial',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_api_group_partial_mode`
--

INSERT INTO `fb_api_group_partial_mode` (`id_api_group`, `user`, `whiteListDomain`, `whiteListStagingIP`, `pageEdge`, `name`, `basePathKey`, `paymentID`, `missingDaysToWhiteList`, `totalUpdates`, `source`, `info`, `mode`, `created_at`, `updated_at`) VALUES
(1, 1, '', '', 'events', 'portfoliodavide.com', 'TyKUmpmiSfgNlEcobrRwKIdto7sZ594w', 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX', 7, 1, 'portfoliodavide', '', 'partial', '2016-10-30 21:01:36', '2016-10-30 21:01:37'),
(2, 1, '', '', 'events', 'portfoliodavide.com', '3Tb0UvSv81XRPfVMRhsgYIHUaWxt5A1r', 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX', 7, 1, 'portfoliodavide', '', 'partial', '2016-10-30 21:02:08', '2016-10-30 21:02:09'),
(3, 1, '', '', 'videos', 'portfoliodavide.com', '3tQplI2v8NEgzoE9sOvTfrw58q36v8pA', 'PAY-XXXXXXXXXXXXXXXXXXXXXXXX', 7, 1, 'portfoliodavide', '', 'partial', '2016-10-30 21:02:45', '2016-10-30 21:02:46');

-- --------------------------------------------------------

--
-- Table structure for table `fb_api_info`
--

CREATE TABLE `fb_api_info` (
  `id_api` int(10) UNSIGNED NOT NULL,
  `user` int(10) UNSIGNED NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `whiteListDomain` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `whiteListStagingIP` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `basePathKey` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `paymentID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `totalUpdates` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `missingDaysToWhiteList` int(10) UNSIGNED DEFAULT NULL,
  `mode` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'info',
  `response` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fb_api_mode`
--

CREATE TABLE `fb_api_mode` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `fetchMedia` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_api_mode`
--

INSERT INTO `fb_api_mode` (`name`, `description`, `fetchMedia`) VALUES
('full', 'The full mode dispatch and refresh data about every sub-content, descending from the media choosen.', 0),
('info', 'The info mode fetches information about page.', 0),
('partial', 'The partial mode dispatch and refresh data about sub-content choosen, descending from the media choosen.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fb_api_partial_mode`
--

CREATE TABLE `fb_api_partial_mode` (
  `id_api` int(10) UNSIGNED NOT NULL,
  `base` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `endPath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `response` longtext COLLATE utf8_unicode_ci NOT NULL,
  `groupApi` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_api_partial_mode`
--

INSERT INTO `fb_api_partial_mode` (`id_api`, `base`, `endPath`, `response`, `groupApi`) VALUES
(1, '360094627500262', 'admins', '[{"name":"Davide","id":"752252208147728"}]', 1),
(2, '360094627500262', 'feed', '', 1),
(3, '360094627500262', 'admins', '[{"name":"Davide","id":"752252208147728"}]', 2),
(4, '360094627500262', 'feed', '', 2),
(5, '768929796479969', 'reactions', '[{"id":"842396789203622"},{"id":"10205376873810885"}]', 3);

-- --------------------------------------------------------

--
-- Table structure for table `fb_field`
--

CREATE TABLE `fb_field` (
  `query` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isFollowingRequest` tinyint(1) NOT NULL,
  `isPageField` tinyint(1) NOT NULL,
  `isBasic` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_field`
--

INSERT INTO `fb_field` (`query`, `description`, `isFollowingRequest`, `isPageField`, `isBasic`) VALUES
('about', 'The title of the Page.', 0, 1, 0),
('app_links', 'The link of the Page for the Facebook App.', 0, 1, 0),
('category', 'The Page category.', 0, 1, 0),
('category_list', 'The Page sub-categories.', 0, 1, 0),
('contact_address', 'The mailing/contact address.', 0, 1, 0),
('cover', 'The cover information of the Page.', 0, 1, 0),
('cover_photo', 'The cover photo.', 1, 0, 0),
('created_time', 'When it was created.', 0, 0, 0),
('current_location', 'The current location of the Page ^^??^^.', 0, 1, 0),
('description', 'The description.', 0, 1, 0),
('emails', 'The email addresses listed on "About".', 0, 1, 0),
('end_time', 'The end time.', 0, 0, 0),
('from', 'The author.', 0, 0, 0),
('general_info', 'The general information of the Page.', 0, 1, 0),
('hours', 'The operating hours.', 0, 1, 0),
('impressum', 'The legal information about the Page publishers.', 0, 1, 0),
('is_always_open', 'If location is always open.', 0, 1, 0),
('likes', 'The likes received by users.', 0, 1, 0),
('link', 'The link.', 0, 1, 0),
('location', 'The location where the albums is shooted.', 0, 1, 0),
('message', 'The message.', 0, 0, 0),
('name', 'The name.', 0, 1, 1),
('phone', 'The phone number.', 0, 1, 0),
('place', 'The place where the event it\'s made.', 0, 0, 1),
('privacy', 'The privacy about the album.', 0, 0, 0),
('source', 'The source.', 0, 0, 1),
('start_time', 'The start time.', 0, 0, 0),
('title', 'The title.', 0, 0, 0),
('update_time', 'The update time.', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fb_page_edge`
--

CREATE TABLE `fb_page_edge` (
  `endPath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `toBeSupported` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_page_edge`
--

INSERT INTO `fb_page_edge` (`endPath`, `title`, `description`, `toBeSupported`) VALUES
('albums', 'Albums', 'The albums of photos located on the Page.', 1),
('events', 'Events', 'The events created by the Page.', 1),
('insights', 'Likes', 'Total likes received by users.', 0),
('milestones', 'Milestones', 'The milestones created by the Page.', 1),
('posts', 'Posts', 'The posts shared on Page\'s timeline.', 1),
('videos', 'Videos', 'The videos created by the Page.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fb_page_edge_node`
--

CREATE TABLE `fb_page_edge_node` (
  `endPath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isRecursive` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_page_edge_node`
--

INSERT INTO `fb_page_edge_node` (`endPath`, `title`, `description`, `isRecursive`) VALUES
('admins', 'Admins', 'The album\'s admins.', 1),
('attachments', 'Attachments', 'The attachments of the ^^??^^.', 1),
('attending', 'Attending people', 'The attending people for the event.', 0),
('captions', 'Captions', 'Captions for the video.', 1),
('comments', 'Comments', 'The comments inserted.', 1),
('declined', 'Declined', 'The people who has declined the event.', 0),
('feed', 'Feed', 'The feed of posts (including status updates) and links published to this event\'s wall.', 1),
('interested', 'Interested', 'Interested people.', 1),
('likes', 'Likes', 'The likes received.', 0),
('live_videos', 'Live videos', 'The live videos linked to this event.', 1),
('maybe', 'Maybe', 'The people who perhaps attend to the event.', 0),
('noreply', 'No reply', 'The people who does not replied to the event.', 0),
('photos', 'Photos', 'The photos uploaded.', 1),
('picture', 'Picture', 'The album\' picture.', 1),
('reactions', 'Reactions', 'The reactions from people as like, love, wow, [...] .', 1),
('roles', 'Roles', 'List of profiles having roles on the event.', 1),
('sharedposts', 'Shares', 'The shares of the element.', 1),
('sponsor_tags', 'Sponsor tags', 'Sponsor pages tagged in the video.', 1),
('tags', 'Tags', 'Users tagged in the video.', 1),
('thumbnails', 'Thumbnails', 'Thumbnails for the video.', 1),
('video_insights', 'Video insights', 'Total insights from all video posts associated with this video.', 1),
('videos', 'Videos', 'Videos added.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `fb_requests_dates_full_mode`
--

CREATE TABLE `fb_requests_dates_full_mode` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` int(10) UNSIGNED NOT NULL,
  `month` int(10) UNSIGNED NOT NULL,
  `requestsNo` int(10) UNSIGNED NOT NULL,
  `groupApi` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fb_requests_dates_full_mode`
--

INSERT INTO `fb_requests_dates_full_mode` (`id`, `year`, `month`, `requestsNo`, `groupApi`) VALUES
(1, 2016, 7, 26, 1),
(2, 2016, 8, 41, 1),
(3, 2016, 9, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `fb_requests_dates_info`
--

CREATE TABLE `fb_requests_dates_info` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` int(10) UNSIGNED NOT NULL,
  `month` int(10) UNSIGNED NOT NULL,
  `requestsNo` int(10) UNSIGNED NOT NULL,
  `api` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `fb_requests_dates_partial_mode`
--

CREATE TABLE `fb_requests_dates_partial_mode` (
  `id` int(10) UNSIGNED NOT NULL,
  `year` int(10) UNSIGNED NOT NULL,
  `month` int(10) UNSIGNED NOT NULL,
  `requestsNo` int(10) UNSIGNED NOT NULL,
  `groupApi` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_comment`
--

CREATE TABLE `forum_comment` (
  `topicID` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_section`
--

CREATE TABLE `forum_section` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `routeName` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `forum_section`
--

INSERT INTO `forum_section` (`name`, `description`, `routeName`) VALUES
('Feature', 'Ask and discuss about features about service response you want to be implemented in.', 'static_forum.feature'),
('Support', 'Ask support of any type of problem.', 'static_forum.support'),
('Request', 'Ask request on service.', 'static_forum.request');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topic`
--

CREATE TABLE `forum_topic` (
  `ID` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `info_api_cost`
--

CREATE TABLE `info_api_cost` (
  `monthCost` smallint(6) NOT NULL,
  `servicesNo` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `info_api_cost`
--

INSERT INTO `info_api_cost` (`monthCost`, `servicesNo`) VALUES
(0, 2),
(2, 2),
(8, 10),
(20, -1);

-- --------------------------------------------------------

--
-- Table structure for table `media_api_cost`
--

CREATE TABLE `media_api_cost` (
  `monthCost` smallint(6) NOT NULL,
  `servicesNo` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media_api_cost`
--

INSERT INTO `media_api_cost` (`monthCost`, `servicesNo`) VALUES
(0, 1),
(8, 1),
(30, 5),
(60, 15),
(100, -1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1),
('2015_12_16_182759_create_providers_table', 1),
('2015_12_18_132311_create_fb_page_edge_table', 1),
('2015_12_19_213001_create_fb_page_edge_node_table', 1),
('2015_12_19_214834_create_fb_field_table', 1),
('2015_12_21_105919_create_field_followingrequest_table', 1),
('2016_01_02_001203_create_fb_edge_edgeNode_table', 1),
('2016_01_03_130541_create_fb_api_mode_table', 1),
('2016_02_05_134735_create_user_payment_table', 1),
('2016_02_19_121127_create_fb_api_group_partial_mode_table', 1),
('2016_02_19_121259_create_fb_api_partial_mode_table', 1),
('2016_03_02_200412_create_fb_requests_dates_partial_mode_table', 1),
('2016_03_18_104457_create_fb_api_group_full_mode_table', 1),
('2016_03_18_104844_create_fb_api_full_mode_table', 1),
('2016_03_21_143058_create_fb_requests_dates_full_mode_table', 1),
('2016_04_04_172731_create_fb_api_info_table', 1),
('2016_04_05_064740_create_api_resource_table', 1),
('2016_04_05_221900_create_fb_requests_dates_info_table', 1),
('2016_05_03_143106_create_fb_api_group_full_mode_source_table', 1),
('2016_06_11_123842_create_news_table', 1),
('2016_06_28_155708_create_info_api_cost_table', 1),
('2016_06_28_155724_create_media_api_cost_table', 1),
('2016_07_01_090651_create_forum_section_table', 1),
('2016_07_01_102203_create_forum_topic_table', 1),
('2016_07_04_104254_create_forum_comment_table', 1),
('2016_07_06_181913_create_access_token_table', 1),
('2016_07_19_132259_create_checkout_flow_table', 1),
('2016_08_04_152735_create_api_discount_table', 1),
('2016_08_05_210540_create_fbfullmode_payment_table', 1),
('2016_08_05_210554_create_fbpartialmode_payment_table', 1),
('2016_08_05_210620_create_fbinfomode_payment_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `writer` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `isImportant` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`writer`, `title`, `message`, `isImportant`, `created_at`) VALUES
('admin', 'New IDEA!', 'Oh! I have few problems of configuration on the \'Community\' section, from developing API to set up the Cron-Job. So Is there a system o service which is doing this behaviour? Nope, it is not developed yet. So, let\'s go to [...]', 1, '2015-12-19 20:55:10'),
('admin', 'Starting Developing', 'In these weeks I\'ve configured the service in pure PHP. The PHP language, despite it was just enough old, was chosen because Facebook provides a library so reach of classes and methods. Why pure PHP? Just to see how Database, Facebook APIs, own APIs, responses and data manipulation should be configured. So I developed a framework to configure manually the Database. Okay, I\'m ready to code and to adapt the code to Laravel. Then [...]', 1, '2016-01-15 16:56:27');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`name`, `created_at`, `updated_at`) VALUES
('facebook', '2015-12-19 20:55:10', '2015-12-19 20:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'member',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'cris94and1@gmail.com', '$2y$10$TyCv6aGPjrugRxKn/gGeZugZazmHcaTvvANPcxRUkgEhFkCTZEz.q', 'admin', NULL, '2015-12-19 20:55:10', '2015-12-19 20:55:10'),
(2, 'ìdeo', 'info@ideonetwork.it', '$2y$10$pJT7rOmWWLTQt87xzOEvW.mTuasvo3ecl7q/Q97L8w1UMG/gIlKbC', 'moderator', NULL, '2015-12-19 20:55:10', '2015-12-19 20:55:10'),
(3, 'Davide Saggioro', 'saggiorodavide@gmail.com', '$2y$10$dT0BquWAQ1QiwjeK6xSo8uSAB3mQuvqE6IV7pPZKxpKYo4SSyu.U6', 'member', NULL, '2016-08-07 15:37:10', '2016-10-30 20:52:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_payment`
--

CREATE TABLE `user_payment` (
  `paymentID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payerID` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `finish_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_payment`
--

INSERT INTO `user_payment` (`paymentID`, `user_email`, `payerID`, `token`, `created_at`, `finish_at`) VALUES
('PAY-XXXXXXXXXXXXXXXXXXXXXXXX', 'cris94and1@gmail.com', 'XXXXXXXXXXXXX', 'EC-XXXXXXXXXXXXXXXXX', '2016-08-04 22:00:00', '2038-01-19 03:14:07');

-- --------------------------------------------------------

--
-- Table structure for table `_fbapigroupfullmode_edgenode`
--

CREATE TABLE `_fbapigroupfullmode_edgenode` (
  `apiGroup` int(10) UNSIGNED NOT NULL,
  `edgeNode` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `_fbapigroupfullmode_edgenode`
--

INSERT INTO `_fbapigroupfullmode_edgenode` (`apiGroup`, `edgeNode`) VALUES
(4, 'admins'),
(2, 'attachments'),
(3, 'attachments'),
(1, 'attending'),
(4, 'feed'),
(4, 'interested'),
(4, 'picture');

-- --------------------------------------------------------

--
-- Table structure for table `_fbapigroupfullmode_payment`
--

CREATE TABLE `_fbapigroupfullmode_payment` (
  `endPoint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paymentID` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_fbapigrouppartialmode_payment`
--

CREATE TABLE `_fbapigrouppartialmode_payment` (
  `endPoint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paymentID` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_fbapiinfomode_payment`
--

CREATE TABLE `_fbapiinfomode_payment` (
  `endPoint` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `paymentID` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_fbapiinfo_field`
--

CREATE TABLE `_fbapiinfo_field` (
  `basePathKey` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `query` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_fb_apis_full_mode_fields`
--

CREATE TABLE `_fb_apis_full_mode_fields` (
  `api` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_fb_apis_partial_mode_fields`
--

CREATE TABLE `_fb_apis_partial_mode_fields` (
  `api` int(10) UNSIGNED NOT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `_fb_edge_edgenode`
--

CREATE TABLE `_fb_edge_edgenode` (
  `edge` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `edgeNode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT '0',
  `defaultField` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relativeRoot` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `_fb_edge_edgenode`
--

INSERT INTO `_fb_edge_edgenode` (`edge`, `edgeNode`, `isDefault`, `defaultField`, `relativeRoot`) VALUES
('albums', 'comments', 0, NULL, NULL),
('albums', 'photos', 0, NULL, NULL),
('albums', 'picture', 0, NULL, NULL),
('albums', 'reactions', 0, NULL, NULL),
('albums', 'sharedposts', 0, NULL, NULL),
('events', 'admins', 0, NULL, NULL),
('events', 'attending', 0, NULL, NULL),
('events', 'comments', 0, NULL, NULL),
('events', 'declined', 0, NULL, NULL),
('events', 'feed', 0, NULL, NULL),
('events', 'interested', 0, NULL, NULL),
('events', 'maybe', 0, NULL, NULL),
('events', 'noreply', 0, NULL, NULL),
('events', 'photos', 0, NULL, NULL),
('events', 'picture', 0, NULL, NULL),
('events', 'roles', 0, NULL, NULL),
('milestones', 'comments', 0, NULL, NULL),
('milestones', 'likes', 0, NULL, NULL),
('milestones', 'photos', 0, NULL, NULL),
('posts', 'attachments', 0, NULL, NULL),
('posts', 'comments', 0, NULL, NULL),
('posts', 'reactions', 0, NULL, NULL),
('posts', 'sharedposts', 0, NULL, NULL),
('videos', 'comments', 0, NULL, NULL),
('videos', 'reactions', 0, NULL, NULL),
('videos', 'sharedposts', 0, NULL, NULL),
('videos', 'video_insights', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `_fb_field_followingrequest`
--

CREATE TABLE `_fb_field_followingrequest` (
  `parentField` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `_fb_field_followingrequest`
--

INSERT INTO `_fb_field_followingrequest` (`parentField`, `field`) VALUES
('cover_photo', 'source');

-- --------------------------------------------------------

--
-- Table structure for table `_fb_parent_field`
--

CREATE TABLE `_fb_parent_field` (
  `edge` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `edgeNode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `field` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isDefault` tinyint(1) NOT NULL DEFAULT '0',
  `defaultRoot` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `_fb_parent_field`
--

INSERT INTO `_fb_parent_field` (`edge`, `edgeNode`, `field`, `isDefault`, `defaultRoot`) VALUES
('albums', NULL, 'location', 0, ''),
('albums', NULL, 'privacy', 0, ''),
('albums', NULL, 'link', 1, ''),
('albums', NULL, 'cover_photo', 0, ''),
('albums', NULL, 'description', 0, ''),
('albums', NULL, 'name', 0, ''),
('events', NULL, 'place', 1, ''),
('events', NULL, 'name', 1, ''),
('events', NULL, 'description', 1, ''),
('events', NULL, 'cover', 1, ''),
('milestones', NULL, 'description', 1, ''),
('milestones', NULL, 'title', 1, ''),
('posts', NULL, 'link', 1, ''),
('posts', NULL, 'message', 1, ''),
('posts', NULL, 'created_time', 1, ''),
('videos', NULL, 'source', 1, ''),
('videos', NULL, 'description', 1, ''),
(NULL, 'comments', 'created_time', 0, ''),
(NULL, 'comments', 'from', 0, ''),
(NULL, 'comments', 'message', 0, ''),
(NULL, 'photos', 'source', 0, ''),
(NULL, 'videos', 'source', 0, '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `api_discount`
--
ALTER TABLE `api_discount`
  ADD PRIMARY KEY (`monthNo`);

--
-- Indexes for table `api_resource`
--
ALTER TABLE `api_resource`
  ADD PRIMARY KEY (`basePathKey`),
  ADD KEY `api_resource_provider_foreign` (`provider`);

--
-- Indexes for table `checkout_flow`
--
ALTER TABLE `checkout_flow`
  ADD PRIMARY KEY (`step`,`path`);

--
-- Indexes for table `fb_api_full_mode`
--
ALTER TABLE `fb_api_full_mode`
  ADD PRIMARY KEY (`id_api`),
  ADD KEY `fb_api_full_mode_groupapi_foreign` (`groupApi`);

--
-- Indexes for table `fb_api_group_full_mode`
--
ALTER TABLE `fb_api_group_full_mode`
  ADD PRIMARY KEY (`id_api_group`),
  ADD UNIQUE KEY `fb_api_group_full_mode_basepathkey_unique` (`basePathKey`),
  ADD KEY `fb_api_group_full_mode_pageedge_foreign` (`pageEdge`),
  ADD KEY `fb_api_group_full_mode_user_foreign` (`user`),
  ADD KEY `fb_api_group_full_mode_paymentid_foreign` (`paymentID`);

--
-- Indexes for table `fb_api_group_full_mode_source`
--
ALTER TABLE `fb_api_group_full_mode_source`
  ADD PRIMARY KEY (`source`,`apiGroup`),
  ADD KEY `fb_api_group_full_mode_source_apigroup_foreign` (`apiGroup`);

--
-- Indexes for table `fb_api_group_partial_mode`
--
ALTER TABLE `fb_api_group_partial_mode`
  ADD PRIMARY KEY (`id_api_group`),
  ADD UNIQUE KEY `fb_api_group_partial_mode_basepathkey_unique` (`basePathKey`),
  ADD KEY `fb_api_group_partial_mode_pageedge_foreign` (`pageEdge`),
  ADD KEY `fb_api_group_partial_mode_user_foreign` (`user`),
  ADD KEY `fb_api_group_partial_mode_paymentid_foreign` (`paymentID`);

--
-- Indexes for table `fb_api_info`
--
ALTER TABLE `fb_api_info`
  ADD PRIMARY KEY (`id_api`),
  ADD UNIQUE KEY `fb_api_info_basepathkey_unique` (`basePathKey`),
  ADD KEY `fb_api_info_user_foreign` (`user`),
  ADD KEY `fb_api_info_paymentid_foreign` (`paymentID`);

--
-- Indexes for table `fb_api_mode`
--
ALTER TABLE `fb_api_mode`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `fb_api_partial_mode`
--
ALTER TABLE `fb_api_partial_mode`
  ADD PRIMARY KEY (`id_api`),
  ADD KEY `fb_api_partial_mode_groupapi_foreign` (`groupApi`);

--
-- Indexes for table `fb_field`
--
ALTER TABLE `fb_field`
  ADD PRIMARY KEY (`query`);

--
-- Indexes for table `fb_page_edge`
--
ALTER TABLE `fb_page_edge`
  ADD PRIMARY KEY (`endPath`);

--
-- Indexes for table `fb_page_edge_node`
--
ALTER TABLE `fb_page_edge_node`
  ADD PRIMARY KEY (`endPath`);

--
-- Indexes for table `fb_requests_dates_full_mode`
--
ALTER TABLE `fb_requests_dates_full_mode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fb_requests_dates_full_mode_groupapi_foreign` (`groupApi`);

--
-- Indexes for table `fb_requests_dates_info`
--
ALTER TABLE `fb_requests_dates_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fb_requests_dates_info_api_foreign` (`api`);

--
-- Indexes for table `fb_requests_dates_partial_mode`
--
ALTER TABLE `fb_requests_dates_partial_mode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fb_requests_dates_partial_mode_groupapi_foreign` (`groupApi`);

--
-- Indexes for table `forum_comment`
--
ALTER TABLE `forum_comment`
  ADD PRIMARY KEY (`topicID`,`created_at`);

--
-- Indexes for table `forum_topic`
--
ALTER TABLE `forum_topic`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `info_api_cost`
--
ALTER TABLE `info_api_cost`
  ADD PRIMARY KEY (`monthCost`);

--
-- Indexes for table `media_api_cost`
--
ALTER TABLE `media_api_cost`
  ADD PRIMARY KEY (`monthCost`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`name`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD PRIMARY KEY (`paymentID`),
  ADD KEY `user_payment_user_email_foreign` (`user_email`);

--
-- Indexes for table `_fbapigroupfullmode_edgenode`
--
ALTER TABLE `_fbapigroupfullmode_edgenode`
  ADD PRIMARY KEY (`apiGroup`,`edgeNode`),
  ADD KEY `_fbapigroupfullmode_edgenode_edgenode_foreign` (`edgeNode`);

--
-- Indexes for table `_fbapigroupfullmode_payment`
--
ALTER TABLE `_fbapigroupfullmode_payment`
  ADD PRIMARY KEY (`endPoint`,`paymentID`),
  ADD KEY `_fbapigroupfullmode_payment_paymentid_foreign` (`paymentID`);

--
-- Indexes for table `_fbapigrouppartialmode_payment`
--
ALTER TABLE `_fbapigrouppartialmode_payment`
  ADD PRIMARY KEY (`endPoint`,`paymentID`),
  ADD KEY `_fbapigrouppartialmode_payment_paymentid_foreign` (`paymentID`);

--
-- Indexes for table `_fbapiinfomode_payment`
--
ALTER TABLE `_fbapiinfomode_payment`
  ADD PRIMARY KEY (`endPoint`,`paymentID`),
  ADD KEY `_fbapiinfomode_payment_paymentid_foreign` (`paymentID`);

--
-- Indexes for table `_fbapiinfo_field`
--
ALTER TABLE `_fbapiinfo_field`
  ADD PRIMARY KEY (`basePathKey`,`query`),
  ADD KEY `_fbapiinfo_field_query_foreign` (`query`);

--
-- Indexes for table `_fb_apis_full_mode_fields`
--
ALTER TABLE `_fb_apis_full_mode_fields`
  ADD PRIMARY KEY (`api`,`field`),
  ADD KEY `_fb_apis_full_mode_fields_field_foreign` (`field`);

--
-- Indexes for table `_fb_apis_partial_mode_fields`
--
ALTER TABLE `_fb_apis_partial_mode_fields`
  ADD PRIMARY KEY (`api`,`field`),
  ADD KEY `_fb_apis_partial_mode_fields_field_foreign` (`field`);

--
-- Indexes for table `_fb_edge_edgenode`
--
ALTER TABLE `_fb_edge_edgenode`
  ADD KEY `_fb_edge_edgenode_edge_foreign` (`edge`),
  ADD KEY `_fb_edge_edgenode_edgenode_foreign` (`edgeNode`),
  ADD KEY `_fb_edge_edgenode_defaultfield_foreign` (`defaultField`);

--
-- Indexes for table `_fb_field_followingrequest`
--
ALTER TABLE `_fb_field_followingrequest`
  ADD PRIMARY KEY (`parentField`),
  ADD KEY `_fb_field_followingrequest_field_foreign` (`field`);

--
-- Indexes for table `_fb_parent_field`
--
ALTER TABLE `_fb_parent_field`
  ADD KEY `_fb_parent_field_edge_foreign` (`edge`),
  ADD KEY `_fb_parent_field_edgenode_foreign` (`edgeNode`),
  ADD KEY `_fb_parent_field_field_foreign` (`field`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `api_discount`
--
ALTER TABLE `api_discount`
  MODIFY `monthNo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `fb_api_full_mode`
--
ALTER TABLE `fb_api_full_mode`
  MODIFY `id_api` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fb_api_group_full_mode`
--
ALTER TABLE `fb_api_group_full_mode`
  MODIFY `id_api_group` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `fb_api_group_partial_mode`
--
ALTER TABLE `fb_api_group_partial_mode`
  MODIFY `id_api_group` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fb_api_info`
--
ALTER TABLE `fb_api_info`
  MODIFY `id_api` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fb_api_partial_mode`
--
ALTER TABLE `fb_api_partial_mode`
  MODIFY `id_api` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `fb_requests_dates_full_mode`
--
ALTER TABLE `fb_requests_dates_full_mode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `fb_requests_dates_info`
--
ALTER TABLE `fb_requests_dates_info`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `fb_requests_dates_partial_mode`
--
ALTER TABLE `fb_requests_dates_partial_mode`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `api_resource`
--
ALTER TABLE `api_resource`
  ADD CONSTRAINT `api_resource_provider_foreign` FOREIGN KEY (`provider`) REFERENCES `providers` (`name`);

--
-- Constraints for table `fb_api_full_mode`
--
ALTER TABLE `fb_api_full_mode`
  ADD CONSTRAINT `fb_api_full_mode_groupapi_foreign` FOREIGN KEY (`groupApi`) REFERENCES `fb_api_group_full_mode` (`id_api_group`);

--
-- Constraints for table `fb_api_group_full_mode`
--
ALTER TABLE `fb_api_group_full_mode`
  ADD CONSTRAINT `fb_api_group_full_mode_pageedge_foreign` FOREIGN KEY (`pageEdge`) REFERENCES `fb_page_edge` (`endPath`),
  ADD CONSTRAINT `fb_api_group_full_mode_paymentid_foreign` FOREIGN KEY (`paymentID`) REFERENCES `user_payment` (`paymentID`),
  ADD CONSTRAINT `fb_api_group_full_mode_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `fb_api_group_full_mode_source`
--
ALTER TABLE `fb_api_group_full_mode_source`
  ADD CONSTRAINT `fb_api_group_full_mode_source_apigroup_foreign` FOREIGN KEY (`apiGroup`) REFERENCES `fb_api_group_full_mode` (`id_api_group`);

--
-- Constraints for table `fb_api_group_partial_mode`
--
ALTER TABLE `fb_api_group_partial_mode`
  ADD CONSTRAINT `fb_api_group_partial_mode_pageedge_foreign` FOREIGN KEY (`pageEdge`) REFERENCES `fb_page_edge` (`endPath`),
  ADD CONSTRAINT `fb_api_group_partial_mode_paymentid_foreign` FOREIGN KEY (`paymentID`) REFERENCES `user_payment` (`paymentID`),
  ADD CONSTRAINT `fb_api_group_partial_mode_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `fb_api_info`
--
ALTER TABLE `fb_api_info`
  ADD CONSTRAINT `fb_api_info_paymentid_foreign` FOREIGN KEY (`paymentID`) REFERENCES `user_payment` (`paymentID`),
  ADD CONSTRAINT `fb_api_info_user_foreign` FOREIGN KEY (`user`) REFERENCES `users` (`id`);

--
-- Constraints for table `fb_api_partial_mode`
--
ALTER TABLE `fb_api_partial_mode`
  ADD CONSTRAINT `fb_api_partial_mode_groupapi_foreign` FOREIGN KEY (`groupApi`) REFERENCES `fb_api_group_partial_mode` (`id_api_group`);

--
-- Constraints for table `fb_requests_dates_full_mode`
--
ALTER TABLE `fb_requests_dates_full_mode`
  ADD CONSTRAINT `fb_requests_dates_full_mode_groupapi_foreign` FOREIGN KEY (`groupApi`) REFERENCES `fb_api_group_full_mode` (`id_api_group`) ON DELETE CASCADE;

--
-- Constraints for table `fb_requests_dates_info`
--
ALTER TABLE `fb_requests_dates_info`
  ADD CONSTRAINT `fb_requests_dates_info_api_foreign` FOREIGN KEY (`api`) REFERENCES `fb_api_info` (`id_api`) ON DELETE CASCADE;

--
-- Constraints for table `fb_requests_dates_partial_mode`
--
ALTER TABLE `fb_requests_dates_partial_mode`
  ADD CONSTRAINT `fb_requests_dates_partial_mode_groupapi_foreign` FOREIGN KEY (`groupApi`) REFERENCES `fb_api_group_partial_mode` (`id_api_group`) ON DELETE CASCADE;

--
-- Constraints for table `forum_comment`
--
ALTER TABLE `forum_comment`
  ADD CONSTRAINT `forum_comment_topicid_foreign` FOREIGN KEY (`topicID`) REFERENCES `forum_topic` (`ID`);

--
-- Constraints for table `user_payment`
--
ALTER TABLE `user_payment`
  ADD CONSTRAINT `user_payment_user_email_foreign` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`);

--
-- Constraints for table `_fbapigroupfullmode_edgenode`
--
ALTER TABLE `_fbapigroupfullmode_edgenode`
  ADD CONSTRAINT `_fbapigroupfullmode_edgenode_apigroup_foreign` FOREIGN KEY (`apiGroup`) REFERENCES `fb_api_group_full_mode` (`id_api_group`),
  ADD CONSTRAINT `_fbapigroupfullmode_edgenode_edgenode_foreign` FOREIGN KEY (`edgeNode`) REFERENCES `fb_page_edge_node` (`endPath`);

--
-- Constraints for table `_fbapigroupfullmode_payment`
--
ALTER TABLE `_fbapigroupfullmode_payment`
  ADD CONSTRAINT `_fbapigroupfullmode_payment_endpoint_foreign` FOREIGN KEY (`endPoint`) REFERENCES `fb_api_group_full_mode` (`basePathKey`),
  ADD CONSTRAINT `_fbapigroupfullmode_payment_paymentid_foreign` FOREIGN KEY (`paymentID`) REFERENCES `user_payment` (`paymentID`);

--
-- Constraints for table `_fbapigrouppartialmode_payment`
--
ALTER TABLE `_fbapigrouppartialmode_payment`
  ADD CONSTRAINT `_fbapigrouppartialmode_payment_endpoint_foreign` FOREIGN KEY (`endPoint`) REFERENCES `fb_api_group_partial_mode` (`basePathKey`),
  ADD CONSTRAINT `_fbapigrouppartialmode_payment_paymentid_foreign` FOREIGN KEY (`paymentID`) REFERENCES `user_payment` (`paymentID`);

--
-- Constraints for table `_fbapiinfomode_payment`
--
ALTER TABLE `_fbapiinfomode_payment`
  ADD CONSTRAINT `_fbapiinfomode_payment_endpoint_foreign` FOREIGN KEY (`endPoint`) REFERENCES `fb_api_info` (`basePathKey`),
  ADD CONSTRAINT `_fbapiinfomode_payment_paymentid_foreign` FOREIGN KEY (`paymentID`) REFERENCES `user_payment` (`paymentID`);

--
-- Constraints for table `_fbapiinfo_field`
--
ALTER TABLE `_fbapiinfo_field`
  ADD CONSTRAINT `_fbapiinfo_field_basepathkey_foreign` FOREIGN KEY (`basePathKey`) REFERENCES `fb_api_info` (`basePathKey`),
  ADD CONSTRAINT `_fbapiinfo_field_query_foreign` FOREIGN KEY (`query`) REFERENCES `fb_field` (`query`);

--
-- Constraints for table `_fb_apis_full_mode_fields`
--
ALTER TABLE `_fb_apis_full_mode_fields`
  ADD CONSTRAINT `_fb_apis_full_mode_fields_api_foreign` FOREIGN KEY (`api`) REFERENCES `fb_api_full_mode` (`id_api`) ON DELETE CASCADE,
  ADD CONSTRAINT `_fb_apis_full_mode_fields_field_foreign` FOREIGN KEY (`field`) REFERENCES `fb_field` (`query`) ON DELETE CASCADE;

--
-- Constraints for table `_fb_apis_partial_mode_fields`
--
ALTER TABLE `_fb_apis_partial_mode_fields`
  ADD CONSTRAINT `_fb_apis_partial_mode_fields_api_foreign` FOREIGN KEY (`api`) REFERENCES `fb_api_partial_mode` (`id_api`) ON DELETE CASCADE,
  ADD CONSTRAINT `_fb_apis_partial_mode_fields_field_foreign` FOREIGN KEY (`field`) REFERENCES `fb_field` (`query`) ON DELETE CASCADE;

--
-- Constraints for table `_fb_edge_edgenode`
--
ALTER TABLE `_fb_edge_edgenode`
  ADD CONSTRAINT `_fb_edge_edgenode_defaultfield_foreign` FOREIGN KEY (`defaultField`) REFERENCES `fb_field` (`query`) ON DELETE CASCADE,
  ADD CONSTRAINT `_fb_edge_edgenode_edge_foreign` FOREIGN KEY (`edge`) REFERENCES `fb_page_edge` (`endPath`) ON DELETE CASCADE,
  ADD CONSTRAINT `_fb_edge_edgenode_edgenode_foreign` FOREIGN KEY (`edgeNode`) REFERENCES `fb_page_edge_node` (`endPath`) ON DELETE CASCADE;

--
-- Constraints for table `_fb_field_followingrequest`
--
ALTER TABLE `_fb_field_followingrequest`
  ADD CONSTRAINT `_fb_field_followingrequest_field_foreign` FOREIGN KEY (`field`) REFERENCES `fb_field` (`query`) ON DELETE CASCADE,
  ADD CONSTRAINT `_fb_field_followingrequest_parentfield_foreign` FOREIGN KEY (`parentField`) REFERENCES `fb_field` (`query`) ON DELETE CASCADE;

--
-- Constraints for table `_fb_parent_field`
--
ALTER TABLE `_fb_parent_field`
  ADD CONSTRAINT `_fb_parent_field_edge_foreign` FOREIGN KEY (`edge`) REFERENCES `fb_page_edge` (`endPath`) ON DELETE CASCADE,
  ADD CONSTRAINT `_fb_parent_field_edgenode_foreign` FOREIGN KEY (`edgeNode`) REFERENCES `fb_page_edge_node` (`endPath`) ON DELETE CASCADE,
  ADD CONSTRAINT `_fb_parent_field_field_foreign` FOREIGN KEY (`field`) REFERENCES `fb_field` (`query`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
