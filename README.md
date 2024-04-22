# **Rese（リーズ）　飲食店予約サービス**							
- 登録されている飲食店を日付、時間、人数で予約することが出来ます。							
							
## **作成した目的**							
### **現状の問題**							
- 外部の飲食店予約サービスは手数料を取られる。							
- 機能や画面が複雑で使いづらい。							
							
## **アプリケーションURL**							
### ローカル環境							
#### http://localhost

### 本番環境（停止中）						
#### http://13.112.10.25
							
## **他のリポジトリ**							
- git@github.com:mitsuun0121/resepj.git　よりgit clone　【フロントエンド】							
- git@github.com:mitsuun0121/reseproject-backend.git　よりgit clone　【バックエンド】							
							
## **機能一覧**	<br>

## 【ユーザーの機能】							
### 会員登録							
- 新規会員登録ページで新規ユーザー登録							
- 会員登録時のメールアドレス宛に確認メールが送信されるメール認証機能							
###### ※後述の「注意事項」もご確認下さい							
### ログイン							
- ログインページでログイン後、ログインユーザーのトップページに遷移							
### ログアウト							
- ログアウト後、デフォルトのトップページに遷移							
### 飲食店の予約							
- 飲食店詳細ページで日付、時間、人数を決定して予約完了後、予約完了ページに遷移							
### Stripe決済							
- 予約完了ページでStripe決済を選択すると、決済画面に遷移							
### 飲食店の予約内容の変更と取消（削除）							
- マイページの予約状況から予約内容の日付、時間、人数の変更、または予約の取消（削除）ができる							
### 飲食店の予約の削除							
- マイページの予約履歴から過去の予約履歴を削除できる							
### 飲食店のお気に入り登録							
- トップページの飲食店のハートをクリック、または飲食店詳細ページのハートをクリックすることで、お気に入りが登録できる
###### ※後述の「注意事項」もご確認下さい							
### 飲食店のお気に入り削除							
- マイページでお気に入りを削除できる							
### 飲食店の口コミ投稿							
- 予約したお店に来店後、マイページの口コミ投稿から口コミを投稿できる
### 飲食店の口コミ編集							
- マイページの投稿履歴から投稿した口コミを編集できる   				
### 飲食店の口コミ削除							
- マイページの投稿履歴から口コミを削除できる							
### 飲食店の検索							
- トップページのエリアから該当するエリアのお店を検索できる							
- トップページのジャンルから該当するジャンルのお店を検索できる							
- トップページの検索ボックスにキーワードを入力してお店を検索できる
### 飲食店の並び替え							
- トップページの並び替えからランダムにお店を並び替えできる							
- トップページの並び替えから評価が高い順にお店を並び替えできる							
- トップページの並び替えから評価が低い順にお店を並び替えできる   				
### リマインダーメールの送信							
- 予約当日の朝8時に、予約者にQRコード付きのリマインダーメールが送信される<br><br>							
							
## 【管理者の機能】							
### ログイン							
- ログインページでログイン後、管理者の管理ページに遷移							
### ログアウト							
- ログアウト後、ログインページに遷移							
### 店舗代表者登録							
- 管理者の管理ページで店舗代表者を作成できる
### 新規店舗の作成							
- 管理者の管理ページでcsvファイルをインポートして新規店舗を作成できる
### 口コミの削除							
- 管理者の管理ページで全ての口コミを削除できる<br><br>				
							
## 【店舗代表者の機能】							
### ログイン							
- ログインページでログイン後、店舗代表者の管理ページに遷移							
### ログアウト							
- ログアウト後、ログインページに遷移							
### 店舗情報の更新							
- 店舗代表者の管理ページで店舗情報を更新できる							
### 予約の確認							
- 店舗代表者の管理ページで予約状況と予約履歴を確認できる							
### メール送信							
- 店舗代表者の管理ページで来店した利用者にお知らせメールを送信できる<br><br>							
							
