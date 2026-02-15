<?php

namespace Jaikumar0101\LivewireEditor\Tests\Unit;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\CkEditor;
use Livewire\Livewire;

class CkEditorTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $component = Livewire::test(CkEditor::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function it_initializes_with_empty_content()
    {
        $component = Livewire::test(CkEditor::class);

        $component->assertSet('content', '');
    }

    /** @test */
    public function it_can_be_instantiated_with_content()
    {
        $content = '<p>Test content</p>';
        
        $component = Livewire::test(CkEditor::class, ['content' => $content]);

        $component->assertSet('content', $content);
    }

    /** @test */
    public function it_generates_unique_editor_id()
    {
        $component1 = Livewire::test(CkEditor::class);
        $component2 = Livewire::test(CkEditor::class);

        $editorId1 = $component1->get('editorId');
        $editorId2 = $component2->get('editorId');

        $this->assertNotEquals($editorId1, $editorId2);
        $this->assertStringStartsWith('ckeditor-', $editorId1);
    }

    /** @test */
    public function it_can_update_content()
    {
        $component = Livewire::test(CkEditor::class);

        $newContent = '<p>Updated content</p>';
        $component->set('content', $newContent);

        $component->assertSet('content', $newContent);
    }

    /** @test */
    public function it_can_set_height()
    {
        $height = 400;
        
        $component = Livewire::test(CkEditor::class, ['height' => $height]);

        $component->assertSet('height', $height);
    }

    /** @test */
    public function it_accepts_custom_config()
    {
        $config = ['toolbar' => ['Bold', 'Italic']];
        
        $component = Livewire::test(CkEditor::class, ['config' => $config]);

        $this->assertIsArray($component->get('config'));
    }

    /** @test */
    public function it_can_set_theme()
    {
        $component = Livewire::test(CkEditor::class, ['theme' => 'dark']);

        $component->assertSet('theme', 'dark');
    }

    /** @test */
    public function it_renders_successfully()
    {
        $component = Livewire::test(CkEditor::class);

        $component->assertViewIs('livewire-editor::components.forms.editor.ckeditor');
    }
}
