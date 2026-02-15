<?php

namespace YourVendor\LivewireEditor;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class EditorServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__.'/../config/livewire-editor.php', 'livewire-editor'
        );
    }

    public function boot()
    {
        // Register Livewire components
        Livewire::component('forms.editor.ckeditor', \YourVendor\LivewireEditor\Components\Forms\Editor\CkEditor::class);
        Livewire::component('forms.editor.ckeditor5', \YourVendor\LivewireEditor\Components\Forms\Editor\CkEditor5::class);
        Livewire::component('forms.editor.tiptap', \YourVendor\LivewireEditor\Components\Forms\Editor\TipTapEditor::class);

        // Load views
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'livewire-editor');

        // Register Blade directive for assets
        Blade::directive('livewireEditorAssets', function ($editor = null) {
            return "<?php echo \YourVendor\LivewireEditor\Facades\LivewireEditor::assets({$editor}); ?>";
        });

        // Publish assets
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../resources/js' => public_path('vendor/livewire-editor/js'),
                __DIR__.'/../resources/css' => public_path('vendor/livewire-editor/css'),
            ], 'livewire-editor-assets');

            $this->publishes([
                __DIR__.'/../config/livewire-editor.php' => config_path('livewire-editor.php'),
            ], 'livewire-editor-config');

            $this->publishes([
                __DIR__.'/../resources/views' => resource_path('views/vendor/livewire-editor'),
            ], 'livewire-editor-views');
        }
    }
}