## **使用技術（実行環境）**							
`・フロントエンド`							
・Nuxt.js　"nuxt": "^2.15.8"　"vue": "^2.7.10"

	$ git clone git@github.com:mitsuun0121/resepj.git
 	$ cd resepj
  	$ touch .env
   	.envに環境変数を設定
    API_URL=http://localhost
    STRIPE_PUBLIC_KEY=xxxxxxxxxxxxxxxxxxxxxxxxx
    
    $ curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.1/install.sh | bash
    $ nvm ls-remote
	$ nvm install 18
 	（webpackbavパッケージが、Node.jsのバージョンと非互換の場合は、Node.jsをバージョンアップする。）
							
	$ yarn install
 	$ yarn dev
							
`・バックエンド`							
・Laravel 8.x							
・PHP 8.1.18-fpm							
・MySQL 8.0.26							
・nginx 1.21.1
  				
	$ git clone git@github.com:mitsuun0121/reseproject-backend.git
 	$ docker-compose up -d --build							
	$ docker-compose exec php bash
 	$ composer install
  	$ exit
 	$ cd reseproject-backend
  	$ cd src
   	$ cp .env.example .env
    .envに環境変数を設定
     DB_CONNECTION=mysql
	 DB_HOST=mysql
	 DB_PORT=3306
	 DB_DATABASE=laravel_db
	 DB_USERNAME=laravel_user
	 DB_PASSWORD=laravel_pass
 	 MAIL_MAILER=smtp
	 MAIL_HOST=sandbox.smtp.mailtrap.io
	 MAIL_PORT=2525
	 MAIL_USERNAME=xxxxxxxxxxxxxx
	 MAIL_PASSWORD=xxxxxxxxxxxxxx
	 MAIL_ENCRYPTION=tls
	 MAIL_FROM_ADDRESS=rese@example.com
	 MAIL_FROM_NAME="${APP_NAME}"
	 MAIL_DRIVER=smtp
	 JWT_SERCRET=xxxxxxxxxxxxxxxxxxxxxxxx
	 STRIPE_PUBLIC_KEY=xxxxxxxxxxxxxxxxxxxxxxxxxxxx
	 STRIPE_SECRET_KEY=xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx
  
	$ php artisan key:generate
 	$ php artisan migrate（マイグレーション済の場合は不要）
  	$ php artisan db:seed（シーディング済の場合は不要）
							
## **テーブル設計**

usersテーブル
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| --- | --- | --- | --- | --- | --- |
| id | unsigned bigint | 〇 |  | 〇 |  |
| name | varchar(255) |  |  | 〇 |  |
| email | varchar(255) |  | 〇 | 〇 |  |
| password | varchar(255) |  |  | 〇 |  |
| confirm_token | varchar(255) |  |  |  |  |
| verified | tinyint |  |  | 〇 |  |
| access_token | varchar(255) |  |  |  |  |
| created_at | timestamp |  |  |  |  |
| updated_at | timestamp |  |  |  |  |

shopsテーブル
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| --- | --- | --- | --- | --- | --- |
| id | unsigned bigint | 〇 |  | 〇 |  |
| area_id | unsigned bigint |  |  | 〇 | areas(id) |
| genre_id | unsigned bigint |  |  | 〇 | genres(id) |
| name | varchar(255) |  |  | 〇 |  |
| description | text |  |  | 〇 |  |
| photo_url | varchar(255) |  |  | 〇 |  |
| created_at | timestamp |  |  |  |  |
| updated_at | timestamp |  |  |  |  |					
							
areasテーブル
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| --- | --- | --- | --- | --- | --- |
| id | unsigned bigint | 〇 |  | 〇 |  |
| name | varchar(255) |  |  | 〇 |  |
| created_at | timestamp |  |  |  |  |
| updated_at | timestamp |  |  |  |  |			
							
genresテーブル
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| --- | --- | --- | --- | --- | --- |
| id | unsigned bigint | 〇 |  | 〇 |  |
| name | varchar(255) |  |  | 〇 |  |
| created_at | timestamp |  |  |  |  |
| updated_at | timestamp |  |  |  |  |	
				
							
favoritesテーブル
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| --- | --- | --- | --- | --- | --- |
| id | unsigned bigint | 〇 |  | 〇 |  |
| user_id | unsigned bigint |  |  | 〇 | users(id) |
| shop_id | unsigned bigint |  |  | 〇 | shops(id) |
| created_at | timestamp |  |  |  |  |
| updated_at | timestamp |  |  |  |  |				
							
