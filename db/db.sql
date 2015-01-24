
CREATE DATABASE `db_einfodesk`;

CREATE TABLE `tbl_user` (
  `ucol_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ucol_username` varchar(50) NOT NULL,
  `ucol_password` varchar(100) NOT NULL,
  `ucol_type` bit(1) NOT NULL,
  PRIMARY KEY (`ucol_id`),
  UNIQUE KEY `ucol_username_UNIQUE` (`ucol_username`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1 COMMENT='contains user id , useername and password .';


CREATE TABLE `tbl_admin` (
  `admin_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_username` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_firstName` varchar(100) NOT NULL,
  `admin_lastName` varchar(150) NOT NULL,
  `admin_emailId` varchar(100) NOT NULL,
  `admin_contactNo` varchar(15) NOT NULL,
  `admin_image_name` varchar(50) DEFAULT NULL,
  `admin_image` longblob,
  `admin_image_type` varchar(10) DEFAULT NULL,
  `admin_image_size` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`admin_id`),
  UNIQUE KEY `admin_username_UNIQUE` (`admin_username`),
  UNIQUE KEY `admin_emailId_UNIQUE` (`admin_emailId`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1 COMMENT='admin accounts';


CREATE TABLE `tbl_student` (
  `stcol_id` int(10) unsigned NOT NULL,
  `stcol_firstName` varchar(100) NOT NULL,
  `stcol_lastName` varchar(100) NOT NULL,
  `stcol_batch` int(11) NOT NULL,
  `stcol_department` varchar(25) NOT NULL,
  `stcol_rollNo` varchar(30) NOT NULL,
  `stcol_dob` date NOT NULL,
  `stcol_permAddress` varchar(150) NOT NULL,
  `stcol_tempAddress` varchar(150) DEFAULT NULL,
  `stcol_emailId` varchar(150) NOT NULL,
  `stcol_contactNo` char(11) NOT NULL,
  `stcol_fatherName` varchar(100) NOT NULL,
  `stcol_motherName` varchar(100) DEFAULT NULL,
  `stcol_guardianName` varchar(100) DEFAULT NULL,
  `stcol_image_name` varchar(50) NOT NULL,
  `stcol_image` longblob NOT NULL,
  `stcol_image_type` varchar(10) NOT NULL,
  `stcol_image_size` varchar(30) NOT NULL,
  UNIQUE KEY `stcol_rollNo_UNIQUE` (`stcol_rollNo`),
  UNIQUE KEY `stcol_emailId_UNIQUE` (`stcol_emailId`),
  UNIQUE KEY `stcol_id_UNIQUE` (`stcol_id`),
  CONSTRAINT `fk_stcol_id` FOREIGN KEY (`stcol_id`) REFERENCES `tbl_user` (`ucol_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='student basic information\nneed to add some other columns for /* comment truncated */ /* /* comment truncated */ /* referencing as library, fees, attendance, etc.\nroll no must be set unique but was ambiguity.*/*/';


CREATE TABLE `tbl_staff` (
  `stfcol_id` int(10) unsigned NOT NULL,
  `stfcol_firstName` varchar(100) NOT NULL,
  `stfcol_lastName` varchar(100) NOT NULL,
  `stfcol_dob` date NOT NULL,
  `stfcol_department` varchar(100) NOT NULL,
  `stfcol_jobPosition` varchar(100) NOT NULL,
  `stfcol_workTime` int(11) NOT NULL,
  `stfcol_permAddress` varchar(150) NOT NULL,
  `stfcol_tempAddress` varchar(150) DEFAULT NULL,
  `stfcol_emailId` varchar(250) NOT NULL,
  `stfcol_contactNo` char(11) NOT NULL,
  `stfcol_bio` varchar(500) DEFAULT NULL,
  `stfcol_image_name` varchar(50) NOT NULL,
  `stfcol_image` longblob NOT NULL,
  `stfcol_image_type` varchar(10) NOT NULL,
  `stfcol_image_size` varchar(30) NOT NULL,
  UNIQUE KEY `stfcol_id_UNIQUE` (`stfcol_id`),
  UNIQUE KEY `stfcol_emailId_UNIQUE` (`stfcol_emailId`),
  CONSTRAINT `fk_stfcol_id` FOREIGN KEY (`stfcol_id`) REFERENCES `tbl_user` (`ucol_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE `tbl_user_login_history` (
  `userloginhistorycol_id` int(10) unsigned NOT NULL,
  `userloginhistorycol_ipAddress` varchar(20) NOT NULL,
  `userloginhistorycol_dateTime` datetime NOT NULL,
  KEY `fk_userloginhistorycol_id_idx` (`userloginhistorycol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tbl_login_attempts` (
  `attemptcol_ipAddress` varchar(20) NOT NULL,
  `attemptcol_attempts` int(11) NOT NULL,
  `attemptcol_lastLogin` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `tbl_class_schedule` (
  `schedulecol_id` int(11) NOT NULL AUTO_INCREMENT,
  `schedulecol_department` varchar(10) NOT NULL,
  `schedulecol_level` int(2) NOT NULL,
  `schedulecol_section` char(2) DEFAULT NULL,
  `schedulecol_image_name` varchar(50) NOT NULL,
  `schedulecol_image` longblob NOT NULL,
  `schedulecol_image_type` varchar(10) NOT NULL,
  `schedulecol_image_size` varchar(30) NOT NULL,
  PRIMARY KEY (`schedulecol_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


CREATE TABLE `tbl_notice` (
  `noticecol_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `noticecol_title` varchar(100) NOT NULL,
  `noticecol_content` longtext NOT NULL,
  `noticecol_author` varchar(100) NOT NULL,
  `noticecol_date` datetime NOT NULL,
  `noticecol_status` bit(1) NOT NULL,
  PRIMARY KEY (`noticecol_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;