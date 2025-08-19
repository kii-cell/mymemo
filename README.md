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

![メモ一覧](https://github.com/user-attachments/assets/af92bbe8-3741-4896-9657-9812c7a8d89b)
![タグ検索](https://github.com/user-attachments/assets/cfce3917-1ce9-4c47-b30f-70af948efdf2)
![ピン留め](https://github.com/user-attachments/assets/1181d6ac-8eaf-4b38-b7f2-2c3faea7c85b)
![ゴミ箱](https://github.com/user-attachments/assets/18f10b66-9b7a-4396-bbc4-1e37047759a1)

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
