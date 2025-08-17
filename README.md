MyMemo（Laravel製ログイン付きメモ管理アプリ）

🔍 概要

Laravel Breezeをベースにしたログイン機能付きメモ管理アプリです。
ユーザーはログイン後、自分だけのメモを作成・編集・削除できます。
学習成果として、Laravelの基本機能、CRUD操作、認証、ピン留めやタグ付けなどの機能を体験することを目的に作成しました。

💬 開発の経緯・ストーリー

未経験からLaravelを学習しながら、日常で使えるメモアプリを作ることで、
	•	認証機能の理解
	•	CRUD操作の実装
	•	UI/UX改善の経験
を積むために開発しました。

🛠 使用技術
	•	フロント / クライアント: Bootstrap 5, Vite
	•	サーバーサイド: PHP 8.x, Laravel 11, Laravel Breeze
	•	DB: MySQL
	•	その他 / バージョン管理: Git / GitHub

📌 実装済み機能
	•	ユーザー登録・ログイン・ログアウト
	•	メモの新規作成・一覧表示・詳細表示
	•	メモの編集・削除
	•	ログインユーザーごとのメモ管理（他ユーザーのメモにはアクセス不可）
	•	バリデーション（未入力や文字数制限など）
	•	メモのピン留め（優先表示）
	•	タグ付け・タグによるフィルタリング
	•	モバイル対応UI（レスポンシブ対応）

💡 今後追加予定の機能
	•	メモのアーカイブ機能
	•	より高度な検索・並び替え

📷 画面キャプチャ

※後日追加予定

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