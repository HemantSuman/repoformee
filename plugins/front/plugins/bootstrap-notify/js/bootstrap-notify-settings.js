var Notify = function () {
    var showNotification = function (text, type) {
        if (type == 'success')
            type = 'success';

        if (type == 'error')
            type = 'danger';

        if (type == 'warning')
            type = 'warning';

        if (type == 'info')
            type = 'info';

        var n = $.notify({
            message: text,
        }, {
            // settings
            element: 'body',
            position: null,
            type: type,
            allow_dismiss: true,
            newest_on_top: false,
            showProgressbar: false,
            placement: {
                from: "top",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 9999,
            delay: 2000,
            timer: 111000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated fadeInDown',
                exit: 'animated fadeOutUp'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class'
        });

        setTimeout(function () {
            n.close();
        }, 3000);
    }

    return {
        showNotification: function (msg, type) {
            showNotification(msg, type);
        }
    };
}();