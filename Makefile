init: docker-stop docker-pull docker-build docker-up-d composer-install
init-dev: init docker-stop docker-pull docker-build docker-up

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

db-migrate-diff:
	docker-compose run --rm api-php-cli php bin/console doctrine:migrations:diff

db-migrate:
	docker-compose run --rm api-php-cli php bin/console doctrine:migrations:migrate

composer-install:
	docker-compose run --rm api-php-cli composer install

create-superuser:
	docker-compose run --rm api-php-cli php bin/console app:create-superuser

manage-jwt-keys:
	mkdir -p api/config/jwt
	openssl genpkey -out api/config/jwt/private.pem -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
	openssl pkey -in api/config/jwt/private.pem -out api/config/jwt/public.pem -pubout
	openssl genrsa -out api/config/jwt/private-test.pem -aes256 4096
	openssl rsa -pubout -in api/config/jwt/private-test.pem -out api/config/jwt/public-test.pem
	docker-compose run --rm api-php-cli chmod 664 config/jwt/private.pem config/jwt/public.pem
	docker-compose run --rm api-php-cli chmod 664 config/jwt/private-test.pem config/jwt/public-test.pem


