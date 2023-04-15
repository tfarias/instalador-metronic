$(function () {
    $('li.rota').on('click', function (e) {
        var $checkbox = $(this).find(':checkbox');
        if (event.target.type !== 'checkbox') {
            $checkbox.prop('checked', !$checkbox.prop('checked'));
        }
    });

    $('select[name="tipo_profissional_id"]').change(function () {
        var id = $(this).val();
        if (id == '') {
            $('#listagem').addClass('hide');
        } else {
            $('#carregando').removeClass('hide');
            $(':checkbox').prop('checked', false);
            $.post(SITE_PATH + '/tipo_profissional/carregar-permissoes', {id: id}, function (rotas) {
                $.each(rotas, function (key, rota) {
                    $('#rota-' + rota.id).prop('checked', true);
                });
                $('#listagem').removeClass('hide');
                $('#carregando').addClass('hide');
            });
        }
    })


    $('.permitir-todos').click(function (e) {
        e.preventDefault();
        $(this).parents('.ibox-content').find(':checkbox').prop('checked', true);
    });

    $('form[name="salvar-permissoes"]').on('submit', function (e) {
        e.preventDefault();
        var $form = $(this),
            $botaoSubmit = $form.find('button[type="submit"]'),
            dados = $form.serializeArray();

        if ($form.find('select[name="tipo_profissional_id"]').val() == '') {
            toastr['warning']("Por favor, escolha o grupo de acesso que deseja gerenciar as permissões.");
            return;
        }

        $botaoSubmit.find('.fa-spinner').removeClass('hide');
        $botaoSubmit.find('span').text('Salvando...');
        $botaoSubmit.attr('disabled', true);
        $.post($form.attr('action'), dados, function (retorno) {
            if (retorno) {
                toastr.warning("As permissões foram atualizadas com sucesso para o grupo selecionado.", 'Permissões atualizadas');
            } else {
                toastr.error("Houve um erro ao salvar as permissões, contate o suporte técnico.", 'Erro');
            }
            $botaoSubmit.removeAttr('disabled');
            $botaoSubmit.find('.fa-spinner').addClass('hide');
            $botaoSubmit.find('span').text('Salvar');
        });
    })
});