<template>
      <div v-if="editor">
        <button type="button" @click="editor.chain().focus().toggleBold().run()" :disabled="!editor.can().chain().focus().toggleBold().run()" class="btn btn-outline-secondary btn-sm mx-1" :class="{ 'is-active': editor.isActive('bold') }">
        bold
        </button>
        <button type="button" @click="editor.chain().focus().toggleItalic().run()" :disabled="!editor.can().chain().focus().toggleItalic().run()" class="btn btn-outline-secondary btn-sm mx-1" :class="{ 'is-active': editor.isActive('italic') }">
        italic
        </button>
        <button type="button" @click="editor.chain().focus().toggleStrike().run()" :disabled="!editor.can().chain().focus().toggleStrike().run()" class="btn btn-outline-secondary btn-sm mx-1" :class="{ 'is-active': editor.isActive('strike') }">
        strike
        </button>
        <button type="button" @click="editor.chain().focus().toggleCode().run()" :disabled="!editor.can().chain().focus().toggleCode().run()" class="btn btn-outline-secondary btn-sm mx-1" :class="{ 'is-active': editor.isActive('code') }">
        code
        </button>
        <button type="button" @click="editor.chain().focus().unsetAllMarks().run()" class="btn btn-outline-secondary btn-sm mx-1">
        clear marks
        </button>
        <button type="button" @click="editor.chain().focus().clearNodes().run()" class="btn btn-outline-secondary btn-sm mx-1">
        clear nodes
        </button>
        <button type="button" @click="editor.chain().focus().setParagraph().run()" :class="{ 'is-active': editor.isActive('paragraph') }" class="btn btn-outline-secondary btn-sm mx-1">
        paragraph
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 1 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 1 }) }" class="btn btn-outline-secondary btn-sm mx-1">
        h1
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 2 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 2 }) }" class="btn btn-outline-secondary btn-sm mx-1">
        h2
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 3 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 3 }) }" class="btn btn-outline-secondary btn-sm mx-1">
        h3
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 4 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 4 }) }" class="btn btn-outline-secondary btn-sm mx-1">
        h4
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 5 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 5 }) }" class="btn btn-outline-secondary btn-sm mx-1">
        h5
        </button>
        <button type="button" @click="editor.chain().focus().toggleHeading({ level: 6 }).run()" :class="{ 'is-active': editor.isActive('heading', { level: 6 }) }" class="btn btn-outline-secondary btn-sm mx-1">
        h6
        </button>
        <button type="button" @click="editor.chain().focus().toggleBulletList().run()" :class="{ 'is-active': editor.isActive('bulletList') }" class="btn btn-outline-secondary btn-sm mx-1">
        bullet list
        </button>
        <button type="button" @click="editor.chain().focus().toggleOrderedList().run()" :class="{ 'is-active': editor.isActive('orderedList') }" class="btn btn-outline-secondary btn-sm mx-1">
        ordered list
        </button>
        <button type="button" @click="editor.chain().focus().toggleCodeBlock().run()" :class="{ 'is-active': editor.isActive('codeBlock') }" class="btn btn-outline-secondary btn-sm mx-1">
        code block
        </button>
        <button type="button" @click="editor.chain().focus().toggleBlockquote().run()" :class="{ 'is-active': editor.isActive('blockquote') }" class="btn btn-outline-secondary btn-sm mx-1">
        blockquote
        </button>
        <button type="button" @click="editor.chain().focus().setHorizontalRule().run()" class="btn btn-outline-secondary btn-sm mx-1">
        horizontal rule
        </button>
        <button type="button" @click="editor.chain().focus().setHardBreak().run()" class="btn btn-outline-secondary btn-sm mx-1">
        hard break
        </button>
        <button type="button" @click="editor.chain().focus().undo().run()" :disabled="!editor.can().chain().focus().undo().run()" class="btn btn-outline-secondary btn-sm mx-1">
        undo
        </button>
        <button type="button" @click="editor.chain().focus().redo().run()" :disabled="!editor.can().chain().focus().redo().run()" class="btn btn-outline-secondary btn-sm mx-1">
        redo
        </button>
    </div>
    <editor-content :editor="editor" />
</template>
  
<script>
  import StarterKit from '@tiptap/starter-kit'
  import { Editor, EditorContent } from '@tiptap/vue-3'
  
  export default {
    components: {
      EditorContent,
    },
    extensions: [
      StarterKit
    ],
    props: {
      modelValue: {
        type: String,
        default: '',
      },
    },
  
    emits: ['update:modelValue'],
  
    data() {
      return {
        editor: null,
      }
    },
  
    watch: {
      modelValue(value) {
        // HTML
        const isSame = this.editor.getHTML() === value
  
        // JSON
        // const isSame = JSON.stringify(this.editor.getJSON()) === JSON.stringify(value)
  
        if (isSame) {
          return
        }
  
        this.editor.commands.setContent(value, false)
      },
    },
  
    mounted() {
      this.editor = new Editor({
        extensions: [
          StarterKit,
        ],
        content: this.modelValue,
        onUpdate: () => {
          // HTML
          this.$emit('update:modelValue', this.editor.getHTML())
  
          // JSON
          // this.$emit('update:modelValue', this.editor.getJSON())
        },
      })
    },
  
    beforeUnmount() {
      this.editor.destroy()
    },
  }
</script>
  
<style>
    .ProseMirror {
        border: 1px solid gray;
    }
</style>