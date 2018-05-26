<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CMSConfiguracion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cms_configuration', function (Blueprint $table) {
            $table->increments('id');
            $table->string('template_skin'); // blue, black, purple, yellow, red, green
            $table->string('template_layout_options'); // fixed, layout-boxed, layout-top-nav, sidebar-collapse, sidebar-mini
            $table->string('login_background_url'); // Login CMS Background
            $table->string('correo_contacto'); // Correo Destinatario de Contacto
            $table->string('front_site_up'); // Sitio Front Up? [1 = Modo Desactivado <-> 0 = Modo Activado]
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cms_configuration');
    }
}
