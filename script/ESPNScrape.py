#!/usr/bin/python
# Copyright 2010 Google Inc.
# Licensed under the Apache License, Version 2.0
# http://www.apache.org/licenses/LICENSE-2.0

# Google's Python Class
# http://code.google.com/edu/languages/google-python-class/

#import os
import re
import json
#import sys
#import urllib
import mechanize
import requests
import ssl
import mysql.connector

## Given a url, try to retrieve it. If it's text/html,
## print its base url and its text.
def wget(url):
  ssl._create_default_https_context=ssl._create_unverified_context
  br = mechanize.Browser()
  br.set_handle_robots(False)
  db = mysql.connector.connect(host="127.0.0.1",    # your host, usually localhost
                     user="root",         # your username
                     password="",  # your password
                     auth_plugin="mysql_native_password",
                     database="ncaa1")        # name of the data base

  # you must create a Cursor object. It will let
  #  you execute all the queries you need
  cur = db.cursor()

  # Use all the SQL you like
  cur.execute("SELECT team_id FROM team")

  # print all the first cell of all the rows
  for row in cur.fetchall():
    teamid=str(row[0])
    url="https://www.espn.com/mens-college-basketball/team/stats/_/id/" + teamid + "/"
    #print(url)
    headers = {'User-Agent': 'Mozilla/5.0'}
    response=requests.get(url,headers=headers)
    html=response.text
    results=re.search(".*espnfitt__'\]=({.*});<\/script",html,re.DOTALL)
    if (results):
        json_load=json.loads(results.group(1))
        team=json_load.get('page',{}).get('content',{}).get('stats',{}).get('team',{});
        if len(team) != 0:
          wins=0
          losses=0
          rank=team.get('rank',100)
          displayNm=team.get('displayName','')
          abbrev=team.get('abbrev','')
          logo=team.get('logo','')
          mascot=team['shortDisplayName']
          record=team.get('recordSummary',{})
          if len(record) != 0:
             winslosses=re.search("([0-9]*)-([0-9]*)",record)
             if (winslosses):
                wins=winslosses.group(1)
                losses=winslosses.group(2)
          teamColor=team.get('teamColor','000000')
          altColor=team.get('altColor','ffffff')
          standingSummary=team['standingSummary']
          place=re.search(".* in ([\-a-zA-Z0-9 ]*)",standingSummary)
          if (place):
             conf=place.group(1)
          nickname=team['nickname']
          location=team['location']
          links=team['links']
          playerStats=json_load['page']['content']['stats']['playerStats']
          for playerStat in playerStats[0]:
              name=playerStat['athlete']['name']
              gp=playerStat['statGroups']['stats'][0]['displayValue']
              mpg=playerStat['statGroups']['stats'][1]['displayValue']
              ppg=playerStat['statGroups']['stats'][2]['displayValue']
              sql="insert into player(year_id,name,team_id,gp,mpg,ppg) values (2024,%s,%s,%s,%s,%s)"
              val=(name,teamid,gp,mpg,ppg)
              cur.execute(sql,val)
          sql="update team set school=%s,shortname=%s,location_=%s,team_color=%s,alt_color=%s,logo=%s,wins=%s,losses=%s,rank_=%s,mascot=%s,conference=%s,link=%s where team_id=%s"
          val=(displayNm,abbrev,location,teamColor,altColor,logo,wins,losses,rank,mascot,conf,links,teamid)
          cur.execute(sql,val)
          db.commit()
    else:
        print("nothing")

def main():
   wget('foo')

if __name__ == '__main__':
  main()
