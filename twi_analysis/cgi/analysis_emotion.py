#!/usr/bin/env python
# -*- coding: utf-8 -*-

import mysetting
tweetdata = mysetting.tweetdata
nega_pogi = mysetting.nega_pogi


# DBから辞書型の変数に取り出す
def db_in_dict():
    temp_dict = {}
    # 単語と評価点だけを取り出し（読みと品詞名は除外）
    for line in nega_pogi.find({}, {'_id': 0}):
        temp_dict[line['word']] = line['point']
    return temp_dict


# 受け取った key で data を検索してみて、存在したらその値を返す
def isexist_and_get_data(data, key):
    return data[key] if key in data else None


# -1 〜 1の範囲で与えられた文章（単語リスト）に対する感情値を返す。(1: 最もポジ、-1:最もネガ)
def get_emotion(word_list):
    val_list = {}
    np_dict = db_in_dict()
    for key, line in word_list.items():
        temp_list = {}
        for word in line:
            temp_list[word] = isexist_and_get_data(np_dict, word)
        val_list[key] = temp_list
    return val_list


def get_score(word_list):
    score = 0
    word_count = 0
    for line in word_list.values():
        for val in line.values():
            if val is not None and val != 0:  # 見つかればスコアを足し合わせて単語カウントする
                score += val
                word_count += 1
    return score / float(word_count) if word_count != 0. else 0.


if __name__ == '__main__':
    # 感情値を算出するべきものだけ抽出
    for d in tweetdata.find({'mecabed': True, 'emotion': {'$ne': True}}, {
        '_id': 1, 'noun': 1, 'verb': 1, 'adjective': 1, 'adverb': 1
    }):
        # _id は邪魔なので変数に退避して削除する
        db_id = d['_id']
        del d['_id']

        # 形態素解析で分解された単語に感情値を追加した辞書を取得
        point_list = get_emotion(d)
        # 感情値の平均値を算出する
        total_score = get_score(point_list)

        for k, v in point_list.items():
            tweetdata.update({'_id': db_id}, {'$set': {k: v}})
        # 感情値を算出したというフラグを追加
        tweetdata.update(
            {'_id': db_id}, {'$set': {'emotion': True}})
        tweetdata.update(
            {'_id': db_id}, {'$set': {'emotion_point': total_score}})
    print "success"

print "finish"
