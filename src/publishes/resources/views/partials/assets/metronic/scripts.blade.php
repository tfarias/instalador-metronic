@section('scripts')

    <script src="{{ asset('templates/default/jquery.js') }}"></script>
    <script src="{{ asset('templates/default/bootstrap.min.js') }}"></script>

    <!--[if lt IE 9]>
    <script src="{{ asset('templates/metronic/js/respond.min.js') }}"></script>
    <![endif]-->
    <script src="{{ asset('templates/metronic/js/plugins/cookie/js.cookie.min.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/blockui/jquery.blockui.min.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/bootstrap-switch/bootstrap-switch.min.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/dates/moment-with-locales.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/dates/bootstrap-datetimepicker.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/dates/daterangepicker.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/datapicker/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/datapicker/bootstrap-datepicker.pt-BR.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/select2/select2.full.min.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/morris/morris.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/mask.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/app.min.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/layout.min.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/money.js') }}"></script>
    <script src="{{ asset('templates/default/validator.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/input_file/fileinput.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/input_file/fileinput_locale_pt-BR.js') }}"></script>
    <script src="{{ asset('templates/metronic/js/plugins/jquery_form/jquery.form.min.js') }}"></script>
    <script src="{{ asset('templates/default/sistema/extensions.js') }}"></script>
    <script src="{{ asset('templates/default/sistema/functions.js') }}"></script>
    <script src="{{ asset('templates/default/sistema/action.js') }}"></script>

    <script>
        var rota = '{{Route::currentRouteName()}}'.split(".")
        $.when(
            $("#ul-menu li").each(function (key, value) {
                if (strripos($(value).attr('id'), '-') > 0) {
                    var ids = $(value).attr('id').split("-")
                    $(ids).each(function (k, v) {
                        if (strripos(v, '.') > 0) {
                            var reg = v.split(".")
                            v = reg[0]
                        }
                        if (v == rota[0]) {
                            $(value).addClass('active')
                            $(value).css({'border-top': '1px solid #2D5F8B', 'border-bottom': '1px solid #2D5F8B'})
                            $(value).find('a').css({'background': '#3d8a63'})
                            $(value).find('a').append('<span class="selected"></span>');
                        }
                    })

                } else if ($(value).attr('id') == rota[0]) {
                    $(value).addClass('active')
                    $(value).css({'border-top': '1px solid #2D5F8B', 'border-bottom': '1px solid #2D5F8B'})

                    $(value).find('a').css({'background': '#3d8a63'})

                    $(value).find('a').append('<span class="selected"></span>');
                }

            })
        ).then(function(){
            $("#ul-menu li").each(function (key, value) {
                if (!empty($(value).find('a').attr('href'))) {
                    if ($(value).find('a').attr("href").length > SITE_PATH.length) {
                        var url = $(value).find('a').attr("href").substr(SITE_PATH.length + 1, $(value).find('a').attr("href").length)

                        if(rota[1]=='index'){
                            if (url == rota[0]) {
                                $(value).addClass('active')
                            }
                        }else{
                            if (replaceAll(url,'-','_') == replaceAll(rota[0]+"/"+rota[1],'-','_')) {
                                $(value).addClass('active')
                            }
                        }

                    }
                }
            })
        })
    </script>
@show