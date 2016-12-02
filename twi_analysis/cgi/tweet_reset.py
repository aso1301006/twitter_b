#!/usr/bin/env python
# -*- coding: utf-8 -*-

import mysetting
tweetdata = mysetting.tweetdata


if __name__ == '__main__':
    tweetdata.update({}, {'$unset': {
        'noun': 1, 'verb': 1, 'adjective': 1, 'adverb': 1, 'undefined': 1,
        'mecabed': 1, 'emotion': 1, 'emotion_point': 1
    }}, multi=True)  # １つ目が upsert、２つ目が multi の指定（複数行消去するため true ）
    print mysetting.RETURN_STRING_SUCCESS

    print mysetting.RETURN_STRING_FINISH
