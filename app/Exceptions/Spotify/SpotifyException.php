<?php

namespace App\Exceptions\Spotify;

class SpotifyException extends \Exception
{
    public const TOKEN_EXPIRED = 'The access token expired';

    public const RATE_LIMIT_STATUS = 429;

    /**
     * The reason string from the request's error object.
     *
     * @var string
     */
    private $reason;

    /**
     * Returns the reason string from the request's error object.
     *
     * @see https://developer.spotify.com/documentation/web-api/reference/object-model/#player-error-reasons
     *
     * @return string
     */
    public function getReason()
    {
        return $this->reason;
    }

    public function hasExpiredToken(): bool
    {
        return $this->getMessage() === self::TOKEN_EXPIRED;
    }

    public function isRateLimited(): bool
    {
        return $this->getCode() === self::RATE_LIMIT_STATUS;
    }

    public function setReason($reason): void
    {
        $this->reason = $reason;
    }
}
