<?php

namespace Jaikumar0101\LivewireEditor\Components\Forms\Editor;

use Livewire\Component;
use Jaikumar0101\LivewireEditor\Traits\EditorComponent;

class CkEditor extends Component
{
    use EditorComponent;

    public function mount($content = '', $config = [], $theme = 'default', $height = null)
    {
        $this->initializeEditor($content, $config);
        $this->theme = $theme;
        
        if ($height) {
            $this->height = $height;
            $this->config['height'] = $height;
        }
    }

    protected function getEditorConfigKey(): string
    {
        return 'ckeditor';
    }

    public function getEditorConfig(): array
    {
        $config = $this->config;
        
        // Merge toolbar configuration
        if (!isset($config['toolbar'])) {
            $config['toolbar'] = $this->getToolbarConfig();
        }

        // Add plugins
        $plugins = $this->getPluginsConfig();
        if ($plugins) {
            $config['extraPlugins'] = implode(',', array_merge(
                $plugins,
                config('livewire-editor.ckeditor.extra_plugins', [])
            ));
        }

        // Remove plugins
        $removedPlugins = config('livewire-editor.ckeditor.removed_plugins', []);
        if ($removedPlugins) {
            $config['removePlugins'] = implode(',', $removedPlugins);
        }

        // Image upload configuration
        $imageUpload = config('livewire-editor.ckeditor.image_upload');
        if ($imageUpload && $imageUpload['enabled']) {
            $config['filebrowserUploadUrl'] = $imageUpload['upload_url'];
            $config['filebrowserUploadMethod'] = 'form';
        }

        // File browser configuration
        $fileBrowser = config('livewire-editor.ckeditor.file_browser');
        if ($fileBrowser && $fileBrowser['enabled']) {
            $config['filebrowserBrowseUrl'] = $fileBrowser['browse_url'];
            $config['filebrowserUploadUrl'] = $fileBrowser['upload_url'];
        }

        return $config;
    }

    public function render()
    {
        return view('livewire-editor::components.forms.editor.ckeditor', [
            'editorConfig' => $this->getEditorConfig(),
            'themeStyles' => $this->getThemeStyles(),
        ]);
    }
}
