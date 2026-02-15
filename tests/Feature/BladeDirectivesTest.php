<?php

namespace Jaikumar0101\LivewireEditor\Tests\Feature;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Illuminate\Support\Facades\Blade;

class BladeDirectivesTest extends TestCase
{
    /** @test */
    public function it_registers_livewire_editor_assets_directive()
    {
        $directives = Blade::getCustomDirectives();

        $this->assertArrayHasKey('livewireEditorAssets', $directives);
    }

    /** @test */
    public function it_registers_livewire_editor_css_directive()
    {
        $directives = Blade::getCustomDirectives();

        $this->assertArrayHasKey('livewireEditorCss', $directives);
    }

    /** @test */
    public function it_registers_livewire_editor_js_directive()
    {
        $directives = Blade::getCustomDirectives();

        $this->assertArrayHasKey('livewireEditorJs', $directives);
    }

    /** @test */
    public function it_registers_livewire_editor_alpine_directive()
    {
        $directives = Blade::getCustomDirectives();

        $this->assertArrayHasKey('livewireEditorAlpine', $directives);
    }
    
    /** @test */
    public function blade_directives_can_be_compiled()
    {
        // Test that directives compile without errors
        $compiled = Blade::compileString('@livewireEditorAssets');
        $this->assertStringContainsString('LivewireEditor::assets', $compiled);
        
        $compiled = Blade::compileString('@livewireEditorCss');
        $this->assertStringContainsString('LivewireEditor::css', $compiled);
        
        $compiled = Blade::compileString('@livewireEditorJs');
        $this->assertStringContainsString('LivewireEditor::js', $compiled);
        
        $compiled = Blade::compileString('@livewireEditorAlpine');
        $this->assertStringContainsString('LivewireEditor::alpineJs', $compiled);
    }
}
