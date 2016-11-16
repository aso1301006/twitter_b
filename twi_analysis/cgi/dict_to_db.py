#!/usr/bin/env python
# -*- coding: utf-8 -*-

import codecs
import mysetting
nega_pogi = mysetting.nega_pogi


# 'db.txt'は上記データベースをテキストファイルに保存したテキストファイル
with codecs.open('db.txt', 'r', 'shift-jis') as f:
    for l in f.readlines():
        line = l.split(':')
        nega_pogi.insert({
            'word': line[0],
            'reading': line[1],
            'pos': line[2],
            'point': float(line[3].rstrip())  # 末尾の改行文字の削除（この書き方は空白なども削除する）
        })
