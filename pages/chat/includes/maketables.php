<?php 
	include "base.php";
	// Create database
	if (mysql_query("CREATE DATABASE $dbname")) { echo ""; } else { echo mysql_error(); }
	// select DB
	mysql_select_db($dbname);	
	// standard responses
        mysql_query("
        CREATE TABLE IF NOT EXISTS `responses` (
          `id` int(11) NOT NULL auto_increment,
          `title` varchar(200) NOT NULL,
          `message` varchar(3000) NOT NULL,
          PRIMARY KEY  (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
        ");
        // files
        mysql_query("
        CREATE TABLE IF NOT EXISTS `files` (
          `id` int(11) NOT NULL auto_increment,
          `path` varchar(300) NOT NULL,
          `name` varchar(200) NOT NULL,
          `description` varchar(1000) NOT NULL,                                                                                               
          PRIMARY KEY  (`id`)
        ) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
        ");

	// create sessions table
	mysql_query("
	CREATE TABLE IF NOT EXISTS `sessions` (
	  `id` int(11) NOT NULL auto_increment,
	  `userID` varchar(200) NOT NULL,
	  `convoID` int(11) NOT NULL,
	  `name` varchar(100) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  `initiated` int(11) NOT NULL,
	  `status` varchar(20) NOT NULL,
	  `ended` int(11) NOT NULL,
	  `updated` int(11) NOT NULL,
	  `answered` int(11) NOT NULL,
	  `contact` varchar(3) NOT NULL default 'no',
	  `hide` varchar(3) NOT NULL default 'no',
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
	");
	// create transcript table
	mysql_query("
	CREATE TABLE IF NOT EXISTS `transcript` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(100) NOT NULL,
	  `message` varchar(2000) NOT NULL,
	  `user` varchar(100) NOT NULL,
	  `convoID` int(11) NOT NULL,
	  `time` varchar(100) NOT NULL,
	  `class` varchar(20) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
	");
	// create archive table
	mysql_query("
		CREATE TABLE IF NOT EXISTS `archive` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(100) NOT NULL,
	  `message` varchar(2000) NOT NULL,
	  `user` varchar(100) NOT NULL,
	  `convoID` int(11) NOT NULL,
	  `time` varchar(100) NOT NULL,
	  `class` varchar(20) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
	");
	// create leads table
	mysql_query("
	CREATE TABLE IF NOT EXISTS `leads` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(100) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  `transcript` varchar(10000) NOT NULL,
	  `date` varchar(50) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
	");
	// create users table
	mysql_query("
	CREATE TABLE IF NOT EXISTS `users` (
	  `id` int(11) NOT NULL auto_increment,
	  `name` varchar(100) NOT NULL,
	  `password` varchar(200) NOT NULL,
	  `username` varchar(100) NOT NULL,
	  `email` varchar(100) NOT NULL,
	  `admin` varchar(3) NOT NULL,
	  `available` varchar(3) NOT NULL default 'no',
	  `keepAlive` int(11) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0
        ");
	// create config table
	 mysql_query("
	CREATE TABLE IF NOT EXISTS `config` (
	  `id` int(11) NOT NULL,
	  `email` varchar(200) NOT NULL,
	  `clientRefresh` int(5) NOT NULL default '2000',
	  `adminRefresh` int(5) NOT NULL default '2000',
	  `convoRefresh` int(5) NOT NULL default '3500',
	  `inactive` int(5) NOT NULL default '3000',
	  `end` int(5) NOT NULL default '3000',
	  `remove` int(5) NOT NULL default '3000',
	  `title` varchar(200) NOT NULL,
	  `offlineMessage` varchar(1000) NOT NULL,
	  `loginMessage` varchar(1000) NOT NULL,
	  `welcome` varchar(500) NOT NULL,
	  `leaveAMessage` varchar(1000) NOT NULL,
	  `thankYouMessage` varchar(1000) NOT NULL,
	  PRIMARY KEY  (`id`)
	) ENGINE=MyISAM DEFAULT CHARSET=latin1
        ");
	// insert default config data
	 mysql_query("
	INSERT INTO `config` (`id`, `email`, `clientRefresh`, `adminRefresh`, `convoRefresh`, `inactive`, `end`, `remove`, `title`, `offlineMessage`, `loginMessage`, `welcome`, `leaveAMessage`, `thankYouMessage`) VALUES
	(0, 'unset', 5000, 3000, 5000, 600, 300, 3000, 'Live Support Chat!', 'None of our representatives are available right now, although you are welcome to leave a message!', 'Please type your name to begin. Entering your email address is optional, although if you would like to be contacted in the future, please add your email address and tick the checkbox before starting your session.', 'Welcome, A representative will be with you shortly', 'None of our representatives are currently available.  Please use the form below to send us an email.', 'Thank you for your message.  We will be in touch as soon as possible!')
        ");

	function table_exists ($table, $db) {
                        $tables = mysql_list_tables ($db);
                                while (list ($temp) = mysql_fetch_array ($tables)) {
                                        if ($temp == $table) {
                                                return TRUE;
                                        }
                                }
                        return FALSE;
                }
                if(table_exists("sessions",$dbname)) {
                        $output = $output . ' <p>Sessions table created!</p> ';
                } else {
                        $output = $output . ' <p>Error creating sessions table!</p> ';
                        $errors = 1;
                }
                if(table_exists("transcript",$dbname)) {
                        $output = $output . ' <p>Transcript table created!</p> ';
                } else {
                        $output = $output . ' <p>Error creating transcript table!</p> ';
                        $errors = 1;
                }
                if(table_exists("archive",$dbname)) {
                        $output = $output . ' <p>Archive table created!</p> ';
                } else {
                        $output = $output . ' <p>Error creating archive table!</p> ';
                        $errors = 1;
                }
                if(table_exists("users",$dbname)) {
                        $output = $output . ' <p>Users table created!</p> ';
                } else {
                        $output = $output . ' <p>Error creating users table!</p> ';
                        $errors = 1;
                }
                if(table_exists("config",$dbname)) {
                        $output = $output . ' <p>Config table created!</p> ';
                } else {
                        $output = $output . ' <p>Config creating users table!</p> ';
                        $errors = 1;
                }
                if(table_exists("leads",$dbname)) {
                        $output = $output . ' <p>Leads table created!</p> ';
                } else {
                        $output = $output . ' <p>Leads creating users table!</p> ';
                        $errors = 1;
                }

		if($errors == 0) {
			echo '<h3>Tables created with no problems.</h3>';
		} else {
			echo '<h3>Errors encountered when creating tables!</h3>';
		}

?>
