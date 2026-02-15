<?php

namespace Jaikumar0101\LivewireEditor\Tests\Unit;

use Jaikumar0101\LivewireEditor\Tests\TestCase;
use Jaikumar0101\LivewireEditor\Traits\EditorComponent;
use Livewire\Component;

class EditorComponentTraitTest extends TestCase
{
    /** @test */
    public function it_has_content_property()
    {
        $component = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $this->assertObjectHasProperty('content', $component);
    }

    /** @test */
    public function it_has_editor_id_property()
    {
        $component = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $this->assertObjectHasProperty('editorId', $component);
    }

    /** @test */
    public function it_has_config_property()
    {
        $component = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $this->assertObjectHasProperty('config', $component);
    }

    /** @test */
    public function it_has_theme_property()
    {
        $component = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $this->assertObjectHasProperty('theme', $component);
    }

    /** @test */
    public function it_has_readonly_property()
    {
        $component = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $this->assertObjectHasProperty('readOnly', $component);
    }

    /** @test */
    public function it_has_placeholder_property()
    {
        $component = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $this->assertObjectHasProperty('placeholder', $component);
    }

    /** @test */
    public function it_has_auto_save_property()
    {
        $component = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $this->assertObjectHasProperty('autoSave', $component);
    }

    /** @test */
    public function it_has_show_counter_property()
    {
        $component = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $this->assertObjectHasProperty('showCounter', $component);
    }

    /** @test */
    public function it_can_initialize_editor()
    {
        $component = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function mount()
            {
                $this->initializeEditor('<p>Test</p>', ['key' => 'value']);
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $component->mount();

        $this->assertEquals('<p>Test</p>', $component->content);
        $this->assertIsString($component->editorId);
        $this->assertIsArray($component->config);
    }

    /** @test */
    public function it_generates_unique_editor_ids()
    {
        $component1 = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function mount()
            {
                $this->initializeEditor();
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $component2 = new class extends Component {
            use EditorComponent;

            protected function getEditorConfigKey(): string
            {
                return 'ckeditor5';
            }

            public function mount()
            {
                $this->initializeEditor();
            }

            public function render()
            {
                return view('livewire-editor::components.forms.editor.ckeditor5');
            }
        };

        $component1->mount();
        $component2->mount();

        $this->assertNotEquals($component1->editorId, $component2->editorId);
    }
}
