<div 
    x-data="{
        editorId: '{{ $editorId }}',
        content: @entangle('content'),
        extensions: @js($extensions),
        toolbarButtons: @js($toolbarButtons),
        readOnly: @entangle('readOnly'),
        showCounter: {{ $showCounter ? 'true' : 'false' }},
        autoSave: {{ $autoSave ? 'true' : 'false' }},
        showToolbar: {{ $showToolbar ? 'true' : 'false' }},
        editor: null,
        wordCount: 0,
        charCount: 0,
        isSaving: false,
        lastSaved: null,
        saveTimeout: null,

        get counterText() {
            const type = '{{ config("livewire-editor.global.counter.type", "words") }}';
            if (type === 'words') {
                return 'Words: ' + this.wordCount;
            }
            return 'Characters: ' + this.charCount;
        },

        get editorStyles() {
            const theme = @js($themeStyles);
            return {
                '--editor-border-color': theme.border_color || '#e5e7eb',
                '--editor-bg': theme.editor_bg || '#ffffff',
                '--editor-text-color': theme.text_color || '#1f2937',
            };
        },

        get toolbarStyles() {
            const theme = @js($themeStyles);
            return {
                '--toolbar-bg': theme.toolbar_bg || '#f9fafb',
                '--toolbar-border-color': theme.border_color || '#e5e7eb',
            };
        },

        initEditor() {
            if (typeof window.TiptapCore === 'undefined' || typeof window.TiptapStarterKit === 'undefined') {
                console.error('TipTap is not loaded. Include @livewireEditorAssets directive.');
                return;
            }

            const { Editor } = window.TiptapCore;
            const editorExtensions = this.buildExtensions();

            try {
                this.editor = new Editor({
                    element: document.querySelector('#' + this.editorId),
                    extensions: editorExtensions,
                    content: this.content || '<p></p>',
                    editable: !this.readOnly,
                    onUpdate: ({ editor }) => {
                        const html = editor.getHTML();
                        this.content = html;
                        this.updateCounter(editor);

                        if (this.autoSave) {
                            this.scheduleAutoSave();
                        }
                    },
                    onCreate: ({ editor }) => {
                        this.updateCounter(editor);
                        console.log('TipTap initialized successfully');
                    },
                });

                this.setupLivewireListeners();
            } catch (error) {
                console.error('TipTap initialization error:', error);
            }
        },

        buildExtensions() {
            const extensions = [];
            const { StarterKit } = window.TiptapStarterKit;

            if (this.extensions.StarterKit) {
                extensions.push(StarterKit.configure(this.extensions.StarterKit));
            } else {
                extensions.push(StarterKit);
            }

            if (this.extensions.Underline && window.TiptapUnderline) {
                extensions.push(window.TiptapUnderline.Underline);
            }

            if (this.extensions.TextAlign && window.TiptapTextAlign) {
                extensions.push(window.TiptapTextAlign.TextAlign.configure(this.extensions.TextAlign));
            }

            if (this.extensions.Link && window.TiptapLink) {
                extensions.push(window.TiptapLink.Link.configure(this.extensions.Link));
            }

            if (this.extensions.Image && window.TiptapImage) {
                extensions.push(window.TiptapImage.Image.configure(this.extensions.Image));
            }

            if (this.extensions.Table && window.TiptapTable) {
                extensions.push(window.TiptapTable.Table.configure(this.extensions.Table));
                if (window.TiptapTableRow) extensions.push(window.TiptapTableRow.TableRow);
                if (window.TiptapTableCell) extensions.push(window.TiptapTableCell.TableCell);
                if (window.TiptapTableHeader) extensions.push(window.TiptapTableHeader.TableHeader);
            }

            if (this.extensions.TextStyle && window.TiptapTextStyle) {
                extensions.push(window.TiptapTextStyle.TextStyle);
            }

            if (this.extensions.Color && window.TiptapColor) {
                extensions.push(window.TiptapColor.Color);
            }

            if (this.extensions.Highlight && window.TiptapHighlight) {
                extensions.push(window.TiptapHighlight.Highlight.configure(this.extensions.Highlight));
            }

            return extensions;
        },

        executeCommand(type, level = null) {
            if (!this.editor) return;

            const commands = {
                heading: () => this.editor.chain().focus().toggleHeading({ level }).run(),
                bold: () => this.editor.chain().focus().toggleBold().run(),
                italic: () => this.editor.chain().focus().toggleItalic().run(),
                underline: () => this.editor.chain().focus().toggleUnderline().run(),
                strike: () => this.editor.chain().focus().toggleStrike().run(),
                bulletList: () => this.editor.chain().focus().toggleBulletList().run(),
                orderedList: () => this.editor.chain().focus().toggleOrderedList().run(),
                blockquote: () => this.editor.chain().focus().toggleBlockquote().run(),
                codeBlock: () => this.editor.chain().focus().toggleCodeBlock().run(),
                undo: () => this.editor.chain().focus().undo().run(),
                redo: () => this.editor.chain().focus().redo().run(),
                link: () => this.setLink(),
                image: () => this.addImage(),
                table: () => this.editor.chain().focus().insertTable({ rows: 3, cols: 3, withHeaderRow: true }).run(),
            };

            if (commands[type]) {
                commands[type]();
            }
        },

        isActive(type, level = null) {
            if (!this.editor) return false;

            if (type === 'heading' && level) {
                return this.editor.isActive('heading', { level });
            }

            return this.editor.isActive(type);
        },

        setLink() {
            const previousUrl = this.editor.getAttributes('link').href;
            const url = window.prompt('URL', previousUrl);

            if (url === null) return;

            if (url === '') {
                this.editor.chain().focus().extendMarkRange('link').unsetLink().run();
                return;
            }

            this.editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
        },

        addImage() {
            const url = window.prompt('Image URL');

            if (url) {
                this.editor.chain().focus().setImage({ src: url }).run();
            }
        },

        updateCounter(editor) {
            const text = editor.getText();
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
                    this.editor.commands.setContent(data.content);
                }
            });

            Livewire.on('clear-editor-content', (data) => {
                if (data.editorId === this.editorId && this.editor) {
                    this.editor.commands.clearContent();
                }
            });

            Livewire.on('set-editor-readonly', (data) => {
                if (data.editorId === this.editorId && this.editor) {
                    this.editor.setEditable(!data.readOnly);
                }
            });
        },

        destroy() {
            if (this.editor) {
                this.editor.destroy();
                console.log('TipTap destroyed');
            }
        }
    }"
    x-init="initEditor()"
    class="livewire-editor-container tiptap-wrapper"
    wire:ignore
>
    <!-- Toolbar -->
    <div x-show="showToolbar" class="tiptap-toolbar" :style="toolbarStyles">
        <template x-for="(button, index) in toolbarButtons" :key="index">
            <div class="toolbar-item">
                <template x-if="button.type === 'separator'">
                    <div class="toolbar-separator"></div>
                </template>
                
                <template x-if="button.type !== 'separator'">
                    <button
                        type="button"
                        @click="executeCommand(button.type, button.level || null)"
                        :class="{'is-active': isActive(button.type, button.level)}"
                        :title="button.title"
                        class="toolbar-button"
                        x-text="button.icon"
                    ></button>
                </template>
            </div>
        </template>
    </div>

    <!-- Editor Container -->
    <div 
        :id="editorId" 
        class="tiptap-editor"
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
