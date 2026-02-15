<?php

namespace Jaikumar0101\LivewireEditor\Components\Forms\Editor;

use Livewire\Component;
use Jaikumar0101\LivewireEditor\Traits\EditorComponent;

class CkEditor5 extends Component
{
    use EditorComponent;

    public function mount($content = '', $config = [], $theme = 'default', $placeholder = null)
    {
        $this->initializeEditor($content, $config);
        $this->theme = $theme;
        
        if ($placeholder) {
            $this->placeholder = $placeholder;
            $this->config['placeholder'] = $placeholder;
        }
    }

    protected function getEditorConfigKey(): string
    {
        return 'ckeditor5';
    }

    public function getEditorConfig(): array
    {
        $config = $this->config;
        
        // Merge toolbar configuration
        if (!isset($config['toolbar'])) {
            $config['toolbar'] = $this->getToolbarConfig();
        }

        // Add image upload configuration if enabled
        $uploadConfig = config('livewire-editor.ckeditor5.simpleUpload');
        if ($uploadConfig && isset($uploadConfig['uploadUrl'])) {
            $config['simpleUpload'] = $uploadConfig;
            
            // Replace CSRF token placeholder
            if (isset($config['simpleUpload']['headers']['X-CSRF-TOKEN'])) {
                $config['simpleUpload']['headers']['X-CSRF-TOKEN'] = csrf_token();
            }
        }

        // Add other configurations
        $config['heading'] = config('livewire-editor.ckeditor5.heading', []);
        $config['image'] = config('livewire-editor.ckeditor5.image', []);
        $config['table'] = config('livewire-editor.ckeditor5.table', []);
        $config['link'] = config('livewire-editor.ckeditor5.link', []);
        $config['fontSize'] = config('livewire-editor.ckeditor5.fontSize', []);
        $config['fontFamily'] = config('livewire-editor.ckeditor5.fontFamily', []);
        $config['fontColor'] = config('livewire-editor.ckeditor5.fontColor', []);
        $config['fontBackgroundColor'] = config('livewire-editor.ckeditor5.fontBackgroundColor', []);
        $config['codeBlock'] = config('livewire-editor.ckeditor5.codeBlock', []);
        $config['htmlEmbed'] = config('livewire-editor.ckeditor5.htmlEmbed', []);

        return $config;
    }

    public function render()
    {
        return view('livewire-editor::components.forms.editor.ckeditor5', [
            'editorConfig' => $this->getEditorConfig(),
            'themeStyles' => $this->getThemeStyles(),
        ]);
    }
}
