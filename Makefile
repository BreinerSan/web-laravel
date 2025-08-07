up:
	docker-compose up -d

down:
	docker-compose down

restart:
	docker-compose restart

build:
	docker-compose build --parallel

rebuild:
	docker-compose build --no-cache --parallel

fresh:
	docker-compose down -v && docker-compose build --no-cache && docker-compose up -d

# Comandos optimizados
install:
    docker-compose exec app composer install --no-dev --optimize-autoloader
    docker-compose exec app pnpm install

setup:
    make install
    docker-compose exec app php artisan key:generate
    docker-compose exec app php artisan migrate
    docker-compose exec app php artisan db:seed

bash:
	docker exec -it laravel-app sh

migrate:
	docker exec -it laravel-app php artisan migrate

seed:
	docker exec -it laravel-app php artisan db:seed

npm-install:
	docker exec -it laravel-app npm install

npm-dev:
	docker exec -it laravel-app npm run dev

pnpm-install:
    docker-compose exec app pnpm install

pnpm-dev:
    docker-compose exec app pnpm dev

artisan:
	docker exec -it laravel-app php artisan

# Comandos de limpieza
clean:
    docker system prune -f
    docker volume prune -f

logs:
    docker-compose logs -f app
