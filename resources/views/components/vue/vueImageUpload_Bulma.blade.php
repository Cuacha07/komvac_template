{{-- Requerimientos: Bulma Css Framework, Vue.js 2, vueNotifications.blade.php, Laravel 5.3 --}}

<script>
Vue.component('imageupload', {
    props: ['value'],
    template: `
    <div>
        <div class="has-text-left">Tamaño máximo 2 MB</div> <br>
        <div class="has-text-centered" v-show="!renderImage">
            <img src="http://support.yumpu.com/en/wp-content/themes/qaengine/img/default-thumbnail.jpg" alt="" class="image">
            <div class="fileUpload button is-primary is-large">
                <span>Subir imagen</span>
                <input id="file" name="file" type="file" class="upload" @change="onFileChange">
            </div>
        </div>

        <div class="has-text-centered" v-show="renderImage">
            <img :src="renderImage" class="image" style="margin-right: auto; margin-left: auto; margin-bottom: 15px;"/>
            <a class="button is-primary is-large" @click="removeImage">Remover imagen</a>
        </div>
    </div>
    `,
    mixins: [notifications], //Use Notifications
    data: function () {
        return {
            renderImage: '',
            public_url: "{{ URL::to('/') }}/",
        }
    },
    watch: {
        value: function (value) { 
            if(value == '') { 
                this.renderImage = ''; 
            }
            else {
                if(this.isURL(value) == true) {
                    this.renderImage  = value;
                } else {
                    this.renderImage  = this.public_url+value +"?"+Date.now(); //Update cache
                }
            }
        }
    },
    methods: {
        onFileChange: function(e) {                 
            var files = e.target.files || e.dataTransfer.files

            if (!files.length)
                return;

            if(!this.isValidImage(files[0])) {
                this.removeImage()
                return;
            }

            this.createImage(files[0])

            //this.blog.imagen = files
            this.$emit('input', files[0]);
        },
        createImage: function(file) {
            var image = new Image()
            var reader = new FileReader()
            var vm = this
            reader.onload = (e) => {
                vm.renderImage = e.target.result
            }
            reader.readAsDataURL(file)
        },
        isValidImage: function (file) {
            var _validFileExtensions = ["jpg", "jpeg", "png"];

            //Size
            if (file.size > 2097152) {
                    this.notification('fa fa-exclamation-triangle', 'Error', "La imagen "+file.name+" es demasiado grande.", 'topCenter');
                    return false;
            } //2 MB

            //Type
            type = file.name.split('.')[file.name.split('.').length - 1].toLowerCase();
            if (_validFileExtensions.indexOf(type) == -1) {
                this.notification('fa fa-exclamation-triangle', 'Error', "La imagen "+file.name+" no es del formato correcto [jpg, jpeg, png].", 'topCenter');
                return false;
            }
            return true;
        },
        removeImage: function (e) {
            document.getElementById("file").value = "";
            this.renderImage = ''
            //this.blog.imagen = ''
            this.$emit('input', '');
        },

        isURL: function (str) {
            var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
            if(!regex.test(str)) {
                //alert("Please enter valid URL.");
                return false;
            } else {
                return true;
            }
        }
    }
});
</script>

{{-- CSS --}}
@push('css')
<style>
    .imgUpload img {
        /*width: 30%;
        height: 50%;*/
        margin: auto;
        display: block;
        margin-bottom: 10px;
    }
    .fileUpload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>
@endpush