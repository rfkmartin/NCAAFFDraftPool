drop table if exists results;
drop table if exists place;
drop table if exists points;
drop table if exists category;

create table category (
   category_id int not null auto_increment,
   category varchar(64) not null,
   primary key (category_id)
);

create table points (
   points_id int not null,
   points int,
   primary key (points_id)
);

create table place (
   place int not null,
   points_id int,
   category_id int,
   primary key (place,points_id,category_id),
   foreign key (points_id) references points(points_id),
   foreign key (category_id) references category(category_id)
);

create table results (
   user_id int not null,
   category_id int not null,
   points int default 0,
   primary key (user_id,category_id)
);

alter table player add mvp int not null default 0;

insert into category (category_id,category) values (1,'Lowest Seed to Advance(Round of 64)');
insert into category (category_id,category) values (2,'Lowest Seed to Advance(Round of 32)');
insert into category (category_id,category) values (3,'Team Total Points');
insert into category (category_id,category) values (4,'Team Total Individual Game Highs');
insert into category (category_id,category) values (5,'Individual Tournament Points');
insert into category (category_id,category) values (6,'Individual Game High');
insert into category (category_id,category) values (7,'Most Seeds to Advance Each Round');
insert into category (category_id,category) values (8,'Most Valuable Player');

insert into points (points_id,points) values (1,64);
insert into points (points_id,points) values (2,48);
insert into points (points_id,points) values (3,32);
insert into points (points_id,points) values (4,16);
insert into points (points_id,points) values (5,50);
insert into points (points_id,points) values (6,100);

insert into place(place,points_id,category_id) values (1,5,1);
insert into place(place,points_id,category_id) values (1,5,2);
insert into place(place,points_id,category_id) values (1,1,3);
insert into place(place,points_id,category_id) values (2,2,3);
insert into place(place,points_id,category_id) values (3,3,3);
insert into place(place,points_id,category_id) values (4,4,3);
insert into place(place,points_id,category_id) values (1,1,4);
insert into place(place,points_id,category_id) values (2,2,4);
insert into place(place,points_id,category_id) values (3,3,4);
insert into place(place,points_id,category_id) values (4,4,4);
insert into place(place,points_id,category_id) values (1,1,5);
insert into place(place,points_id,category_id) values (2,2,5);
insert into place(place,points_id,category_id) values (3,3,5);
insert into place(place,points_id,category_id) values (4,4,5);
insert into place(place,points_id,category_id) values (1,1,6);
insert into place(place,points_id,category_id) values (2,2,6);
insert into place(place,points_id,category_id) values (3,3,6);
insert into place(place,points_id,category_id) values (4,4,6);
insert into place(place,points_id,category_id) values (1,5,7);
insert into place(place,points_id,category_id) values (1,6,8);

insert into results (user_id,category_id) values (0,1);
insert into results (user_id,category_id) values (0,2);
insert into results (user_id,category_id) values (0,3);
insert into results (user_id,category_id) values (0,4);
insert into results (user_id,category_id) values (0,5);
insert into results (user_id,category_id) values (0,6);
insert into results (user_id,category_id) values (0,7);
insert into results (user_id,category_id) values (0,8);
insert into results (user_id,category_id) values (1,1);
insert into results (user_id,category_id) values (1,2);
insert into results (user_id,category_id) values (1,3);
insert into results (user_id,category_id) values (1,4);
insert into results (user_id,category_id) values (1,5);
insert into results (user_id,category_id) values (1,6);
insert into results (user_id,category_id) values (1,7);
insert into results (user_id,category_id) values (1,8);
insert into results (user_id,category_id) values (2,1);
insert into results (user_id,category_id) values (2,2);
insert into results (user_id,category_id) values (2,3);
insert into results (user_id,category_id) values (2,4);
insert into results (user_id,category_id) values (2,5);
insert into results (user_id,category_id) values (2,6);
insert into results (user_id,category_id) values (2,7);
insert into results (user_id,category_id) values (2,8);
insert into results (user_id,category_id) values (3,1);
insert into results (user_id,category_id) values (3,2);
insert into results (user_id,category_id) values (3,3);
insert into results (user_id,category_id) values (3,4);
insert into results (user_id,category_id) values (3,5);
insert into results (user_id,category_id) values (3,6);
insert into results (user_id,category_id) values (3,7);
insert into results (user_id,category_id) values (3,8);
insert into results (user_id,category_id) values (4,1);
insert into results (user_id,category_id) values (4,2);
insert into results (user_id,category_id) values (4,3);
insert into results (user_id,category_id) values (4,4);
insert into results (user_id,category_id) values (4,5);
insert into results (user_id,category_id) values (4,6);
insert into results (user_id,category_id) values (4,7);
insert into results (user_id,category_id) values (4,8);
insert into results (user_id,category_id) values (5,1);
insert into results (user_id,category_id) values (5,2);
insert into results (user_id,category_id) values (5,3);
insert into results (user_id,category_id) values (5,4);
insert into results (user_id,category_id) values (5,5);
insert into results (user_id,category_id) values (5,6);
insert into results (user_id,category_id) values (5,7);
insert into results (user_id,category_id) values (5,8);
insert into results (user_id,category_id) values (6,1);
insert into results (user_id,category_id) values (6,2);
insert into results (user_id,category_id) values (6,3);
insert into results (user_id,category_id) values (6,4);
insert into results (user_id,category_id) values (6,5);
insert into results (user_id,category_id) values (6,6);
insert into results (user_id,category_id) values (6,7);
insert into results (user_id,category_id) values (6,8);
insert into results (user_id,category_id) values (7,1);
insert into results (user_id,category_id) values (7,2);
insert into results (user_id,category_id) values (7,3);
insert into results (user_id,category_id) values (7,4);
insert into results (user_id,category_id) values (7,5);
insert into results (user_id,category_id) values (7,6);
insert into results (user_id,category_id) values (7,7);
insert into results (user_id,category_id) values (7,8);
