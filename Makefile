COM_COLOR   = \033[0;34m
OBJ_COLOR   = \033[0;36m
OK_COLOR    = \033[0;32m
ERROR_COLOR = \033[0;31m
WARN_COLOR  = \033[0;33m
NO_COLOR    = \033[m

help :
	@echo "$(COM_COLOR)cc.............: Cache clear$(NO_COLOR)"
	@echo "$(COM_COLOR)cc-hard........: Cache clear hard$(NO_COLOR)"
	@echo "$(COM_COLOR)fixtures.......: Fixtures load$(NO_COLOR)"
	@echo "$(COM_COLOR)clean-db.......: Clean DB$(NO_COLOR)"
cc :
	php bin/console cache:clear
cc-hard :
	rm -Rf var/cache/*
fixtures :
	php bin/console doctrine:fixtures:load --append
clean-db :
	php bin/console doctrine:database:drop --force
	php bin/console doctrine:database:create
	php bin/console doctrine:migrations:migrate --no-interaction
	php bin/console doctrine:fixtures:load --no-interaction
