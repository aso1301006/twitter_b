#!/usr/bin/env python
# -*- coding: utf-8 -*-

from pymongo import MongoClient

# 使わないのでとりあえずコメントアウト
# KEYS = {  # 自分のアカウントで入手したキーを下記に記載
#     'consumer_key': '**********',
#     'consumer_secret': '**********',
#     'access_token': '**********',
#     'access_secret': '**********',
# }

# twitter = None
connect = None
db = None
tweetdata = None
nega_pogi = None


def initialize():  # twitter接続情報や、mongoDBへの接続処理等initial処理実行
    global twitter, connect, db, tweetdata, nega_pogi

    # 使わないのでとりあえずコメントアウト
    # twitter = OAuth1Session(KEYS['consumer_key'], KEYS['consumer_secret'],
    #                         KEYS['access_token'], KEYS['access_secret'])
    connect = MongoClient('localhost', 27017)
    db = connect.twi_analysis
    tweetdata = db.tweetdata
    nega_pogi = db.nega_pogi


initialize()
