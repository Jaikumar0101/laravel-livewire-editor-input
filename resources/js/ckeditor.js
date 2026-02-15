// CKEditor 4 Helper Functions
window.LivewireEditorCK = {
    init: function(editorId, config = {}) {
        if (typeof CKEDITOR !== 'undefined') {
            const defaultConfig = {
                height: 300,
                toolbar: [
                    { name: 'document', items: ['Source'] },
                    { name: 'clipboard', items: ['Cut', 'Copy', 'Paste', 'Undo', 'Redo'] },
                    { name: 'editing', items: ['Find', 'Replace'] },
                    '/',
                    { name: 'basicstyles', items: ['Bold', 'Italic', 'Underline', 'Strike'] },
                    { name: 'paragraph', items: ['NumberedList', 'BulletedList', 'Blockquote'] },
                    { name: 'links', items: ['Link', 'Unlink'] },
                    { name: 'insert', items: ['Image', 'Table', 'HorizontalRule'] },
                    '/',
                    { name: 'styles', items: ['Styles', 'Format'] },
                ]
            };

            const finalConfig = { ...defaultConfig, ...config };
            return CKEDITOR.replace(editorId, finalConfig);
        } else {
            console.error('CKEditor 4 is not loaded');
            return null;
        }
    },

    destroy: function(editor) {
        if (editor && typeof editor.destroy === 'function') {
            editor.destroy();
        }
    }
};
