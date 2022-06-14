pull:
	git pull;

build:
	cd workspace/myapp/
	docker-compose  -f workspace\myapp\docker-compose.yml build --no-cache

up:
	cd workspace/myapp/
	docker-compose -f workspace\myapp\docker-compose.yml up -d

down:
	cd workspace/myapp/
	docker-compose -f workspace\myapp\docker-compose.yml down

app-init:
	cd workspace/myapp/
	docker-compose exec app cp .env.example .env
	docker-compose exec app composer install
	docker-compose exec app apk add npm

app-seeder:
	cd workspace/myapp/
	docker-compose exec app php artisan db:seed

app-migrate:
	cd workspace/myapp/
	docker-compose exec app php artisan migrate

web-init:
	cd workspace/myapp/nuxt/
	yarn install


