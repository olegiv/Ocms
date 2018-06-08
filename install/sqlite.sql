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

DROP TABLE IF EXISTS `#dbPrefix#ocms_node`;

CREATE TABLE `#dbPrefix#node` ( `id` INTEGER PRIMARY KEY AUTOINCREMENT, `title` TEXT, `body` TEXT );

INSERT INTO `#dbPrefix#node` (id, title, body) VALUES
  (1, 'Homepage', '<h2>This is Opossum CMS Homepage</h2><p>Hello Opossum!</p>');
INSERT INTO `#dbPrefix#node` (title, body) VALUES
	('Test Page', '<h2>This is a test page for Oposum CMS</h2><p>How s life Possum?</p>');
