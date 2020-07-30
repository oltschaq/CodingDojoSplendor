install:
	docker-compose run --rm composer composer install

ssh-php:
	docker-compose run --rm php bash

ssh-composer:
	docker-compose run --rm composer bash

test-behat:
	docker-compose run --rm php bin/behat

test: test-behat
