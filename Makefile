init:
	docker-compose up -d
	docker-compose exec php composer install

test:
	docker-compose up -d
	docker-compose exec php php run-test.php

login:
	docker-compose exec php sh

cbf:
	docker-compose exec php ./vendor/bin/phpcbf