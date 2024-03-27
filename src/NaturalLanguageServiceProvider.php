<?php

namespace Coxlr\NaturalLanguage;

use Illuminate\Support\ServiceProvider;

class NaturalLanguageServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../config/naturallanguage.php' => config_path('naturallanguage.php'),
        ]);
    }

    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/naturallanguage.php', 'naturallanguage');

        $this->app->bind(NaturalLanguageClient::class, function () {
            return new NaturalLanguageClient(config('naturallanguage'));
        });

        $this->app->bind(NaturalLanguage::class, function () {
            $client = app(NaturalLanguageClient::class);

            return new NaturalLanguage($client);
        });

        $this->app->alias(NaturalLanguage::class, 'laravel-natural-language');
    }
}
