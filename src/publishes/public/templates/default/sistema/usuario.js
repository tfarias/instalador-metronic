$(function () {
    $(document).on('loaded.bs.modal', function () {
        $('#id_equipe').select2({
            allowClear: true,
            width: '100%',
            openOnEnter: false,
            theme: "bootstrap",
            language: "pt-BR",
            placeholder: "Selecione..."
        });
    })
});