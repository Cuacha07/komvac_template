@push('css')
<style> .pagination li a { cursor: pointer; } </style>
@endpush

<script>
Vue.component('pagination', {
    props: ['param'],
    //props: ['total', 'per_page', 'current_page', 'last_page', 'next_page_url', 'prev_page_url'],
    template: `
        <div v-if="hasData">
            <ul class="pagination pagination-sm no-margin">

                <!-- First Page -->
                <li :class="isFirst()">
                    <a @click="goPage(1)">««</a>
                </li>

                <!-- Prev Button -->
                <li :class="areMore(param.prev_page_url)">
                    <a @click="setPage(param.prev_page_url)">«</a>
                </li>

                <!-- Pages -->
                <li v-for="value in totalPages" :class="isActive(value)">
                    <a @click="goPage(value)">@{{ value }}</a>
                </li>

                <!-- Next Button -->
                <li :class="areMore(param.next_page_url)">
                    <a @click="setPage(param.next_page_url)">»</a>
                </li>

                <!-- Last Page -->
                <li :class="isLast()">
                    <a @click="goPage(param.last_page)">»»</a>
                </li>

            </ul>
        </div>
    `,
    data: function () {
        return {
            hasData: false,
            intervalLength: 6 //Pair Number
        }
    },
    watch: {
        param: function (value) {
            //console.log(value);
            if(value != null) {
                if(value.total >= value.per_page) { this.hasData = true; } 
                else { this.hasData = false; }
            } else { this.hasData = false; }
        }
    },
    computed: {
        totalPages: function () {
            if(this.param.total == 0) { return 0; }

            // return Math.ceil(this.param.total / this.param.per_page);

            var total = Math.ceil(this.param.total / this.param.per_page); //console.log("Total: "+total);
            
            var currentPage = this.param.current_page;

            //Ranges
            var il = this.intervalLength / 2;

            //Initial and End Interval
            var start_int = this.minusZero(currentPage, il); //console.log("start: "+start_int);
            var end_int = this.maximunTotal(currentPage, il, this.intervalLength, total); //console.log("end: "+end_int);

            var intervalTotal = [];

            for (var i = start_int; i <= end_int; i++) {
                intervalTotal.push(i);
            }

            //console.log(intervalTotal);
            return intervalTotal;

        }
    },
    methods: {
        //Next & Prev Buttons
        setPage: function (url) {
            if(url != null) {
                this.$emit('setpage', url); 
            }
        },

        //Go to Page Button
        goPage: function (page) {
            
            var url = "";
            var param = "";

            //Detect nulls & "?" and Emit
            if(this.param.prev_page_url != null) {
                param = this.param.prev_page_url;
            } else {
                param = this.param.next_page_url;
            }

            //Is Current Page check
            if(this.isCurrentPage(page)) {
                url = param.substring(0, param.indexOf("?"))+"?page="+page;
                this.$emit('setpage', url);
            }
        },

        //Disabled on Next & Prev
        areMore: function (url) {
            if(url == null) {
                return "disabled";
            }
        },

        //Disabled for First and Last Buttons
        isFirst: function () {
            if(this.param.current_page == 1) {
                return "disabled";
            }
        },

        isLast: function () {
            if(this.param.current_page == this.param.last_page) {
                return "disabled";
            }
        },

        isActive: function (page) {
            if(page == this.param.current_page) {
                return "active";
            }
        },

        isCurrentPage: function (page) {
            if(page == this.param.current_page) {
                return false;
            } else { return true; }
        },

        between: function (x, min, max) {
            return x >= min && x <= max;
        },

        minusZero: function (val, minus) {
            if(val - minus > 0) { return val - minus; } 
            else { return 1; }
        },

        maximunTotal: function (val, max, minimun, total) {
            if(val + max < total) {
                if(val + max < minimun) { return minimun; } 
                else { return val + max; }
            }
            else { return total; }
        }
    }
});
</script>