<?php

namespace Jaikumar0101\LivewireEditor\Components\Forms\Editor;

use Livewire\Component;
use Jaikumar0101\LivewireEditor\Traits\EditorComponent;

class TipTapEditor extends Component
{
    use EditorComponent;

    public $showToolbar = true;
    public $showBubbleMenu = false;
    public $showFloatingMenu = false;

    public function mount($content = '', $config = [], $theme = 'default', $showToolbar = null)
    {
        $this->initializeEditor($content, $config);
        $this->theme = $theme;
        
        if ($showToolbar !== null) {
            $this->showToolbar = $showToolbar;
        } else {
            $this->showToolbar = config('livewire-editor.tiptap.toolbar.enabled', true);
        }

        $this->showBubbleMenu = config('livewire-editor.tiptap.bubble_menu.enabled', true);
        $this->showFloatingMenu = config('livewire-editor.tiptap.floating_menu.enabled', false);
    }

    protected function getEditorConfigKey(): string
    {
        return 'tiptap';
    }

    public function getExtensions(): array
    {
        $extensions = $this->getExtensionsConfig();
        $enabledExtensions = [];

        foreach ($extensions as $name => $extensionConfig) {
            if (isset($extensionConfig['enabled']) && $extensionConfig['enabled']) {
                $enabledExtensions[$name] = $extensionConfig['config'] ?? [];
            }
        }

        return $enabledExtensions;
    }

    public function getToolbarButtons(): array
    {
        return config('livewire-editor.tiptap.toolbar.buttons', []);
    }

    public function getBubbleMenuButtons(): array
    {
        return config('livewire-editor.tiptap.bubble_menu.buttons', []);
    }

    public function render()
    {
        return view('livewire-editor::components.forms.editor.tiptap-editor', [
            'editorId' => $this->editorId,
            'content' => $this->content,
            'extensions' => $this->getExtensions(),
            'toolbarButtons' => $this->getToolbarButtons(),
            'bubbleMenuButtons' => $this->getBubbleMenuButtons(),
            'themeStyles' => $this->getThemeStyles(),
            'readOnly' => $this->readOnly,
            'showCounter' => $this->showCounter,
            'autoSave' => $this->autoSave,
            'showToolbar' => $this->showToolbar,
        ]);
    }
}
