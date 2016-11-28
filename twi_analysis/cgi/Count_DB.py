#!/usr/bin/env python
# -*- coding: utf-8 -*-

from sklearn.feature_extraction.text import CountVectorizer
from collections import defaultdict
from collections import Counter
import time
import numpy
import mysetting
import analysis_emotion as emo
import sys
import codecs
sys.stdout = codecs.getwriter("utf-8")(sys.stdout)
tweetdata = mysetting.tweetdata


def str_to_date_jp(str_date):
    if str_date is not None:
        return datetime.datetime.strptime(str_date, '%Y-%m-%d %H:%M:%S')
    else:
        return None


# 形態素分解および感情値算出が終わったものを抽出
def get_mecabed_strings(
    user_id=None, from_date_str=None, to_date_str=None
):
    tweet_list = []
    tweet_texts = []
    pos_list = []

    # from_date = str_to_date_jp_utc(from_date_str)
    # to_date = str_to_date_jp_utc(to_date_str)
    from_date = from_date_str
    to_date = to_date_str

    # 取得対象期間の条件設定
    if (from_date_str is not None) and (to_date_str is not None):
        query = {'created_datetime': {"$gte": from_date, "$lt": to_date}}
    elif (from_date_str is not None) and (to_date_str is None):
        query = {'created_datetime': {"$gte": from_date}}
    elif (from_date_str is None) and (to_date_str is not None):
        query = {'created_datetime': {"$lt": to_date}}
    else:
        query = {}

    # 抽出するユーザIDの指定
    if user_id is not None:
        # query['user_id'] = user_id
        query['id'] = user_id

    # 形態素解析や感情値分析されているものだけを抽出
    query['mecabed'] = True
    query['emotion'] = True

    # 指定した条件のツイートを取得
    for d in tweetdata.find(query, {
        'noun': 1,
        # 'verb': 1,
        'adjective': 1,
        # 'adverb': 1,
        'text': 1
    }):
        tweet = ""
        # Mecabで分割済みの単語をのリストを作成
        if 'noun' in d:
            for word in d['noun']:
                tweet += word + " "
                pos_list.append(u'名詞')
        # if 'verb' in d:
        #     for word in d['verb']:
        #         tweet += word + " "
        if 'adjective' in d:
            for word in d['adjective']:
                tweet += word + " "
                pos_list.append(u'形容詞')
        # if 'adverb' in d:
        #     for word in d['adverb']:
        #         tweet += word + " "
        tweet_list.append(tweet)
        tweet_texts.append(d['text'])
    ret_dict = {
        "tweet_list": tweet_list, "tweet_texts": tweet_texts,
        "pos_list": pos_list
    }
    return ret_dict


ret = get_mecabed_strings()
tw_list = ret['tweet_list']
pos_list = ret['pos_list']

start = time.time()

c_vec = CountVectorizer()
c_vec.fit(tw_list)
c_terms = c_vec.get_feature_names()
c_tran = c_vec.transform([" ".join(tw_list)])
c_tranarr = c_tran.toarray()
arg_ind = numpy.argsort(c_tranarr)[0][:-50:-1]

elapsed_time = time.time() - start

# print mysetting.RETURN_STRING_SUCCESS
# print tw_list
# print c_terms
# print tw_list
# print c_tran.toarray()
for i in arg_ind:
    emotion = emo.isexist_and_get_data(c_terms[i])
    print c_terms[i], pos_list[i], emotion, c_tranarr[0][i]
# print mysetting.RETURN_STRING_FINISH
print "elapsed_time:{0}".format(elapsed_time) + "[sec]"

# start = time.time()

# counter = Counter(ret)


# elapsed_time = time.time() - start
