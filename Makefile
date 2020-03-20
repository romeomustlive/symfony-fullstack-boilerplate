init-dev: docker-stop docker-pull docker-build docker-up

docker-stop:
	docker-compose down --remove-orphans

docker-pull:
	docker-compose pull

docker-build: 
	docker-compose build

docker-up:
	docker-compose up