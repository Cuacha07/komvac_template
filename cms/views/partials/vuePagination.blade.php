@push('css')
<style> .pagination li a { cursor: pointer; } </style>
@endpush

<script>

//Pagination for Laravel 5.3
Vue.component('pagination', {
    props: ['param'],
    //props: ['total', 'per_page', 'current_page', 'last_page', 'next_page_url', 'prev_page_url'],
    template: `
        <div v-if="hasData">
            <ul class="pagination">

                <!-- First Page -->
                <li :class="isFirst()">
                    <a @click="goPage(1)"><i class="fa fa-arrow-left" aria-hidden="true"></i><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                </li>

                <!-- Prev Button -->
                <li :class="areMore(param.prev_page_url)">
                    <a @click="setPage(param.prev_page_url)"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                </li>

                <!-- Pages -->
                <li v-for="value in totalPages" :class="isActive(value)">
                    <a @click="goPage(value)">@{{ value }}</a>
                </li>

                <!-- Next Button -->
                <li :class="areMore(param.next_page_url)">
                    <a @click="setPage(param.next_page_url)"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </li>

                <!-- Last Page -->
                <li :class="isLast()">
                    <a @click="goPage(param.last_page)"><i class="fa fa-arrow-right" aria-hidden="true"></i><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </li>

            </ul>
        </div>
    `,
    data: function () {
        return {
            hasData: false
        }
    },
    watch: {
        param: function (value) {
            if(value != null) {
                if(value.total > 0) { this.hasData = true; } 
                else { this.hasData = false; }
            } else { this.hasData = false; }
        }
    },
    computed: {
        totalPages: function () {
            if(this.param.total == 0) { return 0; }
            return Math.floor(this.param.total / this.param.per_page);
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
        }
    }
});
</script>