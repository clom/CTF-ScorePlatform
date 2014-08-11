CTF-ScorePlatform
=================

Project misaka CTF Platform

## これはなに?
seccon CTF のオンライン予選を受けて、自分でもスコアサーバ作れたらいいなってことで作りました

## インストール方法
* まず `git clone` をしましょう、そして使用するWebサーバに設置してください

`git clone https://github.com/clom/CTF-ScorePlatform.git`
* 次に `conf.php` のファイルを自分が使用している環境に編集をしてください
* データベースに必要なテーブルはすべて `sql.txt` 上に記載しています
* ユーザ登録は手動で登録するため、 auth テーブルに user と パスワード`sha1`を追加してあげると使用できます。

## 最後に
* 修正や機能を追加したという人がいらっしゃいましたら遠慮なく pull request 等送ってください。

