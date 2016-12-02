#!/usr/bin/env python
# -*- coding: utf-8 -*-

from sklearn.feature_extraction.text import CountVectorizer
import time
import datetime
import numpy
import mysetting
import sys
# import codecs
# sys.stdout = codecs.getwriter("utf-8")(sys.stdout)
tweetdata = mysetting.tweetdata


def str_to_date_jp(str_date):
    if str_date is not None:
        return datetime.datetime.strptime(str_date, '%Y-%m-%d %H:%M:%S')
    else:
        return None


# 形態素分解および感情値算出が終わったものを抽出
def get_mecabed_strings(
    user_id=None, from_date_str=None, to_date_str=None, word=None, *etc
):
    tweet_list = []

    from_date = str_to_date_jp(from_date_str)
    to_date = str_to_date_jp(to_date_str)

    # 取得対象期間の条件設定
    # 開始期間 以降 終了期間 より前 で検索を行う
    if (from_date_str is not None) and (to_date_str is not None):
        query = {'created_at': {"$gte": from_date, "$lt": to_date}}
    elif (from_date_str is not None) and (to_date_str is None):
        query = {'created_at': {"$gte": from_date}}
    elif (from_date_str is None) and (to_date_str is not None):
        query = {'created_at': {"$lt": to_date}}
    else:
        query = {}

    # 抽出するユーザIDの指定
    if user_id is not None:
        query['user_id'] = user_id

    # 指定された単語を含むツイートを検索
    if word is not None:
        word = word.decode('utf-8')
        query['$or'] = [  # 与えられた単語が辞書のキーに存在するか
            {'noun.' + word: {'$exists': 1}},
            {'adjective.' + word: {'$exists': 1}}
        ]

    # 形態素解析や感情値分析されているものだけを抽出
    query['mecabed'] = True
    query['emotion'] = True

    # 指定した条件のツイートを取得
    for d in tweetdata.find(query, {
        'noun': 1,
        # 'verb': 1,
        'adjective': 1
        # 'adverb': 1,
    }):
        tweet = ""
        # Mecabで分割済みの単語をのリストを作成
        if 'noun' in d:
            for word, point in d['noun'].items():
                if point is not None:
                    tweet += word + " "
        if 'adjective' in d:
            for word, point in d['adjective'].items():
                if point is not None:
                    tweet += word + " "
        tweet_list.append(tweet)
    return tweet_list


if __name__ == '__main__':
    start = time.time()

    argvs = sys.argv  # コマンドライン引数の取得（すべて文字列で取得される）
    argc = len(argvs)
    if argc == 1:  # コマンドライン引数が指定されていない場合
        tw_list = get_mecabed_strings()
    elif 2 <= argc & argc <= 5:
        del argvs[0]  # 0番目にはモジュール名が入っているため
        tw_list = get_mecabed_strings(*argvs)
    else:
        sys.exit("引数が必要以上に指定されています")

    if tw_list == []:
        print mysetting.RETURN_STRING_SUCCESS
        print u"該当するツイートがありませんでした"
    else:
        if argc == 5:
            stop_word = argvs[3].decode('utf-8')  # コマンドライン引数はマルチバイトのためデコード
            c_vec = CountVectorizer(stop_word)
        else:
            c_vec = CountVectorizer()
        c_vec.fit(tw_list)
        c_terms = c_vec.get_feature_names()
        c_tran = c_vec.transform([" ".join(tw_list)])
        c_tranarr = c_tran.toarray()
        arg_ind = numpy.argsort(c_tranarr)[0][::-1][:5]

        count_result = {}
        for i in arg_ind:
            key = c_terms[i]
            value = c_tranarr[0][i]
            count_result[key] = value

        # count_result が存在すれば更新、なければ挿入する
        tweetdata.update({}, {'count_result': count_result}, upsert=True)
        print mysetting.RETURN_STRING_SUCCESS

    print mysetting.RETURN_STRING_FINISH
    elapsed_time = time.time() - start
    print "elapsed_time:{0}".format(elapsed_time) + "[sec]"
