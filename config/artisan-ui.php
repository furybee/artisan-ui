<?php

use FuryBee\ArtisanUi\Http\Middleware\EnsureUserIsAuthorized;

return [

    /*
    |--------------------------------------------------------------------------
    | Artisan UI Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will be assigned to every Artisan UI route - giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => [
        'web',
        EnsureUserIsAuthorized::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Artisan UI Command List
    |--------------------------------------------------------------------------
    |
    | Determine if vendor commands should be listed too.
    |
    */

    'vendor' => true,

];
