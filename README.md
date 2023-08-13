
  
  

## Packages/Library used

Laravel Breeze - Official vue set-up for Laravel
dayjs - library that parses, validates, manipulates, and displays dates and times

## Files changed

/resources/js/Components/ClockForm.vue
/resources/js/Components/Clock.vue
/resources/js/Pages/Dashboard.vue
/app/Http/Controllers/TimeController.php

  

## How to run
Clone this repo:

    git clone https://github.com/helloworld0123/clock-challenge.git

Run:

    composer install

Start sail

    ./vendor/bin/sail up


Start dev for vue

    ./vendor/bin/sail npm run dev

or Build vue files

    ./vendor/bin/sail npm run build

Rename `.env.exampe` file to `.env`

Run database migrations
    
    ./vendor/bin/sail php artisan migrate

Open http://localhost
Login: http://localhost/login
Register: http://localhost/register
