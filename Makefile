COM_COLOR   = \033[0;34m
OBJ_COLOR   = \033[0;36m
OK_COLOR    = \033[0;32m
ERROR_COLOR = \033[0;31m
WARN_COLOR  = \033[0;33m
NO_COLOR    = \033[m

help :
	@echo "$(COM_COLOR)cc.......: Cache clear$(NO_COLOR)"
cc :
	php bin/console cache:clear
cc-hard :
	rm -Rf var/cache/*
