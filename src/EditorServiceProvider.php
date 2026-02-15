<?php

namespace Jaikumar0101\LivewireEditor;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\CkEditor;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\CkEditor5;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\TipTapEditor;

class EditorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-editor.php', 
            'livewire-editor'
        );

        $this->app->singleton('livewire-editor', function ($app) {
            return new \Jaikumar0101\LivewireEditor\LivewireEditorManager($app);
        });
    }

    public function boot()
    {
        $this->registerLivewireComponents();
        $this->registerBladeDirectives();
        $this->registerPublishables();
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-editor');
    }

    protected function registerLivewireComponents(): void
    {
        // Register Livewire components
        Livewire::component('forms.editor.ckeditor', CkEditor::class);
        Livewire::component('forms.editor.ckeditor5', CkEditor5::class);
        Livewire::component('forms.editor.tiptap', TipTapEditor::class);
    }

    protected function registerBladeDirectives(): void
    {
        // Main asset directive
        Blade::directive('livewireEditorAssets', function ($editor = null) {
            return "<?php echo \Jaikumar0101\LivewireEditor\Facades\LivewireEditor::assets({$editor}); ?>";
        });

        // Individual editor asset directives
        Blade::directive('livewireEditorCss', function () {
            return "<?php echo \Jaikumar0101\LivewireEditor\Facades\LivewireEditor::css(); ?>";
        });

        Blade::directive('livewireEditorJs', function ($editor = null) {
            return "<?php echo \Jaikumar0101\LivewireEditor\Facades\LivewireEditor::js({$editor}); ?>";
        });

        // Alpine.js directive (if not already included)
        Blade::directive('livewireEditorAlpine', function () {
            return "<?php echo \Jaikumar0101\LivewireEditor\Facades\LivewireEditor::alpineJs(); ?>";
        });
    }

    protected function registerPublishables(): void
    {
        if ($this->app->runningInConsole()) {
            // Publish assets
            $this->publishes([
                __DIR__.'/../resources/css' => public_path('vendor/livewire-editor/css'),
            ], 'livewire-editor-assets');

            // Publish configuration
            $this->publishes([
                __DIR__.'/../config/livewire-editor.php' => config_path('livewire-editor.php'),
            ], 'livewire-editor-config');

            // Publish views
            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-editor'),
            ], 'livewire-editor-views');

            // Publish all
            $this->publishes([
                __DIR__.'/../resources/css' => public_path('vendor/livewire-editor/css'),
                __DIR__.'/../config/livewire-editor.php' => config_path('livewire-editor.php'),
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-editor'),
            ], 'livewire-editor');
        }
    }
}
