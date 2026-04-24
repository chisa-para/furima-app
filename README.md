# test_contact-form

```markdown
# COACHTECHフリマアプリ

## 1. 概要

Laravelを使用した、個人同士での商品の売り買いが可能なフリマアプリです。

## 2. 環境構築の手順

Dockerビルド
1. `git clone git@github.com:chisa-para/furima-app.git`
2. docker run --rm \
3. -u "$(id -u):$(id -g)" \
4. -v "$(pwd):/var/www/html" \
5. -w /var/www/html \
6. laravelsail/php83-composer:latest \
7. composer install --ignore-platform-reqs
8. ./vendor/bin/sail up -d --build

Laravel環境構築
1.`cp .env.example .env`
　.env内の各項目の値を下記のように変更
　・DB_HOST=mysql
　・DB_DATABASE=laravel
　・DB_USERNAME=sail
　・DB_PASSWORD=password

　・MAIL_HOST=mailhog

2. `./vendor/bin/sail php artisan key:generate`
3. `./vendor/bin/sail php artisan migrate`
4. `./vendor/bin/sail php artisan db:seed`

## 3. 開発環境

・商品一覧画面:http://localhost/
・ユーザー登録:http://localhost/register
・ログイン登録:http://localhost/login
　　シーダー登録ユーザー：山田一郎（メールアドレス＝Yamada@example.com、パスワード＝321Double、出品商品＝腕時計・マイク）
　　　　　　　　　鈴木花子（メールアドレス＝hanako@example.com、パスワード＝furima875、出品商品＝玉ねぎ・ショルダーバッグ・メイクセット）
　　　　　　　　　瓜田杉郎（メールアドレス＝uritai@example.com、パスワード＝100items、出品商品＝HDD・革靴・PC・タンブラー・コーヒーミル）
・phpMyAdmin:http://localhost:8080/



## 4. 使用技術（実行環境）

- PHP 8.3
- Laravel 13.0
- MySQL 8.4
- nginx / Laravel Sail
- Docker / Docker Desktop
- Composer, npm, Stripe API
```

## 5.ER図