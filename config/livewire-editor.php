<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Default Editor
    |--------------------------------------------------------------------------
    |
    | This option defines the default editor that will be used throughout
    | your application. You can override this on a per-component basis.
    |
    | Supported: "ckeditor", "ckeditor5", "tiptap"
    |
    */

    'default' => env('LIVEWIRE_EDITOR_DEFAULT', 'ckeditor5'),

    /*
    |--------------------------------------------------------------------------
    | Asset Loading Strategy
    |--------------------------------------------------------------------------
    |
    | Determine how assets should be loaded.
    | Options: 'cdn', 'local', 'mix', 'vite'
    |
    */

    'asset_strategy' => env('LIVEWIRE_EDITOR_ASSET_STRATEGY', 'cdn'),

    /*
    |--------------------------------------------------------------------------
    | CKEditor 4 Configuration
    |--------------------------------------------------------------------------
    */

    'ckeditor' => [
        'enabled' => true,
        'cdn' => 'https://cdn.ckeditor.com/4.22.1/standard-all/ckeditor.js',
        
        'default_config' => [
            'height' => 300,
            'language' => 'en',
            'removePlugins' => 'exportpdf',
        ],

        'toolbar' => [
            ['Source'],
            ['Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord', '-', 'Undo', 'Redo'],
            ['Find', 'Replace', '-', 'SelectAll'],
            ['Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript'],
            ['NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote'],
            ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
            ['Link', 'Unlink', 'Anchor'],
            ['Image', 'Table', 'HorizontalRule', 'SpecialChar'],
            ['Styles', 'Format', 'Font', 'FontSize'],
            ['TextColor', 'BGColor'],
            ['Maximize', 'ShowBlocks'],
        ],

        'plugins' => [
            // Built-in plugins
            'dialogui',
            'dialog',
            'about',
            'basicstyles',
            'notification',
            'button',
            'toolbar',
            'clipboard',
            'enterkey',
            'entities',
            'floatingspace',
            'wysiwygarea',
            'indent',
            'indentlist',
            'list',
            'undo',
            // Additional plugins you want to enable
            'image',
            'link',
            'table',
            'horizontalrule',
            'specialchar',
            'blockquote',
        ],

        'extra_plugins' => [
            // Add custom plugins here
            // 'codesnippet',
            // 'autogrow',
            // 'placeholder',
        ],

        'removed_plugins' => [
            'exportpdf',
        ],

        // Image upload configuration
        'image_upload' => [
            'enabled' => false,
            'upload_url' => '/api/editor/upload-image',
            'csrf_token' => true,
            'max_size' => 2048, // KB
            'allowed_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp'],
        ],

        // File browser configuration
        'file_browser' => [
            'enabled' => false,
            'browse_url' => null,
            'upload_url' => null,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CKEditor 5 Configuration
    |--------------------------------------------------------------------------
    */

    'ckeditor5' => [
        'enabled' => true,
        'cdn' => 'https://cdn.ckeditor.com/ckeditor5/40.2.0/classic/ckeditor.js',
        
        'default_config' => [
            'language' => 'en',
            'placeholder' => 'Start typing...',
        ],

        'toolbar' => [
            'items' => [
                'heading',
                '|',
                'bold',
                'italic',
                'underline',
                'strikethrough',
                '|',
                'fontSize',
                'fontFamily',
                'fontColor',
                'fontBackgroundColor',
                '|',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'alignment',
                'outdent',
                'indent',
                '|',
                'imageUpload',
                'blockQuote',
                'insertTable',
                'mediaEmbed',
                'codeBlock',
                'htmlEmbed',
                '|',
                'undo',
                'redo',
                '|',
                'sourceEditing',
            ],
            'shouldNotGroupWhenFull' => true,
        ],

        'plugins' => [
            'Essentials',
            'Paragraph',
            'Bold',
            'Italic',
            'Underline',
            'Strikethrough',
            'Heading',
            'Link',
            'List',
            'Alignment',
            'Image',
            'ImageCaption',
            'ImageStyle',
            'ImageToolbar',
            'ImageUpload',
            'Table',
            'TableToolbar',
            'MediaEmbed',
            'BlockQuote',
            'Indent',
            'IndentBlock',
            'CodeBlock',
            'HtmlEmbed',
            'SourceEditing',
            'FontFamily',
            'FontSize',
            'FontColor',
            'FontBackgroundColor',
        ],

        'heading' => [
            'options' => [
                ['model' => 'paragraph', 'title' => 'Paragraph', 'class' => 'ck-heading_paragraph'],
                ['model' => 'heading1', 'view' => 'h1', 'title' => 'Heading 1', 'class' => 'ck-heading_heading1'],
                ['model' => 'heading2', 'view' => 'h2', 'title' => 'Heading 2', 'class' => 'ck-heading_heading2'],
                ['model' => 'heading3', 'view' => 'h3', 'title' => 'Heading 3', 'class' => 'ck-heading_heading3'],
                ['model' => 'heading4', 'view' => 'h4', 'title' => 'Heading 4', 'class' => 'ck-heading_heading4'],
            ]
        ],

        'image' => [
            'toolbar' => [
                'imageTextAlternative',
                'imageStyle:inline',
                'imageStyle:block',
                'imageStyle:side',
                '|',
                'toggleImageCaption',
                'linkImage',
            ],
            'upload' => [
                'types' => ['jpeg', 'png', 'gif', 'bmp', 'webp', 'svg+xml'],
            ],
        ],

        'table' => [
            'contentToolbar' => [
                'tableColumn',
                'tableRow',
                'mergeTableCells',
                'tableCellProperties',
                'tableProperties',
            ],
        ],

        'link' => [
            'decorators' => [
                'openInNewTab' => [
                    'mode' => 'manual',
                    'label' => 'Open in a new tab',
                    'attributes' => [
                        'target' => '_blank',
                        'rel' => 'noopener noreferrer'
                    ]
                ]
            ]
        ],

        'fontSize' => [
            'options' => [9, 11, 13, 'default', 17, 19, 21, 27, 35],
        ],

        'fontFamily' => [
            'options' => [
                'default',
                'Arial, Helvetica, sans-serif',
                'Courier New, Courier, monospace',
                'Georgia, serif',
                'Lucida Sans Unicode, Lucida Grande, sans-serif',
                'Tahoma, Geneva, sans-serif',
                'Times New Roman, Times, serif',
                'Trebuchet MS, Helvetica, sans-serif',
                'Verdana, Geneva, sans-serif',
            ],
        ],

        'fontColor' => [
            'columns' => 5,
            'documentColors' => 10,
        ],

        'fontBackgroundColor' => [
            'columns' => 5,
            'documentColors' => 10,
        ],

        // Simple upload adapter
        'simpleUpload' => [
            'uploadUrl' => '/api/editor/upload-image',
            'withCredentials' => true,
            'headers' => [
                'X-CSRF-TOKEN' => 'CSRF-Token',
            ],
        ],

        // Code block configuration
        'codeBlock' => [
            'languages' => [
                ['language' => 'plaintext', 'label' => 'Plain text'],
                ['language' => 'php', 'label' => 'PHP'],
                ['language' => 'javascript', 'label' => 'JavaScript'],
                ['language' => 'python', 'label' => 'Python'],
                ['language' => 'java', 'label' => 'Java'],
                ['language' => 'css', 'label' => 'CSS'],
                ['language' => 'html', 'label' => 'HTML'],
                ['language' => 'sql', 'label' => 'SQL'],
                ['language' => 'xml', 'label' => 'XML'],
            ],
        ],

        // HTML embed configuration
        'htmlEmbed' => [
            'showPreviews' => true,
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | TipTap Configuration
    |--------------------------------------------------------------------------
    */

    'tiptap' => [
        'enabled' => true,
        
        'cdn' => [
            'core' => 'https://cdn.jsdelivr.net/npm/@tiptap/core@2.1.13/dist/index.umd.min.js',
            'starter_kit' => 'https://cdn.jsdelivr.net/npm/@tiptap/starter-kit@2.1.13/dist/index.umd.min.js',
            'pm' => 'https://cdn.jsdelivr.net/npm/@tiptap/pm@2.1.13/dist/index.umd.min.js',
            'extension_text_align' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-text-align@2.1.13/dist/index.umd.min.js',
            'extension_underline' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-underline@2.1.13/dist/index.umd.min.js',
            'extension_link' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-link@2.1.13/dist/index.umd.min.js',
            'extension_image' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-image@2.1.13/dist/index.umd.min.js',
            'extension_table' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-table@2.1.13/dist/index.umd.min.js',
            'extension_table_row' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-table-row@2.1.13/dist/index.umd.min.js',
            'extension_table_cell' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-table-cell@2.1.13/dist/index.umd.min.js',
            'extension_table_header' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-table-header@2.1.13/dist/index.umd.min.js',
            'extension_color' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-color@2.1.13/dist/index.umd.min.js',
            'extension_text_style' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-text-style@2.1.13/dist/index.umd.min.js',
            'extension_highlight' => 'https://cdn.jsdelivr.net/npm/@tiptap/extension-highlight@2.1.13/dist/index.umd.min.js',
        ],

        'default_config' => [
            'content' => '<p>Start typing...</p>',
            'editorProps' => [
                'attributes' => [
                    'class' => 'prose prose-sm sm:prose lg:prose-lg xl:prose-xl focus:outline-none',
                ],
            ],
        ],

        'extensions' => [
            'StarterKit' => [
                'enabled' => true,
                'config' => [
                    'heading' => [
                        'levels' => [1, 2, 3, 4, 5, 6],
                    ],
                ],
            ],
            'Underline' => ['enabled' => true],
            'TextAlign' => [
                'enabled' => true,
                'config' => [
                    'types' => ['heading', 'paragraph'],
                    'alignments' => ['left', 'center', 'right', 'justify'],
                ],
            ],
            'Link' => [
                'enabled' => true,
                'config' => [
                    'openOnClick' => false,
                    'HTMLAttributes' => [
                        'class' => 'text-blue-600 underline',
                    ],
                ],
            ],
            'Image' => [
                'enabled' => true,
                'config' => [
                    'inline' => true,
                    'allowBase64' => true,
                ],
            ],
            'Table' => [
                'enabled' => true,
                'config' => [
                    'resizable' => true,
                    'HTMLAttributes' => [
                        'class' => 'border-collapse table-auto w-full',
                    ],
                ],
            ],
            'TextStyle' => ['enabled' => true],
            'Color' => ['enabled' => true],
            'Highlight' => [
                'enabled' => true,
                'config' => [
                    'multicolor' => true,
                ],
            ],
        ],

        'toolbar' => [
            'enabled' => true,
            'sticky' => true,
            'buttons' => [
                ['type' => 'heading', 'level' => 1, 'icon' => 'H1', 'title' => 'Heading 1'],
                ['type' => 'heading', 'level' => 2, 'icon' => 'H2', 'title' => 'Heading 2'],
                ['type' => 'heading', 'level' => 3, 'icon' => 'H3', 'title' => 'Heading 3'],
                ['type' => 'separator'],
                ['type' => 'bold', 'icon' => 'B', 'title' => 'Bold'],
                ['type' => 'italic', 'icon' => 'I', 'title' => 'Italic'],
                ['type' => 'underline', 'icon' => 'U', 'title' => 'Underline'],
                ['type' => 'strike', 'icon' => 'S', 'title' => 'Strike'],
                ['type' => 'separator'],
                ['type' => 'bulletList', 'icon' => '•', 'title' => 'Bullet List'],
                ['type' => 'orderedList', 'icon' => '1.', 'title' => 'Ordered List'],
                ['type' => 'separator'],
                ['type' => 'link', 'icon' => '🔗', 'title' => 'Link'],
                ['type' => 'image', 'icon' => '🖼', 'title' => 'Image'],
                ['type' => 'table', 'icon' => '⊞', 'title' => 'Table'],
                ['type' => 'separator'],
                ['type' => 'blockquote', 'icon' => '"', 'title' => 'Blockquote'],
                ['type' => 'codeBlock', 'icon' => '<>', 'title' => 'Code Block'],
                ['type' => 'separator'],
                ['type' => 'undo', 'icon' => '↶', 'title' => 'Undo'],
                ['type' => 'redo', 'icon' => '↷', 'title' => 'Redo'],
            ],
        ],

        'bubble_menu' => [
            'enabled' => true,
            'buttons' => ['bold', 'italic', 'link'],
        ],

        'floating_menu' => [
            'enabled' => false,
            'buttons' => ['heading1', 'heading2', 'bulletList'],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Global Settings
    |--------------------------------------------------------------------------
    */

    'global' => [
        // Enable/disable auto-save
        'auto_save' => [
            'enabled' => false,
            'interval' => 30000, // milliseconds
        ],

        // Character/word counter
        'counter' => [
            'enabled' => false,
            'type' => 'words', // 'words' or 'characters'
        ],

        // Read-only mode
        'read_only' => false,

        // Inline mode
        'inline' => false,

        // Initial focus
        'auto_focus' => false,

        // Spell checker
        'spell_check' => true,
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Themes
    |--------------------------------------------------------------------------
    */

    'themes' => [
        'default' => [
            'primary_color' => '#3b82f6',
            'toolbar_bg' => '#f9fafb',
            'editor_bg' => '#ffffff',
            'border_color' => '#e5e7eb',
            'text_color' => '#1f2937',
        ],
        'dark' => [
            'primary_color' => '#60a5fa',
            'toolbar_bg' => '#1f2937',
            'editor_bg' => '#111827',
            'border_color' => '#374151',
            'text_color' => '#f9fafb',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Event Hooks
    |--------------------------------------------------------------------------
    */

    'events' => [
        'on_init' => null, // Callback when editor initializes
        'on_change' => null, // Callback when content changes
        'on_focus' => null, // Callback when editor gains focus
        'on_blur' => null, // Callback when editor loses focus
        'on_save' => null, // Callback when content is saved
    ],
];
