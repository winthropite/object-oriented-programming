CREATE DATABASE cdia_user;

USE cdia_user;

CREATE TABLE user (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255) NOT NULL,
	password VARCHAR(123) NULL
);

INSERT INTO user 
	(username, password) 
VALUES 
	('test', '$5$rounds=5000$cdia$h26OSgrWChu6TZfWeqS92bm2lWEPFWMlVHRaOMXyp2D');