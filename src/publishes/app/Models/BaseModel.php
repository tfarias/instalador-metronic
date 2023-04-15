<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseModel
 * @package App
 *
 * Aqui vai todos os métodos que todos os nossos models tem em comum.
 */
class BaseModel extends Model
{

    protected $guarded = ['id'];

    protected $primaryKey = 'id';
}
