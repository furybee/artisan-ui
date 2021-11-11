<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- Meta Information -->
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="robots" content="noindex, nofollow" />

        <!-- Title -->
        <title>Artisan UI - {{ config('artisan-ui.project') }} - {{ config('artisan-ui.environment') }}</title>

        <!-- Style sheets -->
        <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" />
        <link href="{{ asset(mix('app.css', 'vendor/artisan-ui')) }}" rel="stylesheet" type="text/css" />
    </head>
    <body class="bg-gray-100">
        <div id="artisan-ui" class="main container mx-auto">
            <router-view></router-view>
        </div>

        <!-- Global Telescope Object -->
        <script>
            window.ArtisanUi = @json([
                'commands' => $commands,
                'hasvendor' => $hasVendor
            ]);
        </script>

        <script src="{{ asset(mix('app.js', 'vendor/artisan-ui')) }}"></script>
    </body>
</html>
