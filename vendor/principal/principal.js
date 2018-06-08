//MENSAGEM
function message(type, msg) {
    if (msg) {
        //CONFIG MENSAGEM
        toastr.options = {
                // "closeButton": true,
                "closeButton": true,
                "newestOnTop": true,
                "progressBar": true,
                "showDuration": "600",
                "progressBar": true,
                "hideDuration": "500",
                "timeOut": "8500",
                "extendedTimeOut": "1000",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut",
                "positionClass": "toast-top-center",
        }
    }
    //EXIBE MENSAGEM
    Command:toastr[type]('<strong>'+msg+'</strong>');
}