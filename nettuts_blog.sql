-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Host: internal-db.s41150.gridserver.com
-- Generation Time: Oct 17, 2008 at 12:48 PM
-- Server version: 4.1.25
-- PHP Version: 4.4.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `db41150_nettuts_blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL auto_increment,
  `title` varchar(255) NOT NULL default '',
  `post` text NOT NULL,
  `author_id` int(11) NOT NULL default '0',
  `date_posted` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `post`, `author_id`, `date_posted`) VALUES
(1, 'My First Blog Post!', 'This is my first post on my new simple blog!', 1, '2008-10-17'),
(2, 'Web design!', 'This post is all about web design! I love web design!', 1, '2008-10-17'),
(3, 'The Importance of UX', 'This post is all about user experience and how important it is while designing for the web.', 1, '2008-10-18');

-- --------------------------------------------------------

--
-- Table structure for table `blog_post_tags`
--

CREATE TABLE `blog_post_tags` (
  `blog_post_id` int(11) NOT NULL default '0',
  `tag_id` int(11) NOT NULL default '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blog_post_tags`
--

INSERT INTO `blog_post_tags` (`blog_post_id`, `tag_id`) VALUES
(2, 1),
(3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `people`
--

CREATE TABLE `people` (
  `id` int(11) NOT NULL auto_increment,
  `first_name` varchar(255) NOT NULL default '',
  `last_name` varchar(255) NOT NULL default '',
  `url` varchar(255) NOT NULL default '',
  `email` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `people`
--

INSERT INTO `people` (`id`, `first_name`, `last_name`, `url`, `email`) VALUES
(1, 'Ben', 'Mills', 'http://www.benmillsdesigns.com/', 'bmills@benmillsdesigns.com');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL default '',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `name`) VALUES
(1, 'Web Design'),
(2, 'User Experience');
