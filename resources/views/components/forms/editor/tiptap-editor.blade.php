<div wire:ignore>
    <div id="{{ $editorId }}" class="tiptap-editor"></div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof window.TiptapCore !== 'undefined' && typeof window.TiptapStarterKit !== 'undefined') {
            const { Editor } = window.TiptapCore;
            const { StarterKit } = window.TiptapStarterKit;
            
            const editor = new Editor({
                element: document.querySelector('#{{ $editorId }}'),
                extensions: [
                    StarterKit,
                ],
                content: @js($content),
                onUpdate: ({ editor }) => {
                    @this.set('content', editor.getHTML());
                },
            });

            // Listen for Livewire updates
            Livewire.on('updateContent', (content) => {
                editor.commands.setContent(content);
            });

            // Store editor instance for cleanup
            window['editor_{{ $editorId }}'] = editor;
        } else {
            console.error('TipTap is not loaded. Make sure to include @livewireEditorAssets directive.');
        }
    });

    // Cleanup on component removal
    document.addEventListener('livewire:navigated', () => {
        if (window['editor_{{ $editorId }}']) {
            window['editor_{{ $editorId }}'].destroy();
        }
    });
</script>
@endpush
