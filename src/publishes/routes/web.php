<?php
Auth::routes();
Route::get('logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::get('nao-autorizado', function () {
    return view('erros.nao_autorizado');
})->name('nao_autorizado');

Route::post('fill', 'SelectController@fill')->name('fill');
Route::post('getedit', 'SelectController@getEdit')->name('getEdit');

Route::group(['middleware' => ['auth', 'has-permission']], function () {
    Route::get('/', 'HomeController@index')->name('home');

    Route::group(['prefix' => 'usuario', 'as' => 'usuario.'], function () {
        Route::get('cadastro', function () {
            return view('usuario.cadastro');
        })->name('cadastro');

        Route::get('alterar_imagem/{id}', 'UsuarioController@alterarImagem')->name('alterar_imagem');
        Route::post('alterar_imagem/{id}', 'UsuarioController@salvarImagem')->name('imagem_post');
        Route::get('alterar_senha/{id}', 'UsuarioController@alterarSenha')->name('alterar_senha');
        Route::delete('delete_img/{id}', 'UsuarioController@deleteImg')->name('delete_img');
        Route::post('alterar_senha/{id}', 'UsuarioController@salvarSenha')->name('salvar_senha');
        Route::post('alterar_cadastro/{id}', 'UsuarioController@alterarCadastro')->name('alterar_cadastro');

    });

    // Tipo de usuário
    Route::group(['prefix' => 'tipo_usuario', 'as' => 'tipo_usuario.'], function () {
        Route::post('carregar-permissoes', 'TipoUsuarioController@carregarPermissoes')->name('carregar_permissoes');
        Route::get('gerenciar-permissoes', 'TipoUsuarioController@gerenciarPermissoes')->name('gerenciar_permissoes');
        Route::post('gerenciar-permissoes', 'TipoUsuarioController@salvarPermissoes')->name('gerenciar_permissoes.post');
    });

    Route::resource('sis_usuario', 'SisUsuarioController');
    Route::group(['prefix' => 'sis_usuario', 'as' => 'sis_usuario.'], function () {
        Route::get('getedit/{id}', 'SisUsuarioController@getedit')->name('getedit');
        Route::post('fill', 'SisUsuarioController@fill')->name('fill');
    });

    Route::resource('aux_tipo_usuario', 'AuxTipoUsuarioController');
    Route::group(['prefix' => 'aux_tipo_usuario', 'as' => 'aux_tipo_usuario.'], function () {
        Route::get('getedit/{id}', 'AuxTipoUsuarioController@getedit')->name('getedit');
        Route::post('fill', 'AuxTipoUsuarioController@fill')->name('fill');
    });
    Route::resource('rota', 'RotaController');
    Route::group(['prefix' => 'rota', 'as' => 'rota.'], function () {
        Route::get('getedit/{id}', 'RotaController@getedit')->name('getedit');
        Route::post('fill', 'RotaController@fill')->name('fill');
    });

    Route::resource('tipo_rota', 'TipoRotaController');
    Route::group(['prefix' => 'tipo_rota', 'as' => 'tipo_rota.'], function () {
        Route::get('getedit/{id}', 'TipoRotaController@getedit')->name('getedit');
        Route::post('fill', 'TipoRotaController@fill')->name('fill');
    });
    //[rota]
});


