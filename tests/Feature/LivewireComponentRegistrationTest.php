<?php

namespace Jaikumar0101\LivewireEditor\Tests\Feature;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Livewire\Livewire;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\CkEditor;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\CkEditor5;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\TipTapEditor;

class LivewireComponentRegistrationTest extends TestCase
{
    /** @test */
    public function it_registers_ckeditor_component()
    {
        // Test that the component can be instantiated
        $component = Livewire::test(CkEditor::class);
        $this->assertNotNull($component);
    }

    /** @test */
    public function it_registers_ckeditor5_component()
    {
        // Test that the component can be instantiated
        $component = Livewire::test(CkEditor5::class);
        $this->assertNotNull($component);
    }

    /** @test */
    public function it_registers_tiptap_component()
    {
        // Test that the component can be instantiated
        $component = Livewire::test(TipTapEditor::class);
        $this->assertNotNull($component);
    }
    
    /** @test */
    public function it_can_render_ckeditor_by_alias()
    {
        // Test rendering by component alias
        $component = Livewire::test('forms.editor.ckeditor');
        $this->assertNotNull($component);
    }

    /** @test */
    public function it_can_render_ckeditor5_by_alias()
    {
        // Test rendering by component alias
        $component = Livewire::test('forms.editor.ckeditor5');
        $this->assertNotNull($component);
    }

    /** @test */
    public function it_can_render_tiptap_by_alias()
    {
        // Test rendering by component alias
        $component = Livewire::test('forms.editor.tiptap');
        $this->assertNotNull($component);
    }
}
