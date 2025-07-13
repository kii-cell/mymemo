# MyMemo（Laravel製ログイン付きメモ管理アプリ）

## 🔍 概要

Laravel Breezeをベースにした、ログイン付きのメモ管理アプリです。  
ユーザーはログイン後、自分だけのメモを作成・編集・削除できます。

## 🛠 使用技術

- PHP 8.x
- Laravel 11
- MySQL
- Laravel Breeze（認証機能）
- Vite（フロントエンドビルド）
- Git / GitHub

## 📷 画面キャプチャ（※あとで画像追加予定）

※ここにログイン画面やメモ一覧などの画像を追加していくと好印象

## 📌 機能一覧

- ユーザー登録 / ログイン / ログアウト
- メモの新規作成・一覧表示
- メモの編集・削除
- ログインユーザーごとにメモを管理

## 💬 今後追加したい機能（任意）

- メモへのタグ付け・検索機能
- メモのピン留め
- モバイル対応UI調整

## 🚀 セットアップ方法

```bash
git clone https://github.com/<your-name>/mymemo.git
cd mymemo
composer install
cp .env.example .env
php artisan key:generate
npm install && npm run dev
php artisan migrate
php artisan serve