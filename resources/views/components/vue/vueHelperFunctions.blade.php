<!-- lodash’s JS -->
{!! Html::script('js/vue/lodash.min.js') !!}

<!-- EPPZScrollTo -->
{!! Html::script('js/EPPZScrollTo.js') !!}

<script>
var helperFunctions = {
    methods: {
        //Helper Functions
        //Array Index Finder
        findIndexByKeyValue: function (arraytosearch, key, valuetosearch) {
            for (var i = 0; i < arraytosearch.length; i++) {
                if (arraytosearch[i][key] == valuetosearch) { return i }
            } return null
        },

        //Return Fecha String
        dateString: function (fecha) {
            if(fecha == null){return;}
            var meses = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            var diasSemana = new Array("Domingo", "Lunes","Martes","Miércoles","Jueves","Viernes","Sábado");
            var f = new Date(fecha.replace(/-/g,"/")); //Fix UTC "-" to Local "/"
            return diasSemana[f.getDay()] + ", " + f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
        },

        //Return Fecha String
        dateString2: function (fecha) {
            if(fecha == null){return;}
            var meses = new Array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
            var f = new Date(fecha.replace(/-/g,"/")); //Fix UTC "-" to Local "/"
            return f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear();
        },

        //Format Bytes
        formatBytes: function (bytes, decimals) {
            if(bytes == 0) return '0 Bytes';
            var k = 1000,
                dm = decimals + 1 || 3,
                sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'],
                i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
        },

        //Format Currency
        formatCurrency: function (value) {
            var val = parseFloat(value);
            return '$' + val.toFixed(2).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
        },

        toTitleCase: function (str) {
            return str.replace(/\w\S*/g, function(txt){return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();});
        },

        //Slug Url
        slugify: function(value) {
            value = value.replace(/^\s+|\s+$/g, ''); // trim
            value = value.toLowerCase();

            // remove accents, swap ñ for n, etc
            var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
            var to   = "aaaaaeeeeeiiiiooooouuuunc------";
            for (var i=0, l=from.length ; i<l ; i++) {
                value = value.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
            }

            value = value.replace(/[^a-z0-9 -]/g, '').replace(/\s+/g, '-').replace(/-+/g, '-'); // collapse dashes

            return value;
        }
    }
}
</script>