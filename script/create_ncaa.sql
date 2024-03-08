drop database if exists ncaa1;
create database ncaa1;
use ncaa1;

-- date;python ESPNScrape.py;cat create_ncaa.sql > temp.sql ;cat create_bracket.sql >> temp.sql ;mysql -u root -pLuv2Drnk < temp.sql;./parseHTML.pl ;date
-- select school,seed,p.name,ppg from bracket b join team t on b.team_id=t.team_id join player p on p.team_id=b.team_id where round<=2 order by seed,b.team_id,ppg desc;
create table logger (
   logger_id int not null auto_increment,
   msg_dt datetime not null,
   session_id varchar(32) not null,
   page varchar(32) not null,
   user_id int not null,
   message varchar(512) not null,
   primary key (logger_id)
);

CREATE TABLE tourney_year (
   year_id int not null,
   image_filename VARCHAR(64) NOT NULL,
   main_color VARCHAR(16) NOT NULL,
   secondary_color VARCHAR(16) NOT NULL,
   tertiary_color VARCHAR(16) NOT NULL,
  PRIMARY KEY (year_id)
);

create table tourney (
   tourney_id int not null auto_increment,
   name varchar(64),
   year_id int NOT NULL,
   draft int,
   primary key(tourney_id),
   foreign key(year_id) references tourney_year(year_id)
);

CREATE TABLE _login (
   login_id INT(11) NOT NULL AUTO_INCREMENT,
   name VARCHAR(64) NOT NULL,
   username varchar(16) NOT NULL,
   password VARCHAR(64) NOT NULL,
   email VARCHAR(64) NOT NULL,
   is_admin int default 0,
   PRIMARY KEY (login_id)
);

create table tourneyOwnerYear (
   tourney_id int not null AUTO_INCREMENT,
   login_id int not null,
   year_id int not null,
   name varchar(64),
   password VARCHAR(64) NOT NULL,
   primary key (tourney_id,login_id,year_id),
   foreign key (year_id) references tourney_year(year_id),
   foreign key (login_id) references _login(login_id)
);

create table entry (
   entry_id int not null auto_increment,
   login_id int not null,
   tourney_id int not null,
   name varchar(64) not null,
   primary key (entry_id),
   foreign key (login_id) references _login(login_id),
   foreign key (tourney_id) references tourneyOwnerYear(tourney_id)
);

create table team (
   team_id int not null,
   school varchar(64) not null,
   shortname varchar(64) not null,
   location_ varchar(32),
   team_color varchar(16),
   alt_color varchar(16),
   logo varchar(64),
   mascot varchar(32),
   conference varchar(64),
   region varchar(32),
   link varchar(128),
   wins int,
   losses int,
   rpi int,
   rank_ int,
   seed int,
   primary key (team_id)
);

create table bracket (
   bracket_pos int not null,
   next_pos int not null,
   game_id int,
   round varchar(32),
   primary key (bracket_pos)
);

create table round (
   round_id int not null,
   round varchar(32) not null,
   primary key (round_id)
);

create table player (
   player_id int not null auto_increment,
   name varchar(64) not null,
   team_id int not null,
   year_id int not null,
   gp float,
   mpg float,
   ppg float,
   mvpFF int,
   mvpReg int,
   primary key (player_id),
   foreign key (year_id) references tourney_year(year_id),
   foreign key (team_id) references team(team_id)
);

create table keyValue (
   k varchar(64),
   v varchar(64),
   primary key (k)
);

create table teamGame (
   team_id int not null,
   bracket_pos int not null,
   year_id int not null,
   points int not null default 0,
   winner int default 0,
   primary key (team_id,bracket_pos,year_id),
   foreign key (team_id) references team(team_id),
   foreign key (year_id) references tourney_year(year_id),
   foreign key (bracket_pos) references bracket(bracket_pos)
);

create table playerGame (
   player_id int not null,
   bracket_pos int not null,
   year_id int not null,
   points int not null default 0,
   primary key (player_id,bracket_pos,year_id),
   foreign key (player_id) references player(player_id),
   foreign key (year_id) references tourney_year(year_id),
   foreign key (bracket_pos) references bracket(bracket_pos)
);

create table draft (
   draft_pos int not null,
   player_order int not null,
   team_order int not null,
   primary key (draft_pos)
);

create table ownerTeam (
   owner_id int not null,
   team_id int not null,
   draft int,
   primary key (owner_id,team_id),
   foreign key (owner_id) references entry(entry_id),
   foreign key (team_id) references team(team_id)
);

create table ownerPlayer (
   owner_id int not null,
   player_id int not null,
   draft int,
   primary key (owner_id,player_id),
   foreign key (owner_id) references entry(entry_id),
   foreign key (player_id) references player(player_id)
);

create table teamstatsYear (
   team_id int not null,
   year_id int not null,
   wins int,
   losses int,
   rank_ int,
   seed int,
   primary key(team_id,year_id),
   foreign key(team_id) references team(team_id),
   foreign key(year_id) references tourney_year(year_id)
);

create table region (
    year_id int not null,
    position int not null,
    directional varchar(10) default '',
    primary key(year_id,position),
    foreign key(year_id) references tourney_year(year_id)
);


INSERT INTO keyValue(k,v) VALUES ("playerUpdateDTM",CURTIME());
INSERT INTO keyValue(k,v) VALUES ("status",'PREDRAFT');
INSERT INTO keyValue(k,v) VALUES ("currentPlayerRound",'0');
INSERT INTO keyValue(k,v) VALUES ("currentTeamRound",'0');

