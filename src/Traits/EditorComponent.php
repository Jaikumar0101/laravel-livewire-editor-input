<?php

namespace Jaikumar0101\LivewireEditor\Traits;

trait EditorComponent
{
    public $content = '';
    public $editorId;
    public $config = [];
    public $theme = 'default';
    public $readOnly = false;
    public $placeholder = '';
    public $height = null;
    public $autoSave = false;
    public $showCounter = false;

    public function initializeEditor($content = '', $config = [])
    {
        $this->content = $content;
        $this->editorId = $this->generateEditorId();
        $this->config = $this->mergeConfig($config);
        $this->applyGlobalSettings();
    }

    protected function generateEditorId(): string
    {
        $editorType = class_basename($this);
        return strtolower($editorType) . '-' . uniqid();
    }

    protected function mergeConfig(array $userConfig = []): array
    {
        $editorKey = $this->getEditorConfigKey();
        $defaultConfig = config("livewire-editor.{$editorKey}.default_config", []);
        
        return array_merge($defaultConfig, $userConfig);
    }

    protected function applyGlobalSettings(): void
    {
        $globalConfig = config('livewire-editor.global', []);
        
        if (isset($globalConfig['read_only'])) {
            $this->readOnly = $globalConfig['read_only'];
        }

        if (isset($globalConfig['auto_save']['enabled'])) {
            $this->autoSave = $globalConfig['auto_save']['enabled'];
        }

        if (isset($globalConfig['counter']['enabled'])) {
            $this->showCounter = $globalConfig['counter']['enabled'];
        }
    }

    abstract protected function getEditorConfigKey(): string;

    public function updatedContent($value)
    {
        $this->dispatch('editor-updated', [
            'editorId' => $this->editorId,
            'content' => $value,
        ]);

        if ($this->autoSave) {
            $this->dispatch('editor-auto-save', [
                'editorId' => $this->editorId,
                'content' => $value,
            ]);
        }
    }

    public function setContent($content)
    {
        $this->content = $content;
        $this->dispatch('set-editor-content', [
            'editorId' => $this->editorId,
            'content' => $content,
        ]);
    }

    public function getContent()
    {
        return $this->content;
    }

    public function clearContent()
    {
        $this->content = '';
        $this->dispatch('clear-editor-content', [
            'editorId' => $this->editorId,
        ]);
    }

    public function setReadOnly($readOnly = true)
    {
        $this->readOnly = $readOnly;
        $this->dispatch('set-editor-readonly', [
            'editorId' => $this->editorId,
            'readOnly' => $readOnly,
        ]);
    }

    protected function getThemeStyles(): array
    {
        $themeName = $this->theme;
        return config("livewire-editor.themes.{$themeName}", config('livewire-editor.themes.default', []));
    }

    protected function getToolbarConfig(): array
    {
        $editorKey = $this->getEditorConfigKey();
        return config("livewire-editor.{$editorKey}.toolbar", []);
    }

    protected function getPluginsConfig(): array
    {
        $editorKey = $this->getEditorConfigKey();
        return config("livewire-editor.{$editorKey}.plugins", []);
    }

    protected function getExtensionsConfig(): array
    {
        $editorKey = $this->getEditorConfigKey();
        return config("livewire-editor.{$editorKey}.extensions", []);
    }
}
