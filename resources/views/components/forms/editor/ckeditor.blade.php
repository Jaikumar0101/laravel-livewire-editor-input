<div 
    x-data="ckeditorComponent({
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
    <textarea 
        :id="editorId" 
        class="ckeditor-editor"
    ></textarea>

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
    Alpine.data('ckeditorComponent', (options) => ({
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

        initEditor() {
            if (typeof CKEDITOR === 'undefined') {
                console.error('CKEditor 4 is not loaded. Include @livewireEditorAssets directive.');
                return;
            }

            this.editor = CKEDITOR.replace(this.editorId, this.config);
            
            this.editor.on('instanceReady', () => {
                // Set initial content
                if (this.content) {
                    this.editor.setData(this.content);
                }

                // Set read-only if needed
                if (this.readOnly) {
                    this.editor.setReadOnly(true);
                }

                console.log('CKEditor 4 initialized successfully');
            });

            // Listen for changes
            this.editor.on('change', () => {
                const data = this.editor.getData();
                this.content = data;
                this.updateCounter(data);

                if (this.autoSave) {
                    this.scheduleAutoSave();
                }
            });

            // Setup Livewire listeners
            this.setupLivewireListeners();
        },

        updateCounter(html) {
            const text = html.replace(/<[^>]*>/g, '');
            this.wordCount = text.split(/\s+/).filter(w => w.length > 0).length;
            this.charCount = text.length;
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
            
            this.$wire.dispatch('editor-auto-save', {
                editorId: this.editorId,
                content: this.content
            });

            setTimeout(() => {
                this.isSaving = false;
                this.lastSaved = new Date().toLocaleTimeString();
            }, 500);
        },

        setupLivewireListeners() {
            Livewire.on('set-editor-content', (data) => {
                if (data.editorId === this.editorId && this.editor) {
                    this.editor.setData(data.content);
                }
            });

            Livewire.on('clear-editor-content', (data) => {
                if (data.editorId === this.editorId && this.editor) {
                    this.editor.setData('');
                }
            });

            Livewire.on('set-editor-readonly', (data) => {
                if (data.editorId === this.editorId && this.editor) {
                    this.editor.setReadOnly(data.readOnly);
                }
            });
        },

        destroy() {
            if (this.editor) {
                this.editor.destroy();
                console.log('CKEditor 4 destroyed');
            }
        }
    }));
});
</script>
@endPushOnce
