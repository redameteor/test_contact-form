# FashionablyLate (お問い合わせ管理システム)

## 機能一覧
- ユーザー認証機能
 - 新規登録 / ログイン / ログアウト
- お問い合わせ入力機能
 - 入力フォーム / 確認画面 / 完了画面
- 管理機能(ログインユーザーのみ)
 - お問い合わせ一覧表示
 - データの詳細表示 / データの削除
 - 詳細条件による検索機能
 - CSVエクスポート
 - ページネイション

## 環境構築
- docker compose exec php bash
- composer install
- cp .envexample .env
- php artisan make:controller ContactController
- php artisan make:migration create_contacts_table
- php artisan make:maigration create_categories_table
- php artisan make:model Contact
- php artisan make:seeder CategoriesTableSeeder
- php artisan make:model Category
- php artisan db:seed --class=CategoriesTableSeeder
- composer require laravel/fortify
- php artisan vendor:publish --provider="Laravel\Fortify\FortifyServiceProvider"
- composer require laravel-lang/lang:~7.0 --dev
- cp -r ./vendor/laravel-lang/lang/src/ja ./resources/lang/
- php artisan make:controller AuthController
- php artisan make:request ContactRequest

## 使用技術
- Laravel 8.83.8
- PHP 8.1
- Mysql 8.0.26
- nginx 1.21.1

## 画面設計
- お問い合わせフォーム入力ページ	http://localhost
- お問い合わせフォーム確認ページ	/confirm
- サンクスページ	/thanks
- 管理画面	/admin
- ユーザ登録	/register
- ログイン	/login

## ＥＲ図
![ER図](./er-diagram.png)