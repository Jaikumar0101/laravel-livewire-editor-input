<?php

namespace Jaikumar0101\LivewireEditor\Tests;

use Orchestra\Testbench\TestCase as Orchestra;
use Jaikumar0101\LivewireEditor\EditorServiceProvider;
use Livewire\LivewireServiceProvider;

abstract class TestCase extends Orchestra
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->loadViewsFrom();
    }

    protected function getPackageProviders($app)
    {
        return [
            LivewireServiceProvider::class,
            EditorServiceProvider::class,
        ];
    }

    protected function getPackageAliases($app)
    {
        return [
            'LivewireEditor' => \Jaikumar0101\LivewireEditor\Facades\LivewireEditor::class,
        ];
    }

    protected function getEnvironmentSetUp($app)
    {
        // Set application key for encryption
        $app['config']->set('app.key', 'base64:'.base64_encode(random_bytes(32)));
        
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testing');
        $app['config']->set('database.connections.testing', [
            'driver' => 'sqlite',
            'database' => ':memory:',
            'prefix' => '',
        ]);

        // Setup livewire-editor configuration
        $app['config']->set('livewire-editor.default', 'ckeditor5');
        $app['config']->set('livewire-editor.asset_strategy', 'cdn');
    }

    protected function loadViewsFrom()
    {
        $this->app['view']->addNamespace('livewire-editor', __DIR__.'/../resources/views');
    }
}
