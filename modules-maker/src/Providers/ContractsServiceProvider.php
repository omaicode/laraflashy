<?php

namespace Omaicode\Modules\Providers;

use Illuminate\Support\ServiceProvider;
use Omaicode\Modules\Contracts\RepositoryInterface;
use Omaicode\Modules\Laravel\LaravelFileRepository;

class ContractsServiceProvider extends ServiceProvider
{
    /**
     * Register some binding.
     */
    public function register()
    {
        $this->app->bind(RepositoryInterface::class, LaravelFileRepository::class);
    }
}
