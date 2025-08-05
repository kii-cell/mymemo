# MyMemo（Laravel製ログイン付きメモ管理アプリ）

## 🔍 概要
Laravel Breezeをベースにした、**ログイン機能付きのメモ管理アプリ**です。  
ユーザーはログイン後、自分だけのメモを作成・編集・削除できます。  
「Laravelを使って何ができるか？」を体験しながら実装した、学習成果を示すプロジェクトです。

---

## 🛠 使用技術

- PHP 8.x
- Laravel 11
- MySQL
- Laravel Breeze（認証機能）
- Bootstrap 5
- Vite（フロントエンドビルド）
- Git / GitHub

---

## 📷 画面キャプチャ  
※後日追加予定

---

## 📌 実装済み機能

- ユーザー登録 / ログイン / ログアウト（Breeze）
- メモの新規作成・一覧表示・詳細表示
- メモの編集・削除
- **ログインユーザーごとのメモ管理**
  - 他のユーザーのメモにはアクセスできません
  - 自分のメモだけ表示・編集・削除できます
- バリデーション（未入力や文字数制限など）

---

## 💬 今後追加したい機能

- メモへのタグ付け・タグによる検索機能
- メモのピン留め（優先表示）
- モバイル対応のUI改善（より柔軟なレスポンシブ対応）
- 検索機能や並び替え
- メモのアーカイブ機能

---

## 🚀 セットアップ方法（ローカル環境）

```bash
git clone https://github.com/<your-name>/mymemo.git
cd mymemo
composer install
cp .env.example .env
php artisan key:generate
npm install && npm run dev
php artisan migrate
php artisan serve