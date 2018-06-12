/**
 * Author:  olegiv
 * Created: Jun 7, 2018
 */

/* user */

DROP TABLE IF EXISTS `#dbPrefix#user`;

CREATE TABLE `#dbPrefix#user` (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT,
    password TEXT
);

INSERT INTO `#dbPrefix#user` (username, password) VALUES
    ('opossum', 'mypass'), ('possum', '123'), ('fox', 'fox');

/* node */

DROP TABLE IF EXISTS `#dbPrefix#node`;

CREATE TABLE `#dbPrefix#node` ( `id` INTEGER PRIMARY KEY AUTOINCREMENT, `title` TEXT,
	`body` TEXT, `keywords` TEXT, `description` TEXT);

INSERT INTO `#dbPrefix#node` (id, title, body, keywords, description) VALUES
  (1, 'Homepage', '<h2>This is Opossum CMS Homepage</h2><p>Hello Opossum!</p>', 'opossum,possum', 'Opossum CMS Homepage');
INSERT INTO `#dbPrefix#node` (title, body, keywords, description) VALUES
	('Test Page', '<h2>This is a test page for Oposum CMS</h2><p>How s life Possum?</p>', 'page1', 'OCMS page1');

/* block */

DROP TABLE IF EXISTS `#dbPrefix#block`;

CREATE TABLE `#dbPrefix#block` ( `id` INTEGER PRIMARY KEY AUTOINCREMENT, `title` TEXT, `body` TEXT );

INSERT INTO `#dbPrefix#block` (title, body) VALUES
	('The 1st block', 'This is my first block'),
	('The 2nd block', 'This is my second block');
