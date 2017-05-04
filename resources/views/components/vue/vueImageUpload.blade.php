{{-- Requerimientos: Bootstrap 3, Vue.js 2, vueNotifications.blade.php, Laravel 5.3 --}}

<script>
Vue.component('imageupload', {
    props: ['value'],
    template: `
    <div>
        <div class="text-left">Tamaño máximo 2 MB</div>
        <div class="text-center" v-show="!renderImage">
            <img src="http://matchforecaster.com/upload/noimage.jpg" alt="" class="img-responsive">
            <div class="fileUpload btn btn-primary btn-lg">
                <span>Subir imagen</span>
                <input id="file" name="file" type="file" class="upload" @change="onFileChange">
            </div>
        </div>

        <div class="text-center" v-show="renderImage">
            <img :src="renderImage" class="img-responsive"/>
            <button class="btn btn-primary btn-lg" @click="removeImage">Remover imagen</button>
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
                this.renderImage  = this.public_url+value +"?"+Date.now(); //Update cache
            }
        }
    },
    methods: {
        onFileChange: function(e) {                 
            var files = e.target.files || e.dataTransfer.files

            if (!files.length)
                return;

            if(!this.isValidImage(files)) {
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
        isValidImage: function (files) {
            var _validFileExtensions = ["jpg", "jpeg", "png"];
            for (var i = 0; i < files.length; i++) {

                //Size
                if (files[i].size > 2097152) { return false } //2 MB

                //Type
                type = files[i].name.split('.')[files[i].name.split('.').length - 1].toLowerCase()
                if (_validFileExtensions.indexOf(type) == -1) { return false }

            } return true
        },
        removeImage: function (e) {
            document.getElementById("file").value = "";
            this.renderImage = ''
            //this.blog.imagen = ''
            this.$emit('input', '');
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