reservationsテーブル
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| --- | --- | --- | --- | --- | --- |
| id | unsigned bigint | 〇 |  | 〇 |  |
| user_id | unsigned bigint |  |  | 〇 | users(id) |
| shop_id | unsigned bigint |  |  | 〇 | shops(id) |
| date | date |  |  | 〇 |  |
| time | time |  |  | 〇 |  |
| count | int |  |  | 〇 |  |
| created_at | timestamp |  |  |  |  |
| updated_at | timestamp |  |  |  |  |	

				
							
scoresテーブル
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| --- | --- | --- | --- | --- | --- |
| id | unsigned bigint | 〇 |  | 〇 |  |
| user_id | unsigned bigint |  |  | 〇 | users(id) |
| shop_id | unsigned bigint |  |  | 〇 | shops(id) |
| title | varchar(255) |  |  | 〇 |  |
| review | int |  |  | 〇 |  |
| comment | text |  |  | 〇 |  |
| image | varchar(255) |  |  | 〇 |  |
| created_at | timestamp |  |  |  |  |
| updated_at | timestamp |  |  |  |  |	
				
							
adminsテーブル
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| --- | --- | --- | --- | --- | --- |
| id | unsigned bigint | 〇 |  | 〇 |  |
| name | varchar(255) |  |  | 〇 |  |
| email | varchar(255) |  | 〇 | 〇 |  |
| password | varchar(255) |  |  | 〇 |  |
| access_token | varchar(255) |  |  |  |  |
| created_at | timestamp |  |  |  |  |
| updated_at | timestamp |  |  |  |  |
					
ownersテーブル
| カラム名 | 型 | PRIMARY KEY | UNIQUE KEY | NOT NULL | FOREIGN KEY |
| --- | --- | --- | --- | --- | --- |
| id | unsigned bigint | 〇 |  | 〇 |  |
| shop_id | unsigned bigint |  |  | 〇 | shops(id) |
| name | varchar(255) |  |  | 〇 |  |
| email | varchar(255) |  | 〇 | 〇 |  |
| password | varchar(255) |  |  | 〇 |  |
| access_token | varchar(255) |  |  |  |  |
| created_at | timestamp |  |  |  |  |
| updated_at | timestamp |  |  |  |  |			
							
## **ER図**							
![rese-er](https://github.com/mitsuun0121/reseproject-backend/assets/130974761/5d81116f-28f2-4a45-9e48-a7c800e5e6dd)
								
## **注意事項**							
- 登録時に送られてくる確認メールのリンクでメール認証を行うことで、ログイン可能になります。							
- ログインユーザー以外は、お気に入り登録が出来ません。<br><br>
- 管理ユーザー：管理者　メールアドレス：example@gmail.com　パスワード：1234abcd
- テストユーザー1：山田　太郎　メールアドレス：taro@example.com　パスワード：1234abcd
- テストユーザー2：山田　花子　メールアドレス：hanako@example.com　パスワード：1234abcd
## **csvファイルの記述方法**
- スプレッドシートのファイルから、ダウンロード ➡ カンマ区切り形式（.csv）を選択する。
- ダウンロードされたファイルに名前をつけて、VSCode上で作成する。（※すべてカンマで区切って余白がないように注意して記述）<br><br>
＜記述例＞<br>
1行目　店舗名,地域,ジャンル,店舗概要,画像URL,（ここで改行）<br>
2行目　味ノ屋,福岡県,居酒屋,福岡県の繁華街、天神にひっそり佇む、地元の人々に愛される居酒屋「味の屋」へようこそ。当店では、新鮮な地元食材を使った料理と、心温まるサービスがお客様をお待ちしています。,https://coachtech-matter.s3-ap-northeast-1.amazonaws.com/image/izakaya.jpg,<br><br>
![スクリーンショット 2024-04-22 163545](https://github.com/mitsuun0121/reseproject-backend/assets/130974761/420c606e-bf7a-4011-b9bb-521a83f4f87c)<br>
- ファイルを保存して完了
							
## 提出用スプレッドシート				
			
-https://docs.google.com/spreadsheets/d/1ImF0kXs3xpH6S7PEWeksWbk0AWfmMNybJNw9PuMBShA/edit#gid=1270192593
														
# reseproject-backend
