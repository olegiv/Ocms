BEGIN TRANSACTION;
DROP TABLE IF EXISTS `ocms_user`;
CREATE TABLE IF NOT EXISTS `ocms_user` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`username`	TEXT NOT NULL,
	`password`	TEXT NOT NULL
);
INSERT INTO `ocms_user` (id,username,password) VALUES (1,'opossum','mypass'),
 (2,'possum','123'),
 (3,'fox','fox');
DROP TABLE IF EXISTS `ocms_sidebar`;
CREATE TABLE IF NOT EXISTS `ocms_sidebar` (
	`id`	TEXT NOT NULL,
	`title`	TEXT,
	PRIMARY KEY(`id`)
);
INSERT INTO `ocms_sidebar` (id,title) VALUES ('left','Left'),
 ('top','Top'),
 ('right','Right'),
 ('bottom','Bottom'),
 ('middle','Middle');
DROP TABLE IF EXISTS `ocms_node`;
CREATE TABLE IF NOT EXISTS `ocms_node` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`title`	TEXT NOT NULL,
	`body`	TEXT,
	`keywords`	TEXT,
	`description`	TEXT
);
INSERT INTO `ocms_node` (id,title,body,keywords,description) VALUES (1,'Homepage','<h2>Welcome to Opossum CMS!</h2>','opossum,possum,CMS','Opossum CMS Homepage'),
 (2,'Blogs','<h2>Opossum CMS Blogs</h2>','blog,blogs','Opossum CMS Blogs'),
 (3,'About','<h2>Opossum CMS Blogs</h2>','about','About Opossum CMS');
DROP TABLE IF EXISTS `ocms_category`;
CREATE TABLE IF NOT EXISTS `ocms_category` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`label`	TEXT NOT NULL UNIQUE
);
INSERT INTO `ocms_category` (id,label) VALUES (1,'News'),
 (2,'Site News');
DROP TABLE IF EXISTS `ocms_blog`;
CREATE TABLE IF NOT EXISTS `ocms_blog` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`created`	INTEGER NOT NULL,
	`content_date`	INTEGER NOT NULL,
	`id2_author`	INTEGER NOT NULL,
	`id2_category`	INTEGER NOT NULL,
	`title`	TEXT NOT NULL,
	`body`	TEXT,
	`tags`	TEXT,
	`description`	TEXT,
	FOREIGN KEY(`id2_category`) REFERENCES `ocms_category`(`id`),
	FOREIGN KEY(`id2_author`) REFERENCES `ocms_user`(`id`)
);
INSERT INTO `ocms_blog` (id,created,content_date,id2_author,id2_category,title,body,tags,description) VALUES (1,1531257375,1531257375,1,1,'Blog #1','This is the 1st blog','#blog #1st','1st blog description'),
 (2,1531257377,1531257377,2,2,'Blog #2','This is the 2nd blog','#blog #2nd','2nd blog description');
DROP TABLE IF EXISTS `ocms_block`;
CREATE TABLE IF NOT EXISTS `ocms_block` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`id2_sidebar`	TEXT NOT NULL,
	`title`	TEXT,
	`body`	TEXT,
	`controller`	TEXT,
	`display_in_nodes_logic`	INTEGER,
	`display_in_nodes`	TEXT,
	`display_in_blog`	INTEGER,
	FOREIGN KEY(`id2_sidebar`) REFERENCES `ocms_sidebar`(`id`)
);
INSERT INTO `ocms_block` (id,id2_sidebar,title,body,controller,display_in_nodes_logic,display_in_nodes,display_in_blog) VALUES (1,'right','Right block','This is my right block','',0,'',1),
 (2,'right','Facebook','<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fopossum.su&width=300&height=380&colorscheme=light&show_faces=true&header=false&stream=false&show_border=false&appId=449051328458464" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:300px; height:390px;" allowtransparency="true">
</iframe>','',0,'',1),
 (3,'left','Left block','This is my left block','',0,'',1),
 (4,'middle','Blogs','','BLOG_LIST',1,'1,2',0);
COMMIT;
