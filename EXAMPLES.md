# Example Usage

## Basic Usage Examples

### 1. Simple Blog Post Editor

```php
// app/Livewire/BlogPostForm.php
<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class BlogPostForm extends Component
{
    public $title = '';
    public $content = '';

    public function save()
    {
        $validated = $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:50',
        ]);

        Post::create($validated);
        
        session()->flash('message', 'Post created successfully!');
        return redirect()->to('/posts');
    }

    public function render()
    {
        return view('livewire.blog-post-form');
    }
}
```

```blade
<!-- resources/views/livewire/blog-post-form.blade.php -->
<div>
    <form wire:submit="save">
        <div class="mb-4">
            <label class="block mb-2">Title</label>
            <input type="text" wire:model="title" class="w-full border rounded px-3 py-2">
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-4">
            <label class="block mb-2">Content</label>
            <livewire:forms.editor.ckeditor5 wire:model="content" />
            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Create Post
        </button>
    </form>
</div>
```

### 2. Edit Existing Content

```php
// app/Livewire/EditPost.php
<?php

namespace App\Livewire;

use App\Models\Post;
use Livewire\Component;

class EditPost extends Component
{
    public Post $post;
    public $title;
    public $content;

    public function mount(Post $post)
    {
        $this->post = $post;
        $this->title = $post->title;
        $this->content = $post->content;
    }

    public function update()
    {
        $validated = $this->validate([
            'title' => 'required|min:3',
            'content' => 'required|min:50',
        ]);

        $this->post->update($validated);
        
        session()->flash('message', 'Post updated successfully!');
    }

    public function render()
    {
        return view('livewire.edit-post');
    }
}
```

```blade
<!-- resources/views/livewire/edit-post.blade.php -->
<div>
    <form wire:submit="update">
        <div class="mb-4">
            <label class="block mb-2">Title</label>
            <input type="text" wire:model="title" class="w-full border rounded px-3 py-2">
        </div>

        <div class="mb-4">
            <label class="block mb-2">Content</label>
            <livewire:forms.editor.ckeditor5 :content="$content" />
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            Update Post
        </button>
    </form>
</div>
```

### 3. Using Different Editors

#### CKEditor 4
```blade
<livewire:forms.editor.ckeditor 
    :content="$description" 
    :config="['height' => 250]" 
/>
```

#### CKEditor 5
```blade
<livewire:forms.editor.ckeditor5 
    :content="$article" 
    :config="[
        'toolbar' => ['heading', '|', 'bold', 'italic', 'link'],
        'placeholder' => 'Write your article here...'
    ]" 
/>
```

#### TipTap
```blade
<livewire:forms.editor.tiptap 
    :content="$notes" 
/>
```

### 4. With Custom Configuration

```blade
@php
$editorConfig = [
    'toolbar' => [
        'heading',
        '|',
        'bold',
        'italic',
        'underline',
        'strikethrough',
        '|',
        'link',
        'bulletedList',
        'numberedList',
        '|',
        'blockQuote',
        'insertTable',
        '|',
        'undo',
        'redo'
    ],
    'heading' => [
        'options' => [
            ['model' => 'paragraph', 'title' => 'Paragraph'],
            ['model' => 'heading1', 'view' => 'h1', 'title' => 'Heading 1'],
            ['model' => 'heading2', 'view' => 'h2', 'title' => 'Heading 2'],
            ['model' => 'heading3', 'view' => 'h3', 'title' => 'Heading 3'],
        ]
    ]
];
@endphp

<livewire:forms.editor.ckeditor5 :content="$content" :config="$editorConfig" />
```

### 5. Multiple Editors on Same Page

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
            wire:model="mainContent" 
            key="main-editor"
        />
    </div>

    <div>
        <label>Conclusion</label>
        <livewire:forms.editor.ckeditor5 
            wire:model="conclusion" 
            key="conclusion-editor"
        />
    </div>
</div>
```

### 6. Listening to Editor Events

```blade
<div>
    <livewire:forms.editor.ckeditor5 wire:model="content" />

    <div id="word-count" class="text-sm text-gray-600 mt-2">
        Words: <span id="count">0</span>
    </div>

    @push('scripts')
    <script>
        Livewire.on('editor-updated', (event) => {
            const wordCount = event.content.split(/\s+/).filter(word => word.length > 0).length;
            document.getElementById('count').textContent = wordCount;
        });
    </script>
    @endpush
</div>
```

### 7. Form with Validation

```php
public function rules()
{
    return [
        'content' => [
            'required',
            'min:100',
            function ($attribute, $value, $fail) {
                // Remove HTML tags and check minimum word count
                $text = strip_tags($value);
                $wordCount = str_word_count($text);
                
                if ($wordCount < 50) {
                    $fail('The content must contain at least 50 words.');
                }
            },
        ],
    ];
}
```

```blade
<div>
    <label>Article Content</label>
    <livewire:forms.editor.ckeditor5 wire:model="content" />
    @error('content') 
        <span class="text-red-500 text-sm">{{ $message }}</span> 
    @enderror
</div>
```

## Layout Setup

### Main Layout Example

```blade
<!-- resources/views/layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Livewire Styles -->
    @livewireStyles
    
    <!-- Livewire Editor Assets -->
    @livewireEditorAssets('ckeditor5')
</head>
<body>
    <div class="container mx-auto px-4 py-8">
        {{ $slot }}
    </div>

    <!-- Livewire Scripts -->
    @livewireScripts
    
    <!-- Additional Scripts -->
    @stack('scripts')
</body>
</html>
```

## Tips and Best Practices

1. **Always use unique keys** when using multiple editors on the same page
2. **Include `@livewireEditorAssets`** in your layout's `<head>` section
3. **Use wire:model** for automatic two-way binding
4. **Validate content** both client-side and server-side
5. **Consider performance** - load only the editor you need using `@livewireEditorAssets('editorname')`
6. **Customize configuration** per editor instance when needed
