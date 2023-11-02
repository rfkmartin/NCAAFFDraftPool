#!/usr/bin/python
# Copyright 2010 Google Inc.
# Licensed under the Apache License, Version 2.0
# http://www.apache.org/licenses/LICENSE-2.0

# Google's Python Class
# http://code.google.com/edu/languages/google-python-class/

import os
import re
import sys
import urllib
import mechanize
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
                     database="")        # name of the data base

  # you must create a Cursor object. It will let
  #  you execute all the queries you need
  cur = db.cursor()

  # Use all the SQL you like
  cur.execute("SELECT team_id FROM team")

  # print all the first cell of all the rows
  for row in cur.fetchall():
    file="../data/team" + str(row[0]) + ".html"
    url="http://www.espn.com/mens-college-basketball/team/stats/_/id/" + str(row[0]) + "/"
    print(url)
    print(file)
    br.retrieve(url,file)

def main():
   wget('foo')

if __name__ == '__main__':
  main()
