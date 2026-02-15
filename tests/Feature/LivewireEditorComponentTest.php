<?php

namespace Jaikumar0101\LivewireEditor\Tests\Feature;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Jaikumar0101\LivewireEditor\Components\Forms\Editor\CkEditor5;
use Livewire\Livewire;

class LivewireEditorComponentTest extends TestCase
{
    /** @test */
    public function it_can_render_ckeditor5_component()
    {
        $component = Livewire::test(CkEditor5::class);

        $component
            ->assertStatus(200)
            ->assertSee('ckeditor5');
    }

    /** @test */
    public function it_can_bind_content_with_wire_model()
    {
        $component = Livewire::test(CkEditor5::class);

        $content = '<p>New content</p>';
        $component->set('content', $content);

        $component->assertSet('content', $content);
    }

    /** @test */
    public function it_persists_content_after_update()
    {
        $initialContent = '<p>Initial content</p>';
        $component = Livewire::test(CkEditor5::class, ['content' => $initialContent]);

        $component->assertSet('content', $initialContent);

        $updatedContent = '<p>Updated content</p>';
        $component->set('content', $updatedContent);

        $component->assertSet('content', $updatedContent);
    }

    /** @test */
    public function it_can_handle_empty_content()
    {
        $component = Livewire::test(CkEditor5::class);

        $component->set('content', '');
        $component->assertSet('content', '');
    }

    /** @test */
    public function it_can_handle_html_content()
    {
        $htmlContent = '<h1>Heading</h1><p>Paragraph with <strong>bold</strong> and <em>italic</em> text.</p>';
        
        $component = Livewire::test(CkEditor5::class, ['content' => $htmlContent]);

        $component->assertSet('content', $htmlContent);
    }

    /** @test */
    public function it_maintains_state_across_updates()
    {
        $component = Livewire::test(CkEditor5::class);

        $component->set('content', '<p>First</p>');
        $component->assertSet('content', '<p>First</p>');

        $component->set('content', '<p>Second</p>');
        $component->assertSet('content', '<p>Second</p>');

        $component->set('content', '<p>Third</p>');
        $component->assertSet('content', '<p>Third</p>');
    }

    /** @test */
    public function it_can_have_multiple_instances_on_same_page()
    {
        $component1 = Livewire::test(CkEditor5::class, ['content' => '<p>Component 1</p>']);
        $component2 = Livewire::test(CkEditor5::class, ['content' => '<p>Component 2</p>']);

        $component1->assertSet('content', '<p>Component 1</p>');
        $component2->assertSet('content', '<p>Component 2</p>');

        // Ensure editor IDs are unique
        $this->assertNotEquals($component1->get('editorId'), $component2->get('editorId'));
    }
}
