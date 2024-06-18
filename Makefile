# コンテナ起動
up:
	docker compose up -d
# 起動とビルド
up-build:
	docker compose up -d --build
# キャッシュを削除してビルド
build:
	docker compose build --no-cache --force-rm
# コンテナ破棄
down:
	docker compose down --remove-orphans
#db root接続
db-root:
	docker compose exec db mysql -u root -p
# マイグレーション実行
migrate:
	docker compose exec app php artisan migrate
# マイグレーションのロールバック
rollback:
	docker compose exec app php artisan migrate:rollback
# DBリセット
fresh:
	docker compose exec app php artisan migrate:fresh --seed
# Seeder実行
seed:
	docker compose exec app php artisan db:seed
# Seeder実行（クラス指定）
seed-c:
	docker compose exec app php artisan db:seed --class=${CLASS}
# Laravel Tinker
tinker:
	docker compose exec app php artisan tinker
# 全体テスト
test:
	docker compose exec app php artisan test
# feature test（指定）
test-f:
	docker compose exec app php artisan test tests/Feature/${FILE}.php
# unit test（指定）
test-u:
	docker compose exec app php artisan test tests/Unit/${FILE}.php
# キャッシュ生成（基本的にデプロイ時）
optimize:
	docker compose exec app php artisan optimize
# キャッシュクリア
optimize-clear:
	docker compose exec app php artisan optimize:clear
# キャッシュ生成（基本的にデプロイ時）
cache:
	docker compose exec app composer dump-autoload -o
	@make optimize
	docker compose exec app php artisan event:cache
	docker compose exec app php artisan view:cache
# キャッシュクリア
cache-clear:
	docker compose exec app composer clear-cache
	@make optimize-clear
	docker compose exec app php artisan event:clear
# キュー稼働
queue:
	docker compose exec app php artisan queue:work
	docker compose exec app php artisan queue:work --stop-when-empty
# スケジュールの実行
schedule-run:
	docker compose exec app php artisan schedule:run
# 定義したルーティング一覧
route-list:
	docker compose exec app php artisan route:list
# イベント生成
event-generate:
	docker compose exec app php artisan event:generate
# イベント作成
event:
	docker compose exec app php artisan make:event ${NAME}
# モデル作成
model:
	docker compose exec app php artisan make:model ${NAME}
# コントローラ作成
controller:
	docker compose exec app php artisan make:controller ${NAME}Controller
# リソースコントローラ作成
controller-r:
	docker compose exec app php artisan make:controller ${NAME}Controller --resource
# APIリソースコントローラ作成
controller-a:
	docker compose exec app php artisan make:controller ${NAME}Controller --api
# フォームリクエスト作成
request:
	docker compose exec app php artisan make:request ${NAME}Request
# マイグレーション作成
migration:
	docker compose exec app php artisan make:migration ${NAME}
# マイグレーション作成（テーブル作成）
migration-c:
	docker compose exec app php artisan make:migration create_${NAME}_table
# シーダー作成
seeder:
	docker compose exec app php artisan make:seeder ${NAME}Seeder
# ファクトリー作成
factory:
	docker compose exec app php artisan make:factory ${NAME}Factory
# テスト作成
test-file-f:
	docker compose exec app php artisan make:test ${NAME}Test
# テスト作成
test-file-u:
	docker compose exec app php artisan make:test ${NAME}Test --unit
# provider作成
provider:
	docker compose exec app php artisan make:provider ${NAME}Provider
# facade作成
facade:
	docker compose exec app php artisan make:facade ${NAME}Facade
# service作成
service:
	docker compose exec app php artisan make:service ${NAME}
# repository作成
repository:
	docker compose exec app php artisan make:repository ${NAME}
# ruleの作成
rule:
	docker compose exec app php artisan make:rule ${NAME}
# notificationの作成
notification:
	docker compose exec app php artisan make:notification ${NAME}Notification
# exceptionの作成
exception:
	docker compose exec app php artisan make:exception ${NAME}Exception
# resourceの作成
resource:
	docker compose exec app php artisan make:resource ${NAME}Resource
# resource collectionの作成
resource-c:
	docker compose exec app php artisan make:resource ${NAME}Collection
# resource collectionの作成
view:
	docker compose exec app php artisan make:view ${NAME}
# middlewareの作成
middleware:
	docker compose exec app php artisan make:middleware ${NAME}Middleware
# castの作成
cast:
	docker compose exec app php artisan make:cast ${NAME}
combo:
	docker compose exec app php artisan make:controller Resource/${NAME}Controller --api
	docker compose exec app php artisan make:service Resource/${NAME}Service
	docker compose exec app php artisan make:repository ${NAME}Repository
	docker compose exec app php artisan make:resource Resource/${NAME}/${NAME}Resource
	docker compose exec app php artisan make:resource Resource/${NAME}/${NAME}Collection
	docker compose exec app php artisan make:interface Repository/${NAME}/${NAME}Interface
	docker compose exec app php artisan make:interface Service/Resource/${NAME}Interface
	docker compose exec app php artisan make:request Resource/${NAME}/${NAME}IndexRequest
	docker compose exec app php artisan make:request Resource/${NAME}/${NAME}StoreRequest
	docker compose exec app php artisan make:request Resource/${NAME}/${NAME}UpdateRequest
policy:
	docker compose exec app php artisan make:policy ${NAME}Policy
policy-m:
	docker compose exec app php artisan make:policy ${NAME}Policy --model=${NAME}
command:
	docker compose exec app php artisan make:command ${NAME}
entity:
	docker compose exec app php artisan make:entity ${NAME}
usecase:
	docker compose exec app php artisan make:usecase ${NAME}