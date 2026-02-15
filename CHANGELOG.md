# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [2.0.0] - 2025-02-15

### Added
- **Alpine.js Integration**: Complete rewrite using Alpine.js for reactive components
- **Enhanced Plugin System**: Comprehensive plugin configuration for all editors
- **Custom Toolbar Support**: Fully customizable toolbars for TipTap
- **Theme System**: Built-in theming with custom color schemes
- **Auto-Save Feature**: Configurable auto-save with visual indicators
- **Word/Character Counter**: Real-time content length tracking
- **Read-Only Mode**: Programmatic editor locking
- **Event System**: Rich event hooks for editor lifecycle
- **Image Upload**: Configurable image upload support for all editors
- **Multiple Extension Support**: TipTap extensions (TextAlign, Link, Image, Table, Color, Highlight)
- **Improved Asset Management**: Smart asset loading with CDN/local options
- **Dark Mode Support**: Built-in dark theme
- **Mobile Responsive**: Enhanced mobile experience
- **Better Error Handling**: Comprehensive error messages
- **LivewireEditorManager**: Centralized asset management

### Changed
- **Breaking**: View files now use Alpine.js instead of vanilla JavaScript
- **Breaking**: Component structure refactored with traits
- **Breaking**: Configuration file significantly expanded
- Improved documentation with more examples
- Better TypeScript-style code documentation
- Enhanced CSS with CSS variables for theming

### New Configuration Options
- `asset_strategy`: Choose between 'cdn', 'local', 'vite', 'mix'
- `global.auto_save`: Auto-save configuration
- `global.counter`: Word/character counter settings
- `themes`: Custom theme definitions
- Extended toolbar configurations for all editors
- Plugin management for CKEditor 4
- Extension management for TipTap
- Image upload configurations

### New Blade Directives
- `@livewireEditorAlpine`: Load Alpine.js separately
- `@livewireEditorCss`: Load CSS assets only
- `@livewireEditorJs`: Load JS assets only

### New Component Props
- `theme`: Set custom theme
- `readOnly`: Enable read-only mode
- `showCounter`: Display word/character counter
- `autoSave`: Enable auto-save
- `showToolbar`: Toggle toolbar (TipTap)

### New Events
- `editor-auto-save`: Fired when auto-save triggers
- `set-editor-content`: Update editor content programmatically
- `clear-editor-content`: Clear editor content
- `set-editor-readonly`: Toggle read-only mode

## [1.0.0] - 2025-01-15

### Added
- Initial release
- CKEditor 4 Livewire component
- CKEditor 5 Livewire component
- TipTap Livewire component
- `@livewireEditorAssets` Blade directive
- Basic configuration file
- CSS styling for all editors
- Vanilla JavaScript implementations
- Comprehensive documentation
- Support for Livewire 3.x
- Support for Laravel 10.x and 11.x

[Unreleased]: https://github.com/yourvendor/livewire-editor/compare/v2.0.0...HEAD
[2.0.0]: https://github.com/yourvendor/livewire-editor/compare/v1.0.0...v2.0.0
[1.0.0]: https://github.com/yourvendor/livewire-editor/releases/tag/v1.0.0
