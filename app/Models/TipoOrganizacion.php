<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoOrganizacion extends Model
{
    use HasFactory;
    protected $table = 'tipo_organizacion';
    protected $guarded = ['id','created_at','updated_at'];
}
