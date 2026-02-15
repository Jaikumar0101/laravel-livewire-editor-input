<?php

namespace Jaikumar0101\LivewireEditor\Tests\Unit;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Jaikumar0101\LivewireEditor\Facades\LivewireEditor;

class LivewireEditorFacadeTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        
        // Reset assets before each test
        LivewireEditor::resetAssets();
    }

    /** @test */
    public function it_can_access_facade()
    {
        $this->assertInstanceOf(\Jaikumar0101\LivewireEditor\LivewireEditorManager::class, LivewireEditor::getFacadeRoot());
    }

    /** @test */
    public function it_can_call_methods_through_facade()
    {
        $alpineJs = LivewireEditor::alpineJs();

        $this->assertIsString($alpineJs);
        $this->assertNotEmpty($alpineJs);
    }

    /** @test */
    public function it_can_generate_css_through_facade()
    {
        $css = LivewireEditor::css();

        $this->assertIsString($css);
        $this->assertNotEmpty($css);
    }

    /** @test */
    public function it_can_generate_js_through_facade()
    {
        $js = LivewireEditor::js('ckeditor5');

        $this->assertIsString($js);
        $this->assertNotEmpty($js);
    }

    /** @test */
    public function it_can_generate_assets_through_facade()
    {
        $assets = LivewireEditor::assets('ckeditor5');

        $this->assertIsString($assets);
        $this->assertNotEmpty($assets);
    }

    /** @test */
    public function it_can_reset_assets_through_facade()
    {
        // Load assets
        $first = LivewireEditor::assets();
        $this->assertNotEmpty($first);
        
        // Reset
        LivewireEditor::resetAssets();

        // Should be able to load assets again after reset
        $assets = LivewireEditor::assets();
        $this->assertIsString($assets);
        $this->assertNotEmpty($assets);
    }
}
