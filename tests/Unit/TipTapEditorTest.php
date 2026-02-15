<?php

namespace Jaikumar0101\LivewireEditor\Tests\Unit;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\TipTapEditor;
use Livewire\Livewire;

class TipTapEditorTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $component = Livewire::test(TipTapEditor::class);

        $component->assertStatus(200);
    }

    /** @test */
    public function it_initializes_with_empty_content()
    {
        $component = Livewire::test(TipTapEditor::class);

        $component->assertSet('content', '');
    }

    /** @test */
    public function it_can_be_instantiated_with_content()
    {
        $content = '<p>Test content</p>';
        
        $component = Livewire::test(TipTapEditor::class, ['content' => $content]);

        $component->assertSet('content', $content);
    }

    /** @test */
    public function it_generates_unique_editor_id()
    {
        $component1 = Livewire::test(TipTapEditor::class);
        $component2 = Livewire::test(TipTapEditor::class);

        $editorId1 = $component1->get('editorId');
        $editorId2 = $component2->get('editorId');

        $this->assertNotEquals($editorId1, $editorId2);
        $this->assertStringStartsWith('tiptapeditor-', $editorId1);
    }

    /** @test */
    public function it_can_update_content()
    {
        $component = Livewire::test(TipTapEditor::class);

        $newContent = '<p>Updated content</p>';
        $component->set('content', $newContent);

        $component->assertSet('content', $newContent);
    }

    /** @test */
    public function it_can_toggle_toolbar()
    {
        $component = Livewire::test(TipTapEditor::class, ['showToolbar' => false]);

        $component->assertSet('showToolbar', false);

        $component->set('showToolbar', true);
        $component->assertSet('showToolbar', true);
    }

    /** @test */
    public function it_can_toggle_bubble_menu()
    {
        $component = Livewire::test(TipTapEditor::class);

        $component->set('showBubbleMenu', true);
        $component->assertSet('showBubbleMenu', true);
    }

    /** @test */
    public function it_can_toggle_floating_menu()
    {
        $component = Livewire::test(TipTapEditor::class);

        $component->set('showFloatingMenu', true);
        $component->assertSet('showFloatingMenu', true);
    }

    /** @test */
    public function it_accepts_custom_config()
    {
        $config = ['extensions' => ['bold', 'italic']];
        
        $component = Livewire::test(TipTapEditor::class, ['config' => $config]);

        $this->assertIsArray($component->get('config'));
    }

    /** @test */
    public function it_can_set_theme()
    {
        $component = Livewire::test(TipTapEditor::class, ['theme' => 'dark']);

        $component->assertSet('theme', 'dark');
    }

    /** @test */
    public function it_renders_successfully()
    {
        $component = Livewire::test(TipTapEditor::class);

        $component->assertViewIs('livewire-editor::components.forms.editor.tiptap-editor');
    }
}
