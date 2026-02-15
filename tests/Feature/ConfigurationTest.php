<?php

namespace Jaikumar0101\LivewireEditor\Tests\Feature;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Illuminate\Support\Facades\Config;

class ConfigurationTest extends TestCase
{
    /** @test */
    public function it_has_default_editor_configuration()
    {
        $this->assertNotNull(Config::get('livewire-editor.default'));
    }

    /** @test */
    public function it_has_asset_strategy_configuration()
    {
        $this->assertNotNull(Config::get('livewire-editor.asset_strategy'));
    }

    /** @test */
    public function it_can_override_default_editor()
    {
        Config::set('livewire-editor.default', 'ckeditor');

        $this->assertEquals('ckeditor', Config::get('livewire-editor.default'));
    }

    /** @test */
    public function it_can_override_asset_strategy()
    {
        Config::set('livewire-editor.asset_strategy', 'local');

        $this->assertEquals('local', Config::get('livewire-editor.asset_strategy'));
    }

    /** @test */
    public function it_has_global_configuration()
    {
        $this->assertIsArray(Config::get('livewire-editor.global'));
    }

    /** @test */
    public function it_has_auto_save_configuration()
    {
        $autoSaveConfig = Config::get('livewire-editor.global.auto_save');

        $this->assertIsArray($autoSaveConfig);
        $this->assertArrayHasKey('enabled', $autoSaveConfig);
        $this->assertArrayHasKey('interval', $autoSaveConfig);
    }

    /** @test */
    public function it_has_counter_configuration()
    {
        $counterConfig = Config::get('livewire-editor.global.counter');

        $this->assertIsArray($counterConfig);
        $this->assertArrayHasKey('enabled', $counterConfig);
        $this->assertArrayHasKey('type', $counterConfig);
    }

    /** @test */
    public function it_has_themes_configuration()
    {
        $themes = Config::get('livewire-editor.themes');

        $this->assertIsArray($themes);
        $this->assertArrayHasKey('default', $themes);
        $this->assertArrayHasKey('dark', $themes);
    }

    /** @test */
    public function it_has_editor_specific_configurations()
    {
        $this->assertIsArray(Config::get('livewire-editor.ckeditor5'));
        $this->assertIsArray(Config::get('livewire-editor.ckeditor'));
        $this->assertIsArray(Config::get('livewire-editor.tiptap'));
    }
}
