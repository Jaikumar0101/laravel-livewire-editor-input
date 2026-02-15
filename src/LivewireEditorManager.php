<?php

namespace YourVendor\LivewireEditor;

use Illuminate\Support\Facades\App;

class LivewireEditorManager
{
    protected $app;
    protected static $assetsLoaded = [];

    public function __construct($app)
    {
        $this->app = $app;
    }

    /**
     * Load all assets for specified editor(s)
     */
    public function assets($editor = null): string
    {
        $editor = $this->normalizeEditorName($editor);
        
        $html = [];
        
        // Add Alpine.js if not already added
        $html[] = $this->alpineJs();
        
        // Add CSS
        $html[] = $this->css();
        
        // Add editor-specific JavaScript
        $html[] = $this->js($editor);
        
        return implode("\n", array_filter($html));
    }

    /**
     * Get CSS assets
     */
    public function css(): string
    {
        if (isset(self::$assetsLoaded['css'])) {
            return '';
        }

        self::$assetsLoaded['css'] = true;

        $strategy = config('livewire-editor.asset_strategy', 'cdn');
        
        if ($strategy === 'local') {
            return '<link rel="stylesheet" href="' . asset('vendor/livewire-editor/css/editor.css') . '">';
        }

        // For Vite or Mix, return empty as they handle CSS differently
        if (in_array($strategy, ['vite', 'mix'])) {
            return '<!-- Livewire Editor CSS loaded via ' . $strategy . ' -->';
        }

        // Default to local
        return '<link rel="stylesheet" href="' . asset('vendor/livewire-editor/css/editor.css') . '">';
    }

    /**
     * Get JavaScript assets for editor(s)
     */
    public function js($editor = null): string
    {
        $editor = $this->normalizeEditorName($editor);
        
        $scripts = [];
        
        if ($editor === 'all' || $editor === null) {
            $scripts[] = $this->getCkEditorScripts();
            $scripts[] = $this->getCkEditor5Scripts();
            $scripts[] = $this->getTipTapScripts();
        } elseif ($editor === 'ckeditor') {
            $scripts[] = $this->getCkEditorScripts();
        } elseif ($editor === 'ckeditor5') {
            $scripts[] = $this->getCkEditor5Scripts();
        } elseif ($editor === 'tiptap') {
            $scripts[] = $this->getTipTapScripts();
        }
        
        return implode("\n", array_filter($scripts));
    }

    /**
     * Get Alpine.js script
     */
    public function alpineJs(): string
    {
        if (isset(self::$assetsLoaded['alpine'])) {
            return '';
        }

        self::$assetsLoaded['alpine'] = true;

        return '<script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>';
    }

    /**
     * Get CKEditor 4 scripts
     */
    protected function getCkEditorScripts(): string
    {
        if (isset(self::$assetsLoaded['ckeditor']) || !config('livewire-editor.ckeditor.enabled', true)) {
            return '';
        }

        self::$assetsLoaded['ckeditor'] = true;

        $cdn = config('livewire-editor.ckeditor.cdn');
        
        return '<script src="' . $cdn . '"></script>';
    }

    /**
     * Get CKEditor 5 scripts
     */
    protected function getCkEditor5Scripts(): string
    {
        if (isset(self::$assetsLoaded['ckeditor5']) || !config('livewire-editor.ckeditor5.enabled', true)) {
            return '';
        }

        self::$assetsLoaded['ckeditor5'] = true;

        $cdn = config('livewire-editor.ckeditor5.cdn');
        
        return '<script src="' . $cdn . '"></script>';
    }

    /**
     * Get TipTap scripts
     */
    protected function getTipTapScripts(): string
    {
        if (isset(self::$assetsLoaded['tiptap']) || !config('livewire-editor.tiptap.enabled', true)) {
            return '';
        }

        self::$assetsLoaded['tiptap'] = true;

        $cdnConfig = config('livewire-editor.tiptap.cdn', []);
        $scripts = [];

        // Load core libraries
        if (isset($cdnConfig['pm'])) {
            $scripts[] = '<script src="' . $cdnConfig['pm'] . '"></script>';
        }
        
        if (isset($cdnConfig['core'])) {
            $scripts[] = '<script src="' . $cdnConfig['core'] . '"></script>';
        }
        
        if (isset($cdnConfig['starter_kit'])) {
            $scripts[] = '<script src="' . $cdnConfig['starter_kit'] . '"></script>';
        }

        // Load extension libraries based on config
        $extensions = config('livewire-editor.tiptap.extensions', []);
        
        foreach ($extensions as $extension => $config) {
            if (isset($config['enabled']) && $config['enabled']) {
                $cdnKey = 'extension_' . strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $extension));
                if (isset($cdnConfig[$cdnKey])) {
                    $scripts[] = '<script src="' . $cdnConfig[$cdnKey] . '"></script>';
                }
            }
        }

        return implode("\n", $scripts);
    }

    /**
     * Normalize editor name
     */
    protected function normalizeEditorName($editor): string
    {
        if ($editor === null) {
            return config('livewire-editor.default', 'ckeditor5');
        }

        // Remove quotes if present
        $editor = trim($editor, "'\"");
        
        return strtolower($editor);
    }

    /**
     * Reset loaded assets (useful for testing)
     */
    public static function resetAssets(): void
    {
        self::$assetsLoaded = [];
    }
}
