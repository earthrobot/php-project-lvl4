start:
	php artisan serve

setup:
	composer install
	cp -n .env.example .env|| true
	php artisan key:gen --ansi
	php artisan migrate
	php artisan db:seed
	npm ci

watch:
	npm run watch

migrate:
	php artisan migrate

console:
	php artisan tinker

test:
	php artisan test

test-coverage:
	php artisan test --coverage-clover coverage-report

deploy:
	git push heroku

lint:
	composer exec phpcs -v

lint-fix:
	composer exec phpcbf -v