INSERT INTO tourney_year(year_id,image_filename,main_color,secondary_color,tertiary_color) VALUES (2017,'Logo2017.png','0xffffff','0xffffff','0xffffff');
INSERT INTO tourney_year(year_id,image_filename,main_color,secondary_color,tertiary_color) VALUES (2018,'Logo2018.png','0xffffff','0xffffff','0xffffff');
INSERT INTO tourney_year(year_id,image_filename,main_color,secondary_color,tertiary_color) VALUES (2019,'Logo2019.png','0xffffff','0xffffff','0xffffff');
INSERT INTO tourney_year(year_id,image_filename,main_color,secondary_color,tertiary_color) VALUES (2020,'Logo2020.png','0xffffff','0xffffff','0xffffff');
INSERT INTO tourney_year(year_id,image_filename,main_color,secondary_color,tertiary_color) VALUES (2024,'Logo2024.png','0xffffff','0xffffff','0xffffff');

INSERT into tourney(name,year_id) values ("2017 NCAA Beta Test",2017);
INSERT into tourney(name,year_id) values ("2018 NCAA Beta Test",2018);
INSERT into tourney(name,year_id) values ("2019 NCAA Beta Test",2019);
INSERT into tourney(name,year_id) values ("2019 NCAA Beta Test",2020);
INSERT into tourney(name,year_id) values ("2024 NCAA Beta Test",2024);

INSERT INTO region(year_id,position) values (2024,0);
INSERT INTO region(year_id,position) values (2024,1);
INSERT INTO region(year_id,position) values (2024,2);
INSERT INTO region(year_id,position) values (2024,3);

