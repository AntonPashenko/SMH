compose_local=cd docker && docker compose -f docker-compose.db.yml -f docker-compose.local.yml
level=90

run_local: ## Build and run containers in DEVELOPER mode, install composer/npm dependencies, init database
	mkdir -p -m777 ../_data/db
	$(compose_local) down
	$(compose_local) up --build -d
	$(compose_local) exec php sh -c 'export COMPOSER_PROCESS_TIMEOUT=0 \
		&& composer install --optimize-autoloader --no-scripts \
		&& composer auto-scripts'