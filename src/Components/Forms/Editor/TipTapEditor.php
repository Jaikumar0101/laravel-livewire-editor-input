<?php

namespace YourVendor\LivewireEditor\Components\Forms\Editor;

use Livewire\Component;

class TipTapEditor extends Component
{
    public $content = '';
    public $editorId;
    public $config = [];
    
    public function mount($content = '', $config = [])
    {
        $this->content = $content;
        $this->editorId = 'tiptap-' . uniqid();
        $this->config = array_merge(
            config('livewire-editor.tiptap.default_config', []),
            $config
        );
    }

    public function updatedContent($value)
    {
        $this->dispatch('editor-updated', content: $value);
    }

    public function render()
    {
        return view('livewire-editor::components.forms.editor.tiptap-editor');
    }
}
