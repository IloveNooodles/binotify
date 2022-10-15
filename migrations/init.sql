drop table if exists User;

create table User (
	user_id int(11) AUTO_INCREMENT primary key,
	email varchar(256) unique not null,
	password varchar(256) not null,
	username varchar(256) unique not null,
	isAdmin bool not null
);

insert into User (email, password, username, isAdmin) values ('admin@binotify.com', 'binotify.com', 'admin', true);

drop table if exists Album;

create table Album (
	album_id int(11) AUTO_INCREMENT primary key,
	judul varchar(64) not null,
	penyanyi varchar(128) not null,
	total_duration int(11) not null,
	image_path varchar(256) not null,
	tanggal_terbit date not null,
	genre varchar(64)
);

drop table if exists Song;

create table Song (
	song_id int(11) AUTO_INCREMENT primary key,
	judul varchar(64) not null,
	penyanyi varchar(128),
	tanggal_terbit date not null,
	genre varchar(64),
	duration int(11) not null,
	audio_path varchar(256) not null,
	image_path varchar(256),
	album_id int(11),
	FOREIGN KEY (album_id) REFERENCES Album(album_id)
);