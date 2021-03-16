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
	php artisan test -- tests --whitelist tests --coverage-clover coverage-report

test-coverage:
	composer phpunit -- tests --whitelist tests --coverage-clover coverage-report

deploy:
	git push heroku

lint:
	composer phpcs

lint-fix:
	composer phpcbf

seed statuses:
	php artisan db:seed --class=TaskStatusSeeder