<?php

	define("SERVER","localhost");
	define("USERNAME","root");
	define("PASSWORD","");
	define("databaseName","db_einfodesk");

	//table constants
	define("siteName", "www.einfodesk.com");
	define("tableAdmin","tbl_admin");
	define("tableUser","tbl_user");
	define("tableStudent","tbl_student");
	define("tableStaff","tbl_staff");
	define("viewStudent","view_student");
	define("viewStaff", "view_staff");
	define("tableNotice","tbl_notice");
	define("tableNote","tbl_note");
	define("tableLoginAttempt","tbl_login_attempts");
	define("tableUserLoginHistory","tbl_user_login_history");
	define("tableAdminLoginHistory","tbl_admin_login_history");
	define("tableClassSchedule","tbl_class_schedule");

	//other important constants
	define("attemptsNumber", "5");//for login attempts
	define("timePeriod", "60");//block for false login attempts
	define("COOKIE_EXPIRE", 60*60*24*100);      //100 days by default
	define("COOKIE_PATH", "/");

	//sms constants
	define("smsUsername", "null");
	define("smsPassword", "null");
	define("smsType", "0");
	define("smsDlr", "0");
	define("smsSource", "eInfoDesk");


	//Mailer Constants
	define("SMTPUsername", "system.einfodesk@gmail.com");
	define("SMTPPassword", "einfodeskuser");
	define("mailFrom", "test@einfodesk.com");
	define("mailReplyTo", "support@einfodesk.com");

?>