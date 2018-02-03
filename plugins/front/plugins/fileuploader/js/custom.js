$(document).ready(function () {

    // enable fileuploader plugin
    $('#upload-Adimg').fileuploader({
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
        changeInput: ' ',
        theme: 'thumbnails',
        enableApi: true,
        addMore: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                    '<ul class="fileuploader-items-list">' +
                    '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><img src="' + root_url + '/plugins/front/img/icons/file.jpg"></div></li>' +
                    '</ul>' +
                    '</div>',
            item: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="thumbnail-holder">${image}</div>' +
                    '<div class="actions-holder">' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                    '</div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',
            item2: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="thumbnail-holder">${image}</div>' +
                    '<div class="actions-holder">' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                    '</div>' +
                    '</div>' +
                    '</li>',
            startImageRenderer: true,
            canvasImage: false,
            _selectors: {
                list: '.fileuploader-items-list',
                item: '.fileuploader-item',
                start: '.fileuploader-action-start',
                retry: '.fileuploader-action-retry',
                remove: '.fileuploader-action-remove'
            },
            onItemShow: function (item, listEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input');

                plusInput.insertAfter(item.html);

                if (item.format == 'image') {
                    item.html.find('.fileuploader-item-icon').hide();
                }
            },
        },
        afterRender: function (listEl, parentEl, newInputEl, inputEl) {
            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                    api = $.fileuploader.getInstance(inputEl.get(0));

            plusInput.on('click', function () {
                api.open();
            });
        },
        /*
         // while using upload option, please set
         // startImageRenderer: false
         // for a better effect
         upload: {
         url: './php/upload_file.php',
         data: null,
         type: 'POST',
         enctype: 'multipart/form-data',
         start: true,
         synchron: true,
         beforeSend: null,
         onSuccess: function(data, item) {
         setTimeout(function() {
         item.html.find('.progress-holder').hide();
         item.renderImage();
         }, 400);
         },
         onError: function(item) {
         item.html.find('.progress-holder').hide();
         item.html.find('.fileuploader-item-icon i').text('Failed!');
         
         setTimeout(function() {
         item.remove();
         }, 1500);
         },
         onProgress: function(data, item) {
         var progressBar = item.html.find('.progress-holder');
         
         if(progressBar.length > 0) {
         progressBar.show();
         progressBar.find('.fileuploader-progressbar .bar').width(data.percentage + "%");
         }
         }
         },
         dragDrop: {
         container: '.fileuploader-thumbnails-input'
         },
         onRemove: function(item) {
         $.post('php/upload_remove.php', {
         file: item.name
         });
         },
         */
    });


    // enable fileuploader plugin
    $('#uploadimg_business').fileuploader({
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
        changeInput: ' ',
        theme: 'thumbnails',
        enableApi: true,
        addMore: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                    '<ul class="fileuploader-items-list">' +
                    '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><img src="' + root_url + '/plugins/front/img/icons/file.jpg"></div></li>' +
                    '</ul>' +
                    '</div>',
            item: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="thumbnail-holder">${image}</div>' +
                    '<div class="actions-holder">' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                    '</div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',
            item2: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="thumbnail-holder">${image}</div>' +
                    '<div class="actions-holder">' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                    '</div>' +
                    '</div>' +
                    '</li>',
            startImageRenderer: true,
            canvasImage: false,
            _selectors: {
                list: '.fileuploader-items-list',
                item: '.fileuploader-item',
                start: '.fileuploader-action-start',
                retry: '.fileuploader-action-retry',
                remove: '.fileuploader-action-remove'
            },
            onItemShow: function (item, listEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input');

                plusInput.insertAfter(item.html);

                if (item.format == 'image') {
                    item.html.find('.fileuploader-item-icon').hide();
                }
            },

            onImageLoaded: function (item, listEl, parentEl, newInputEl, inputEl) {
                var img = new Image();
                img.src = $(item.html[0]).find('img').attr('src');
                console.log(img.width, img.height);
                if (img.width != 650 || img.height != 375) {
                    Notify.showNotification('Image require 650*375', "warning");
                    item.remove();
                    return false;
                }

            },
        },
        beforeSelect: function (files, listEl, parentEl, newInputEl, inputEl) {
            var memPlanUser = JSON.parse($('.memPlanUser').text());
            console.log(memPlanUser, typeof memPlanUser[0]['number_image_upload'], memPlanUser[0]['number_image_upload']);
            if ((typeof memPlanUser[0]['number_image_upload'] != 'undefined') && (memPlanUser[0]['number_image_upload'] != '')) {
                var num_img = memPlanUser[0]['number_image_upload'];
            } else {
                var num_img = 5;
            }
            if ($('.fileuploader-item-image').length >= num_img) {
                Notify.showNotification('You can only upload ' + num_img + ' images');
                return false;
            }
//            console.log(files, listEl, parentEl, newInputEl, inputEl);
//            return false;
        },
        afterRender: function (listEl, parentEl, newInputEl, inputEl) {
            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                    api = $.fileuploader.getInstance(inputEl.get(0));

            plusInput.on('click', function () {
                api.open();
            });
        },

    });


    // enable fileuploader plugin
    $('#uploadimg_private').fileuploader({
        extensions: ['jpg', 'jpeg', 'png', 'gif', 'bmp'],
        changeInput: ' ',
        theme: 'thumbnails',
        enableApi: true,
        addMore: true,
        thumbnails: {
            box: '<div class="fileuploader-items">' +
                    '<ul class="fileuploader-items-list">' +
                    '<li class="fileuploader-thumbnails-input"><div class="fileuploader-thumbnails-input-inner"><img src="' + root_url + '/plugins/front/img/icons/file.jpg"></div></li>' +
                    '</ul>' +
                    '</div>',
            item: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="thumbnail-holder">${image}</div>' +
                    '<div class="actions-holder">' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                    '</div>' +
                    '<div class="progress-holder">${progressBar}</div>' +
                    '</div>' +
                    '</li>',
            item2: '<li class="fileuploader-item">' +
                    '<div class="fileuploader-item-inner">' +
                    '<div class="thumbnail-holder">${image}</div>' +
                    '<div class="actions-holder">' +
                    '<a class="fileuploader-action fileuploader-action-remove" title="Remove"><i class="remove"></i></a>' +
                    '</div>' +
                    '</div>' +
                    '</li>',
            startImageRenderer: true,
            canvasImage: false,
            _selectors: {
                list: '.fileuploader-items-list',
                item: '.fileuploader-item',
                start: '.fileuploader-action-start',
                retry: '.fileuploader-action-retry',
                remove: '.fileuploader-action-remove'
            },
            onItemShow: function (item, listEl) {
                var plusInput = listEl.find('.fileuploader-thumbnails-input');

                plusInput.insertAfter(item.html);

                if (item.format == 'image') {
                    item.html.find('.fileuploader-item-icon').hide();
                }
            },

            onImageLoaded: function (item, listEl, parentEl, newInputEl, inputEl) {
                var img = new Image();
                img.src = $(item.html[0]).find('img').attr('src');
                console.log(img.width, img.height);
                if (img.width != 650 || img.height != 375) {
                    Notify.showNotification('Image require 650*375', "warning");
                    item.remove();
                    return false;
                }

            },
        },
        beforeSelect: function (files, listEl, parentEl, newInputEl, inputEl) {
            var packagesjson = JSON.parse($('.packagesjson').text());
            var package_id = $('.package_id').val();
            if (typeof packagesjson[package_id]['number_image_upload'] != 'undefined') {
                var num_img = packagesjson[0]['number_image_upload'];
            } else {
                var num_img = 5;
            }
            if ($('.fileuploader-item-image').length >= num_img) {
                Notify.showNotification('You can only upload ' + num_img + ' images');
                return false;
            }
//            console.log(files, listEl, parentEl, newInputEl, inputEl);
//            return false;
        },
        afterRender: function (listEl, parentEl, newInputEl, inputEl) {
            var plusInput = listEl.find('.fileuploader-thumbnails-input'),
                    api = $.fileuploader.getInstance(inputEl.get(0));

            plusInput.on('click', function () {
                api.open();
            });
        },

    });

});
