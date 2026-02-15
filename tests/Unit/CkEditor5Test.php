<?php

namespace Jaikumar0101\LivewireEditor\Tests\Unit;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\CkEditor5;
use Livewire\Livewire;

class CkEditor5Test extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $component = Livewire::test(CkEditor5::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function it_initializes_with_empty_content()
    {
        $component = Livewire::test(CkEditor5::class);

        $component->assertSet('content', '');
    }

    /** @test */
    public function it_can_be_instantiated_with_content()
    {
        $content = '<p>Test content</p>';
        
        $component = Livewire::test(CkEditor5::class, ['content' => $content]);

        $component->assertSet('content', $content);
    }

    /** @test */
    public function it_generates_unique_editor_id()
    {
        $component1 = Livewire::test(CkEditor5::class);
        $component2 = Livewire::test(CkEditor5::class);

        $editorId1 = $component1->get('editorId');
        $editorId2 = $component2->get('editorId');

        $this->assertNotEquals($editorId1, $editorId2);
        $this->assertStringStartsWith('ckeditor5-', $editorId1);
    }

    /** @test */
    public function it_can_update_content()
    {
        $component = Livewire::test(CkEditor5::class);

        $newContent = '<p>Updated content</p>';
        $component->set('content', $newContent);

        $component->assertSet('content', $newContent);
    }

    /** @test */
    public function it_accepts_custom_config()
    {
        $config = ['placeholder' => 'Custom placeholder'];
        
        $component = Livewire::test(CkEditor5::class, ['config' => $config]);

        $this->assertArrayHasKey('placeholder', $component->get('config'));
    }

    /** @test */
    public function it_can_set_theme()
    {
        $component = Livewire::test(CkEditor5::class, ['theme' => 'dark']);

        $component->assertSet('theme', 'dark');
    }

    /** @test */
    public function it_can_set_placeholder()
    {
        $placeholder = 'Start typing...';
        
        $component = Livewire::test(CkEditor5::class, ['placeholder' => $placeholder]);

        $component->assertSet('placeholder', $placeholder);
    }

    /** @test */
    public function it_can_toggle_readonly_mode()
    {
        $component = Livewire::test(CkEditor5::class);

        $component->assertSet('readOnly', false);

        $component->set('readOnly', true);
        $component->assertSet('readOnly', true);
    }

    /** @test */
    public function it_can_enable_counter()
    {
        $component = Livewire::test(CkEditor5::class);

        $component->set('showCounter', true);
        $component->assertSet('showCounter', true);
    }

    /** @test */
    public function it_can_enable_auto_save()
    {
        $component = Livewire::test(CkEditor5::class);

        $component->set('autoSave', true);
        $component->assertSet('autoSave', true);
    }

    /** @test */
    public function it_renders_successfully()
    {
        $component = Livewire::test(CkEditor5::class);

        $component->assertViewIs('livewire-editor::components.forms.editor.ckeditor5');
    }
}
