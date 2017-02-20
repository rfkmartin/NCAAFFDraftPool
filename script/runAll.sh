date
mysqldump ncaa user -u root -pLuv2Drnk > usertemp.sql
cat create_ncaa.sql > temp.sql
cat create_bracket.sql >> temp.sql
cat usertemp.sql >> temp.sql
mysql -u root -pLuv2Drnk < temp.sql
python ESPNScrape.py
./parseHTML.pl
date