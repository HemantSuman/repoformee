var Notify = function () {

    var defaultHeights = {
        atomic: 70,
        chicchat: 120,
        legacy: 90,
        materialish: 48
    };


    var showMessage = function (text, type) {

        if (type == 'black')
            type = 'twilight';

        if (type == 'done')
            type = 'success';

        if (type == 'warning')
            type = 'warning';

        if (type == 'info')
            type = 'information';



        var n = noty({
            text: text,
            timeout: 6000,
            type: type,
            dismissQueue: true,
            layout: 'topRight',
            closeWith: ['click'],
            theme: 'relax',
            maxVisible: 10,
            animation: {
                open: 'animated bounceInRight',
                close: 'animated bounceOutRight',
                easing: 'swing',
                speed: 500
            }
        });
    }


    var showMessageOld = function (id, msg) {
            $("#" + id).after("<p class='error-message errorMsg top '>" + msg + "</p>");
        
    }

    var showMessageForClass = function (id, msg) {
        $("." + id).after("<p class='error-message errorMsg top '>" + msg + "</p>");

    }

    var trans = function (msg) {

        return msg;

    }

    return {
        showMessage: function (msg, type) {

            showMessage(msg, type);
        },
        showMessageOld: function (id, msg, domIdAndField) {

            showMessageOld(id, msg, domIdAndField);
        },
        showMessageForClass: function (id, msg) {

            showMessageForClass(id, msg);
        },
        trans: function (msg) {

            return trans(msg);
        }

    };

}();