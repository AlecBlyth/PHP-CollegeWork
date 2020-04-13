DROP DATABASE IF EXISTS BunnyCorpDatabase;
CREATE DATABASE BunnyCorpDatabase;
USE BunnyCorpDatabase;

CREATE TABLE  `customers` (
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`username` VARCHAR( 100 ) NOT NULL ,
`password` VARCHAR( 100 ) NOT NULL ,
`firstname` VARCHAR( 100 ) NOT NULL ,
`surname` VARCHAR( 100 ) NOT NULL ,
`email` VARCHAR( 100 ) NOT NULL ,
`mobile` VARCHAR( 100 ) NOT NULL,
`interest` ENUM('Music', 'Cinema', 'Comedy', 'Theatre', 'Magic', 'Convention') NOT NULL
);

CREATE TABLE `events`(
  `event_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `eventName` VARCHAR(100) NOT NULL,
  `eventDesc` VARCHAR(100) NOT NULL,
  `eventType` ENUM('Music', 'Cinema', 'Comedy', 'Theatre', 'Magic', 'Convention') NOT NULL,
  `eventLocation` ENUM('Kirkclady', 'Edinburgh', 'London', 'Tokyo', 'Seoul', 'New York', 'Los Angeles') NOT NULL,
  `eventDate` VARCHAR(100) NOT NULL
);


CREATE TABLE `bookings`(
  `book_id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `event_id` INT NOT NULL,
  `id` INT NOT NULL,
  FOREIGN KEY (event_id) REFERENCES events(event_id),
  FOREIGN KEY (id) REFERENCES customers(id)
) ENGINE = INNODB;

ALTER TABLE customers AUTO_INCREMENT=1000;
ALTER TABLE events AUTO_INCREMENT=2001;
ALTER TABLE bookings AUTO_INCREMENT=3002;

INSERT INTO customers (username,password,email,mobile) VALUES ("admin","password","AlecWindsor@BunnyCorp.org","1000");

SHOW TABLES;
DESCRIBE customers;
DESCRIBE events;
DESCRIBE bookings;

SELECT * FROM customers LIMIT 10;
SELECT * FROM events LIMIT 10;
SELECT * FROM bookings LIMIT 10;
