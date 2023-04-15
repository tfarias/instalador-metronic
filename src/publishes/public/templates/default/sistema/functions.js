function sendFormModal(form){
    var modal = modal_ativa();
    var documento = $(modal).find('.modal-content');
    $(documento).find('form#' + form).ajaxForm({
        success: function (d) {
                swal({
                    title:"Sucesso!",
                    text:"Registro salvo com sucesso",
                    type:"success"
                }, function(){
                    $(modal).modal('hide')
                })

        },
        error: function (data)
        {
            console.log(data)
            var erros ="";
            if (data.status === 422)
            {
                $.each(data.responseJSON, function (key, value)
                {
                    erros+=    "<p>* ' + value + '</p>"
                });
            }
            swal("Alerta!", erros, "danger")
        }
    });

    return false;
}

function clear_tabs(){
    $(".body-tabs").find('.tab-pane').each(function(){
       $(this).html('')
    });
}
function body_tabs(){

    $(".body-tabs").find('.active').each(function(){
        var active = $(this)

        form_campos(active)
        $(active).find('form.validate').each(function(){
            $(this).formValidator();
        })
        $(this).find('a').click(function(){
            if(!empty(auxiliares.click)){
                return false;
            }
            auxiliares.click=1;
            if(empty($(this).attr('listen'))) {
                if(!empty($(this).attr('id')))
                {
                    switch ($(this).attr('id')){
                        case 'btn-excluir':
                            deletar_tabs($(this).attr('data-texto'),$(this).attr('href'))
                            break;
                        default:
                            if (!empty(this.href)) {
                               $(active).loadGrid($(this).attr('href'), null, ".this-place", body_tabs)
                            }
                            break;
                    }
                }else
                if (!empty(this.href)) {
                    console.log(this.href)
                   $(active).loadGrid($(this).attr('href'), null, ".this-place", body_tabs)
                }
                return false;
            }
        })

        $(this).find("input:submit").click(function () {
            if (empty($(this).attr('onclick')) && empty($(this).attr('listen'))) {
                FormAbas($(active).find('form.validate'));
                return false;
            }
        })

        $(this).find("button").click(function () {
            if (empty($(this).attr('onclick')) && empty($(this).attr('listen'))) {
                if(!empty(auxiliares.click)){
                    return false;
                }
                auxiliares.click=1;

                switch ($(this)[0].type) {
                    case 'button':
                        console.log('button')
                        console.log(active);
                        $(active).find('form').ajaxForm({
                            beforeSubmit: function() {
                                $(active).find('.table-responsive').html("<div class='text-center'><h3><i class='fa fa-spinner fa-pulse'></i> Carregando...</h3></div>");
                            },
                            success: function (d) {
                                $(active).find('.table-responsive').html( $(d).find('.table-responsive'));
                                body_tabs()
                            }
                        }).submit();
                        break;
                    case 'submit':
                        console.log('submit')
                        FormAbas($(active).find('form'));
                        return false;
                        break;
                }
            }

        })

        auxiliares.click = null;

    })

}
$(function(){
    //primeiro carregamento da tela, clica no primeiro link das abas
    $(".area-tabs").each(function(){
        $(this).find("#link-tabs li.active").each(function () {
            $(this).find('a').click()
            clear_tabs()
            $("#text-label").text($(this).find('a').attr('title'))
            $("#" + $(this).find('a').attr('link-id')).loadGrid($(this).find('a').attr('acao'), null, ".area", body_tabs)
            return false;
        })
    })

    $(".area-tabs").each(function(){
        $(this).find("#link-tabs li").each(function () {
            $(this).find('a').click(function(){
                clear_tabs()
                $("#text-label").text($(this).attr('data-original-title'))
                $("#"+$(this).attr('link-id')).loadGrid($(this).attr('acao'),null,".area",body_tabs)
            })
        })
    })
$("#search-menu").on("keyup", function () {
    if (this.value.length > 0) {

        $(".nav-item").hide().filter(function () {
            return $(this).text().toLowerCase().indexOf($("#search-menu").val().toLowerCase()) != -1;
        }).show();
    }
    else {
        $(".nav-item").show();
    }
});

});