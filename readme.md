# Test-Drive Car Website
Based on [laravel framework](http://laravel.com/).

## Setup Project
```sh
# copy project source code
git clone <repo_url>
cd repo_name/
# install composer modules
composer install
# install node.js modules
npm install
# build frontend files
gulp
# create environment file
cp .env.example .env
# set your settings
vim .env
# create autoload file
composer dump-autoload
# generate secure key
php artisan key:generate
# create DB tables
php artisan migrate
# setup some data into DB
php artisan db:seed
# start unit tests
vendor/bin/phpunit
```