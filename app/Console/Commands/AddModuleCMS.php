<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use Artisan;
use File;

class AddModuleCMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:createmodule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a Module for CMS.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->info('*********************************');
        $this->info('Add new module to CMS');
        $this->info('*********************************');

        $templates = ['Clean Template', 'Categories Template', 'Articles Template', 'Blog Template', 'Calendar Template', 'I want more stuff!'];
        $data['template'] = $this->choice('Choose one template module form the list:', $templates, 0);

        $option = array_search($data['template'], $templates);

        switch($option) {
            case 0: $this->cleanTemplate(); break;
            case 1: $this->info('Soon...'); break;
            case 2: $this->info('Soon...'); break;
            case 3: $this->info('Soon...'); break;
            case 4: $this->info('Soon...'); break;
            case 5: $this->info('Help Me! If you want more stuff! Kisses Bye!'); break;
        }
    }

    protected function cleanTemplate()
    {
        $valid_name = false;
        while (!$valid_name) {
            $module_names = $this->nameQuestions();
            $valid_name = $this->confirm('Singluar Name = "'.$module_names['singular'].'" and Plural Name = "'.$module_names['plural'].'". Is this correct? [y|N]');
        }

        //Vendor Directory
        $vendor_directory = base_path()."/vendor/cuacha07/komvac_template_modules/clean_module";
/*
        //Controller
        $controller_name = 'CMS/'.$module_names['plural'].'Controller';
        Artisan::call('make:controller', ['name' => $controller_name]);
        $this->info('Controller created at: App/Http/Controllers/CMS/'.$controller_name.'.php');

        //Model
        $model_name = 'CMS/'.$module_names['singular'];
        Artisan::call('make:model', ['name' => $model_name]);
        $this->info('Model created at: App/CMS'.$model_name.'.php');

        //Request
        $request_name = 'CMS/'.$module_names['singular'].'Request';
        Artisan::call('make:request', ['name' => $request_name]);
        $this->info('Request created at: App/Http/Requests/CMS/'.$request_name.'.php');

        //Migration
        $migration_name = 'cms_'.strtolower($module_names['plural']);
        Artisan::call('make:migration', ['name' => $migration_name]);
        $this->info('Migration created at: database/migrations/'.$migration_name.'.php');
*/
        //Views
        //index.blade.php
        $file_name = "index.blade.php"; $final_name = "index.blade.php";
        $sourceDir = $vendor_directory."/views";
        $destinationDir = base_path()."/resources/views/cms/".strtolower($module_names['plural']);
        $this->copyFiles($module_names, $file_name, $final_name, $sourceDir, $destinationDir);

        //inputs.blade.php
        $file_name = "inputs.blade.php"; $final_name = "inputs.blade.php";
        $sourceDir = $vendor_directory."/views/partials";
        $destinationDir = base_path()."/resources/views/cms/".strtolower($module_names['plural'])."/partials";
        $this->copyFiles($module_names, $file_name, $final_name, $sourceDir, $destinationDir);

        //script.blade.php
        $file_name = "scripts.blade.php"; $final_name = "scripts.blade.php";
        $sourceDir = $vendor_directory."/views/partials";
        $destinationDir = base_path()."/resources/views/cms/".strtolower($module_names['plural'])."/partials";
        $this->copyFiles($module_names, $file_name, $final_name, $sourceDir, $destinationDir);

        //controller.php
        $file_name = "controller.php"; $final_name = ucfirst($module_names['plural'])."Controller.php";
        $sourceDir = $vendor_directory."/controller";
        $destinationDir = base_path()."/App/Http/Controllers/CMS";
        $this->copyFiles($module_names, $file_name, $final_name, $sourceDir, $destinationDir);

        //migration.php
        $file_name = "migration.php";
        $final_name = Carbon::now()->format('Y_m_d')."_create_cms_".lcfirst($module_names['plural'])."_table.php";
        $sourceDir = $vendor_directory."/migration";
        $destinationDir = base_path()."/database/migrations";
        $this->copyFiles($module_names, $file_name, $final_name, $sourceDir, $destinationDir);

        //model.php
        $file_name = "model.php"; $final_name = "CMS".ucfirst($module_names['singular']).".php";
        $sourceDir = $vendor_directory."/model";
        $destinationDir = base_path()."/App/Models/CMS";
        $this->copyFiles($module_names, $file_name, $final_name, $sourceDir, $destinationDir);

        //request.php
        $file_name = "request.php"; $final_name = "CMS".ucfirst($module_names['plural'])."Request.php";
        $sourceDir = $vendor_directory."/request";
        $destinationDir = base_path()."/App/Http/Requests/CMS";
        $this->copyFiles($module_names, $file_name, $final_name, $sourceDir, $destinationDir);

        $this->info('Finished!');

    }

    protected function nameQuestions()
    {
        $singular = $this->ask('What is the module name in singular? (Example: Article)');
        $plural = $this->ask('What is the module name in plural? (Example: Articles)');
        $singular = ucfirst(strtolower(trim($singular)));
        $plural = ucfirst(strtolower(trim($plural)));
        return ['singular' => $singular, 'plural' => $plural];
    }

    /**
     * File copy Function.
     * ucfirst($plural)      -> 1XlcpX (First Capital Plural Name)
     * strtolower($plural)   -> 2XpX   (All Lowercase Plural Name)
     * ucfirst($singular)    -> 3XlcsX (First Capital Singular Name)
     * strtolower($singular) -> 4XsX   (All Lowercase Singular Name)
     *
     * @var array
     * @var string
     * @var string
     * @var string
     * @var string
     */
    protected function copyFiles($module_names, $file_name, $final_name, $sourceDir, $destinationDir)
    {
        $singular = $module_names['singular'];
        $plural   = $module_names['plural'];

        if(!File::isDirectory($destinationDir)) {
            $result = File::makeDirectory($destinationDir, 0775, true);
        }

        $original_file = $sourceDir."/".$file_name;

        $contents = File::get($original_file);
        $contents = str_replace("1XlcpX", ucfirst($plural), $contents);
        $contents = str_replace("2XpX", strtolower($plural), $contents);
        $contents = str_replace("3XlcsX", ucfirst($singular), $contents);
        $contents = str_replace("4XsX", strtolower($plural), $contents);

        $copied_file = $destinationDir."/".$final_name;
        
        File::put($copied_file, $contents);

        $this->comment('File '.$final_name.' created at: ');
        $this->info($copied_file);
    }
}
