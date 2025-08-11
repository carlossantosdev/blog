<?php

namespace App\Providers;

use App\Models\Metric;
use Carbon\CarbonImmutable;
use League\Flysystem\Filesystem;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\View;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use App\Filesystem\CloudflareImagesAdapter;
use Illuminate\Filesystem\FilesystemAdapter;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Cached visitors count.
     */
    protected ?int $visitors = null;

    public function boot() : void
    {
        // Not necessary, but why not?
        Date::use(CarbonImmutable::class);

        Model::automaticallyEagerLoadRelationships();

        // This one helps you catch lots of issues. Check
        // the source code to see what it does.
        Model::shouldBeStrict(! app()->isProduction());

        // Be careful with unguarded models! But
        // this trick removes a lot of friction.
        Model::unguard();

        Storage::extend('cloudflare-images', function ($app, array $config): \Illuminate\Filesystem\FilesystemAdapter {
            $adapter = new CloudflareImagesAdapter(
                config('services.cloudflare_images.token'),
                config('services.cloudflare_images.account_id'),
                config('services.cloudflare_images.account_hash'),
                $config['variant'] ?? 'public',
            );

            $filesystem = new Filesystem($adapter);

            return new FilesystemAdapter($filesystem, $adapter, $config);
        });

        View::composer('*', fn (\Illuminate\View\View $view) => $view->with([
            'user' => auth()->user(),
            'visitors' => $this->visitors ??= cache()->remember(
                'visitors', 600, fn () => Metric::query()
                    ->where('key', 'visitors')
                    ->value('value') ?? 0
            ),
        ]));
    }
}
