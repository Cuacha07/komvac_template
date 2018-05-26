<!-- select2 -->
{!! Html::style('css/select2/select2.min.css') !!}
<style>
.select2-container--default .select2-selection--single, .select2-selection .select2-selection--single {
  border: 1px solid #d2d6de;
  border-radius: 0;
  padding: 6px 12px;
  height: 34px;

  -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
  -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
  transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
}
.select2-container .select2-selection--single .select2-selection__rendered {
  padding-right: 10px;
}
.select2-container .select2-selection--single .select2-selection__rendered {
    padding-left: 0;
    padding-right: 0;
    height: auto;
    margin-top: -4px;
}
.select2-container--default .select2-selection--single .select2-selection__arrow {
  height: 32px;
  right: 3px;
}
.select2-selection--single:hover {
  border-color: #157D0A;
}
</style>
{!! Html::script('js/select2/select2.full.min.js') !!}
{!! Html::script('js/select2/es.js') !!}

<script>
var select2 = {
  directives: {
       select2:  {
           twoWay: true,
           bind: function () {
             var self = this
             $(this.el)
               .select2({
                 //data: optionsData,
                 language: "es"
               })
               .on('change', function () {
                 self.set(this.value)
               })
           },
           update: function (value) {
             $(this.el).val(value).trigger('change')
           },
           unbind: function () {
             $(this.el).off().select2('destroy')
           }
       }
   }
}
</script>
