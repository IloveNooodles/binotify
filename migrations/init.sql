drop table if exists User;

create table User (
	user_id int(11) AUTO_INCREMENT primary key,
	email varchar(256) unique not null,
	password varchar(256) not null,
	username varchar(256) unique not null,
	isAdmin bool not null
);

insert into User (email, password, username, isAdmin) values 
('admin@binotify.com', '$2y$10$Ql.4PSEPe.EEdQCJf0g9xeh1ZdCbKksV5Tf5VkjJ0haKeU7sFnssa', 'binotify.com',  true), 
('sfreeman0@etsy.com', '$2y$10$ik896cO3jbLbH.Z7.hDmReyM9UJhPm6Gq2IAr5PiPjIQ7C5fH6dOi','freeman',  false), 
('crodriguez1@va.gov', '$2y$10$I5AdY05sECk8kXqhyAW5q.dSk92M/RvzVPCzdXdLMwIQS6X4AcRGy','crodriguez',  false), 
('krobertson2@state.tx.us', '$2y$10$8u28mgkJTPle9/lejXxvZ.nCtI9YGtH9IFNv1uPuKE2mHKD58zMXO','krobertson',  false), 
('pfoster3@earthlink.net', '$2y$10$8u28mgkJTPle9/lejXxvZ.nCtI9YGtH9IFNv1uPuKE2mHKD58zMXO','pfoster',  false);

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

INSERT INTO Album (genre, image_path, judul, penyanyi, tanggal_terbit, total_duration) VALUES
('R&B/Soul', 'https://picsum.photos/id/1001/5616/3744', 'The King of Limbs', 'Radiohead', '1971-08-12', 2254),
('Vocal', 'https://picsum.photos/id/1/5616/3744', 'OK Computer', 'Radiohead', '1981-04-26', 3201),
('Post-Disco', 'https://picsum.photos/id/1025/4951/3301', 'Dummy', 'Portishead', '2001-09-17', 2926),
('Folk Music', 'https://picsum.photos/id/1019/5472/3648', 'Third', 'Portishead', '1997-01-16', 2930);

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

