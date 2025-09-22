# Load variables from .env
include docker/.env
export $(shell sed -n 's/=.*//p' docker/.env)

# Variables
DOCKER_COMPOSE = docker compose -f docker/docker-compose.yml

#Docker
print-env:
	@cat docker/.env

build:
	$(DOCKER_COMPOSE) -p $(PROJECT_NAME) build --no-cache

up:
	$(DOCKER_COMPOSE) up -d

down:
	$(DOCKER_COMPOSE) down

logs:
	$(DOCKER_COMPOSE) -p $(PROJECT_NAME) logs -f

restart:
	$(DOCKER_COMPOSE) restart

ps:
	docker ps --format "table {{.ID}}\t{{.Names}}\t{{.Status}}\t{{.Ports}}"

#Backend
bash:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash

composer-install:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "composer install"

cache-clear:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "php bin/console cache:clear"

create-migration:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "php bin/console make:migration"

migrate:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "php bin/console doctrine:migrations:migrate"

schema-update-force:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "php bin/console doctrine:schema:update --force"

#Backend tools
phpstan:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "vendor/bin/phpstan analyse src/"

phpcsfixer:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "vendor/bin/php-cs-fixer fix src"

#example: make b-phpunit ARGS="--filter SomeTest"
phpunit:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "vendor/bin/phpunit $(ARGS)"

phpmd:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "php -d error_reporting='E_ALL & ~E_DEPRECATED' vendor/bin/phpmd src/ text phpmd.ruleset.xml"

phpmd-debug:
	cd docker && docker exec -it $(BACKEND_CONTAINER_NAME) bash -c "php -d error_reporting='E_ALL & ~E_DEPRECATED' vendor/bin/phpmd src/ text phpmd.ruleset.xml --verbose"