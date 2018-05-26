{{-- TinyMCE --}}
{!! Html::script('js/tinymce/tinymce.min.js') !!}

<script>

Vue.component('tinymce', {
    props: ['value'],
    template: `<textarea></textarea>`,
    mounted: function () {
        var vm = this;

        // Init tinymce
        tinymce.init({
            selector: '#'+vm.$el.id,
            //menubar: false,
            language: 'es_MX',
            height: 500,
            plugins: [
                'advlist autolink lists link image charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen',
                'insertdatetime media nonbreaking save table contextmenu directionality',
                'emoticons template paste textcolor colorpicker textpattern imagetools codesample toc'
            ],
            toolbar1: 'undo redo | insert | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
            toolbar2: 'print preview media | forecolor backcolor emoticons | codesample',
            image_advtab: true,
            setup: function(editor) {
                editor.on('keyup', function() { fireEmit(); });
                editor.on('change', function() { fireEmit(); });
                editor.on('Undo', function() { fireEmit(); });
                editor.on('Redo', function() { fireEmit(); });

                function fireEmit() {
                    var newContent = editor.getContent();
                    vm.$emit('input', newContent); // Fire an event to let its parent know
                }
            }
        });
    },
    watch: {
        value: function (value) {
            var vm = this;
            var editor = tinymce.get(vm.$el.id);
            //Cursor Position Fix
            if(value != editor.getContent()) {
                editor.setContent(value);
            }
        }
    },
    destroyed: function () {
        var vm = this;
        tinymce.remove(vm.$el.id);
    }
});
</script>   