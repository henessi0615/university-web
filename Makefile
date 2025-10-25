PHP_BIN = php bin/console
ECS_BIN = php vendor/bin/ecs
PHPSTAN_BIN = php vendor/bin/phpstan

SRC_DIR = src/

.PHONY: ecs ecs-fix stan twig-lint start

ecs:
	$(PHP_BIN) ca:cl
	$(ECS_BIN) check src

ecs-fix:
	$(PHP_BIN) ca:cl
	$(ECS_BIN) check src --fix

stan:
	$(PHP_BIN) ca:cl
	$(PHPSTAN_BIN) analyse -c .phpstan.neon

twig-lint:
	$(PHP_BIN) lint:twig templates

start:
	symfony server:start
