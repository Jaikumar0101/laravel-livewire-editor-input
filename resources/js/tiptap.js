// TipTap Editor Helper Functions
window.LivewireEditorTipTap = {
    init: function(element, config = {}) {
        if (typeof window.TiptapCore !== 'undefined' && typeof window.TiptapStarterKit !== 'undefined') {
            const { Editor } = window.TiptapCore;
            const { StarterKit } = window.TiptapStarterKit;
            
            const defaultConfig = {
                extensions: [StarterKit],
                content: '<p>Start typing...</p>',
            };

            const finalConfig = { 
                ...defaultConfig, 
                ...config,
                element: typeof element === 'string' ? document.querySelector(element) : element
            };

            try {
                const editor = new Editor(finalConfig);
                console.log('TipTap initialized successfully');
                return editor;
            } catch (error) {
                console.error('TipTap initialization error:', error);
                throw error;
            }
        } else {
            console.error('TipTap libraries are not loaded');
            throw new Error('TipTap not available');
        }
    },

    destroy: function(editor) {
        if (editor && typeof editor.destroy === 'function') {
            editor.destroy();
        }
    },

    setContent: function(editor, content) {
        if (editor && typeof editor.commands !== 'undefined') {
            editor.commands.setContent(content);
        }
    },

    getContent: function(editor, format = 'html') {
        if (editor) {
            if (format === 'html') {
                return editor.getHTML();
            } else if (format === 'json') {
                return editor.getJSON();
            } else if (format === 'text') {
                return editor.getText();
            }
        }
        return '';
    }
};
