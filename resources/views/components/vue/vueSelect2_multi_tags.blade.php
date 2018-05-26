@push('css')
{!! Html::style('css/select2/select2.min.css') !!}
<style>
  .select2-container--default .select2-selection--multiple , .select2-selection .select2-selection--multiple  {
    border: 1px solid #d2d6de;
    border-radius: 0;
    padding: 4px 12px;
    height: 34px;

    -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
    -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
    transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
  }
  .select2-container .select2-selection--multiple  .select2-selection__rendered {
    padding-right: 10px;
  }
  .select2-container .select2-selection--multiple  .select2-selection__rendered {
      padding-left: 0;
      padding-right: 0;
      height: auto;
      margin-top: -4px;
  }
  .select2-container--default .select2-selection--multiple  .select2-selection__arrow {
    height: 32px;
    right: 3px;
  }
  .select2-selection--multiple :hover {
    border-color: #157D0A;
  }
</style>
@endpush

{!! Html::script('js/select2/select2.full.min.js') !!}
{!! Html::script('js/select2/es.js') !!}

<script>

//Get it from: https://github.com/gustavobissolli/vue2-select2/issues/1

Vue.component('select2', {
    props: ['options', 'value'],
    template: `
        <div>
            <select multiple ref='select' style="width: 100%;">
                <slot></slot>
            </select>
        </div>
    `,
    mounted: function () {
        var vm = this;
        $(this.$refs.select)
            .select2({ data: this.options, placeholder: "Selecciona tags", language: "es" })
            .on('change', function (ev, args) {
                if (!(args && "ignore" in args)) {
                    vm.$emit('input', $(this).val());
                }
            });
            
            Vue.nextTick(() => {
                $(this.$refs.select).val(this.value).trigger('change', { ignore: true });
            });
    },
    watch: {
        value: function (value, oldValue) {
            // update value
            $(this.$refs.select).val(this.value).trigger('change', { ignore: true });
        },
        options: function (options) {
            // update options
            if($(this.$refs.select).select2('val') == null) {
              $(this.$refs.select).select2({ data: options });
            } else {
              $(this.$refs.select).select2({ data: options });
              $(this.$refs.select).val(this.value).trigger('change', { ignore: true });
            }
        }
    },
    destroyed: function () {
        $(this.$refs.select).off().select2('destroy');
    }
});

var select2_multi_tags = {
  mounted: function() {
    this.getTags();
  },
  data: {
    //Tags
    selected: [],
    options: [],
    loadingSelect2: false,

    //Modal
    loadingModal: false,
    showModal: false,
    dataModal: { nombre: '' },
  },
  methods: {
    //Tags
    getTags: function() {
      this.loadingSelect2 = true;
      var resource = this.$resource(this.tagsRoute);
      resource.get({}).then(function (response) {
          this.options = response.data;
          this.loadingSelect2 = false;
      });
    },

    //Modal Functions
    openModal: function () {
      this.showModal = true
      window.setTimeout(function () {
          document.getElementById("PN").focus();
      }, 0);
    },
    saveModal: function () {
      if(this.saveInAction == true) { return; }
      this.loadingModal= true
      this.saveInAction = true

      var form = new FormData();
      form.append('nombre', this.dataModal.nombre);

      var resource = this.$resource(this.tagsSaveRoute)
      resource.save(form).then(function (response) {
          this.notification('fa fa-check-circle', 'OK!', "Tag Agregado!", 'topCenter');
          this.showModal = false
          this.loadingModal = false

          //Fix para Tags al añadir
          this.selected.push(String(response.data.id));

          //Reload Tags
          this.getTags()

          this.dataModal.nombre = ''
          this.saveInAction = false
      }, function (response) {
          this.notification('fa fa-exclamation-triangle', 'Error', "Se ha producido un error.", 'topCenter');
          this.showModal = false
          this.loadingModal = false
          this.dataModal.nombre = ''
          this.saveInAction = false
      })
    }
  }
}
</script>