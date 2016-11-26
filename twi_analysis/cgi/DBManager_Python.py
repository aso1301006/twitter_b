#!/usr/bin/env python
# -*- coding: utf-8 -*-

from pymongo import MongoClient

HOST = 'localhost'


class DBManager_Python:
    def __init__(self):  # twitter接続情報や、mongoDBへの接続処理等initial処理実行

        # 使わないのでとりあえずコメントアウト
        # self.twitter = OAuth1Session(KEYS['consumer_key'],
        #                         KEYS['consumer_secret'],
        #                         KEYS['access_token'],
        #                         KEYS['access_secret']
        # )
        self.connect = MongoClient(HOST, 27017)
        self.db = self.connect.twi_analysis
        self.tweetdata = self.db.tweetdata
        self.nega_pogi = self.db.nega_pogi
