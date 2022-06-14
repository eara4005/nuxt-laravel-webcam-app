# webcam-app ローカル環境構築

・Docker Node.js Git の環境が整っていることが前提

目次

1. [ソースコードのダウンロード](#dl)
1. [仮想環境の立ち上げ](#build)

<a id="dl"></a>

## ソースコードのダウンロード

<a id="build"></a>

## 仮想環境を立ち上げ
作業ディレクトリまで移動
```
$ cd workspace/myapp/
```
環境変数(.env)のコピー
```
$ cp .env.example .env
```
ビルド
```
$ docker-compose build --no-cache
```
コンテナの立ち上げ
```
$ docker-compose up -d
```
バックエンド初期化
```
cd laravel
cp .env.example .env
cd ../
$ docker-compose exec app sh
/var/www/laravel # composer install
/var/www/laravel # apk add npm
/var/www/laravel # npm install
/var/www/laravel # npm run dev
/var/www/laravel # php artisan key:generate
/var/www/laravel # exit
```
フロントエンド初期化
```
$ cd nuxt/
$ yarn install
$ cd ../
```
db初期化
```
$ docker-compose exec app php artisan migrate
$ docker-compose exec app php artisan db:seed --class=NecomataSeeder
$ docker-compose exec app php artisan migrate
```
再起動
```
docker-compose down
docker-compose up -d
```
アクセス  
http://localhost:3000  

停止
```
docker-compose down
```