init: docker-stop docker-pull docker-build docker-up-d
init-dev: docker-stop docker-pull docker-build docker-up

docker-stop:
	docker-compose down --remove-orphans

docker-pull:
	docker-compose pull

docker-build: 
	docker-compose build

docker-up:
	docker-compose up

docker-up-d:
	docker-compose up -d

api-permissions:
	docker run --rm -v ${PWD}/api:/app -w /app alpine chmod -R 777 storage

cache-clear:
	docker-compose run --rm api-php-cli php artisan cache:clear

db-migrate:
	docker-compose run --rm api-php-cli php artisan migrate

