#!/usr/bin/env python
# -*- coding: utf-8 -*-

import mysetting
# import analysis_mecab as mecab
# import Count_DB as countdb
import datetime
import pytz
import re
import sys
import codecs
sys.stdout = codecs.getwriter("utf-8")(sys.stdout)
tweetdata = mysetting.tweetdata


# def str_to_date_jp(str_date):
#     dts = datetime.datetime.strptime(str_date,'%a %b %d %H:%M:%S +0000 %Y')
#     return pytz.utc.localize(dts).astimezone(pytz.timezone('Asia/Tokyo'))


# tw_date = "Wed Nov 30 05:26:18 +0000 2016"
# date = str_to_date_jp(tw_date)
# tweetdata.insert({'date': date})

# date = countdb.str_to_date_jp("2015-03-18 00:00:00")
# for d in tweetdata.find({'date': {"$gt": date}}):
#     print d


pattern = re.compile("ため", re.IGNORECASE)
word = "分"
for d in tweetdata.find({'$or': [
    {'noun.' + word: {'$exists': 1}},
    {'adjective.' + word: {'$exists': 1}}
]}):
    for key, value in d.items():
        print key, type(value), value
