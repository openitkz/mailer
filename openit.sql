-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- ����: 127.0.0.1
-- ����� ��������: ��� 02 2016 �., 13:16
-- ������ �������: 10.1.16-MariaDB
-- ������ PHP: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- ���� ������: `openit`
--

-- --------------------------------------------------------

--
-- ��������� ������� `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT '100',
  `surname` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `contact_lists_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ���� ������ ������� `contacts`
--

INSERT INTO `contacts` (`contact_id`, `name`, `surname`, `email`, `contact_lists_id`) VALUES
(5, 'aza', 'aza', 'zorkanov.93@gmail.com', 6);

-- --------------------------------------------------------

--
-- ��������� ������� `contact_lists`
--

CREATE TABLE `contact_lists` (
  `contact_lists_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ���� ������ ������� `contact_lists`
--

INSERT INTO `contact_lists` (`contact_lists_id`, `name`, `description`, `users_id`) VALUES
(6, 'adsf', 'adsf', 4),
(7, 'asdf', 'asdf', 4);

-- --------------------------------------------------------

--
-- ��������� ������� `messages_sent`
--

CREATE TABLE `messages_sent` (
  `message_sent_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(100) DEFAULT NULL,
  `html_message` text,
  `status` varchar(2) DEFAULT 'N' COMMENT 'N-not sent, S-sent',
  `m_datetime` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ���� ������ ������� `messages_sent`
--

INSERT INTO `messages_sent` (`message_sent_id`, `user_id`, `subject`, `html_message`, `status`, `m_datetime`, `email`) VALUES
(7, 4, 'asd', 'fasdf', 'S', 1475398821, 'zorkanov.93@gmail.com');

-- --------------------------------------------------------

--
-- ��������� ������� `profiles`
--

CREATE TABLE `profiles` (
  `profile_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- ��������� ������� `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `profile_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- ���� ������ ������� `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `profile_id`) VALUES
(4, 'azamat', '017209858496bc150fb467b572938d7dd788a20f', NULL);

--
-- ������� ���������� ������
--

--
-- ������� ������� `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`),
  ADD KEY `fk_contacts_contact_lists` (`contact_lists_id`);

--
-- ������� ������� `contact_lists`
--
ALTER TABLE `contact_lists`
  ADD PRIMARY KEY (`contact_lists_id`),
  ADD KEY `fk_contact_lists_users` (`users_id`);

--
-- ������� ������� `messages_sent`
--
ALTER TABLE `messages_sent`
  ADD PRIMARY KEY (`message_sent_id`),
  ADD KEY `fk_messages_sent_users` (`user_id`);

--
-- ������� ������� `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`profile_id`);

--
-- ������� ������� `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `fk_users_profiles` (`profile_id`);

--
-- AUTO_INCREMENT ��� ���������� ������
--

--
-- AUTO_INCREMENT ��� ������� `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT ��� ������� `contact_lists`
--
ALTER TABLE `contact_lists`
  MODIFY `contact_lists_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT ��� ������� `messages_sent`
--
ALTER TABLE `messages_sent`
  MODIFY `message_sent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT ��� ������� `profiles`
--
ALTER TABLE `profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT ��� ������� `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- ����������� �������� ����� ����������� ������
--

--
-- ����������� �������� ����� ������� `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `fk_contacts_contact_lists` FOREIGN KEY (`contact_lists_id`) REFERENCES `contact_lists` (`contact_lists_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- ����������� �������� ����� ������� `contact_lists`
--
ALTER TABLE `contact_lists`
  ADD CONSTRAINT `fk_contact_lists_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- ����������� �������� ����� ������� `messages_sent`
--
ALTER TABLE `messages_sent`
  ADD CONSTRAINT `fk_messages_sent_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- ����������� �������� ����� ������� `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_profiles` FOREIGN KEY (`profile_id`) REFERENCES `profiles` (`profile_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
