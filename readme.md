## Code
This code is still under construction, Work in Progress.

The idea was, to make an application to manage my playlists on Spotify.
I created views for Artists, Albums, Tracks and Playlists in this application.

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

### Redis
I've set up queues running through Redis, in the `config/queue.php` there's some configurations for that. Also `config/database.php` had to be adjusted slightly.
In the .env.example I've set the host for redis to `redis`, because that's in the docker setup. The QUEUE_CONNECTION is set to `redis` as well

### Artisan commands
There are 2 commands for now:
- `spotify:refresh-token`, which will refresh the access token. You can run this in a scheduler every 59 minutes, since the access token expires every 60 minutes

and
- `spotify:fetch-data`, which will fetch the data from a single spotify playlist (I have 10.000 tracks in there, including duplicates) and it will then process those tracks, including Artists, Albums.
This will be sent to the `default` queue for now.

### Queues
In this case I'm running my queue worker through ``` bash php artisan queue:work --daemon```, it will pick up the queued actions in the artisan command

# Spotify
Go to https://developer.spotify.com/dashboard/ and create an account
If you want to make an application using the API of Spotify, you need to Create an application inside that dashboard.
It will give you a client ID and a client Secret

In the .env file you need to fill SPOTIFY_CLIENT_ID and SPOTIFY_CLIENT_SECRET

## Spotify authorization
Go to http://spoti.local/spotify/authorize (one time)
Spotify will ask you to authorize this application, click Yes / Ok
It will send a code to http://spoti.local/spotify/callback which in its turn will save / cache the access token, refresh token, the usual

## Todo
- Need to work on processing paginated items. In the artisan command fetch-data I'm fetching 10.000 items. 100 per page. How to process it properly. Challenge.
- Improve the authorize / callback flow. When the access token expires (after 1 hour) you should automatically need to get a new token.
There's some bugs in there.
- At this point, when session times out, you'll get a 401 unauthorized exception. Need to handle that properly in the SpotifyService