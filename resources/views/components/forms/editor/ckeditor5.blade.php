<div wire:ignore>
    <div id="{{ $editorId }}"></div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof ClassicEditor !== 'undefined') {
            ClassicEditor
                .create(document.querySelector('#{{ $editorId }}'), {!! json_encode($config) !!})
                .then(editor => {
                    // Set initial content
                    editor.setData(@js($content));
                    
                    // Update Livewire on change
                    editor.model.document.on('change:data', () => {
                        @this.set('content', editor.getData());
                    });

                    // Listen for Livewire updates
                    Livewire.on('updateContent', (content) => {
                        editor.setData(content);
                    });

                    // Store editor instance for cleanup
                    window['editor_{{ $editorId }}'] = editor;
                })
                .catch(error => {
                    console.error('CKEditor 5 initialization error:', error);
                });
        } else {
            console.error('CKEditor 5 is not loaded. Make sure to include @livewireEditorAssets directive.');
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
