# Laravel Livewire Editor Package

A comprehensive Laravel package providing multiple WYSIWYG editor components for Livewire 3, including CKEditor 4, CKEditor 5, and TipTap.

## Features

- 🎨 Multiple editor options (CKEditor 4, CKEditor 5, TipTap)
- ⚡ Built for Livewire 3
- 🔧 Highly configurable
- 📦 Easy installation and setup
- 🎯 Simple Blade directive for assets
- 🌙 Dark mode support (for TipTap)

## Requirements

- PHP 8.1 or higher
- Laravel 10.x or 11.x
- Livewire 3.x

## Installation

Install the package via Composer:

```bash
composer require yourvendor/livewire-editor
```

### Publish Assets

Publish the package assets:

```bash
php artisan vendor:publish --tag=livewire-editor-assets
```

Publish the configuration file (optional):

```bash
php artisan vendor:publish --tag=livewire-editor-config
```

Publish the views (optional, for customization):

```bash
php artisan vendor:publish --tag=livewire-editor-views
```

## Usage

### 1. Include Assets in Your Layout

Add the `@livewireEditorAssets` directive in your layout file's `<head>` section:

```blade
<!DOCTYPE html>
<html>
<head>
    <!-- Your other head content -->
    
    @livewireEditorAssets('ckeditor5')
    {{-- Or load all editors --}}
    @livewireEditorAssets
</head>
<body>
    {{ $slot }}
</body>
</html>
```

Available asset options:
- `@livewireEditorAssets('ckeditor')` - CKEditor 4 only
- `@livewireEditorAssets('ckeditor5')` - CKEditor 5 only
- `@livewireEditorAssets('tiptap')` - TipTap only
- `@livewireEditorAssets` or `@livewireEditorAssets('all')` - All editors

### 2. Use in Your Blade Views

#### CKEditor 5 (Recommended)

```blade
<livewire:forms.editor.ckeditor5 :content="$post->body" />
```

Or with the `@livewire` directive:

```blade
@livewire('forms.editor.ckeditor5', ['content' => $content])
```

#### CKEditor 4

```blade
<livewire:forms.editor.ckeditor :content="$post->body" />
```

#### TipTap

```blade
<livewire:forms.editor.tiptap :content="$post->body" />
```

### 3. Using in Livewire Components

In your Livewire component:

```php
<?php

namespace App\Livewire;

use Livewire\Component;

class PostEditor extends Component
{
    public $content = '';

    public function mount($post = null)
    {
        if ($post) {
            $this->content = $post->body;
        }
    }

    public function save()
    {
        $this->validate([
            'content' => 'required|min:10',
        ]);

        // Save your content
        Post::create([
            'body' => $this->content,
        ]);
    }

    public function render()
    {
        return view('livewire.post-editor');
    }
}
```

In your view file (`resources/views/livewire/post-editor.blade.php`):

```blade
<div>
    <form wire:submit="save">
        <div>
            <label>Content</label>
            <livewire:forms.editor.ckeditor5 wire:model="content" />
            @error('content') <span class="error">{{ $message }}</span> @enderror
        </div>

        <button type="submit">Save Post</button>
    </form>
</div>
```

### 4. Custom Configuration

You can pass custom configuration to any editor:

```blade
<livewire:forms.editor.ckeditor5 
    :content="$content" 
    :config="[
        'toolbar' => ['heading', 'bold', 'italic', 'link'],
        'placeholder' => 'Start typing...'
    ]" 
/>
```

## Configuration

The configuration file (`config/livewire-editor.php`) allows you to customize default settings:

```php
return [
    'default' => 'ckeditor5', // Default editor
    
    'ckeditor5' => [
        'default_config' => [
            'toolbar' => ['heading', 'bold', 'italic', 'link'],
        ],
    ],
    
    // ... other options
];
```

## Editor Events

All editors dispatch a `editor-updated` event when content changes:

```blade
<div>
    <livewire:forms.editor.ckeditor5 wire:model="content" />
    
    <script>
        Livewire.on('editor-updated', (event) => {
            console.log('Editor content updated:', event.content);
        });
    </script>
</div>
```

## Styling

The package includes default styles that work with Tailwind CSS. You can customize the styles by:

1. Publishing the CSS file and modifying it
2. Overriding CSS variables in your own stylesheet
3. Publishing and modifying the Blade views

## Troubleshooting

### Editors not loading

Make sure you've:
1. Published the assets: `php artisan vendor:publish --tag=livewire-editor-assets`
2. Included `@livewireEditorAssets` in your layout
3. Cleared your browser cache

### Content not syncing with Livewire

Ensure you're using `wire:model` or properly binding the content:

```blade
<livewire:forms.editor.ckeditor5 wire:model="content" />
```

## License

This package is open-sourced software licensed under the MIT license.

## Credits

- CKEditor 4 by CKSource
- CKEditor 5 by CKSource
- TipTap by Tiptap GmbH

## Support

For issues, questions, or contributions, please visit the GitHub repository.
