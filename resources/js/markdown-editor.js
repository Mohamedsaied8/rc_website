/*
 * Markdown editor used by the admin post form and the public "write a post" form.
 *
 * Two writing modes, one storage format. "Basic" shows a formatting toolbar whose
 * buttons insert markdown for you (headings, bold, lists…), "Markdown" hides the
 * toolbar for people who'd rather type the syntax. Either way the textarea holds
 * plain markdown, so posts written in one mode stay editable in the other and the
 * server never has to deal with a second content format.
 *
 * Preview is rendered server-side through BlogPost::renderMarkdown so what the
 * author sees is exactly what the published page will show — including the fact
 * that raw HTML gets stripped.
 */
export default function markdownEditor(config = {}) {
    return {
        mode: config.mode || 'basic',      // 'basic' | 'markdown'
        tab: 'write',                      // 'write' | 'preview'
        content: config.value || '',
        previewUrl: config.previewUrl,
        csrf: config.csrf,
        titleField: config.titleField || null,
        excerptField: config.excerptField || null,
        previewHtml: '',
        previewTitle: '',
        previewExcerpt: '',
        loading: false,
        error: '',

        init() {
            // Remember the author's preferred mode between posts.
            const saved = window.localStorage?.getItem('rc-editor-mode');
            if (saved === 'basic' || saved === 'markdown') this.mode = saved;
        },

        setMode(mode) {
            this.mode = mode;
            window.localStorage?.setItem('rc-editor-mode', mode);
        },

        async showPreview() {
            this.tab = 'preview';
            this.loading = true;
            this.error = '';
            this.previewTitle = this.fieldValue(this.titleField);
            this.previewExcerpt = this.fieldValue(this.excerptField);

            try {
                const response = await fetch(this.previewUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': this.csrf,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ content: this.content }),
                });

                if (!response.ok) throw new Error('Preview failed (' + response.status + ')');

                const data = await response.json();
                this.previewHtml = data.html || '<p><em>Nothing to preview yet.</em></p>';
            } catch (e) {
                this.error = 'Could not build the preview. Your text is safe — try again.';
            } finally {
                this.loading = false;
            }
        },

        fieldValue(id) {
            if (!id) return '';
            return document.getElementById(id)?.value?.trim() || '';
        },

        get wordCount() {
            const words = this.content.trim().split(/\s+/).filter(Boolean).length;
            return words;
        },

        get readingTime() {
            return Math.max(1, Math.ceil(this.wordCount / 200));
        },

        /* ---------- Toolbar actions ---------- */

        // Replace the prefix on every line the cursor/selection touches.
        // Passing an empty prefix clears formatting back to normal text.
        setBlock(prefix) {
            const input = this.$refs.input;
            const value = input.value;
            const start = input.selectionStart;
            const end = input.selectionEnd;

            const lineStart = value.lastIndexOf('\n', start - 1) + 1;
            let lineEnd = value.indexOf('\n', end);
            if (lineEnd === -1) lineEnd = value.length;

            const existing = /^([ \t]*)(#{1,6} +|> +|[-*+] +|\d+\. +)?/;
            const rewritten = value
                .slice(lineStart, lineEnd)
                .split('\n')
                .map((line) => line.replace(existing, '$1') + '')
                .map((line) => prefix + line.replace(/^[ \t]+/, ''))
                .join('\n');

            this.replaceRange(lineStart, lineEnd, rewritten, lineStart + rewritten.length);
        },

        // Wrap the selection in a token pair (bold, italic, inline code).
        wrap(token, placeholder) {
            const input = this.$refs.input;
            const value = input.value;
            const start = input.selectionStart;
            const end = input.selectionEnd;
            const selected = value.slice(start, end);

            // Toggle off if the selection is already wrapped.
            const before = value.slice(Math.max(0, start - token.length), start);
            const after = value.slice(end, end + token.length);
            if (selected && before === token && after === token) {
                this.replaceRange(start - token.length, end + token.length, selected, start - token.length + selected.length);
                return;
            }

            const text = selected || placeholder;
            const replacement = token + text + token;
            const caret = start + token.length;
            this.replaceRange(start, end, replacement, caret, caret + text.length);
        },

        insertLink() {
            const input = this.$refs.input;
            const start = input.selectionStart;
            const end = input.selectionEnd;
            const label = input.value.slice(start, end) || 'link text';
            const replacement = '[' + label + '](https://)';
            // Drop the caret right after "https://" so the URL is the next thing typed.
            const caret = start + replacement.length - 1;
            this.replaceRange(start, end, replacement, caret);
        },

        // Single place where the textarea value changes.
        //
        // The DOM is written first and an input event is dispatched so x-model picks
        // the change up, rather than assigning this.content and waiting for Alpine to
        // write it back — that round trip re-assigns textarea.value, which resets the
        // caret to the end and scrambled every toolbar action.
        replaceRange(from, to, text, caretStart, caretEnd) {
            const input = this.$refs.input;
            const value = input.value;

            input.value = value.slice(0, from) + text + value.slice(to);
            input.dispatchEvent(new Event('input', { bubbles: true }));

            const select = () => {
                input.focus();
                input.setSelectionRange(caretStart, caretEnd ?? caretStart);
            };
            select();
            // Once more after Alpine's effects flush, in case it touched the value.
            this.$nextTick(select);
        },
    };
}
