# mogitate

## 環境構築

### Docker ビルド

1. git clone git@github.com:masaroro/mogitate.git
2. DockerDesktop アプリを立ち上げ
3. docker-compose up -d --build

### Laravel 環境構築

1. docker-compose exec php bash
2. composer install
3. 「.env.example」ファイルを 「.env」ファイルに命名を変更。または、.env ファイルを作成
4. env 以下の環境変数を追加  
   　 DB_CONNECTION=mysql<br>
   　 DB_HOST=mysql<br>
   　 DB_PORT=3306<br>
   　 DB_DATABASE=laravel_db<br>
   　 DB_USERNAME=laravel_user<br>
   　 DB_PASSWORD=laravel_pass<br>
5. php artisan key:generate
6. php artisan migrate
7. php artisan storage:link
8. php artisan db:seed

## 使用技術(実行環境)

- PHP 7.4.9
- Laravel 8.83.8
- MySQL 8.0.26

## ER 図

![index](https://github.com/user-attachments/assets/1cabd94f-61c3-4785-a35a-b957ec4eb04d)

## URL

- 開発環境：http://localhost/products
- phpMyAdmin:：http://localhost:8080/
