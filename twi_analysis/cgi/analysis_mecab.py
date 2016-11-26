#!/usr/bin/env python
# -*- coding: utf-8 -*-

import time
import MeCab
import mysetting
from collections import defaultdict
import unicodedata
tweetdata = mysetting.tweetdata


# mecab 形態素分解
def mecab_analysis(sentence):
    t = MeCab.Tagger('-Ochasen')
    sentence = sentence.replace('\n', ' ')
    text = sentence.encode('utf-8')
    node = t.parseToNode(text)
    result_dict = defaultdict(list)
    for i in range(140):  # ツイートなのでMAX140文字
        if node.surface != "":  # ヘッダとフッタを除外
            word_type = node.feature.split(",")[0]
            # if word_type in ["名詞", "形容詞", "動詞", "副詞"]:
            if word_type not in ["名詞", "形容詞", "動詞", "副詞"]:
                word_type = "その他"
            plain_word = node.feature.split(",")[6]
            if plain_word != "*":
                key = word_type.decode('utf-8')
                value = plain_word.decode('utf-8')
                result_dict[key].append(value)
        node = node.next
        if node is None:
            break
    return result_dict


if __name__ == '__main__':
    try:
        start = time.time()
        # mecabedがtrueのものはすでに分解されているので除外する
        for d in tweetdata.find({'mecabed': {'$ne': True}}, {
            '_id': 1, 'id': 1, 'text': 1,
            # 'noun': 1, 'verb': 1, 'adjective': 1, 'adverb': 1
        }):
            # 半角カナを全角カナに
            twitter_text = unicodedata.normalize('NFKC', d['text'])
            res = mecab_analysis(twitter_text)

            # 品詞毎にフィールド分けして入れ込んでいく
            for k in res.keys():
                word_list = []
                pos = ""

                for w in res[k]:
                    word_list.append(w)

                # 品詞ごとにフィールドを分ける
                if k == u'形容詞':
                    pos = "adjective"
                elif k == u'動詞':
                    pos = "verb"
                elif k == u'名詞':
                    pos = "noun"
                elif k == u'副詞':
                    pos = "adverb"
                elif k == u"その他":
                    pos = u"undefined"

                tweetdata.update({'_id': d['_id']}, {
                    '$push': {pos: {'$each': word_list}}
                })

            # 形態素解析済みのツイートにMecabedフラグの追加
            tweetdata.update({'_id': d['_id']}, {'$set': {'mecabed': True}})
    # RuntimeError は mecab 処理中に発生したエラー
    except RuntimeError as e:
        print "RuntimeError:" + e.message
    except Exception as e:
        print "Exception:" + e.message
    except:
        print mysetting.RETURN_STRING_ERROR
    else:
        print mysetting.RETURN_STRING_SUCCESS

print mysetting.RETURN_STRING_FINISH
elapsed_time = time.time() - start
print "elapsed_time:{0}".format(elapsed_time) + "[sec]"
