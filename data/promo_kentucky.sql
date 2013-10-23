
CREATE DATABASE IF NOT EXISTS `promo_kentucky` DEFAULT CHARACTER SET latin1 COLLATE ;
--USERNAME   sersubs_kentucky     PASSWORD WJTLP01XU9IMKEN

create table if not exists `jb_user` (
	`id` varchar (12) primary key not null,
	`username`  varchar(100) not null,
	`first_name`   varchar(100) not null,
	`last_name`   varchar(100) null,
	`name` varchar(200) not null,
	`birthday` date not null,
	`gender`   char(1) not null,
	`email` 	varchar(70)not null,
	`date_register`	TIMESTAMP,
	`place` 	varchar(60)not null
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists `jb_voters`(
    `id_user` varchar (12) not null,
    `id_voter`  varchar(12)not null,
	`vote_date`    date not null,
	`kty_votes`  BIGINT(30)not null,
	CONSTRAINT FK_voters FOREIGN KEY (id_user)
		REFERENCES jb_user (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

create table if not exists `jb_media`(
    `id_user`      varchar(12)not null,
    `name`      varchar(20)not null,
    `media_type`       varchar(10)not null,
	`date_upload`    TIMESTAMP,
	`description`    blob not null,
	CONSTRAINT FK_media FOREIGN KEY (id_user)
		REFERENCES jb_user (id) ON DELETE CASCADE ON UPDATE CASCADE
)ENGINE=InnoDB DEFAULT CHARSET=utf8;