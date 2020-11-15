COM_COLOR   = \033[0;34m
OBJ_COLOR   = \033[0;36m
OK_COLOR    = \033[0;32m
ERROR_COLOR = \033[0;31m
WARN_COLOR  = \033[0;33m
NO_COLOR    = \033[m

help:
	@echo "$(COM_COLOR)cc.............: Cache clear$(NO_COLOR)"
	@echo "$(COM_COLOR)cc-hard........: Cache clear hard$(NO_COLOR)"
	@echo "$(COM_COLOR)fixtures.......: Fixtures load$(NO_COLOR)"
	@echo "$(COM_COLOR)clean-db.......: Clean DB$(NO_COLOR)"
	@echo "$(COM_COLOR)clean-vendor...: Clean vendor$(NO_COLOR)"
	@echo "$(COM_COLOR)csfixer........: Fix coding standard$(NO_COLOR)"
	@echo "$(COM_COLOR)test...........: Tests$(NO_COLOR)"
	@echo "$(COM_COLOR)start..........: Start containers$(NO_COLOR)"
	@echo "$(COM_COLOR)stop...........: Stop Containers$(NO_COLOR)"
	@echo "$(COM_COLOR)restart........: Stop and start containers$(NO_COLOR)"
	@echo "$(COM_COLOR)down...........: Down Containers$(NO_COLOR)"
	@echo "$(COM_COLOR)clean..........: Clean docker$(NO_COLOR)"
	@echo "$(COM_COLOR)ssh-php........: Connect to php container$(NO_COLOR)"
	@echo "$(COM_COLOR)ssh-db.........: Connect to bd container$(NO_COLOR)"
	@echo "$(COM_COLOR)ps.............: Lists containers$(NO_COLOR)"
	@echo "$(COM_COLOR)build..........: Build docker$(NO_COLOR)"
	@echo "$(COM_COLOR)rebuild........: Clean et build docker$(NO_COLOR)"
	@echo "$(COM_COLOR)log-php........: Display php logs$(NO_COLOR)"

cc:
	docker-compose exec php bin/console cache:clear
cc-hard:
	docker-compose exec rm -Rf var/cache/*
fixtures:
	docker-compose exec php bin/console doctrine:fixtures:load --append
clean-db:
	docker-compose exec php bin/console doctrine:database:drop --force
	docker-compose exec php bin/console doctrine:database:create
	docker-compose exec php bin/console doctrine:migrations:migrate --no-interaction
	docker-compose exec php bin/console doctrine:fixtures:load --no-interaction
clean-vendor: cc-hard
	docker-compose exec php rm -Rf vendor
	docker-compose exec php rm composer.lock
	docker-compose exec php composer install
csfixer:
	docker-compose exec php vendor/bin/php-cs-fixer fix
test:
	docker-compose exec ./bin/phpunit
start:
	docker-compose up -d
stop:
	docker-compose stop
down:
	docker-compose down
restart: stop start
clean:
	docker system prune -a -f
ssh-php:
	docker-compose exec php sh
ssh-db:
	docker-compose exec db sh
ps:
	docker ps && docker-compose ps
build:
	docker build -t sf .
rebuild: clean build
compose:
	docker-compose up --build -d
log-php:
	docker-compose exec php tail -f var/log/dev.log