INSERT INTO Song (album_id, audio_path, duration, genre, image_path, judul, penyanyi, tanggal_terbit) VALUES
(1, '/var/www/html/public/audio/Sunset.mp3', 315, 'Progressive', 'https://picsum.photos/id/1024/1920/1280', 'Bloom', 'Radiohead', '2022-05-28'),
(1, '/var/www/html/public/audio/Sunset.mp3', 281, 'New Age', 'https://picsum.photos/id/1005/5760/3840', 'Morning Mr Magpie', 'Radiohead', '1979-06-20'),
(1, '/var/www/html/public/audio/Sunset.mp3', 267, 'R&B/Soul', 'https://picsum.photos/id/1024/1920/1280', 'Little by Little', 'Radiohead', '2021-02-24'),
(1, '/var/www/html/public/audio/Sunset.mp3', 193, 'Hip-Hop/Rap', 'https://picsum.photos/id/1021/2048/1206', 'Feral', 'Radiohead', '2012-04-29'),
(1, '/var/www/html/public/audio/Sunset.mp3', 301, 'Kayokyoku', 'https://picsum.photos/id/1013/4256/2832', 'Lotus Flower', 'Radiohead', '1971-03-26'),
(1, '/var/www/html/public/audio/Sunset.mp3', 287, 'Comedy', 'https://picsum.photos/id/1003/1181/1772', 'Codex', 'Radiohead', '1970-01-27'),
(1, '/var/www/html/public/audio/Sunset.mp3', 290, 'Spoken Word', 'https://picsum.photos/id/1/5616/3744', 'Give Up the Ghost', 'Radiohead', '1970-06-28'),
(1, '/var/www/html/public/audio/Sunset.mp3', 320, 'Fitness & Workout', 'https://picsum.photos/id/1022/6000/3376', 'Separator', 'Radiohead', '2012-09-07'),
(2, '/var/www/html/public/audio/Sunset.mp3', 284, 'Holiday', 'https://picsum.photos/id/1002/4312/2868', 'Airbag', 'Radiohead', '1987-01-27'),
(2, '/var/www/html/public/audio/Sunset.mp3', 383, 'Spoken Word', 'https://picsum.photos/id/0/5616/3744', 'Paranoid Android', 'Radiohead', '2018-08-08'),
(2, '/var/www/html/public/audio/Sunset.mp3', 267, 'Easy Listening', 'https://picsum.photos/id/10/2500/1667', 'Subterranean Homesick Alien', 'Radiohead', '2014-02-07'),        
(2, '/var/www/html/public/audio/Sunset.mp3', 264, 'Kayokyoku', 'https://picsum.photos/id/102/4320/3240', 'Exit Music (For a Film)', 'Radiohead', '1970-09-27'),
(2, '/var/www/html/public/audio/Sunset.mp3', 299, 'World', 'https://picsum.photos/id/1019/5472/3648', 'Let Down', 'Radiohead', '1971-12-13'),
(2, '/var/www/html/public/audio/Sunset.mp3', 261, 'Dance )', 'https://picsum.photos/id/1011/5472/3648', 'Karma Police', 'Radiohead', '1997-12-17'),
(2, '/var/www/html/public/audio/Sunset.mp3', 117, 'Kayokyoku', 'https://picsum.photos/id/1010/5184/3456', 'Fitter Happier', 'Radiohead', '2004-01-28'),
(2, '/var/www/html/public/audio/Sunset.mp3', 230, 'Reggae', 'https://picsum.photos/id/1002/4312/2868', 'Electioneering', 'Radiohead', '1998-11-27'),
(2, '/var/www/html/public/audio/Sunset.mp3', 285, 'Spoken Word', 'https://picsum.photos/id/101/2621/1747', 'Climbing Up the Walls', 'Radiohead', '2008-04-21'),
(2, '/var/www/html/public/audio/Sunset.mp3', 228, 'Folk Music', 'https://picsum.photos/id/1014/6016/4000', 'No Surprises', 'Radiohead', '1998-01-09'),
(2, '/var/www/html/public/audio/Sunset.mp3', 259, 'Soundtrack', 'https://picsum.photos/id/1003/1181/1772', 'Lucky', 'Radiohead', '2001-03-18'),
(2, '/var/www/html/public/audio/Sunset.mp3', 324, 'Anime', 'https://picsum.photos/id/1019/5472/3648', 'The Tourist', 'Radiohead', '1970-04-26'),
(3, '/var/www/html/public/audio/Sunset.mp3', 302, 'Indie Pop', 'https://picsum.photos/id/1012/3973/2639', 'Mysterons', 'Portishead', '1970-05-29'),
(3, '/var/www/html/public/audio/Sunset.mp3', 251, 'Anime', 'https://picsum.photos/id/1019/5472/3648', 'Sour Times', 'Portishead', '1994-02-09'),
(3, '/var/www/html/public/audio/Sunset.mp3', 235, 'Comedy', 'https://picsum.photos/id/1025/4951/3301', 'Strangers', 'Portishead', '1998-05-13'),
(3, '/var/www/html/public/audio/Sunset.mp3', 256, 'Enka', 'https://picsum.photos/id/1014/6016/4000', 'It Could Be Sweet', 'Portishead', '2022-07-12'),
(3, '/var/www/html/public/audio/Sunset.mp3', 291, 'Commercial', 'https://picsum.photos/id/1023/3955/2094', 'Wandering Star', 'Portishead', '1985-04-10'),
(3, '/var/www/html/public/audio/Sunset.mp3', 229, 'Indie Pop', 'https://picsum.photos/id/1011/5472/3648', 'It\'s a Fire', 'Portishead', '2005-01-29'),
(3, '/var/www/html/public/audio/Sunset.mp3', 234, 'R&B/Soul', 'https://picsum.photos/id/1/5616/3744', 'Numb', 'Portishead', '2016-12-24'),
(3, '/var/www/html/public/audio/Sunset.mp3', 302, 'Opera', 'https://picsum.photos/id/1020/4288/2848', 'Roads', 'Portishead', '1978-05-18'),
(3, '/var/www/html/public/audio/Sunset.mp3', 219, 'Metal', 'https://picsum.photos/id/1015/6000/4000', 'Pedestal', 'Portishead', '1989-08-24'),
(3, '/var/www/html/public/audio/Sunset.mp3', 301, 'Anime', 'https://picsum.photos/id/1008/5616/3744', 'Biscuit', 'Portishead', '1971-10-07'),
(3, '/var/www/html/public/audio/Sunset.mp3', 306, 'Disney', 'https://picsum.photos/id/1012/3973/2639', 'Glory Box', 'Portishead', '2010-11-01'),
(4, '/var/www/html/public/audio/Sunset.mp3', 298, 'Industrial', 'https://picsum.photos/id/1005/5760/3840', 'Silence', 'Portishead', '2007-08-01'),
(4, '/var/www/html/public/audio/Sunset.mp3', 237, 'Easy Listening', 'https://picsum.photos/id/1012/3973/2639', 'Hunter', 'Portishead', '2021-02-03'),
(4, '/var/www/html/public/audio/Sunset.mp3', 196, 'New Age', 'https://picsum.photos/id/1012/3973/2639', 'Nylon Smile', 'Portishead', '2021-05-18'),
(4, '/var/www/html/public/audio/Sunset.mp3', 269, 'Latin', 'https://picsum.photos/id/1011/5472/3648', 'The Rip', 'Portishead', '2019-02-23'),
(4, '/var/www/html/public/audio/Sunset.mp3', 207, 'Vocal', 'https://picsum.photos/id/101/2621/1747', 'Plastic', 'Portishead', '1978-09-13'),
(4, '/var/www/html/public/audio/Sunset.mp3', 387, 'Tex-Mex', 'https://picsum.photos/id/100/2500/1656', 'We Carry On', 'Portishead', '2019-05-27'),
(4, '/var/www/html/public/audio/Sunset.mp3', 91, 'World', 'https://picsum.photos/id/100/2500/1656', 'Deep Water', 'Portishead', '2002-01-09'),
(4, '/var/www/html/public/audio/Sunset.mp3', 283, 'Hip-Hop/Rap', 'https://picsum.photos/id/1025/4951/3301', 'Machine Gun', 'Portishead', '1993-08-12'),
(4, '/var/www/html/public/audio/Sunset.mp3', 405, 'Soundtrack', 'https://picsum.photos/id/1002/4312/2868', 'Small', 'Portishead', '1991-07-13'),
(4, '/var/www/html/public/audio/Sunset.mp3', 212, 'Spoken Word', 'https://picsum.photos/id/1011/5472/3648', 'Magic Doors', 'Portishead', '2006-11-14'),
(4, '/var/www/html/public/audio/Sunset.mp3', 345, 'Industrial', 'https://picsum.photos/id/1009/5000/7502', 'Threads', 'Portishead', '1986-08-08');