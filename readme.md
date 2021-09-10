## Code
This code is still under construction, Work in Progress.

The idea was, to make an application to manage my playlists on Spotify.
I created Artists, Albums, Tracks and Playlists in this application.

Then, in the front, you can just see what you have (Like Spotify itself)
In the back, when you log in, you can manage those items.

## Setup for local development

### PHP
``` bash
cp .env.example .env
```

### Composer
``` bash
composer install
php artisan key:generate
```

### MySQL
Configure the `.env` to your needs (database name, username, password)

``` bash
./artisan migrate
./artisan db:seed
```

### Assets (Yarn)
``` bash
yarn install
yarn run dev
```
