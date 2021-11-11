# Artisan UI

![image](https://user-images.githubusercontent.com/45472257/141324726-4279ae1a-cacc-4fd7-b3de-fe3d5be6b999.png)

## Installing The Artisan UI Dashboard

This package provides a beautiful dashboard through your application that allows you to list all availables artisan commands. The Artisan UI dashboard package can be installed in your project using Composer:

```sh
composer require furybee/artisan-ui
```

After installing Artisan UI, you may publish its assets using the `artisan-ui:install` Artisan command:

```sh
php artisan artisan-ui:install
```

## Dashboard Authorization
Artisan UI exposes a dashboard at the `/artisan-ui` URI. Within your `app/Providers/ArtisanUiServiceProvider.php` file, there is a gate method that controls access to the Artisan UI dashboard. By default, all visitors are restricted. You should modify this gate as needed to grant access to your Artisan UI dashboard:

```php
/**
 * Register the Artisan UI gate.
 *
 * This gate determines who can access Artisan UI in non-local environments.
 *
 * @return void
 */
protected function gate()
{
    Gate::define('viewArtisanUI', function ($user = null) {
        return in_array(optional($user)->email, [
            'hello@sebastienfontaine.me',
        ]);
    });
}
```

## Upgrading Artisan UI

When upgrading to a new version of Artisan UI, you should re-publish Artisan UI's assets:

```sh
php artisan artisan-ui:publish
```

To keep the assets up-to-date and avoid issues in future updates, you may add the `artisan-ui:publish` command to the post-update-cmd scripts in your application's `composer.json` file:

```json
{
    "scripts": {
        "post-update-cmd": [
            "@php artisan artisan-ui:publish --ansi"
        ]
    }
}
```

## Customizing Middleware

If needed, you can customize the middleware stack used by Artisan UI routes by updating your `config/artisan-ui.php` file. If you have not published Artisan UI's configuration file, you may do so using the `vendor:publish` Artisan command:

```sh
php artisan vendor:publish --tag=artisan-ui-config
```

Once the configuration file has been published, you may edit Artisan UI's middleware by tweaking the middleware configuration option within this file:

```php
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
```

## Inspiration

- https://github.com/laravel/vapor-ui
- https://artisan.page created by [@jbrooksuk](https://twitter.com/jbrooksuk)
