<?php

namespace Jaikumar0101\LivewireEditor\Tests\Unit;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Jaikumar0101\LivewireEditor\EditorServiceProvider;
use Illuminate\Support\Facades\Config;

class EditorServiceProviderTest extends TestCase
{
    /** @test */
    public function it_registers_the_service_provider()
    {
        $this->assertTrue($this->app->providerIsLoaded(EditorServiceProvider::class));
    }

    /** @test */
    public function it_registers_livewire_editor_service()
    {
        $this->assertTrue($this->app->bound('livewire-editor'));
    }

    /** @test */
    public function it_can_resolve_livewire_editor_from_container()
    {
        $editor = $this->app->make('livewire-editor');

        $this->assertInstanceOf(\Jaikumar0101\LivewireEditor\LivewireEditorManager::class, $editor);
    }

    /** @test */
    public function it_merges_configuration()
    {
        $this->assertNotNull(Config::get('livewire-editor.default'));
        $this->assertNotNull(Config::get('livewire-editor.asset_strategy'));
    }

    /** @test */
    public function it_loads_views()
    {
        $this->assertTrue($this->app['view']->exists('livewire-editor::components.forms.editor.ckeditor5'));
        $this->assertTrue($this->app['view']->exists('livewire-editor::components.forms.editor.ckeditor'));
        $this->assertTrue($this->app['view']->exists('livewire-editor::components.forms.editor.tiptap-editor'));
    }

    /** @test */
    public function it_has_correct_default_configuration()
    {
        $this->assertEquals('ckeditor5', Config::get('livewire-editor.default'));
        $this->assertEquals('cdn', Config::get('livewire-editor.asset_strategy'));
    }
}
