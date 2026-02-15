// CKEditor 5 Helper Functions
window.LivewireEditorCK5 = {
    init: function(elementId, config = {}) {
        if (typeof ClassicEditor !== 'undefined') {
            const defaultConfig = {
                toolbar: {
                    items: [
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
                    ]
                }
            };

            const finalConfig = { ...defaultConfig, ...config };

            return ClassicEditor
                .create(document.querySelector(elementId), finalConfig)
                .then(editor => {
                    console.log('CKEditor 5 initialized successfully');
                    return editor;
                })
                .catch(error => {
                    console.error('CKEditor 5 initialization error:', error);
                    throw error;
                });
        } else {
            console.error('CKEditor 5 is not loaded');
            return Promise.reject('CKEditor 5 not available');
        }
    },

    destroy: function(editor) {
        if (editor && typeof editor.destroy === 'function') {
            return editor.destroy();
        }
        return Promise.resolve();
    }
};
