<?php

namespace App\Exceptions\Spotify;

class SpotifyAuthException extends SpotifyException
{
    public const INVALID_CLIENT = 'Invalid client';

    public const INVALID_CLIENT_SECRET = 'Invalid client secret';

    public const INVALID_REFRESH_TOKEN = 'Invalid refresh token';

    public function hasInvalidCredentials(): bool
    {
        return in_array($this->getMessage(), [
            self::INVALID_CLIENT,
            self::INVALID_CLIENT_SECRET,
        ]);
    }

    public function hasInvalidRefreshToken(): bool
    {
        return $this->getMessage() === self::INVALID_REFRESH_TOKEN;
    }
}
