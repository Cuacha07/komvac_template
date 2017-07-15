<script>
Vue.component('vprogress', {
    props: ['progress'],
    template: `
    <div v-if="progress">
        <div class="text-center"><h3>@{{textp}}</h3></div>
        <div class="progress">
            <div class="progress-bar progress-bar-green" role="progressbar" :aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100" :style="widthp">
                <span class="sr-only">@{{progress}}% Completado (success)</span>
            </div>
        </div>
    </div>
    `,
    computed: {
        widthp: function () {
            return "width: " + this.progress + "%;";
        },
        textp: function () {
            return this.progress+"%";
        }
    }
});
</script>