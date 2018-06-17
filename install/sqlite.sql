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
  (1, 'Homepage', '<h2>Welcome to Opossum CMS!</h2>', 'opossum,possum,CMS', 'Opossum CMS Homepage'),
	(2, 'Blogs', '<h2>Opossum CMS Blogs</h2>', 'blog,blogs', 'Opossum CMS Blogs'),
	(3, 'About', '<h2>Opossum CMS Blogs</h2>', 'about', 'About Opossum CMS');

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

CREATE TABLE `#dbPrefix#block` ( 
	`id` INTEGER PRIMARY KEY AUTOINCREMENT,
	`id2_sidebar` TEXT,
	`title` TEXT,
	`body` TEXT,
	`controller` TEXT,
	`display_in_nodes_logic` INTEGER,
	`display_in_nodes` TEXT,
	`display_in_blog` INTEGER,
	FOREIGN KEY(id2_sidebar) REFERENCES #dbPrefix#sidebar(id)
);

INSERT INTO `#dbPrefix#block` (
	id2_sidebar, title, body, controller, display_in_nodes_logic, display_in_nodes, display_in_blog) VALUES
		('right', 'Right block', 'This is my right block', '', 0, '', 1),
		('right', 'Facebook', '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fopossum.su&width=300&height=380&colorscheme=light&show_faces=true&header=false&stream=false&show_border=false&appId=449051328458464" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:390px;" allowtransparency="true">
</iframe>', '', 0, '', 1),
		('left', 'Left block', 'This is my left block', '', 0, '', 1),
		('middle', 'Blogs', '', 'BLOG_LIST', 1, '1,2', 0);
