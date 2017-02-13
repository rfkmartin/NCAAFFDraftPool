drop database if exists ncaa;
create database ncaa;
use ncaa;

-- date;python ESPNScrape.py;cat create_ncaa.sql > temp.sql ;cat create_bracket.sql >> temp.sql ;mysql -u root -pLuv2Drnk < temp.sql;./parseHTML.pl ;date

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
   conference varchar(64),
   region varchar(32),
   wins int,
   losses int,
   rpi int,
   rank int,
   seed int,
   primary key (team_id)
);

create table bracket (
   bracket_pos int not null,
   next_pos int not null,
   game_id int,
   region varchar(32),
   round varchar(32),
   team_id int,
   primary key (bracket_pos)
);

create table player (
   player_id int not null auto_increment,
   name varchar(64) not null,
   team_id int not null,
   gp float,
   mpg float,
   ppg float,
   primary key (player_id),
   foreign key (team_id) references team(team_id)
);

create table keyValue (
   k varchar(64),
   v varchar(64),
   primary key (k)
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

INSERT INTO keyValue(k,v) VALUES ("playerUpdateDTM",CURTIME());
INSERT INTO keyValue(k,v) VALUES ("status",'PREDRAFT');

INSERT INTO team(team_id,school) VALUES (2000,"Abilene Christian ");
INSERT INTO team(team_id,school) VALUES (2005,"Air Force");
INSERT INTO team(team_id,school) VALUES (2006,"Akron");
INSERT INTO team(team_id,school) VALUES (333,"Alabama");
INSERT INTO team(team_id,school) VALUES (2010,"Alabama A&M");
INSERT INTO team(team_id,school) VALUES (2011,"Alabama State");
INSERT INTO team(team_id,school) VALUES (399,"Albany");
INSERT INTO team(team_id,school) VALUES (2016,"Alcorn State");
INSERT INTO team(team_id,school) VALUES (44,"American");
INSERT INTO team(team_id,school) VALUES (2026,"Appalachian State");
INSERT INTO team(team_id,school) VALUES (12,"Arizona");
INSERT INTO team(team_id,school) VALUES (9,"Arizona State");
INSERT INTO team(team_id,school) VALUES (8,"Arkansas");
INSERT INTO team(team_id,school) VALUES (2032,"Arkansas State");
INSERT INTO team(team_id,school) VALUES (2029,"Arkansas-Pine Bluff");
INSERT INTO team(team_id,school) VALUES (349,"Army");
INSERT INTO team(team_id,school) VALUES (2,"Auburn");
INSERT INTO team(team_id,school) VALUES (2046,"Austin Peay");
INSERT INTO team(team_id,school) VALUES (2050,"Ball State");
INSERT INTO team(team_id,school) VALUES (239,"Baylor");
INSERT INTO team(team_id,school) VALUES (2057,"Belmont");
INSERT INTO team(team_id,school) VALUES (2065,"Bethune-Cookman");
INSERT INTO team(team_id,school) VALUES (2066,"Binghamton");
INSERT INTO team(team_id,school) VALUES (68,"Boise State");
INSERT INTO team(team_id,school) VALUES (103,"Boston College");
INSERT INTO team(team_id,school) VALUES (104,"Boston University");
INSERT INTO team(team_id,school) VALUES (189,"Bowling Green");
INSERT INTO team(team_id,school) VALUES (71,"Bradley");
INSERT INTO team(team_id,school) VALUES (225,"Brown");
INSERT INTO team(team_id,school) VALUES (2803,"Bryant");
INSERT INTO team(team_id,school) VALUES (2083,"Bucknell");
INSERT INTO team(team_id,school) VALUES (2084,"Buffalo");
INSERT INTO team(team_id,school) VALUES (2086,"Butler");
INSERT INTO team(team_id,school) VALUES (252,"BYU");
INSERT INTO team(team_id,school) VALUES (13,"Cal Poly");
INSERT INTO team(team_id,school) VALUES (2239,"Cal State Fullerton");
INSERT INTO team(team_id,school) VALUES (25,"California");
INSERT INTO team(team_id,school) VALUES (2097,"Campbell");
INSERT INTO team(team_id,school) VALUES (2099,"Canisius");
INSERT INTO team(team_id,school) VALUES (2110,"Central Arkansas");
INSERT INTO team(team_id,school) VALUES (2115,"Central Connecticut");
INSERT INTO team(team_id,school) VALUES (2117,"Central Michigan");
INSERT INTO team(team_id,school) VALUES (232,"Charleston");
INSERT INTO team(team_id,school) VALUES (2127,"Charleston Southern");
INSERT INTO team(team_id,school) VALUES (2429,"Charlotte");
INSERT INTO team(team_id,school) VALUES (236,"Chattanooga");
INSERT INTO team(team_id,school) VALUES (2130,"Chicago State");
INSERT INTO team(team_id,school) VALUES (2132,"Cincinnati");
INSERT INTO team(team_id,school) VALUES (228,"Clemson");
INSERT INTO team(team_id,school) VALUES (325,"Cleveland State");
INSERT INTO team(team_id,school) VALUES (324,"Coastal Carolina");
INSERT INTO team(team_id,school) VALUES (2142,"Colgate");
INSERT INTO team(team_id,school) VALUES (38,"Colorado");
INSERT INTO team(team_id,school) VALUES (36,"Colorado State");
INSERT INTO team(team_id,school) VALUES (171,"Columbia");
INSERT INTO team(team_id,school) VALUES (41,"Connecticut");
INSERT INTO team(team_id,school) VALUES (2154,"Coppin State");
INSERT INTO team(team_id,school) VALUES (172,"Cornell");
INSERT INTO team(team_id,school) VALUES (156,"Creighton");
INSERT INTO team(team_id,school) VALUES (2463,"CS Northridge");
INSERT INTO team(team_id,school) VALUES (2934,"CSU Bakersfield");
INSERT INTO team(team_id,school) VALUES (159,"Dartmouth");
INSERT INTO team(team_id,school) VALUES (2166,"Davidson");
INSERT INTO team(team_id,school) VALUES (2168,"Dayton");
INSERT INTO team(team_id,school) VALUES (48,"Delaware");
INSERT INTO team(team_id,school) VALUES (2169,"Delaware State");
INSERT INTO team(team_id,school) VALUES (2172,"Denver");
INSERT INTO team(team_id,school) VALUES (305,"DePaul");
INSERT INTO team(team_id,school) VALUES (2174,"Detroit Mercy");
INSERT INTO team(team_id,school) VALUES (2181,"Drake");
INSERT INTO team(team_id,school) VALUES (2182,"Drexel");
INSERT INTO team(team_id,school) VALUES (150,"Duke");
INSERT INTO team(team_id,school) VALUES (2184,"Duquesne");
INSERT INTO team(team_id,school) VALUES (151,"East Carolina");
INSERT INTO team(team_id,school) VALUES (2193,"East Tennessee St.");
INSERT INTO team(team_id,school) VALUES (2197,"Eastern Illinois");
INSERT INTO team(team_id,school) VALUES (2198,"Eastern Kentucky");
INSERT INTO team(team_id,school) VALUES (2199,"Eastern Michigan");
INSERT INTO team(team_id,school) VALUES (331,"Eastern Washington");
INSERT INTO team(team_id,school) VALUES (2210,"Elon");
INSERT INTO team(team_id,school) VALUES (339,"Evansville");
INSERT INTO team(team_id,school) VALUES (2217,"Fairfield");
INSERT INTO team(team_id,school) VALUES (161,"Fairleigh Dickinson");
INSERT INTO team(team_id,school) VALUES (57,"Florida");
INSERT INTO team(team_id,school) VALUES (50,"Florida A&M");
INSERT INTO team(team_id,school) VALUES (2226,"Florida Atlantic");
INSERT INTO team(team_id,school) VALUES (526,"Florida Gulf Coast");
INSERT INTO team(team_id,school) VALUES (2229,"Florida Intl");
INSERT INTO team(team_id,school) VALUES (52,"Florida State");
INSERT INTO team(team_id,school) VALUES (2230,"Fordham");
INSERT INTO team(team_id,school) VALUES (2870,"Fort Wayne");
INSERT INTO team(team_id,school) VALUES (278,"Fresno State");
INSERT INTO team(team_id,school) VALUES (231,"Furman");
INSERT INTO team(team_id,school) VALUES (2241,"Gardner-Webb");
INSERT INTO team(team_id,school) VALUES (2244,"George Mason");
INSERT INTO team(team_id,school) VALUES (45,"George Washington");
INSERT INTO team(team_id,school) VALUES (46,"Georgetown");
INSERT INTO team(team_id,school) VALUES (61,"Georgia");
INSERT INTO team(team_id,school) VALUES (290,"Georgia Southern");
INSERT INTO team(team_id,school) VALUES (2247,"Georgia State");
INSERT INTO team(team_id,school) VALUES (59,"Georgia Tech");
INSERT INTO team(team_id,school) VALUES (2250,"Gonzaga");
INSERT INTO team(team_id,school) VALUES (2755,"Grambling St");
INSERT INTO team(team_id,school) VALUES (2253,"Grand Canyon");
INSERT INTO team(team_id,school) VALUES (2739,"Green Bay");
INSERT INTO team(team_id,school) VALUES (2261,"Hampton");
INSERT INTO team(team_id,school) VALUES (42,"Hartford");
INSERT INTO team(team_id,school) VALUES (108,"Harvard");
INSERT INTO team(team_id,school) VALUES (62,"Hawai'i");
INSERT INTO team(team_id,school) VALUES (2272,"High Point");
INSERT INTO team(team_id,school) VALUES (2275,"Hofstra");
INSERT INTO team(team_id,school) VALUES (107,"Holy Cross");
INSERT INTO team(team_id,school) VALUES (248,"Houston");
INSERT INTO team(team_id,school) VALUES (2277,"Houston Baptist");
INSERT INTO team(team_id,school) VALUES (47,"Howard");
INSERT INTO team(team_id,school) VALUES (70,"Idaho");
INSERT INTO team(team_id,school) VALUES (304,"Idaho State");
INSERT INTO team(team_id,school) VALUES (356,"Illinois");
INSERT INTO team(team_id,school) VALUES (2287,"Illinois State");
INSERT INTO team(team_id,school) VALUES (2916,"Incarnate Word");
INSERT INTO team(team_id,school) VALUES (84,"Indiana");
INSERT INTO team(team_id,school) VALUES (282,"Indiana State");
INSERT INTO team(team_id,school) VALUES (314,"Iona");
INSERT INTO team(team_id,school) VALUES (2294,"Iowa");
INSERT INTO team(team_id,school) VALUES (66,"Iowa State");
INSERT INTO team(team_id,school) VALUES (85,"IUPUI");
INSERT INTO team(team_id,school) VALUES (2296,"Jackson State");
INSERT INTO team(team_id,school) VALUES (294,"Jacksonville");
INSERT INTO team(team_id,school) VALUES (55,"Jacksonville State");
INSERT INTO team(team_id,school) VALUES (256,"James Madison");
INSERT INTO team(team_id,school) VALUES (2305,"Kansas");
INSERT INTO team(team_id,school) VALUES (2306,"Kansas State");
INSERT INTO team(team_id,school) VALUES (338,"Kennesaw State");
INSERT INTO team(team_id,school) VALUES (2309,"Kent State");
INSERT INTO team(team_id,school) VALUES (96,"Kentucky");
INSERT INTO team(team_id,school) VALUES (2325,"La Salle");
INSERT INTO team(team_id,school) VALUES (322,"Lafayette");
INSERT INTO team(team_id,school) VALUES (2320,"Lamar");
INSERT INTO team(team_id,school) VALUES (2329,"Lehigh");
INSERT INTO team(team_id,school) VALUES (2335,"Liberty");
INSERT INTO team(team_id,school) VALUES (288,"Lipscomb");
INSERT INTO team(team_id,school) VALUES (2031,"Little Rock");
INSERT INTO team(team_id,school) VALUES (2341,"LIU Brooklyn");
INSERT INTO team(team_id,school) VALUES (299,"Long Beach State");
INSERT INTO team(team_id,school) VALUES (2344,"Longwood");
INSERT INTO team(team_id,school) VALUES (2433,"Louisiana Monroe");
INSERT INTO team(team_id,school) VALUES (2348,"Louisiana Tech");
INSERT INTO team(team_id,school) VALUES (97,"Louisville");
INSERT INTO team(team_id,school) VALUES (2350,"Loyola (CHI)");
INSERT INTO team(team_id,school) VALUES (2352,"Loyola (MD)");
INSERT INTO team(team_id,school) VALUES (2351,"Loyola Marymount");
INSERT INTO team(team_id,school) VALUES (99,"LSU");
INSERT INTO team(team_id,school) VALUES (311,"Maine");
INSERT INTO team(team_id,school) VALUES (2363,"Manhattan");
INSERT INTO team(team_id,school) VALUES (2368,"Marist");
INSERT INTO team(team_id,school) VALUES (269,"Marquette");
INSERT INTO team(team_id,school) VALUES (276,"Marshall");
INSERT INTO team(team_id,school) VALUES (120,"Maryland");
INSERT INTO team(team_id,school) VALUES (2379,"Maryland-Eastern Shore");
INSERT INTO team(team_id,school) VALUES (113,"Massachusetts");
INSERT INTO team(team_id,school) VALUES (2377,"McNeese");
INSERT INTO team(team_id,school) VALUES (235,"Memphis");
INSERT INTO team(team_id,school) VALUES (2382,"Mercer");
INSERT INTO team(team_id,school) VALUES (2390,"Miami");
INSERT INTO team(team_id,school) VALUES (193,"Miami (OH)");
INSERT INTO team(team_id,school) VALUES (130,"Michigan");
INSERT INTO team(team_id,school) VALUES (127,"Michigan State");
INSERT INTO team(team_id,school) VALUES (2393,"Middle Tennessee");
INSERT INTO team(team_id,school) VALUES (270,"Milwaukee");
INSERT INTO team(team_id,school) VALUES (135,"Minnesota");
INSERT INTO team(team_id,school) VALUES (344,"Mississippi State");
INSERT INTO team(team_id,school) VALUES (2400,"Mississippi Valley State");
INSERT INTO team(team_id,school) VALUES (142,"Missouri");
INSERT INTO team(team_id,school) VALUES (2623,"Missouri State");
INSERT INTO team(team_id,school) VALUES (2405,"Monmouth");
INSERT INTO team(team_id,school) VALUES (149,"Montana");
INSERT INTO team(team_id,school) VALUES (147,"Montana State");
INSERT INTO team(team_id,school) VALUES (2413,"Morehead State");
INSERT INTO team(team_id,school) VALUES (2415,"Morgan State");
INSERT INTO team(team_id,school) VALUES (116,"Mount St Mary's");
INSERT INTO team(team_id,school) VALUES (93,"Murray State");
INSERT INTO team(team_id,school) VALUES (2426,"Navy");
INSERT INTO team(team_id,school) VALUES (152,"NC State");
INSERT INTO team(team_id,school) VALUES (158,"Nebraska");
INSERT INTO team(team_id,school) VALUES (2440,"Nevada");
INSERT INTO team(team_id,school) VALUES (160,"New Hampshire");
INSERT INTO team(team_id,school) VALUES (167,"New Mexico");
INSERT INTO team(team_id,school) VALUES (166,"New Mexico State");
INSERT INTO team(team_id,school) VALUES (2443,"New Orleans");
INSERT INTO team(team_id,school) VALUES (315,"Niagara");
INSERT INTO team(team_id,school) VALUES (2447,"Nicholls");
INSERT INTO team(team_id,school) VALUES (2885,"NJIT");
INSERT INTO team(team_id,school) VALUES (2450,"Norfolk State");
INSERT INTO team(team_id,school) VALUES (153,"North Carolina");
INSERT INTO team(team_id,school) VALUES (2448,"North Carolina A&T");
INSERT INTO team(team_id,school) VALUES (2428,"North Carolina Central");
INSERT INTO team(team_id,school) VALUES (155,"North Dakota");
INSERT INTO team(team_id,school) VALUES (2449,"North Dakota State");
INSERT INTO team(team_id,school) VALUES (2454,"North Florida");
INSERT INTO team(team_id,school) VALUES (249,"North Texas");
INSERT INTO team(team_id,school) VALUES (111,"Northeastern");
INSERT INTO team(team_id,school) VALUES (2464,"Northern Arizona");
INSERT INTO team(team_id,school) VALUES (2458,"Northern Colorado");
INSERT INTO team(team_id,school) VALUES (2459,"Northern Illinois");
INSERT INTO team(team_id,school) VALUES (2460,"Northern Iowa");
INSERT INTO team(team_id,school) VALUES (94,"Northern Kentucky");
INSERT INTO team(team_id,school) VALUES (77,"Northwestern");
INSERT INTO team(team_id,school) VALUES (2466,"Northwestern State");
INSERT INTO team(team_id,school) VALUES (87,"Notre Dame");
INSERT INTO team(team_id,school) VALUES (2473,"Oakland");
INSERT INTO team(team_id,school) VALUES (195,"Ohio");
INSERT INTO team(team_id,school) VALUES (194,"Ohio State");
INSERT INTO team(team_id,school) VALUES (201,"Oklahoma");
INSERT INTO team(team_id,school) VALUES (197,"Oklahoma State");
INSERT INTO team(team_id,school) VALUES (295,"Old Dominion");
INSERT INTO team(team_id,school) VALUES (145,"Ole Miss");
INSERT INTO team(team_id,school) VALUES (2437,"Omaha");
INSERT INTO team(team_id,school) VALUES (198,"Oral Roberts");
INSERT INTO team(team_id,school) VALUES (2483,"Oregon");
INSERT INTO team(team_id,school) VALUES (204,"Oregon State");
INSERT INTO team(team_id,school) VALUES (279,"Pacific");
INSERT INTO team(team_id,school) VALUES (219,"Penn");
INSERT INTO team(team_id,school) VALUES (213,"Penn State");
INSERT INTO team(team_id,school) VALUES (2492,"Pepperdine");
INSERT INTO team(team_id,school) VALUES (221,"Pittsburgh");
INSERT INTO team(team_id,school) VALUES (2501,"Portland");
INSERT INTO team(team_id,school) VALUES (2502,"Portland State");
INSERT INTO team(team_id,school) VALUES (2504,"Prairie View A&M");
INSERT INTO team(team_id,school) VALUES (2506,"Presbyterian College");
INSERT INTO team(team_id,school) VALUES (163,"Princeton");
INSERT INTO team(team_id,school) VALUES (2507,"Providence");
INSERT INTO team(team_id,school) VALUES (2509,"Purdue");
INSERT INTO team(team_id,school) VALUES (2514,"Quinnipiac");
INSERT INTO team(team_id,school) VALUES (2515,"Radford");
INSERT INTO team(team_id,school) VALUES (227,"Rhode Island");
INSERT INTO team(team_id,school) VALUES (242,"Rice");
INSERT INTO team(team_id,school) VALUES (257,"Richmond");
INSERT INTO team(team_id,school) VALUES (2520,"Rider");
INSERT INTO team(team_id,school) VALUES (2523,"Robert Morris");
INSERT INTO team(team_id,school) VALUES (164,"Rutgers");
INSERT INTO team(team_id,school) VALUES (16,"Sacramento State");
INSERT INTO team(team_id,school) VALUES (2529,"Sacred Heart");
INSERT INTO team(team_id,school) VALUES (2603,"Saint Joseph's");
INSERT INTO team(team_id,school) VALUES (139,"Saint Louis");
INSERT INTO team(team_id,school) VALUES (2608,"Saint Mary's");
INSERT INTO team(team_id,school) VALUES (2612,"Saint Peter's");
INSERT INTO team(team_id,school) VALUES (2534,"Sam Houston State");
INSERT INTO team(team_id,school) VALUES (2535,"Samford");
INSERT INTO team(team_id,school) VALUES (301,"San Diego");
INSERT INTO team(team_id,school) VALUES (21,"San Diego State");
INSERT INTO team(team_id,school) VALUES (2539,"San Francisco");
INSERT INTO team(team_id,school) VALUES (23,"San Jose State");
INSERT INTO team(team_id,school) VALUES (2541,"Santa Clara");
INSERT INTO team(team_id,school) VALUES (2542,"Savannah State");
INSERT INTO team(team_id,school) VALUES (2547,"Seattle");
INSERT INTO team(team_id,school) VALUES (2550,"Seton Hall");
INSERT INTO team(team_id,school) VALUES (2561,"Siena");
INSERT INTO team(team_id,school) VALUES (2565,"SIU Edwardsville");
INSERT INTO team(team_id,school) VALUES (2567,"SMU");
INSERT INTO team(team_id,school) VALUES (6,"South Alabama");
INSERT INTO team(team_id,school) VALUES (2579,"South Carolina");
INSERT INTO team(team_id,school) VALUES (2569,"South Carolina State");
INSERT INTO team(team_id,school) VALUES (2908,"South Carolina Upstate");
INSERT INTO team(team_id,school) VALUES (233,"South Dakota");
INSERT INTO team(team_id,school) VALUES (2571,"South Dakota State");
INSERT INTO team(team_id,school) VALUES (58,"South Florida");
INSERT INTO team(team_id,school) VALUES (2546,"Southeast Missouri State");
INSERT INTO team(team_id,school) VALUES (2545,"Southeastern Louisiana");
INSERT INTO team(team_id,school) VALUES (2582,"Southern");
INSERT INTO team(team_id,school) VALUES (79,"Southern Illinois");
INSERT INTO team(team_id,school) VALUES (2572,"Southern Mississippi");
INSERT INTO team(team_id,school) VALUES (253,"Southern Utah");
INSERT INTO team(team_id,school) VALUES (179,"St Bonaventure");
INSERT INTO team(team_id,school) VALUES (2597,"St Francis (BKN)");
INSERT INTO team(team_id,school) VALUES (2598,"St Francis (PA)");
INSERT INTO team(team_id,school) VALUES (2599,"St John's");
INSERT INTO team(team_id,school) VALUES (24,"Stanford");
INSERT INTO team(team_id,school) VALUES (2617,"Stephen F. Austin");
INSERT INTO team(team_id,school) VALUES (56,"Stetson");
INSERT INTO team(team_id,school) VALUES (2619,"Stony Brook");
INSERT INTO team(team_id,school) VALUES (183,"Syracuse");
INSERT INTO team(team_id,school) VALUES (2628,"TCU");
INSERT INTO team(team_id,school) VALUES (218,"Temple");
INSERT INTO team(team_id,school) VALUES (2633,"Tennessee");
INSERT INTO team(team_id,school) VALUES (2634,"Tennessee State");
INSERT INTO team(team_id,school) VALUES (2635,"Tennessee Tech");
INSERT INTO team(team_id,school) VALUES (2630,"Tennessee-Martin");
INSERT INTO team(team_id,school) VALUES (251,"Texas");
INSERT INTO team(team_id,school) VALUES (245,"Texas A&M");
INSERT INTO team(team_id,school) VALUES (357,"Texas A&M-CC");
INSERT INTO team(team_id,school) VALUES (2640,"Texas Southern");
INSERT INTO team(team_id,school) VALUES (326,"Texas State");
INSERT INTO team(team_id,school) VALUES (2641,"Texas Tech");
INSERT INTO team(team_id,school) VALUES (2643,"The Citadel");
INSERT INTO team(team_id,school) VALUES (2649,"Toledo");
INSERT INTO team(team_id,school) VALUES (119,"Towson");
INSERT INTO team(team_id,school) VALUES (2653,"Troy");
INSERT INTO team(team_id,school) VALUES (2655,"Tulane");
INSERT INTO team(team_id,school) VALUES (202,"Tulsa");
INSERT INTO team(team_id,school) VALUES (5,"UAB");
INSERT INTO team(team_id,school) VALUES (302,"UC Davis");
INSERT INTO team(team_id,school) VALUES (300,"UC Irvine");
INSERT INTO team(team_id,school) VALUES (27,"UC Riverside");
INSERT INTO team(team_id,school) VALUES (2540,"UC Santa Barbara");
INSERT INTO team(team_id,school) VALUES (2116,"UCF");
INSERT INTO team(team_id,school) VALUES (26,"UCLA");
INSERT INTO team(team_id,school) VALUES (82,"UIC");
INSERT INTO team(team_id,school) VALUES (309,"Ul Lafayette");
INSERT INTO team(team_id,school) VALUES (2349,"UMass Lowell");
INSERT INTO team(team_id,school) VALUES (2378,"UMBC");
INSERT INTO team(team_id,school) VALUES (140,"UMKC");
INSERT INTO team(team_id,school) VALUES (2427,"UNC Asheville");
INSERT INTO team(team_id,school) VALUES (2430,"UNC Greensboro");
INSERT INTO team(team_id,school) VALUES (350,"UNC Wilmington");
INSERT INTO team(team_id,school) VALUES (2439,"UNLV");
INSERT INTO team(team_id,school) VALUES (30,"USC");
INSERT INTO team(team_id,school) VALUES (292,"UT Rio Grande Valley");
INSERT INTO team(team_id,school) VALUES (2636,"UT San Antonio");
INSERT INTO team(team_id,school) VALUES (250,"UT-Arlington");
INSERT INTO team(team_id,school) VALUES (254,"Utah");
INSERT INTO team(team_id,school) VALUES (328,"Utah State");
INSERT INTO team(team_id,school) VALUES (3084,"Utah Valley");
INSERT INTO team(team_id,school) VALUES (2638,"UTEP");
INSERT INTO team(team_id,school) VALUES (2674,"Valparaiso");
INSERT INTO team(team_id,school) VALUES (238,"Vanderbilt");
INSERT INTO team(team_id,school) VALUES (2670,"VCU");
INSERT INTO team(team_id,school) VALUES (261,"Vermont");
INSERT INTO team(team_id,school) VALUES (222,"Villanova");
INSERT INTO team(team_id,school) VALUES (258,"Virginia");
INSERT INTO team(team_id,school) VALUES (259,"Virginia Tech");
INSERT INTO team(team_id,school) VALUES (2678,"VMI");
INSERT INTO team(team_id,school) VALUES (2681,"Wagner");
INSERT INTO team(team_id,school) VALUES (154,"Wake Forest");
INSERT INTO team(team_id,school) VALUES (264,"Washington");
INSERT INTO team(team_id,school) VALUES (265,"Washington State");
INSERT INTO team(team_id,school) VALUES (2692,"Weber State");
INSERT INTO team(team_id,school) VALUES (277,"West Virginia");
INSERT INTO team(team_id,school) VALUES (2717,"Western Carolina");
INSERT INTO team(team_id,school) VALUES (2710,"Western Illinois");
INSERT INTO team(team_id,school) VALUES (98,"Western Kentucky");
INSERT INTO team(team_id,school) VALUES (2711,"Western Michigan");
INSERT INTO team(team_id,school) VALUES (2724,"Wichita St");
INSERT INTO team(team_id,school) VALUES (2729,"William & Mary");
INSERT INTO team(team_id,school) VALUES (2737,"Winthrop");
INSERT INTO team(team_id,school) VALUES (275,"Wisconsin");
INSERT INTO team(team_id,school) VALUES (2747,"Wofford");
INSERT INTO team(team_id,school) VALUES (2750,"Wright State");
INSERT INTO team(team_id,school) VALUES (2751,"Wyoming");
INSERT INTO team(team_id,school) VALUES (2752,"Xavier");
INSERT INTO team(team_id,school) VALUES (43,"Yale");
INSERT INTO team(team_id,school) VALUES (2754,"Youngstown State");