<?php

namespace Jaikumar0101\LivewireEditor\Tests\Unit;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Jaikumar0101\LivewireEditor\LivewireEditorManager;

class LivewireEditorManagerTest extends TestCase
{
    protected $manager;

    protected function setUp(): void
    {
        parent::setUp();

        $this->manager = app('livewire-editor');
        // Reset assets before each test
        $this->manager->resetAssets();
    }

    /** @test */
    public function it_can_be_resolved_from_container()
    {
        $this->assertInstanceOf(LivewireEditorManager::class, $this->manager);
    }

    /** @test */
    public function it_can_generate_alpine_js_script()
    {
        $alpineJs = $this->manager->alpineJs();

        $this->assertStringContainsString('alpine', strtolower($alpineJs));
        $this->assertStringContainsString('script', strtolower($alpineJs));
    }

    /** @test */
    public function it_can_generate_css_assets()
    {
        $css = $this->manager->css();

        $this->assertIsString($css);
        $this->assertNotEmpty($css);
    }

    /** @test */
    public function it_can_generate_js_assets_for_ckeditor5()
    {
        $js = $this->manager->js('ckeditor5');

        $this->assertIsString($js);
        $this->assertStringContainsString('ckeditor', strtolower($js));
    }

    /** @test */
    public function it_can_generate_js_assets_for_ckeditor()
    {
        $js = $this->manager->js('ckeditor');

        $this->assertIsString($js);
        $this->assertStringContainsString('ckeditor', strtolower($js));
    }

    /** @test */
    public function it_can_generate_js_assets_for_tiptap()
    {
        $js = $this->manager->js('tiptap');

        $this->assertIsString($js);
        $this->assertStringContainsString('tiptap', strtolower($js));
    }

    /** @test */
    public function it_can_generate_all_assets()
    {
        $assets = $this->manager->assets();

        $this->assertIsString($assets);
        $this->assertStringContainsString('alpine', strtolower($assets));
    }

    /** @test */
    public function it_can_generate_assets_for_specific_editor()
    {
        $assets = $this->manager->assets('ckeditor5');

        $this->assertIsString($assets);
        $this->assertNotEmpty($assets);
    }

    /** @test */
    public function it_can_reset_loaded_assets()
    {
        // Load assets
        $first = $this->manager->alpineJs();
        $this->assertNotEmpty($first);
        
        // Second call should return empty (already loaded)
        $second = $this->manager->alpineJs();
        $this->assertEmpty($second);
        
        // After reset, should return assets again
        $this->manager->resetAssets();
        $third = $this->manager->alpineJs();
        $this->assertNotEmpty($third);
    }

    /** @test */
    public function it_normalizes_editor_names()
    {
        // Test that different name formats are accepted
        $js1 = $this->manager->js('ckeditor5');
        $js2 = $this->manager->js('CkEditor5');
        
        $this->assertIsString($js1);
        $this->assertIsString($js2);
    }

    /** @test */
    public function it_prevents_duplicate_asset_loading()
    {
        $first = $this->manager->alpineJs();
        $this->assertNotEmpty($first);
        
        // Second call should return empty string to prevent duplicates
        $second = $this->manager->alpineJs();
        $this->assertEmpty($second);
    }
}
