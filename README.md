# Laravel Livewire Editor Package 🚀

[![Latest Version](https://img.shields.io/packagist/v/jaikumar0101/livewire-editor-input.svg)](https://packagist.org/packages/jaikumar0101/livewire-editor-input)
[![License](https://img.shields.io/packagist/l/jaikumar0101/livewire-editor-input.svg)](https://packagist.org/packages/jaikumar0101/livewire-editor-input)

A **premium**, **production-ready** Laravel package providing powerful WYSIWYG editor components for Livewire 3, powered by Alpine.js. Choose from CKEditor 4, CKEditor 5, or TipTap with extensive customization options.

## ✨ Features

- 🎨 **Three Powerful Editors**: CKEditor 4, CKEditor 5, and TipTap
- ⚡ **Alpine.js Powered**: Reactive, lightweight, and fast
- 🔧 **Highly Configurable**: Extensive plugin and toolbar customization
- 📦 **Easy Installation**: Simple setup with sensible defaults
- 🎯 **Livewire 3 Native**: Built specifically for Livewire 3
- 🌙 **Dark Mode Support**: Built-in dark theme
- 💾 **Auto-Save**: Optional auto-save functionality
- 📊 **Word/Character Counter**: Track content length
- 🎨 **Custom Themes**: Define your own color schemes
- 🖼️ **Image Upload**: Configurable image upload support
- 📱 **Responsive**: Works beautifully on all devices
- 🔒 **Read-Only Mode**: Toggle edit mode programmatically
- 🎬 **Event System**: Rich event hooks and listeners

## 📋 Requirements

- PHP 8.1 or higher
- Laravel 10.x or 11.x
- Livewire 3.x
- Alpine.js 3.x (included via CDN by default)

## 📦 Installation

Install via Composer:

```bash
composer require jaikumar0101/livewire-editor-input
```

### Publish Assets

Publish the package assets:

```bash
php artisan vendor:publish --tag=livewire-editor-assets
```

Publish configuration file (optional):

```bash
php artisan vendor:publish --tag=livewire-editor-config
```

Publish views for customization (optional):

```bash
php artisan vendor:publish --tag=livewire-editor-views
```

Or publish everything at once:

```bash
php artisan vendor:publish --tag=livewire-editor
```

## 🚀 Quick Start

### 1. Add Assets to Your Layout

```blade
<!DOCTYPE html>
<html>
<head>
    <!-- Other head content -->
    
    {{-- Load CKEditor 5 only --}}
    @livewireEditorAssets('ckeditor5')
    
    {{-- Or load all editors --}}
    @livewireEditorAssets
    
    @livewireStyles
</head>
<body>
    {{ $slot }}
    
    @livewireScripts
</body>
</html>
```

### 2. Use in Your Livewire Components

**In Your View:**
```blade
<div>
    <label>Content</label>
    <livewire:forms.editor.ckeditor5 wire:model="content" />
    
    @error('content') 
        <span class="text-red-500">{{ $message }}</span> 
    @enderror
</div>
```

**In Your Livewire Component:**
```php
<?php

namespace App\Livewire;

use Livewire\Component;

class PostEditor extends Component
{
    public $content = '';

    public function save()
    {
        $this->validate([
            'content' => 'required|min:50',
        ]);

        Post::create(['body' => $this->content]);
        
        session()->flash('message', 'Saved!');
    }

    public function render()
    {
        return view('livewire.post-editor');
    }
}
```

## 📝 Available Editors

### CKEditor 5 (Recommended)

Modern, modular editor with extensive features:

```blade
<livewire:forms.editor.ckeditor5 
    :content="$post->body"
    :config="['placeholder' => 'Start writing...']"
    theme="default"
/>
```

### TipTap

Headless editor with custom toolbar:

```blade
<livewire:forms.editor.tiptap 
    :content="$post->body"
    :showToolbar="true"
    theme="dark"
/>
```

### CKEditor 4

Classic, reliable editor:

```blade
<livewire:forms.editor.ckeditor 
    :content="$post->body"
    :height="400"
/>
```

## ⚙️ Configuration

The configuration file offers extensive customization options:

```php
// config/livewire-editor.php

return [
    // Default editor
    'default' => 'ckeditor5',
    
    // Asset loading strategy: 'cdn', 'local', 'vite', 'mix'
    'asset_strategy' => 'cdn',
    
    // Editor-specific configurations
    'ckeditor5' => [
        'toolbar' => [...],
        'plugins' => [...],
        'image_upload' => [...],
        // ... more options
    ],
    
    'tiptap' => [
        'extensions' => [...],
        'toolbar' => [...],
        'bubble_menu' => [...],
        // ... more options
    ],
    
    // Global settings
    'global' => [
        'auto_save' => [
            'enabled' => true,
            'interval' => 30000, // ms
        ],
        'counter' => [
            'enabled' => true,
            'type' => 'words', // 'words' or 'characters'
        ],
    ],
    
    // Custom themes
    'themes' => [
        'default' => [...],
        'dark' => [...],
    ],
];
```

## 🎨 Advanced Usage

### Custom Configuration

```blade
@php
$editorConfig = [
    'toolbar' => [
        'items' => ['heading', 'bold', 'italic', 'link', 'bulletedList'],
    ],
    'placeholder' => 'Write something amazing...',
    'heading' => [
        'options' => [
            ['model' => 'paragraph', 'title' => 'Paragraph'],
            ['model' => 'heading1', 'view' => 'h1', 'title' => 'Heading 1'],
            ['model' => 'heading2', 'view' => 'h2', 'title' => 'Heading 2'],
        ]
    ]
];
@endphp

<livewire:forms.editor.ckeditor5 
    :content="$content" 
    :config="$editorConfig"
/>
```

### Programmatic Control

```php
// In your Livewire component

public function clearEditor()
{
    $this->dispatch('clear-editor-content', [
        'editorId' => $this->editorId
    ]);
}

public function setReadOnly()
{
    $this->dispatch('set-editor-readonly', [
        'editorId' => $this->editorId,
        'readOnly' => true
    ]);
}
```

### Event Listeners

```blade
<div>
    <livewire:forms.editor.ckeditor5 wire:model="content" />

    @push('scripts')
    <script>
        Livewire.on('editor-updated', (data) => {
            console.log('Content updated:', data.content);
        });

        Livewire.on('editor-auto-save', (data) => {
            // Handle auto-save
            console.log('Auto-saving...', data.content);
        });
    </script>
    @endpush
</div>
```

### Multiple Editors

```blade
<div class="space-y-6">
    <div>
        <label>Introduction</label>
        <livewire:forms.editor.ckeditor5 
            wire:model="introduction" 
            key="intro-editor"
        />
    </div>

    <div>
        <label>Main Content</label>
        <livewire:forms.editor.ckeditor5 
            wire:model="content" 
            key="main-editor"
        />
    </div>
</div>
```

### Image Upload Configuration

**CKEditor 5:**

```php
// config/livewire-editor.php

'ckeditor5' => [
    'simpleUpload' => [
        'uploadUrl' => '/api/editor/upload',
        'withCredentials' => true,
        'headers' => [
            'X-CSRF-TOKEN' => 'CSRF-Token',
        ],
    ],
],
```

**Laravel Route:**

```php
Route::post('/api/editor/upload', function (Request $request) {
    $request->validate([
        'upload' => 'required|image|max:2048',
    ]);

    $path = $request->file('upload')->store('uploads', 'public');
    $url = Storage::url($path);

    return response()->json([
        'url' => $url
    ]);
})->middleware('auth');
```

### Custom Plugins (CKEditor 5)

```php
'ckeditor5' => [
    'plugins' => [
        'Essentials',
        'Bold',
        'Italic',
        // Add your custom plugins here
        'MyCustomPlugin',
    ],
],
```

### TipTap Extensions

```php
'tiptap' => [
    'extensions' => [
        'StarterKit' => [
            'enabled' => true,
            'config' => [
                'heading' => [
                    'levels' => [1, 2, 3],
                ],
            ],
        ],
        'Underline' => ['enabled' => true],
        'Link' => [
            'enabled' => true,
            'config' => [
                'openOnClick' => false,
            ],
        ],
        'Image' => [
            'enabled' => true,
            'config' => [
                'inline' => true,
                'allowBase64' => true,
            ],
        ],
    ],
],
```

### Custom Toolbar (TipTap)

```php
'tiptap' => [
    'toolbar' => [
        'enabled' => true,
        'sticky' => true,
        'buttons' => [
            ['type' => 'bold', 'icon' => 'B', 'title' => 'Bold'],
            ['type' => 'italic', 'icon' => 'I', 'title' => 'Italic'],
            ['type' => 'separator'],
            ['type' => 'heading', 'level' => 1, 'icon' => 'H1', 'title' => 'Heading 1'],
            ['type' => 'link', 'icon' => '🔗', 'title' => 'Link'],
        ],
    ],
],
```

## 🎨 Theming

Define custom themes:

```php
'themes' => [
    'custom' => [
        'primary_color' => '#8b5cf6',
        'toolbar_bg' => '#f3f4f6',
        'editor_bg' => '#ffffff',
        'border_color' => '#d1d5db',
        'text_color' => '#111827',
    ],
],
```

Use in component:

```blade
<livewire:forms.editor.ckeditor5 
    :content="$content"
    theme="custom"
/>
```

## 📊 Features in Detail

### Auto-Save

```php
// Enable globally
'global' => [
    'auto_save' => [
        'enabled' => true,
        'interval' => 30000, // Save every 30 seconds
    ],
],
```

Listen for auto-save events:

```blade
@push('scripts')
<script>
    Livewire.on('editor-auto-save', (data) => {
        // Send AJAX request to save
        fetch('/api/auto-save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ content: data.content })
        });
    });
</script>
@endpush
```

### Word/Character Counter

```php
'global' => [
    'counter' => [
        'enabled' => true,
        'type' => 'words', // or 'characters'
    ],
],
```

### Read-Only Mode

```php
// In Livewire component
public $readOnly = false;

public function toggleReadOnly()
{
    $this->readOnly = !$this->readOnly;
}
```

## 🔧 Troubleshooting

### Editors Not Loading

1. Ensure `@livewireEditorAssets` is in your `<head>`
2. Check browser console for errors
3. Verify CDN access
4. Clear browser cache

### Content Not Syncing

1. Use `wire:model` for two-way binding
2. Ensure Livewire is properly initialized
3. Check for JavaScript errors

### Alpine.js Conflicts

If you already have Alpine.js loaded, use:

```blade
@livewireEditorJs('ckeditor5')
@livewireEditorCss
```

## 📚 Documentation

- [Installation Guide](INSTALLATION.md)
- [Configuration Reference](CONFIGURATION.md)
- [API Documentation](API.md)
- [Examples](EXAMPLES.md)
- [Changelog](CHANGELOG.md)

## 🤝 Contributing

Contributions are welcome! Please see [CONTRIBUTING.md](CONTRIBUTING.md) for details.

## 🐛 Issues

Found a bug? Please [open an issue](https://github.com/Jaikumar0101/laravel-livewire-editor-input/issues).

## 📄 License

This package is open-sourced software licensed under the [MIT license](LICENSE).

## 🙏 Credits

- **CKEditor 4** by [CKSource](https://ckeditor.com/ckeditor-4/)
- **CKEditor 5** by [CKSource](https://ckeditor.com/ckeditor-5/)
- **TipTap** by [Tiptap GmbH](https://tiptap.dev/)
- **Alpine.js** by [Caleb Porzio](https://alpinejs.dev/)
- **Livewire** by [Caleb Porzio](https://laravel-livewire.com/)

## 🌟 Support

If you find this package helpful, please ⭐ star it on GitHub!

---

Made with ❤️ for the Laravel community
