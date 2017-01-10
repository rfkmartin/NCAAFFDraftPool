drop database if exists ncaa;
create database ncaa;
use ncaa;

create table user (
   user_id int not null auto_increment,
   name varchar(64) not null,
   email varchar(64) not null,
   team_name varchar(64),
   password varchar(64) not null,
   draft int,
   primary key (user_id)
);

create table logger (
   logger_id int not null auto_increment,
   msg_dt datetime not null,
   session_id varchar(32) not null,
   page varchar(32) not null,
   user_id int not null,
   message varchar(512) not null,
   primary key (logger_id)
);

create table team (
   team_id int not null,
   school varchar(64) not null,
   location varchar(32),
   mascot varchar(32),
   conference varchar(32),
   region varchar(32),
   wins int,
   losses int,
   rpi int,
   rank int,
   seed int,
   primary key (team_id)
);

create table player (
   player_id int not null auto_increment,
   first varchar(32) not null,
   last varchar(32) not null,
   team_id int not null,
   gp float,
   min float,
   fgm float,
   fga float,
   ftm float,
   fta float,
   tpm float,
   tpa float,
   pts float,
   offr float,
   defr float,
   reb float,
   ast float,
   tover float,
   stl float,
   blk float,
   mpg float,
   ppg float,
   rpg float,
   apg float,
   spg float,
   bpg float,
   tpg float,
   fgpct float,
   ftpct float,
   treypct float,
   primary key (player_id),
   foreign key (team_id) references team(team_id)
);

create table playerUser (
   player_id int not null,
   user_id int not null,
   foreign key (player_id) references player(player_id),
   foreign key (user_id) references user(user_id)
);

create table teamUser (
   team_id int not null,
   user_id int not null,
   foreign key (team_id) references team(team_id),
   foreign key (user_id) references user(user_id)
);