BEGIN TRANSACTION;
CREATE TABLE `ocms_user` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`username`	TEXT NOT NULL,
	`password`	TEXT NOT NULL
);
INSERT INTO `ocms_user` VALUES (1,'opossum','mypass');
INSERT INTO `ocms_user` VALUES (2,'possum','123');
INSERT INTO `ocms_user` VALUES (3,'fox','fox');
CREATE TABLE `ocms_sidebar` (
	`id`	TEXT NOT NULL,
	`title`	TEXT,
	PRIMARY KEY(`id`)
);
INSERT INTO `ocms_sidebar` VALUES ('left','Left');
INSERT INTO `ocms_sidebar` VALUES ('top','Top');
INSERT INTO `ocms_sidebar` VALUES ('right','Right');
INSERT INTO `ocms_sidebar` VALUES ('bottom','Bottom');
INSERT INTO `ocms_sidebar` VALUES ('middle','Middle');
CREATE TABLE `ocms_node` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`title`	TEXT NOT NULL,
	`body`	TEXT,
	`keywords`	TEXT,
	`description`	TEXT
);
INSERT INTO `ocms_node` VALUES (1,'Homepage','<h2>Welcome!</h2>','CMS','OCMS Homepage');
INSERT INTO `ocms_node` VALUES (2,'Blogs','<h2>Blogs</h2>','blog,blogs','OCMS Blogs');
INSERT INTO `ocms_node` VALUES (3,'About','<h2>About</h2>','about','About OCMS');
INSERT INTO `ocms_node` VALUES (404,'404 - Page not found','Page not found',NULL,NULL);
CREATE TABLE "ocms_menu" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`nodeId`	INTEGER NOT NULL,
	`rank`	INTEGER,
	`parentNodeId`	INTEGER,
	`url`	TEXT NOT NULL,
	`label`	TEXT NOT NULL
);
INSERT INTO `ocms_menu` VALUES (1,2,2,NULL,'/blogs','Blogs');
INSERT INTO `ocms_menu` VALUES (2,3,3,NULL,'/about','About');
INSERT INTO `ocms_menu` VALUES (3,1,1,NULL,'/','Homepage');
CREATE TABLE `ocms_category` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`label`	TEXT NOT NULL UNIQUE
);
INSERT INTO `ocms_category` VALUES (1,'News');
INSERT INTO `ocms_category` VALUES (2,'Site News');
CREATE TABLE `ocms_blog` (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`created`	INTEGER NOT NULL,
	`content_date`	INTEGER NOT NULL,
	`id2_author`	INTEGER NOT NULL,
	`id2_category`	INTEGER NOT NULL,
	`title`	TEXT NOT NULL,
	`abstract`	TEXT NOT NULL,
	`body`	TEXT NOT NULL,
	`tags`	TEXT NOT NULL,
	`description`	TEXT NOT NULL,
	FOREIGN KEY(`id2_category`) REFERENCES `ocms_category`(`id`),
	FOREIGN KEY(`id2_author`) REFERENCES `ocms_user`(`id`)
);
INSERT INTO `ocms_blog` VALUES (1,1531257375,1531257375,1,1,'Can Bender bend an iPhone6 Plus?','From an engineering standpoint, the iPhone is an amazingly small and delicately constructed device. The only thing really contributing to the structural integrity of the iPhone 6 Plus is the thin aluminum frame that covers the back and reaches around the sides.','
<p>
	YES! He can. Even not Bender but you - just look how to do it.
</p>
<p data-textannotation-id="0e32af19d50fcba027757a08c4af7aed">
	According to experts, though, it probably shouldn''t be surprising. As Jeremy Irons, a Design Engineer at&nbsp;<a href="http://creativeengineering.com/" target="_blank">Creative Engineering&nbsp;</a>explained:
</p>
<p data-textannotation-id="c1830b3478b878fd3201e5c7712336af">
	<em>From an engineering standpoint, the iPhone is an amazingly small and delicately constructed device. The only thing really contributing to the structural integrity of the iPhone 6 Plus is the thin aluminum frame that covers the back and reaches around the sides. There is also another very thin piece of steel behind the glass, but we are not working with much as far as bending strength.</em>
</p>','bend iPhone Bender','From an engineering standpoint, the iPhone is an amazingly small and delicately constructed device. The only thing really contributing to the structural integrity of the iPhone 6 Plus is the thin aluminum frame that covers the back and reaches around the sides.');
INSERT INTO `ocms_blog` VALUES (2,1531257377,1531257377,2,2,'SQL Joins Diagram','For those about to SQL - we salute you :-)','<p>
	For those about to SQL - we salute you :-)
</p>

<p>
	Source: <a title="Data Visualisation at Google +" href="https://plus.google.com/111053008130113715119/about" target="_blank">Data Visualisation</a>
</p>','db join MySQL SQL syntax','For those about to SQL - we salute you :-)');
CREATE TABLE `ocms_block` (
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
INSERT INTO `ocms_block` VALUES (1,'right','Right block','This is my right block','',0,'',1);
INSERT INTO `ocms_block` VALUES (2,'right','Facebook','Facebook widget','',0,'',1);
INSERT INTO `ocms_block` VALUES (3,'left','Left block','This is my left block','',0,'',1);
INSERT INTO `ocms_block` VALUES (4,'middle','Blogs','','BLOG_LIST',1,'2,3',0);
CREATE TABLE "ocms_alias" (
	`id`	INTEGER NOT NULL PRIMARY KEY AUTOINCREMENT,
	`alias`	TEXT NOT NULL UNIQUE,
	`node`	INTEGER NOT NULL
);
INSERT INTO `ocms_alias` VALUES (1,'/blogs',2);
INSERT INTO `ocms_alias` VALUES (2,'/about',3);
COMMIT;
