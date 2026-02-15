<div wire:ignore>
    <textarea id="{{ $editorId }}" wire:model="content"></textarea>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof CKEDITOR !== 'undefined') {
            const editor = CKEDITOR.replace('{{ $editorId }}', {!! json_encode($config) !!});
            
            editor.on('change', function() {
                @this.set('content', editor.getData());
            });

            // Set initial content
            editor.setData(@js($content));

            // Listen for Livewire updates
            Livewire.on('updateContent', (content) => {
                editor.setData(content);
            });
        } else {
            console.error('CKEditor 4 is not loaded. Make sure to include @livewireEditorAssets directive.');
        }
    });
</script>
@endpush
