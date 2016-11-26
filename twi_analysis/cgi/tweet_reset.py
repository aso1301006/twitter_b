#!/usr/bin/env python
# -*- coding: utf-8 -*-

import mysetting
tweetdata = mysetting.tweetdata


if __name__ == '__main__':
    tweetdata.update({'mecabed': True}, {'$unset': {
        'noun': 1, 'verb': 1, 'adjective': 1, 'adverb': 1, 'etc': 1,
        'mecabed': 1, 'emotion': 1
    }}, False, True)  # １つ目が upsert、２つ目が multi の指定（複数行消去するため true ）
    print "success"

print "finish"
