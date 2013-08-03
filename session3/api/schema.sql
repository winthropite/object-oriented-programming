CREATE DATABASE cdia_restaurant;

USE cdia_restaurant;

CREATE TABLE orders_queue (
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
	order_id INT NOT NULL
);