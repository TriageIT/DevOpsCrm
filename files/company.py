#!/usr/bin/python
import MySQLdb

db = MySQLdb.connect(host="localhost",    # your host, usually localhost
                     user="g7triage",         # your username
                     passwd="TriageCRM",  # your password
		#let weer op het password en spatie
                     db="g7bedrijfsadmin")        # name of the data base

# you must create a Cursor object. It will let
#  you execute all the queries you need
cur = db.cursor()

# Use all the SQL you like
cur.execute("SELECT * FROM branche")

# print all the first cell of all the rows
for row in cur.fetchall():
    print row[0]

db.close()
