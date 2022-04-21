<?php

use App\Models\User;

function getLoggedInUserId(): int
{
    return Auth::id();
}

function getLoggedInUser(): User
{
    return Auth::user();
}
