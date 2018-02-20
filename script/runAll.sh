date
#mysqldump ncaa -h 192.168.10.52 user -u root -pub6ib9 > usertemp.sql
cat create_ncaa.sql > temp.sql
cat create_bracket.sql >> temp.sql
cat create_results.sql >> temp.sql
#cat usertemp.sql >> temp.sql
mysql -h 192.168.10.51 -u root -pub6ib9 < temp.sql
python ESPNScrape.py
./parseHTML.pl
date