up:
	docker-compose up -d

down:
	docker-compose down

restart:
	docker-compose down && docker-compose up -d

bash:
	docker exec -it laravel-app bash

migrate:
	docker exec -it laravel-app php artisan migrate

seed:
	docker exec -it laravel-app php artisan db:seed

npm-install:
	docker exec -it laravel-app npm install

npm-dev:
	docker exec -it laravel-app npm run dev

artisan:
	docker exec -it laravel-app php artisan

