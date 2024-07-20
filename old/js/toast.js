(function (window, $) {
    "use strict";
    const Toast = Swal.mixin({
        toast: true,
        position: "top-right",
        iconColor: "white",
        customClass: {
            popup: "colored-toast",
        },
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
    });
    $.toast = function (config) {
        var size = arguments.length;
        var isString = typeof config === "string";

        if (isString && size === 1) {
            config = {
                message: config,
            };
        }

        if (isString && size === 2) {
            config = {
                title: arguments[1],
                icon: arguments[0],
            };
        }

        Toast.fire(config);
    };
})(window, jQuery);
