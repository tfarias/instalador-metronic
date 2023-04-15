<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SisUsuario extends Authenticatable implements TableInterface
{
    use SoftDeletes;
    use Notifiable;

    protected $fillable = ['nome', 'password', 'email', 'telefone', 'id_tipo_usuario'];

    protected $table = 'sis_usuario';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $dates = ['deleted_at'];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getTableHeaders()
    {
        return ['Nome', 'Email', 'Telefone', 'Tipo de usuário'];
    }


    /**
     * Get the value for a given header. Note that this will be the value
     * passed to any callback functions that are being used.
     *
     * @param string $header
     * @return mixed
     */
    public function getValueForHeader($header)
    {
        switch ($header) {
            case "Nome":
                return $this->nome;

            case "Email":
                return $this->email;

            case "Telefone":
                return $this->telefone;

            case "Tipo de usuário":
                return $this->tipoUsuario->descricao;
        }
    }


    /**
     * Verifica se o usuário tem permissão para acessar a determinada rota.
     *
     * @param Rota $rota
     *
     * @return bool
     */
    public function temPermissao($rota)
    {
        // Grupos que podem acessar essa rota
        $grupos = $rota->grupos->pluck('id')->toArray();

        return in_array($this->attributes['id_tipo_usuario'], $grupos);
    }

    /**
     * Retorna se algum dos grupos de acesso do usuário está marcado como super admin.
     *
     * @return bool
     */
    public function getSuperAdminAttribute()
    {
        return $this->tipoUsuario->super_admin == 'S';
    }

    /**
     * Obtém o primeiro nome do usuário
     *
     * @return string
     */
    public function getPrimeiroNomeAttribute()
    {
        return head(explode(' ', $this->attributes['nome']));
    }


    /**
     * Sis_usuario pertence a Aux_tipo_usuario
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoUsuario()
    {
        return $this->belongsTo(\App\Models\AuxTipoUsuario::class, 'id_tipo_usuario', 'id');
    }

    public function getEmailForPasswordReset()
    {
        return $this->attributes['email'];
    }

    /**
     * Encripta a senha antes de salvar.
     *
     * @param string $password
     */
    protected function setPasswordAttribute($password)
    {
        if (!is_null($password) && !empty($password)) {
            $this->attributes['password'] = bcrypt($password);
        }
    }
}
