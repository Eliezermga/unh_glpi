# GLPI Development Makefile

.PHONY: help install test lint fix security clean

# Variables
PHP_VERSION := 8.1
COMPOSER := composer
PHPUNIT := ./vendor/bin/phpunit
PHPSTAN := ./vendor/bin/phpstan
PHPCS := ./vendor/bin/phpcs
PHPCBF := ./vendor/bin/phpcbf

help: ## Affiche cette aide
	@grep -E '^[a-zA-Z_-]+:.*?## .*$$' $(MAKEFILE_LIST) | sort | awk 'BEGIN {FS = ":.*?## "}; {printf "\033[36m%-20s\033[0m %s\n", $$1, $$2}'

install: ## Installe les dépendances
	$(COMPOSER) install --prefer-dist --no-progress

install-dev: ## Installe les dépendances de développement
	$(COMPOSER) install --prefer-dist --no-progress --dev

update: ## Met à jour les dépendances
	$(COMPOSER) update --prefer-dist --no-progress

test: ## Lance tous les tests
	$(PHPUNIT) --coverage-html coverage-html

test-unit: ## Lance les tests unitaires
	$(PHPUNIT) tests/Unit

test-integration: ## Lance les tests d'intégration
	$(PHPUNIT) tests/Integration

test-functional: ## Lance les tests fonctionnels
	$(PHPUNIT) tests/Functional

lint: ## Vérifie le style de code
	$(PHPCS) --standard=phpcs.xml.dist

lint-fix: ## Corrige automatiquement le style de code
	$(PHPCBF) --standard=phpcs.xml.dist

analyze: ## Analyse statique du code
	$(PHPSTAN) analyse --memory-limit=1G

security: ## Audit de sécurité
	$(COMPOSER) audit

syntax: ## Vérifie la syntaxe PHP
	find . -name "*.php" -not -path "./vendor/*" -exec php -l {} \;

quality: lint analyze security ## Lance tous les contrôles qualité

ci: syntax quality test ## Lance tous les tests CI

clean: ## Nettoie les fichiers temporaires
	rm -rf coverage-html
	rm -rf .phpunit.cache
	rm -rf .phpstan.cache
	rm -f coverage.xml

docker-test: ## Lance les tests avec Docker
	docker-compose -f docker-compose.test.yml up -d
	docker-compose -f docker-compose.test.yml exec php-test make test
	docker-compose -f docker-compose.test.yml down

backup: ## Crée une sauvegarde
	mkdir -p backups
	tar -czf backups/glpi-backup-$(shell date +%Y%m%d_%H%M%S).tar.gz \
		--exclude='vendor' \
		--exclude='files/_cache' \
		--exclude='files/_log' \
		--exclude='files/_tmp' \
		.

setup-dev: install-dev ## Configure l'environnement de développement
	cp config/config_db.php.dist config/config_db.php