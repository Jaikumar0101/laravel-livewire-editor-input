<div 
    x-data="ckeditor5Component({
        editorId: '{{ $editorId }}',
        content: @entangle('content'),
        config: @js($editorConfig),
        readOnly: @entangle('readOnly'),
        showCounter: {{ $showCounter ? 'true' : 'false' }},
        autoSave: {{ $autoSave ? 'true' : 'false' }},
    })"
    x-init="initEditor()"
    class="livewire-editor-container"
    wire:ignore
>
    <!-- Editor Container -->
    <div 
        :id="editorId" 
        class="ckeditor5-editor"
        :style="editorStyles"
    ></div>

    <!-- Counter -->
    <div x-show="showCounter" class="editor-counter mt-2 text-sm text-gray-600">
        <span x-text="counterText"></span>
    </div>

    <!-- Auto-save indicator -->
    <div x-show="autoSave && isSaving" class="auto-save-indicator mt-2 text-sm text-blue-600">
        <span>Saving...</span>
    </div>

    <div x-show="autoSave && lastSaved" class="auto-save-indicator mt-2 text-sm text-green-600">
        <span x-text="'Last saved: ' + lastSaved"></span>
    </div>
</div>

@pushOnce('scripts')
<script>
document.addEventListener('alpine:init', () => {
    Alpine.data('ckeditor5Component', (options) => ({
        editorId: options.editorId,
        content: options.content,
        config: options.config,
        readOnly: options.readOnly,
        showCounter: options.showCounter,
        autoSave: options.autoSave,
        editor: null,
        wordCount: 0,
        charCount: 0,
        isSaving: false,
        lastSaved: null,
        saveTimeout: null,

        get counterText() {
            const type = '{{ config("livewire-editor.global.counter.type", "words") }}';
            if (type === 'words') {
                return `Words: ${this.wordCount}`;
            }
            return `Characters: ${this.charCount}`;
        },

        get editorStyles() {
            const theme = @js($themeStyles);
            return {
                '--editor-border-color': theme.border_color || '#e5e7eb',
                '--editor-bg': theme.editor_bg || '#ffffff',
            };
        },

        initEditor() {
            if (typeof ClassicEditor === 'undefined') {
                console.error('CKEditor 5 is not loaded. Include @livewireEditorAssets directive.');
                return;
            }

            ClassicEditor
                .create(document.querySelector(`#${this.editorId}`), this.config)
                .then(editor => {
                    this.editor = editor;
                    
                    // Set initial content
                    if (this.content) {
                        editor.setData(this.content);
                    }

                    // Set read-only if needed
                    if (this.readOnly) {
                        editor.enableReadOnlyMode(this.editorId);
                    }

                    // Listen for changes
                    editor.model.document.on('change:data', () => {
                        const data = editor.getData();
                        this.content = data;
                        this.updateCounter(data);

                        if (this.autoSave) {
                            this.scheduleAutoSave();
                        }
                    });

                    // Word count plugin (if available)
                    if (editor.plugins.has('WordCount')) {
                        const wordCountPlugin = editor.plugins.get('WordCount');
                        wordCountPlugin.on('update', (evt, stats) => {
                            this.wordCount = stats.words;
                            this.charCount = stats.characters;
                        });
                    }

                    console.log('CKEditor 5 initialized successfully');
                })
                .catch(error => {
                    console.error('CKEditor 5 initialization error:', error);
                });

            // Listen for Livewire events
            this.setupLivewireListeners();
        },

        updateCounter(html) {
            // Simple counter if WordCount plugin is not available
            if (!this.editor.plugins.has('WordCount')) {
                const text = html.replace(/<[^>]*>/g, '');
                this.wordCount = text.split(/\s+/).filter(w => w.length > 0).length;
                this.charCount = text.length;
            }
        },

        scheduleAutoSave() {
            if (this.saveTimeout) {
                clearTimeout(this.saveTimeout);
            }

            this.saveTimeout = setTimeout(() => {
                this.performAutoSave();
            }, {{ config('livewire-editor.global.auto_save.interval', 30000) }});
        },

        performAutoSave() {
            this.isSaving = true;
            
            // Dispatch auto-save event
            this.$wire.dispatch('editor-auto-save', {
                editorId: this.editorId,
                content: this.content
            });

            // Simulate save completion
            setTimeout(() => {
                this.isSaving = false;
                this.lastSaved = new Date().toLocaleTimeString();
            }, 500);
        },

        setupLivewireListeners() {
            // Listen for content update from Livewire
            Livewire.on('set-editor-content', (data) => {
                if (data.editorId === this.editorId && this.editor) {
                    this.editor.setData(data.content);
                }
            });

            // Listen for clear content
            Livewire.on('clear-editor-content', (data) => {
                if (data.editorId === this.editorId && this.editor) {
                    this.editor.setData('');
                }
            });

            // Listen for read-only toggle
            Livewire.on('set-editor-readonly', (data) => {
                if (data.editorId === this.editorId && this.editor) {
                    if (data.readOnly) {
                        this.editor.enableReadOnlyMode(this.editorId);
                    } else {
                        this.editor.disableReadOnlyMode(this.editorId);
                    }
                }
            });
        },

        destroy() {
            if (this.editor) {
                this.editor.destroy()
                    .then(() => console.log('CKEditor 5 destroyed'))
                    .catch(error => console.error(error));
            }
        }
    }));
});
</script>
@endPushOnce
