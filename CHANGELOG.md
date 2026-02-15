# Changelog

All notable changes to this project will be documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.0.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.0.3] - 2026-02-15

### Fixed
- **CRITICAL FIX:** Resolved "Undefined variable $editorId" error in all blade templates
- All component `render()` methods now explicitly pass required variables (`$editorId`, `$content`, `$readOnly`, `$showCounter`, `$autoSave`) to views
- Fixed CkEditor, CkEditor5, and TipTapEditor components to properly expose all properties to blade templates

### Technical Details
- Updated `CkEditor::render()` to pass 7 variables instead of 2
- Updated `CkEditor5::render()` to pass 7 variables instead of 2  
- Updated `TipTapEditor::render()` to pass 10 variables instead of 4

## [1.0.2] - 2026-02-15

### Documentation
- **Added prominent usage warnings** to prevent Blade/Livewire component syntax confusion
- Added detailed "Common Usage Examples" section with 6 practical scenarios
- Added troubleshooting entry for "Undefined variable $editorId" error
- Clarified that components must use `<livewire:...>` syntax, NOT `<x-livewire-editor::...>`
- Added usage notes in Quick Start and Available Editors sections

### Fixed
- Documentation now clearly shows correct Livewire component usage to prevent `$editorId` undefined errors

## [1.0.1] - 2026-02-15

### Fixed
- Fixed dependency constraint for `illuminate/support` from `^10.48|^11.0` to `^10.0|^11.0` to support all Laravel 10.x versions
- Removed `--prefer-stable` flag from GitHub Actions workflow for better Composer compatibility
- Removed Laravel 12 support (not yet available in orchestra/testbench)

### Changed
- Updated illuminate/support constraint to support Laravel 10.0+ (previously only 10.48+)

## [1.0.0] - 2026-02-15

### Added
- Initial release with comprehensive test suite (92 tests, 137 assertions)
- Complete namespace setup for jaikumar0101/livewire-editor-input

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

[Unreleased]: https://github.com/Jaikumar0101/laravel-livewire-editor-input/compare/v2.0.0...HEAD
[2.0.0]: https://github.com/Jaikumar0101/laravel-livewire-editor-input/compare/v1.0.0...v2.0.0
[1.0.0]: https://github.com/Jaikumar0101/laravel-livewire-editor-input/releases/tag/v1.0.0
