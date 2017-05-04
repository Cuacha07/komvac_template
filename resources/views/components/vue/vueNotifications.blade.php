@push('css')
{!! Html::style('css/iziToast/iziToast.min.css') !!}
@endpush

{{-- iziToast (https://github.com/dolce/iziToast) --}}
{!! Html::script('js/iziToast/iziToast.min.js') !!}

<script>
notifications = {
    methods: {
        notification: function (icon, title, message) {
            iziToast.show({
                color: 'dark',
                icon: icon,
                title: title,
                message: message,
                position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                progressBarColor: 'rgb(0, 255, 184)'
            });
        },
        notificationCustom: function (color, icon, title, message, position) {
            iziToast.show({
                color: color,
                icon: icon,
                title: title,
                message: message,
                position: position, // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                progressBarColor: 'rgb(0, 255, 184)'
            });
        },
        notificationDefault: function (message) {
            iziToast.show({
                color: 'dark',
                message: message,
                position: 'topCenter', // bottomRight, bottomLeft, topRight, topLeft, topCenter, bottomCenter
                progressBarColor: 'rgb(0, 255, 184)'
            });
        },
        notificationSuccess: function (title, message, position) {
            iziToast.success({
                title: title,
                message: message,
                position: position
            });
        },
        notificationError: function (title, message, position) {
            iziToast.error({
                title: title,
                message: message,
                position: position
            });
        },
        notificationWarning: function (title, message, position) {
            iziToast.warning({
                title: title,
                message: message,
                position: position
            });
        },
        notificationInfo: function (title, message, position) {
            iziToast.info({
                title: title,
                message: message,
                position: position
            });
        }
    }
}
</script>   