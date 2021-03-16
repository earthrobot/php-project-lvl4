### Hexlet tests and linter status:
[![Actions Status](https://github.com/earthrobot/php-project-lvl4/workflows/hexlet-check/badge.svg)](https://github.com/earthrobot/php-project-lvl4/actions)
[![Maintainability](https://api.codeclimate.com/v1/badges/a65eb3a26e7322f6e9e0/maintainability)](https://codeclimate.com/github/earthrobot/php-project-lvl4/maintainability)
[![Test Coverage](https://api.codeclimate.com/v1/badges/a65eb3a26e7322f6e9e0/test_coverage)](https://codeclimate.com/github/earthrobot/php-project-lvl4/test_coverage)
[![Actions Status](https://github.com/earthrobot/php-project-lvl4/workflows/workflow/badge.svg)](https://github.com/earthrobot/php-project-lvl4/actions)

## About

Task Manager is a task management system, which allows you to set tasks, assign performers and change their statuses. Registration and authentication are required to work with the system.

## Demo

[Try Task Manager](http://young-plateau-29423.herokuapp.com/)

## Setup

```sh
$ make setup
```

## Run

```sh
$ make start
```

## Run tests

```sh
$ make test
```

## Run linter

```sh
$ make lint
```

## Requirements

  * PHP ^7.3.0
  * Extensions: mbstring, curl, dom, xml,zip, sqlite3
  * Composer
  * Node.js & npm
  * [heroku cli](https://devcenter.heroku.com/articles/heroku-cli#download-and-install)
  * SQLite для локальной разработки
  * Ubuntu 18.04
