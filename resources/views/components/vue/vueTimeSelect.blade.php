<script>
Vue.component('timeselect', {
    props: ['value'],
    template: `
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
            <select class="form-control" v-model="timeVal" @change="selectValue">
                <option v-for="h in horas" :value="h.value">@{{h.value}}</option>
            </select>
        </div>
    `,
    mounted: function () {

        //Generate Hours
        for(var i = 0; i < 24; i++) {
            this.horas.push({value: this.twoDigits(i)+":00"});
            this.horas.push({value: this.twoDigits(i)+":15"});
            this.horas.push({value: this.twoDigits(i)+":30"});
            this.horas.push({value: this.twoDigits(i)+":45"});
        }
    },
    data: function () {
        return {
            timeVal: "00:00",
            horas: []
        }
    },
    watch: {
        value: function (value) {
            // update value
            this.timeVal = value.substring(0, 5);
        }
    },
    methods: {
        selectValue: function (e) {
            console.log(this.timeVal+":00");
            this.$emit('input', this.timeVal+":00");
        },

        twoDigits: function (hour) {
            if(Math.floor(hour/10) == 0) { return "0"+hour; } 
            else { return hour; }
        }
    }
});
</script>   