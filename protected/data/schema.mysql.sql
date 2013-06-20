CREATE DATABASE db_name DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

DROP TABLE IF EXISTS yii_user;
CREATE TABLE IF NOT EXISTS yii_user (
    uid INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'User ID',
    email VARCHAR(50) NOT NULL COMMENT 'E-mail',
    password CHAR(32) NOT NULL COMMENT 'Password',
    salt CHAR(32) NOT NULL COMMENT 'Sucure Code',
    role ENUM('ADMIN','MODERATOR','USER') NOT NULL DEFAULT 'USER' COMMENT 'Role',
    time_create TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Create Time',
    time_update TIMESTAMP NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Last Time',
    enabled tinyint(1) NOT NULL DEFAULT '1' COMMENT '1 - active и 0 - noactive',
    ip VARCHAR(15) NOT NULL DEFAULT '0' COMMENT 'IP address',
    PRIMARY KEY (`uid`),
    UNIQUE `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO yii_user (email, password, salt, role) VALUES ('admin@yourdomain.com','b8da40bf357e3de6cf0f9570c7cff2c0','4ff0449a4a31e7.87066262','ADMIN'); /* Password: demo */

DROP TABLE IF EXISTS yii_profile;
CREATE TABLE yii_profile (
    user_id INT(10) UNSIGNED NOT NULL COMMENT 'User ID',
    firstname VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'First Name',
    lastname VARCHAR(50) NOT NULL DEFAULT '' COMMENT 'Last Name',
    uimage VARCHAR(255) NOT NULL DEFAULT '' COMMENT 'User Photo',
    about TEXT NOT NULL DEFAULT '' COMMENT 'User About',
    UNIQUE KEY `user_id` (`user_id`),
    CONSTRAINT `user_profile_id` FOREIGN KEY (`user_id`) REFERENCES `yii_user` (`uid`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ;

INSERT INTO yii_profile (user_id) VALUES ('1');