INSERT INTO round (round_id,round) VALUES (1,'First Four');
INSERT INTO round (round_id,round) VALUES (2,'Round of 64');
INSERT INTO round (round_id,round) VALUES (3,'Round of 32');
INSERT INTO round (round_id,round) VALUES (4,'Sweet 16');
INSERT INTO round (round_id,round) VALUES (5,'Elite 8');
INSERT INTO round (round_id,round) VALUES (6,'Final Four');
INSERT INTO round (round_id,round) VALUES (7,'Championship');
INSERT INTO round (round_id,round) VALUES (8,'Champion');
INSERT INTO team (team_id,school,shortname) VALUES (2428,"North Carolina Central","NC Central");
INSERT INTO team (team_id,school,shortname) VALUES (2908,"South Carolina Upstate","SC Upstate");
INSERT INTO team (team_id,school,shortname) VALUES (2506,"Presbyterian College","Presbyterian College");
INSERT INTO team (team_id,school,shortname) VALUES (292,"UT Rio Grande Valley","UT Rio Grande Valley");
INSERT INTO team (team_id,school,shortname) VALUES (2115,"Central Connecticut","Central Connecticut");
INSERT INTO team (team_id,school,shortname) VALUES (2127,"Charleston Southern","Charleston S");
INSERT INTO team (team_id,school,shortname) VALUES (161,"Fairleigh Dickinson","Fairleigh Dickinson");
INSERT INTO team (team_id,school,shortname) VALUES (2569,"South Carolina State","SC St.");
INSERT INTO team (team_id,school,shortname) VALUES (2000,"Abilene Christian ","Abilene Christian ");
INSERT INTO team (team_id,school,shortname) VALUES (2193,"East Tennessee St.","East Tenn. St.");
INSERT INTO team (team_id,school,shortname) VALUES (526,"Florida Gulf Coast","FGCU");
INSERT INTO team (team_id,school,shortname) VALUES (2448,"North Carolina A&T","NC A&T");
INSERT INTO team (team_id,school,shortname) VALUES (2239,"Cal State Fullerton","Cal St. Fullerton");
INSERT INTO team (team_id,school,shortname) VALUES (45,"George Washington","George Washington");
INSERT INTO team (team_id,school,shortname) VALUES (2458,"Northern Colorado","N Colorado");
INSERT INTO team (team_id,school,shortname) VALUES (2459,"Northern Illinois","N Illinois");
INSERT INTO team (team_id,school,shortname) VALUES (94,"Northern Kentucky","N Kentucky");
INSERT INTO team (team_id,school,shortname) VALUES (79,"Southern Illinois","S Illinois");
INSERT INTO team (team_id,school,shortname) VALUES (2617,"Stephen F. Austin","Stephen F. Austin");
INSERT INTO team (team_id,school,shortname) VALUES (2400,"Mississippi Valley State","Miss. Valley St.");
INSERT INTO team (team_id,school,shortname) VALUES (55,"Jacksonville State","Jacksonville St.");
INSERT INTO team (team_id,school,shortname) VALUES (2449,"North Dakota State","North Dakota St.");
INSERT INTO team (team_id,school,shortname) VALUES (2466,"Northwestern State","Northwestern St.");
INSERT INTO team (team_id,school,shortname) VALUES (2571,"South Dakota State","South Dakota St.");
INSERT INTO team (team_id,school,shortname) VALUES (324,"Coastal Carolina","Coastal Carolina");
INSERT INTO team (team_id,school,shortname) VALUES (2226,"Florida Atlantic","Florida Atl.");
INSERT INTO team (team_id,school,shortname) VALUES (290,"Georgia Southern","Georgia S");
INSERT INTO team (team_id,school,shortname) VALUES (2433,"Louisiana Monroe","Louisiana Monroe");
INSERT INTO team (team_id,school,shortname) VALUES (2351,"Loyola Marymount","Loyola Marymount");
INSERT INTO team (team_id,school,shortname) VALUES (2393,"Middle Tennessee","Middle Tenn.");
INSERT INTO team (team_id,school,shortname) VALUES (2464,"Northern Arizona","N Arizona");
INSERT INTO team (team_id,school,shortname) VALUES (2504,"Prairie View A&M","Prairie View A&M");
INSERT INTO team (team_id,school,shortname) VALUES (2565,"SIU Edwardsville","SIU Edwardsville");
INSERT INTO team (team_id,school,shortname) VALUES (2597,"St Francis (BKN)","St Francis (BKN)");
INSERT INTO team (team_id,school,shortname) VALUES (2630,"Tennessee-Martin","Tenn.-Martin");
INSERT INTO team (team_id,school,shortname) VALUES (2540,"UC Santa Barbara","UC Santa Barbara");
INSERT INTO team (team_id,school,shortname) VALUES (2546,"Southeast Missouri State","SE Missouri St.");
INSERT INTO team (team_id,school,shortname) VALUES (2029,"Arkansas-Pine Bluff","Ark.-Pine Bluff");
INSERT INTO team (team_id,school,shortname) VALUES (2026,"Appalachian State","Appalachian St.");
INSERT INTO team (team_id,school,shortname) VALUES (2534,"Sam Houston State","Sam Houston St.");
INSERT INTO team (team_id,school,shortname) VALUES (2065,"Bethune-Cookman","Bethune-Cookman");
INSERT INTO team (team_id,school,shortname) VALUES (2934,"CSU Bakersfield","CSU Bakersfield");
INSERT INTO team (team_id,school,shortname) VALUES (2277,"Houston Baptist","Houston Baptist");
INSERT INTO team (team_id,school,shortname) VALUES (2598,"St Francis (PA)","St Francis (PA)");
INSERT INTO team (team_id,school,shortname) VALUES (2572,"Southern Mississippi","S Miss.");
INSERT INTO team (team_id,school,shortname) VALUES (299,"Long Beach State","Long Beach St.");
INSERT INTO team (team_id,school,shortname) VALUES (166,"New Mexico State","New Mexico St.");
INSERT INTO team (team_id,school,shortname) VALUES (16,"Sacramento State","Sacramento St.");
INSERT INTO team (team_id,school,shortname) VALUES (265,"Washington State","Washington St.");
INSERT INTO team (team_id,school,shortname) VALUES (2754,"Youngstown State","Youngstown St.");
INSERT INTO team (team_id,school,shortname) VALUES (103,"Boston College","Boston College");
INSERT INTO team (team_id,school,shortname) VALUES (2916,"Incarnate Word","Incarnate Word");
INSERT INTO team (team_id,school,shortname) VALUES (2348,"Louisiana Tech","Louisiana Tech");
INSERT INTO team (team_id,school,shortname) VALUES (153,"North Carolina","UNC");
INSERT INTO team (team_id,school,shortname) VALUES (2603,"Saint Joseph's","Saint Joseph's");
INSERT INTO team (team_id,school,shortname) VALUES (2579,"South Carolina","SC");
INSERT INTO team (team_id,school,shortname) VALUES (179,"St Bonaventure","St Bonaventure");
INSERT INTO team (team_id,school,shortname) VALUES (2635,"Tennessee Tech","Tenn. Tech");
INSERT INTO team (team_id,school,shortname) VALUES (2640,"Texas Southern","Texas S");
INSERT INTO team (team_id,school,shortname) VALUES (2430,"UNC Greensboro","UNC Greensboro");
INSERT INTO team (team_id,school,shortname) VALUES (350,"UNC Wilmington","UNC Wilmington");
INSERT INTO team (team_id,school,shortname) VALUES (2636,"UT San Antonio","UT San Antonio");
INSERT INTO team (team_id,school,shortname) VALUES (2729,"William & Mary","William & Mary");
INSERT INTO team (team_id,school,shortname) VALUES (325,"Cleveland State","Cleveland St.");
INSERT INTO team (team_id,school,shortname) VALUES (116,"Mount St Mary's","Mt. St Mary's");
INSERT INTO team (team_id,school,shortname) VALUES (21,"San Diego State","San Diego St.");
INSERT INTO team (team_id,school,shortname) VALUES (2634,"Tennessee State","Tenn. St.");
INSERT INTO team (team_id,school,shortname) VALUES (189,"Bowling Green","Bowling Green");
INSERT INTO team (team_id,school,shortname) VALUES (2463,"CS Northridge","CS Northridge");
INSERT INTO team (team_id,school,shortname) VALUES (2174,"Detroit Mercy","Detroit Mercy");
INSERT INTO team (team_id,school,shortname) VALUES (151,"East Carolina","East Carolina");
INSERT INTO team (team_id,school,shortname) VALUES (256,"James Madison","James Madison");
INSERT INTO team (team_id,school,shortname) VALUES (113,"Massachusetts","Massachusetts");
INSERT INTO team (team_id,school,shortname) VALUES (160,"New Hampshire","New Hampshire");
INSERT INTO team (team_id,school,shortname) VALUES (2454,"North Florida","North Florida");
INSERT INTO team (team_id,school,shortname) VALUES (2460,"Northern Iowa","N Iowa");
INSERT INTO team (team_id,school,shortname) VALUES (2523,"Robert Morris","Robert Morris");
INSERT INTO team (team_id,school,shortname) VALUES (2612,"Saint Peter's","Saint Peter's");
INSERT INTO team (team_id,school,shortname) VALUES (2539,"San Francisco","San Francisco");
INSERT INTO team (team_id,school,shortname) VALUES (6,"South Alabama","South Alabama");
INSERT INTO team (team_id,school,shortname) VALUES (58,"South Florida","South Florida");
INSERT INTO team (team_id,school,shortname) VALUES (253,"Southern Utah","S Utah");
INSERT INTO team (team_id,school,shortname) VALUES (2427,"UNC Asheville","UNC Asheville");
INSERT INTO team (team_id,school,shortname) VALUES (259,"Virginia Tech","Virginia Tech");
INSERT INTO team (team_id,school,shortname) VALUES (2545,"Southeastern Louisiana","SE Louisiana");
INSERT INTO team (team_id,school,shortname) VALUES (331,"Eastern Washington","E Washington");
INSERT INTO team (team_id,school,shortname) VALUES (104,"Boston University","Boston Univ.");
INSERT INTO team (team_id,school,shortname) VALUES (2110,"Central Arkansas","Central Ark.");
INSERT INTO team (team_id,school,shortname) VALUES (2117,"Central Michigan","Central Mich");
INSERT INTO team (team_id,school,shortname) VALUES (36,"Colorado State","Colorado St.");
INSERT INTO team (team_id,school,shortname) VALUES (2169,"Delaware State","Delaware St.");
INSERT INTO team (team_id,school,shortname) VALUES (2287,"Illinois State","Illinois St.");
INSERT INTO team (team_id,school,shortname) VALUES (338,"Kennesaw State","Kennesaw St.");
INSERT INTO team (team_id,school,shortname) VALUES (2623,"Missouri State","Missouri St.");
INSERT INTO team (team_id,school,shortname) VALUES (2413,"Morehead State","Morehead St.");
INSERT INTO team (team_id,school,shortname) VALUES (197,"Oklahoma State","Oklahoma St.");
INSERT INTO team (team_id,school,shortname) VALUES (2502,"Portland State","Portland St.");
INSERT INTO team (team_id,school,shortname) VALUES (23,"San Jose State","San Jose St.");
INSERT INTO team (team_id,school,shortname) VALUES (2542,"Savannah State","Savannah St.");
INSERT INTO team (team_id,school,shortname) VALUES (2229,"Florida Intl","Florida Intl");
INSERT INTO team (team_id,school,shortname) VALUES (2241,"Gardner-Webb","Gardner-Webb");
INSERT INTO team (team_id,school,shortname) VALUES (2244,"George Mason","George Mason");
INSERT INTO team (team_id,school,shortname) VALUES (59,"Georgia Tech","Georgia Tech");
INSERT INTO team (team_id,school,shortname) VALUES (2755,"Grambling St","Grambling St");
INSERT INTO team (team_id,school,shortname) VALUES (2253,"Grand Canyon","Grand Canyon");
INSERT INTO team (team_id,school,shortname) VALUES (294,"Jacksonville","Jacksonville");
INSERT INTO team (team_id,school,shortname) VALUES (2341,"LIU Brooklyn","LIU Brooklyn");
INSERT INTO team (team_id,school,shortname) VALUES (2350,"Loyola (CHI)","Loyola (CHI)");
INSERT INTO team (team_id,school,shortname) VALUES (155,"North Dakota","North Dakota");
INSERT INTO team (team_id,school,shortname) VALUES (111,"Northeastern","Northeastern");
INSERT INTO team (team_id,school,shortname) VALUES (77,"Northwestern","Northwestern");
INSERT INTO team (team_id,school,shortname) VALUES (295,"Old Dominion","Old Dominion");
INSERT INTO team (team_id,school,shortname) VALUES (198,"Oral Roberts","Oral Roberts");
INSERT INTO team (team_id,school,shortname) VALUES (227,"Rhode Island","Rhode Island");
INSERT INTO team (team_id,school,shortname) VALUES (2529,"Sacred Heart","Sacred Heart");
INSERT INTO team (team_id,school,shortname) VALUES (2608,"Saint Mary's","Saint Mary's");
INSERT INTO team (team_id,school,shortname) VALUES (233,"South Dakota","South Dakota");
INSERT INTO team (team_id,school,shortname) VALUES (357,"Texas A&M-CC","Texas A&M-CC");
INSERT INTO team (team_id,school,shortname) VALUES (27,"UC Riverside","UC Riverside");
INSERT INTO team (team_id,school,shortname) VALUES (309,"Ul Lafayette","Ul Lafayette");
INSERT INTO team (team_id,school,shortname) VALUES (2349,"UMass Lowell","UMass Lowell");
INSERT INTO team (team_id,school,shortname) VALUES (250,"UT-Arlington","UT-Arlington");
INSERT INTO team (team_id,school,shortname) VALUES (9,"Arizona State","Arizona St.");
INSERT INTO team (team_id,school,shortname) VALUES (2130,"Chicago State","Chicago St.");
INSERT INTO team (team_id,school,shortname) VALUES (52,"Florida State","Florida St.");
INSERT INTO team (team_id,school,shortname) VALUES (2247,"Georgia State","Georgia St.");
INSERT INTO team (team_id,school,shortname) VALUES (282,"Indiana State","Indiana St.");
INSERT INTO team (team_id,school,shortname) VALUES (2296,"Jackson State","Jackson St.");
INSERT INTO team (team_id,school,shortname) VALUES (147,"Montana State","Montana St.");
INSERT INTO team (team_id,school,shortname) VALUES (2450,"Norfolk State","Norfolk St.");
INSERT INTO team (team_id,school,shortname) VALUES (277,"West Virginia","Wt Virginia");
INSERT INTO team (team_id,school,shortname) VALUES (2010,"Alabama A&M","Alabama A&M");
INSERT INTO team (team_id,school,shortname) VALUES (2046,"Austin Peay","Austin Peay");
INSERT INTO team (team_id,school,shortname) VALUES (236,"Chattanooga","Chattanooga");
INSERT INTO team (team_id,school,shortname) VALUES (41,"Connecticut","Connecticut");
INSERT INTO team (team_id,school,shortname) VALUES (50,"Florida A&M","Florida A&M");
INSERT INTO team (team_id,school,shortname) VALUES (2031,"Little Rock","Little Rock");
INSERT INTO team (team_id,school,shortname) VALUES (2352,"Loyola (MD)","Loyola (MD)");
INSERT INTO team (team_id,school,shortname) VALUES (2443,"New Orleans","New Orleans");
INSERT INTO team (team_id,school,shortname) VALUES (249,"North Texas","North Texas");
INSERT INTO team (team_id,school,shortname) VALUES (139,"Saint Louis","Saint Louis");
INSERT INTO team (team_id,school,shortname) VALUES (2541,"Santa Clara","Santa Clara");
INSERT INTO team (team_id,school,shortname) VALUES (2619,"Stony Brook","Stony Brook");
INSERT INTO team (team_id,school,shortname) VALUES (2643,"The Citadel","The Citadel");
INSERT INTO team (team_id,school,shortname) VALUES (3084,"Utah Valley","Utah Valley");
INSERT INTO team (team_id,school,shortname) VALUES (154,"Wake Forest","Wake Forest");
INSERT INTO team (team_id,school,shortname) VALUES (2379,"Maryland-Eastern Shore","MD-E Shore");
INSERT INTO team (team_id,school,shortname) VALUES (2197,"Eastern Illinois","E Illinois");
INSERT INTO team (team_id,school,shortname) VALUES (2198,"Eastern Kentucky","E Kentucky");
INSERT INTO team (team_id,school,shortname) VALUES (2717,"Western Carolina","W Carolina");
INSERT INTO team (team_id,school,shortname) VALUES (2710,"Western Illinois","W Illinois");
INSERT INTO team (team_id,school,shortname) VALUES (98,"Western Kentucky","W Kentucky");
INSERT INTO team (team_id,school,shortname) VALUES (2011,"AlabamaState","AlabamaSt.");
INSERT INTO team (team_id,school,shortname) VALUES (2016,"Alcorn State","Alcorn St.");
INSERT INTO team (team_id,school,shortname) VALUES (2154,"Coppin State","Coppin St.");
INSERT INTO team (team_id,school,shortname) VALUES (278,"Fresno State","Fresno St.");
INSERT INTO team (team_id,school,shortname) VALUES (2306,"Kansas State","Kansas St.");
INSERT INTO team (team_id,school,shortname) VALUES (2415,"Morgan State","Morgan St.");
INSERT INTO team (team_id,school,shortname) VALUES (93,"Murray State","Murray St.");
INSERT INTO team (team_id,school,shortname) VALUES (204,"Oregon State","Oregon St.");
INSERT INTO team (team_id,school,shortname) VALUES (2750,"Wright State","Wright St.");
INSERT INTO team (team_id,school,shortname) VALUES (2066,"Binghamton","Binghamton");
INSERT INTO team (team_id,school,shortname) VALUES (25,"California","California");
INSERT INTO team (team_id,school,shortname) VALUES (232,"Charleston","Charleston");
INSERT INTO team (team_id,school,shortname) VALUES (2132,"Cincinnati","Cincinnati");
INSERT INTO team (team_id,school,shortname) VALUES (339,"Evansville","Evansville");
INSERT INTO team (team_id,school,shortname) VALUES (2870,"Fort Wayne","Fort Wayne");
INSERT INTO team (team_id,school,shortname) VALUES (46,"Georgetown","Georgetown");
INSERT INTO team (team_id,school,shortname) VALUES (2272,"High Point","High Point");
INSERT INTO team (team_id,school,shortname) VALUES (107,"Holy Cross","Holy Cross");
INSERT INTO team (team_id,school,shortname) VALUES (97,"Louisville","Louisville");
INSERT INTO team (team_id,school,shortname) VALUES (193,"Miami (OH)","Miami (OH)");
INSERT INTO team (team_id,school,shortname) VALUES (167,"New Mexico","New Mexico");
INSERT INTO team (team_id,school,shortname) VALUES (87,"Notre Dame","Notre Dame");
INSERT INTO team (team_id,school,shortname) VALUES (2492,"Pepperdine","Pepperdine");
INSERT INTO team (team_id,school,shortname) VALUES (221,"Pittsburgh","Pittsburgh");
INSERT INTO team (team_id,school,shortname) VALUES (2507,"Providence","Providence");
INSERT INTO team (team_id,school,shortname) VALUES (2514,"Quinnipiac","Quinnipiac");
INSERT INTO team (team_id,school,shortname) VALUES (2550,"Seton Hall","Seton Hall");
INSERT INTO team (team_id,school,shortname) VALUES (2641,"Texas Tech","Texas Tech");
INSERT INTO team (team_id,school,shortname) VALUES (2674,"Valparaiso","Valparaiso");
INSERT INTO team (team_id,school,shortname) VALUES (238,"Vanderbilt","Vanderbilt");
INSERT INTO team (team_id,school,shortname) VALUES (264,"Washington","Washington");
INSERT INTO team (team_id,school,shortname) VALUES (2724,"Wichita St","Wichita St");
INSERT INTO team (team_id,school,shortname) VALUES (344,"Mississippi State","Miss. St.");
INSERT INTO team (team_id,school,shortname) VALUES (68,"Boise State","Boise St.");
INSERT INTO team (team_id,school,shortname) VALUES (304,"Idaho State","Idaho St.");
INSERT INTO team (team_id,school,shortname) VALUES (326,"Texas State","Texas St.");
INSERT INTO team (team_id,school,shortname) VALUES (2692,"Weber State","Weber St.");
INSERT INTO team (team_id,school,shortname) VALUES (2005,"Air Force","Air Force");
INSERT INTO team (team_id,school,shortname) VALUES (2429,"Charlotte","Charlotte");
INSERT INTO team (team_id,school,shortname) VALUES (156,"Creighton","Creighton");
INSERT INTO team (team_id,school,shortname) VALUES (159,"Dartmouth","Dartmouth");
INSERT INTO team (team_id,school,shortname) VALUES (2217,"Fairfield","Fairfield");
INSERT INTO team (team_id,school,shortname) VALUES (2739,"Green Bay","Green Bay");
INSERT INTO team (team_id,school,shortname) VALUES (322,"Lafayette","Lafayette");
INSERT INTO team (team_id,school,shortname) VALUES (2363,"Manhattan","Manhattan");
INSERT INTO team (team_id,school,shortname) VALUES (269,"Marquette","Marquette");
INSERT INTO team (team_id,school,shortname) VALUES (270,"Milwaukee","Milwaukee");
INSERT INTO team (team_id,school,shortname) VALUES (163,"Princeton","Princeton");
INSERT INTO team (team_id,school,shortname) VALUES (301,"San Diego","San Diego");
INSERT INTO team (team_id,school,shortname) VALUES (2599,"St John's","St John's");
INSERT INTO team (team_id,school,shortname) VALUES (2633,"Tennessee","Tennessee");
INSERT INTO team (team_id,school,shortname) VALUES (245,"Texas A&M","Texas A&M");
INSERT INTO team (team_id,school,shortname) VALUES (300,"UC Irvine","UC Irvine");
INSERT INTO team (team_id,school,shortname) VALUES (222,"Villanova","Villanova");
INSERT INTO team (team_id,school,shortname) VALUES (275,"Wisconsin","Wisconsin");
INSERT INTO team (team_id,school,shortname) VALUES (2032,"Arkansas State","Ark. St.");
INSERT INTO team (team_id,school,shortname) VALUES (127,"Michigan State","Mich St.");
INSERT INTO team (team_id,school,shortname) VALUES (2050,"Ball State","Ball St.");
INSERT INTO team (team_id,school,shortname) VALUES (66,"Iowa State","Iowa St.");
INSERT INTO team (team_id,school,shortname) VALUES (2309,"Kent State","Kent St.");
INSERT INTO team (team_id,school,shortname) VALUES (194,"Ohio State","Ohio St.");
INSERT INTO team (team_id,school,shortname) VALUES (213,"Penn State","Penn St.");
INSERT INTO team (team_id,school,shortname) VALUES (328,"Utah State","Utah St.");
INSERT INTO team (team_id,school,shortname) VALUES (333,"Alabama ","Alabama ");
INSERT INTO team (team_id,school,shortname) VALUES (44,"American","American");
INSERT INTO team (team_id,school,shortname) VALUES (2083,"Bucknell","Bucknell");
INSERT INTO team (team_id,school,shortname) VALUES (13,"Cal Poly","Cal Poly");
INSERT INTO team (team_id,school,shortname) VALUES (2097,"Campbell","Campbell");
INSERT INTO team (team_id,school,shortname) VALUES (2099,"Canisius","Canisius");
INSERT INTO team (team_id,school,shortname) VALUES (38,"Colorado","Colorado");
INSERT INTO team (team_id,school,shortname) VALUES (171,"Columbia","Columbia");
INSERT INTO team (team_id,school,shortname) VALUES (2166,"Davidson","Davidson");
INSERT INTO team (team_id,school,shortname) VALUES (48,"Delaware","Delaware");
INSERT INTO team (team_id,school,shortname) VALUES (2184,"Duquesne","Duquesne");
INSERT INTO team (team_id,school,shortname) VALUES (42,"Hartford","Hartford");
INSERT INTO team (team_id,school,shortname) VALUES (356,"Illinois","Illinois");
INSERT INTO team (team_id,school,shortname) VALUES (96,"Kentucky","Kentucky");
INSERT INTO team (team_id,school,shortname) VALUES (2325,"La Salle","La Salle");
INSERT INTO team (team_id,school,shortname) VALUES (288,"Lipscomb","Lipscomb");
INSERT INTO team (team_id,school,shortname) VALUES (2344,"Longwood","Longwood");
INSERT INTO team (team_id,school,shortname) VALUES (276,"Marshall","Marshall");
INSERT INTO team (team_id,school,shortname) VALUES (142,"Missouri","Missouri");
INSERT INTO team (team_id,school,shortname) VALUES (2405,"Monmouth","Monmouth");
INSERT INTO team (team_id,school,shortname) VALUES (158,"Nebraska","Nebraska");
INSERT INTO team (team_id,school,shortname) VALUES (2447,"Nicholls","Nicholls");
INSERT INTO team (team_id,school,shortname) VALUES (201,"Oklahoma","Oklahoma");
INSERT INTO team (team_id,school,shortname) VALUES (145,"Ole Miss","Ole Miss");
INSERT INTO team (team_id,school,shortname) VALUES (2501,"Portland","Portland");
INSERT INTO team (team_id,school,shortname) VALUES (257,"Richmond","Richmond");
INSERT INTO team (team_id,school,shortname) VALUES (2582,"Southern","Southern");
INSERT INTO team (team_id,school,shortname) VALUES (24,"Stanford","Stanford");
INSERT INTO team (team_id,school,shortname) VALUES (183,"Syracuse","Syracuse");
INSERT INTO team (team_id,school,shortname) VALUES (302,"UC Davis","UC Davis");
INSERT INTO team (team_id,school,shortname) VALUES (258,"Virginia","Virginia");
INSERT INTO team (team_id,school,shortname) VALUES (2737,"Winthrop","Winthrop");
INSERT INTO team (team_id,school,shortname) VALUES (12,"Arizona","Arizona");
INSERT INTO team (team_id,school,shortname) VALUES (2057,"Belmont","Belmont");
INSERT INTO team (team_id,school,shortname) VALUES (71,"Bradley","Bradley");
INSERT INTO team (team_id,school,shortname) VALUES (2084,"Buffalo","Buffalo");
INSERT INTO team (team_id,school,shortname) VALUES (228,"Clemson","Clemson");
INSERT INTO team (team_id,school,shortname) VALUES (2142,"Colgate","Colgate");
INSERT INTO team (team_id,school,shortname) VALUES (172,"Cornell","Cornell");
INSERT INTO team (team_id,school,shortname) VALUES (57,"Florida","Florida");
INSERT INTO team (team_id,school,shortname) VALUES (2230,"Fordham","Fordham");
INSERT INTO team (team_id,school,shortname) VALUES (61,"Georgia","Georgia");
INSERT INTO team (team_id,school,shortname) VALUES (2250,"Gonzaga","Gonzaga");
INSERT INTO team (team_id,school,shortname) VALUES (2261,"Hampton","Hampton");
INSERT INTO team (team_id,school,shortname) VALUES (108,"Harvard","Harvard");
INSERT INTO team (team_id,school,shortname) VALUES (62,"Hawai'i","Hawai'i");
INSERT INTO team (team_id,school,shortname) VALUES (2275,"Hofstra","Hofstra");
INSERT INTO team (team_id,school,shortname) VALUES (248,"Houston","Houston");
INSERT INTO team (team_id,school,shortname) VALUES (84,"Indiana","Indiana");
INSERT INTO team (team_id,school,shortname) VALUES (2335,"Liberty","Liberty");
INSERT INTO team (team_id,school,shortname) VALUES (2377,"McNeese","McNeese");
INSERT INTO team (team_id,school,shortname) VALUES (235,"Memphis","Memphis");
INSERT INTO team (team_id,school,shortname) VALUES (149,"Montana","Montana");
INSERT INTO team (team_id,school,shortname) VALUES (315,"Niagara","Niagara");
INSERT INTO team (team_id,school,shortname) VALUES (2473,"Oakland","Oakland");
INSERT INTO team (team_id,school,shortname) VALUES (279,"Pacific","Pacific");
INSERT INTO team (team_id,school,shortname) VALUES (2515,"Radford","Radford");
INSERT INTO team (team_id,school,shortname) VALUES (164,"Rutgers","Rutgers");
INSERT INTO team (team_id,school,shortname) VALUES (2535,"Samford","Samford");
INSERT INTO team (team_id,school,shortname) VALUES (2547,"Seattle","Seattle");
INSERT INTO team (team_id,school,shortname) VALUES (56,"Stetson","Stetson");
INSERT INTO team (team_id,school,shortname) VALUES (261,"Vermont","Vermont");
INSERT INTO team (team_id,school,shortname) VALUES (2747,"Wofford","Wofford");
INSERT INTO team (team_id,school,shortname) VALUES (2751,"Wyoming","Wyoming");
INSERT INTO team (team_id,school,shortname) VALUES (2199,"Eastern Michigan","E Mich");
INSERT INTO team (team_id,school,shortname) VALUES (2711,"Western Michigan","W Mich");
INSERT INTO team (team_id,school,shortname) VALUES (152,"NC State","NC St.");
INSERT INTO team (team_id,school,shortname) VALUES (399,"Albany","Albany");
INSERT INTO team (team_id,school,shortname) VALUES (2,"Auburn","Auburn");
INSERT INTO team (team_id,school,shortname) VALUES (239,"Baylor","Baylor");
INSERT INTO team (team_id,school,shortname) VALUES (2803,"Bryant","Bryant");
INSERT INTO team (team_id,school,shortname) VALUES (2086,"Butler","Butler");
INSERT INTO team (team_id,school,shortname) VALUES (2168,"Dayton","Dayton");
INSERT INTO team (team_id,school,shortname) VALUES (2172,"Denver","Denver");
INSERT INTO team (team_id,school,shortname) VALUES (305,"DePaul","DePaul");
INSERT INTO team (team_id,school,shortname) VALUES (2182,"Drexel","Drexel");
INSERT INTO team (team_id,school,shortname) VALUES (231,"Furman","Furman");
INSERT INTO team (team_id,school,shortname) VALUES (47,"Howard","Howard");
INSERT INTO team (team_id,school,shortname) VALUES (2305,"Kansas","Kansas");
INSERT INTO team (team_id,school,shortname) VALUES (2329,"Lehigh","Lehigh");
INSERT INTO team (team_id,school,shortname) VALUES (2368,"Marist","Marist");
INSERT INTO team (team_id,school,shortname) VALUES (2382,"Mercer","Mercer");
INSERT INTO team (team_id,school,shortname) VALUES (2440,"Nevada","Nevada");
INSERT INTO team (team_id,school,shortname) VALUES (2483,"Oregon","Oregon");
INSERT INTO team (team_id,school,shortname) VALUES (2509,"Purdue","Purdue");
INSERT INTO team (team_id,school,shortname) VALUES (218,"Temple","Temple");
INSERT INTO team (team_id,school,shortname) VALUES (2649,"Toledo","Toledo");
INSERT INTO team (team_id,school,shortname) VALUES (119,"Towson","Towson");
INSERT INTO team (team_id,school,shortname) VALUES (2655,"Tulane","Tulane");
INSERT INTO team (team_id,school,shortname) VALUES (2681,"Wagner","Wagner");
INSERT INTO team (team_id,school,shortname) VALUES (2752,"Xavier","Xavier");
INSERT INTO team (team_id,school,shortname) VALUES (2006,"Akron","Akron");
INSERT INTO team (team_id,school,shortname) VALUES (225,"Brown","Brown");
INSERT INTO team (team_id,school,shortname) VALUES (2181,"Drake","Drake");
INSERT INTO team (team_id,school,shortname) VALUES (70,"Idaho","Idaho");
INSERT INTO team (team_id,school,shortname) VALUES (85,"IUPUI","IUPUI");
INSERT INTO team (team_id,school,shortname) VALUES (2320,"Lamar","Lamar");
INSERT INTO team (team_id,school,shortname) VALUES (311,"Maine","Maine");
INSERT INTO team (team_id,school,shortname) VALUES (2390,"Miami","Miami");
INSERT INTO team (team_id,school,shortname) VALUES (2437,"Omaha","Omaha");
INSERT INTO team (team_id,school,shortname) VALUES (2520,"Rider","Rider");
INSERT INTO team (team_id,school,shortname) VALUES (2561,"Siena","Siena");
INSERT INTO team (team_id,school,shortname) VALUES (251,"Texas","Texas");
INSERT INTO team (team_id,school,shortname) VALUES (202,"Tulsa","Tulsa");
INSERT INTO team (team_id,school,shortname) VALUES (135,"Minnesota","Minn");
INSERT INTO team (team_id,school,shortname) VALUES (8,"Arkansas","Ark.");
INSERT INTO team (team_id,school,shortname) VALUES (130,"Michigan","Mich");
INSERT INTO team (team_id,school,shortname) VALUES (349,"Army","Army");
INSERT INTO team (team_id,school,shortname) VALUES (150,"Duke","Duke");
INSERT INTO team (team_id,school,shortname) VALUES (2210,"Elon","Elon");
INSERT INTO team (team_id,school,shortname) VALUES (314,"Iona","Iona");
INSERT INTO team (team_id,school,shortname) VALUES (2294,"Iowa","Iowa");
INSERT INTO team (team_id,school,shortname) VALUES (2426,"Navy","Navy");
INSERT INTO team (team_id,school,shortname) VALUES (2885,"NJIT","NJIT");
INSERT INTO team (team_id,school,shortname) VALUES (195,"Ohio","Ohio");
INSERT INTO team (team_id,school,shortname) VALUES (219,"Penn","Penn");
INSERT INTO team (team_id,school,shortname) VALUES (242,"Rice","Rice");
INSERT INTO team (team_id,school,shortname) VALUES (2653,"Troy","Troy");
INSERT INTO team (team_id,school,shortname) VALUES (26,"UCLA","UCLA");
INSERT INTO team (team_id,school,shortname) VALUES (2378,"UMBC","UMBC");
INSERT INTO team (team_id,school,shortname) VALUES (140,"UMKC","UMKC");
INSERT INTO team (team_id,school,shortname) VALUES (2439,"UNLV","UNLV");
INSERT INTO team (team_id,school,shortname) VALUES (254,"Utah","Utah");
INSERT INTO team (team_id,school,shortname) VALUES (2638,"UTEP","UTEP");
INSERT INTO team (team_id,school,shortname) VALUES (43,"Yale","Yale");
INSERT INTO team (team_id,school,shortname) VALUES (252,"BYU","BYU");
INSERT INTO team (team_id,school,shortname) VALUES (99,"LSU","LSU");
INSERT INTO team (team_id,school,shortname) VALUES (2567,"SMU","SMU");
INSERT INTO team (team_id,school,shortname) VALUES (2628,"TCU","TCU");
INSERT INTO team (team_id,school,shortname) VALUES (5,"UAB","UAB");
INSERT INTO team (team_id,school,shortname) VALUES (2116,"UCF","UCF");
INSERT INTO team (team_id,school,shortname) VALUES (82,"UIC","UIC");
INSERT INTO team (team_id,school,shortname) VALUES (30,"USC","USC");
INSERT INTO team (team_id,school,shortname) VALUES (2670,"VCU","VCU");
INSERT INTO team (team_id,school,shortname) VALUES (2678,"VMI","VMI");
INSERT INTO team (team_id,school,shortname) VALUES (120,"Maryland","MD");
INSERT INTO team (team_id,school,shortname) VALUES (88,"Southern Indiana","S. IN");
INSERT INTO team (team_id,school,shortname) VALUES (91,"Bellarmine","MD");
INSERT INTO team (team_id,school,shortname) VALUES (284,"Stonehill","MD");
INSERT INTO team (team_id,school,shortname) VALUES (2330,"LeMoyne","MD");
INSERT INTO team (team_id,school,shortname) VALUES (2453,"North Alabama","MD");
INSERT INTO team (team_id,school,shortname) VALUES (2627,"Tarleton","MD");
INSERT INTO team (team_id,school,shortname) VALUES (2771,"Merrimack","MD");
INSERT INTO team (team_id,school,shortname) VALUES (2815,"Lindenwood","MD");
INSERT INTO team (team_id,school,shortname) VALUES (2856,"Cal Baptist","MD");
INSERT INTO team (team_id,school,shortname) VALUES (2900,"St. Thomas","MD");
INSERT INTO team (team_id,school,shortname) VALUES (28,"UCSD","MD");
INSERT INTO team (team_id,school,shortname) VALUES (2511,"Queens","MD");
INSERT INTO team (team_id,school,shortname) VALUES (112358,"LIU","MD");
INSERT INTO team (team_id,school,shortname) VALUES (3101,"Utah Tech","MD");
INSERT INTO team (team_id,school,shortname) VALUES (2837,"TAMU-Commerce","MD");