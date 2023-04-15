var sistema = {

    /**
     * Configura as requisições em AJAX.
     */
    configurarAjax: function ()
    {
        $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')},
            beforeSend: function ()
            {
                $(".loading-spinner").show();
            },
            complete: function ()
            {
                $(".loading-spinner").hide();
            }
        });
    },

    /**
     * Aplica os plugins necessários para o sistema funcionar corretamente.
     */
    aplicarPluginsExternos: function (elemento)
    {
        if (elemento == null)
        {
            elemento = $(document);
        }

        $('form.validate', elemento).each(function ()
        {
            $(this).formValidator();
        });

        $('body', elemento).on('click', '.confirma-acao', function (event)
        {
            event.preventDefault();
            var $el = $(this),
                texto = $el.attr('data-texto');

            swal({
                title: 'Confirmação',
                text: texto,
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim',
                cancelButtonText: 'Cancelar'
            }, function ()
            {
                var form = $("<form/>",
                    {
                        action: $el.attr('href'),
                        method: 'POST',
                        style:'display:none'
                    }
                );
                form.append(
                    $("<input>",
                        { type:'text',
                            name:'_method',
                            value:'DELETE' }
                    )
                );
                form.append(
                    $("<input>",
                        { type:'text',
                            name:'_token',
                            value: $('meta[name="_token"]').attr('content')}
                    )
                );
                $('#form-delete').append(form);
                form.submit();
            });
        });


    }
};

$(function ()
{
    $('body').on('click', 'a[data-toggle=modal]', function (event) {
        NavObject.navegacao = [{"p": 1, "u": SITE_PATH}];
        event.preventDefault();
        modalharef = $(this).attr('href');

        if (modalharef.indexOf("first") != -1) {
            Acrescentar(modalharef);
        }

    });

    sistema.configurarAjax();
    sistema.aplicarPluginsExternos();

    $('#modal, #modal-xs, #modal_lg').on('hidden.bs.modal', function (e)
    {
        $(e.target).removeData('bs.modal');
        limpar_modais();
        var qtde_modais = last_modal()
        if(qtde_modais==0) {
            var form = $('.this-place').find('form').serializeObject();
            var caminho = $('.this-place').find('form').attr('action')
            if(!empty($('#page-atual').val())){
                form['page'] = $('#page-atual').val();
                console.log(form);
            }
            if(!empty(form)){
                $('.this-place').find("table").loadGrid(caminho, form, 'table', carregar);
            }
            //location.reload();
        }
    });

    $('#modal, #modal-xs, #modal_lg').on('loaded.bs.modal', function (e)
    {
        var modal = modal_ativa();
        if (!empty(modal)) {
            var documento = $(modal).find('.modal-content');
            initModal(documento)
            sistema.aplicarPluginsExternos(documento);
        }

    });

    form_campos($(".this-place"))

    $('#modal, #modal-xs, #modal_lg').on('loaded.bs.modal', function (e)
    {
        form_campos($(this).find(".this-place"))
        initModal($(this).find(".this-place"))
        var html= '<div class="modal-header">\n' +
            '            <button type="button" class="close" data-dismiss="modal" style="width: 20px; height: 20px">\n' +
            '                <span>&times;</span>\n' +
            '            </button>\n' +
            '        </div>';
        $(this).find(".modal-content").prepend(html);
    })


});