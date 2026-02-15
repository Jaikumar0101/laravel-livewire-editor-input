<?php

namespace YourVendor\LivewireEditor\Facades;

use Illuminate\Support\Facades\Facade;

class LivewireEditor extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'livewire-editor';
    }

    public static function assets($editor = null)
    {
        $assets = [];
        
        if ($editor === null || $editor === 'all' || $editor === "'all'") {
            // Load all editor assets
            $assets[] = '<link rel="stylesheet" href="' . asset('vendor/livewire-editor/css/editor.css') . '">';
            $assets[] = '<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>';
            $assets[] = '<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>';
            $assets[] = '<script src="https://unpkg.com/@tiptap/pm@latest/dist/index.js"></script>';
            $assets[] = '<script src="https://unpkg.com/@tiptap/core@latest/dist/index.umd.js"></script>';
            $assets[] = '<script src="https://unpkg.com/@tiptap/starter-kit@latest/dist/index.umd.js"></script>';
            $assets[] = '<script src="' . asset('vendor/livewire-editor/js/ckeditor.js') . '"></script>';
            $assets[] = '<script src="' . asset('vendor/livewire-editor/js/ckeditor5.js') . '"></script>';
            $assets[] = '<script src="' . asset('vendor/livewire-editor/js/tiptap.js') . '"></script>';
        } elseif ($editor === 'ckeditor' || $editor === "'ckeditor'") {
            $assets[] = '<link rel="stylesheet" href="' . asset('vendor/livewire-editor/css/editor.css') . '">';
            $assets[] = '<script src="https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js"></script>';
            $assets[] = '<script src="' . asset('vendor/livewire-editor/js/ckeditor.js') . '"></script>';
        } elseif ($editor === 'ckeditor5' || $editor === "'ckeditor5'") {
            $assets[] = '<link rel="stylesheet" href="' . asset('vendor/livewire-editor/css/editor.css') . '">';
            $assets[] = '<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script>';
            $assets[] = '<script src="' . asset('vendor/livewire-editor/js/ckeditor5.js') . '"></script>';
        } elseif ($editor === 'tiptap' || $editor === "'tiptap'") {
            $assets[] = '<link rel="stylesheet" href="' . asset('vendor/livewire-editor/css/editor.css') . '">';
            $assets[] = '<script src="https://unpkg.com/@tiptap/pm@latest/dist/index.js"></script>';
            $assets[] = '<script src="https://unpkg.com/@tiptap/core@latest/dist/index.umd.js"></script>';
            $assets[] = '<script src="https://unpkg.com/@tiptap/starter-kit@latest/dist/index.umd.js"></script>';
            $assets[] = '<script src="' . asset('vendor/livewire-editor/js/tiptap.js') . '"></script>';
        }
        
        return implode("\n", $assets);
    }
}
