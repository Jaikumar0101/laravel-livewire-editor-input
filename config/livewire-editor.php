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
    | CKEditor 4 Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration options for CKEditor 4.
    |
    */

    'ckeditor' => [
        'cdn' => 'https://cdn.ckeditor.com/4.22.1/standard/ckeditor.js',
        'default_config' => [
            'height' => 300,
            'toolbar' => [
                ['Source'],
                ['Cut', 'Copy', 'Paste', 'Undo', 'Redo'],
                ['Bold', 'Italic', 'Underline'],
                ['NumberedList', 'BulletedList'],
                ['Link', 'Unlink'],
                ['Image', 'Table'],
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | CKEditor 5 Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration options for CKEditor 5.
    |
    */

    'ckeditor5' => [
        'cdn' => 'https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js',
        'default_config' => [
            'toolbar' => [
                'heading',
                '|',
                'bold',
                'italic',
                'link',
                'bulletedList',
                'numberedList',
                '|',
                'outdent',
                'indent',
                '|',
                'blockQuote',
                'insertTable',
                'undo',
                'redo'
            ],
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | TipTap Configuration
    |--------------------------------------------------------------------------
    |
    | Configuration options for TipTap editor.
    |
    */

    'tiptap' => [
        'cdn' => [
            'core' => 'https://unpkg.com/@tiptap/core@latest/dist/index.umd.js',
            'starter_kit' => 'https://unpkg.com/@tiptap/starter-kit@latest/dist/index.umd.js',
            'pm' => 'https://unpkg.com/@tiptap/pm@latest/dist/index.js',
        ],
        'default_config' => [
            // TipTap specific configuration
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Asset Publishing
    |--------------------------------------------------------------------------
    |
    | When set to true, assets will be loaded from CDN. When false,
    | assets will be loaded from your public directory.
    |
    */

    'use_cdn' => env('LIVEWIRE_EDITOR_USE_CDN', true),
];
