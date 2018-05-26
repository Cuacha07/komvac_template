<?php

namespace App\Models\CMS;

use Illuminate\Database\Eloquent\Model;

class CMSConfiguration extends Model
{
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cms_configuration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['template_skin', 'template_layout_options', 'login_background_url', 'correo_contacto', 'front_site_up'];
}
