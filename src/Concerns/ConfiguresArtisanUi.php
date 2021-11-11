<?php

namespace FuryBee\ArtisanUi\Concerns;

use Illuminate\Support\Facades\Config;

trait ConfiguresArtisanUi
{
    /**
     * Ensure Artisan UI is properly configured.
     *
     * @return void
     */
    protected function ensureArtisanUiIsConfigured()
    {
        Config::set('artisan-ui', array_merge([
            'vendor' => true,
        ], Config::get('artisan-ui') ?? []));
    }
}
