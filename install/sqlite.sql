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

/* blog */

DROP TABLE IF EXISTS `#dbPrefix#blog`;

CREATE TABLE `#dbPrefix#blog` ( `id` INTEGER PRIMARY KEY AUTOINCREMENT, `title` TEXT,
	`body` TEXT, `tags` TEXT, `description` TEXT);

INSERT INTO `#dbPrefix#blog` (title, body, tags, description) VALUES
	('Blog #1', 'This is the 1st blog', '#blog #1st', '1st blog description'),
	('Blog #2', 'This is the 2nd blog', '#blog #2nd', '2nd blog description');

/* sidebar */

DROP TABLE IF EXISTS `#dbPrefix#sidebar`;

CREATE TABLE `#dbPrefix#sidebar` ( `id` TEXT PRIMARY KEY, `title` TEXT );

INSERT INTO `#dbPrefix#sidebar` (id, title) VALUES
	('left', 'Left'),
	('top', 'Top'),
	('right', 'Right'),
	('bottom', 'Bottom'),
	('middle', 'Middle');

/* block */

DROP TABLE IF EXISTS `#dbPrefix#block`;

CREATE TABLE `#dbPrefix#block` ( `id` INTEGER PRIMARY KEY AUTOINCREMENT, `id2_sidebar` TEXT,
	`title` TEXT, `body` TEXT, `controller` TEXT,  FOREIGN KEY(id2_sidebar) REFERENCES #dbPrefix#sidebar(id));

INSERT INTO `#dbPrefix#block` (id2_sidebar, title, body, controller) VALUES
	('right', 'Right block', 'This is my right block', ''),
	('right', 'Facebook', '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fopossum.su&width=300&height=380&colorscheme=light&show_faces=true&header=false&stream=false&show_border=false&appId=449051328458464" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:390px;" allowtransparency="true">
</iframe>', ''),
	('left', 'Left block', 'This is my left block', ''),
	('middle', 'Middle block', 'This is my middle block', 'BLOG_LIST');
