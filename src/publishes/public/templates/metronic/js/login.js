var Login = function() {

    var handleLogin = function() {

        $('[data="icheck"]').each(function () {
            $(this).iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
                // increaseArea: '20%' // optional
            });
        });
        $('.login-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            rules: {
                login: {
                    required: true
                },
                password: {
                    required: true
                },
                remember: {
                    required: false
                }
            },

            messages: {
                username: {
                    required: "Login é obrigatório."
                },
                password: {
                    required: "Senha é obrigatória."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   
                $('.alert-danger', $('.login-form')).show();
            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                form.submit(); // form validation success, call ajax form submit
            }
        });

        $('.login-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.login-form').validate().form()) {
                    $('.login-form').submit(); //form validation success, call ajax form submit
                }
                return false;
            }
        });
    }

    var handleForgetPassword = function() {
        $('.forget-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {
                email: {
                    required: true,
                    email: true
                }
            },

            messages: {
                email: {
                    required: "Email é obrigatório."
                }
            },

            invalidHandler: function(event, validator) { //display error alert on form submit   

            },

            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },

            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                error.insertAfter(element.closest('.input-icon'));
            },

            submitHandler: function(form) {
                form.submit();
            }
        });

        $('.forget-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.forget-form').validate().form()) {
                    $('.forget-form').submit();
                }
                return false;
            }
        });

        jQuery('#forget-password').click(function() {
            jQuery('.login-form').hide();
            jQuery('.forget-form').show();
        });

        jQuery('#back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.forget-form').hide();
        });

    }

    var handleRegister = function() {

        function format(state) {
            if (!state.id) { return state.text; }
            var $state = $(
             '<span><img src="../assets/global/img/flags/' + state.element.value.toLowerCase() + '.png" class="img-flag" /> ' + state.text + '</span>'
            );
            
            return $state;
        }

        if (jQuery().select2 && $('#estado_id').size() > 0) {
        /*    $("#estado_id").select2({
	            placeholder: '<i class="fa fa-map-marker"></i>&nbsp;Selecione um estado',
	            templateResult: format,
                templateSelection: format,
                width: 'auto', 
	            escapeMarkup: function(m) {
	                return m;
	            }
	        });
*/

	        $('#estado_id').change(function() {
	            cidade = $("#cidade_id")
	            $.ajax({
                    type:'GET',
                    url:SITE_PATH+'/estados/get_por_estado/'+$(this).val(),
                    beforeSend: function ()
                    {
                        cidade.html('<option value="">carregando...</option>');
                    },
                    success: function (data)
                    {
                        if (!empty(data))
                        {
                            cidade.html('<option value="">Cidades</option>');
                            $.each(data, function (i, option)
                            {
                                cidade.append('<option value="' + option.id + '">' + option.txt + '</option>');
                            });
                        } else
                        {
                            cidade.find('option:first').prop('selected', true);
                        }
                    },
                })
	            $('.register-form').validate().element($(this)); //revalidate the chosen dropdown value and show error or success message for the input
	        });
    	}
        $('.register-form').formValidator();

        $('.register-form').validate({
            errorElement: 'span', //default input error message container
            errorClass: 'help-block', // default input error message class
            focusInvalid: false, // do not focus the last invalid input
            ignore: "",
            rules: {

                nome: {
                    required: true
                },
                genero_id: {
                    required: true
                },

                estado_id: {
                    required: true
                },
                celular: {
                    required: true
                },
                cidade_id: {
                    required: true
                },

                login: {
                    required: true
                },
                password: {
                    required: true
                },
                password_confirmation: {
                    equalTo: "#register_password"
                },
                tnc: {
                    required: true
                },
                idade: {
                    required: true
                }
            },

            messages: { // custom messages for radio buttons and checkboxes
                genero_id: {
                    required: "Por favor! Selecione um gênero!"
                },
                idade: {
                    required: "Por favor! Informe a idade!"
                },
                nome: {
                    required: "Por favor! escreva seu nome aqui!"
                },
                celular: {
                    required: "Por favor! Preencha o celular."
                },
                login: {
                    required: "Por favor! Preencha o login."
                },
                password: {
                    required: "Por favor! Preencha a senha."
                },
                estado_id: {
                    required: "Por favor! Selecione um estado"
                },
                cidade_id: {
                    required: "Por favor! Selecione uma cidade"
                },
                tnc: {
                    required: "Por favor! Aceite os termos e serviços para continuar!"
                },
                password_confirmation: {
                    equalTo: "A senha não está igual a confirmação de senha!"
                }
            },
            invalidHandler: function(event, validator) { //display error alert on form submit

            },
            highlight: function(element) { // hightlight error inputs
                $(element)
                    .closest('.form-group').addClass('has-error'); // set error class to the control group
            },
            success: function(label) {
                label.closest('.form-group').removeClass('has-error');
                label.remove();
            },

            errorPlacement: function(error, element) {
                if (element.attr("name") == "tnc") { // insert checkbox errors after the container                  
                    error.insertAfter($('#register_tnc_error'));
                } else if (element.closest('.input-icon').size() === 1) {
                    error.insertAfter(element.closest('.input-icon'));
                } else {
                    error.insertAfter(element);
                }
            },

            submitHandler: function(form) {
                form[0].submit();
            }
        });

        $('.register-form input').keypress(function(e) {
            if (e.which == 13) {
                if ($('.register-form').validate().form()) {
                    $('.register-form').submit();
                }
                return false;
            }
        });

        jQuery('#register-btn').click(function() {
            jQuery('.login-form').hide();
            jQuery('.register-form').show();
        });

        jQuery('#register-back-btn').click(function() {
            jQuery('.login-form').show();
            jQuery('.register-form').hide();
        });
    }

    return {
        //main function to initiate the module
        init: function() {

            handleLogin();
            handleForgetPassword();
            handleRegister();

        }

    };

}();

jQuery(document).ready(function() {
    Login.init();
});
function empty(mixed_var) {
    var undef, key, i, len;
    var emptyValues = [undef, null, false, 0, '', '0'];
    for (i = 0, len = emptyValues.length; i < len; i++) {
        if (mixed_var === emptyValues[i]) {
            return true;
        }
    }
    if (typeof mixed_var === 'object') {
        for (key in mixed_var) {
            // TODO: should we check for own properties only?
            //if (mixed_var.hasOwnProperty(key)) {
            return false;
            //}
        }
        return true;
    }
    return false;
}