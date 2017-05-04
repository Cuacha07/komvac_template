<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
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


        $module_names = ['singular' => 'article', 'plural' => 'articles'];

        //index.blade.php
        $view_name = 'index.blade.php';
        $sourceDir = base_path()."/App/Helpers/CMSMolds/views/clean";
        $destinationDir = base_path().'/resources/views/cms/'.strtolower($module_names['plural']);


        $this->copyViews($module_names['singular'], $module_names['plural'], $view_name, $sourceDir, $destinationDir);

        dd("Stop");



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

    protected function copyFiles($singular, $plural, $file_name, $sourceDir, $destinationDir)
    {
        //lcfirst($plural)    -> 1XlcpX (First Capital Plural Name)
        //$plural             -> 2XpX   (All Lowercase Plural Name)
        //lcfirst($singular)  -> 3XlcsX (First Capital Singular Name)
        //$singular           -> 4XsX   (All Lowercase Singular Name)

        if(!File::isDirectory($destinationDir)) {
            $result = File::makeDirectory($destinationDir, 0775, true);
        }

        $original_file = $sourceDir."/".$file_name;

        $contents = File::get($original_file);
        $contents = str_replace("1XlcpX", lcfirst($plural), $contents);
        $contents = str_replace("2XpX", $plural, $contents);
        $contents = str_replace("3XlcsX", lcfirst($singular), $contents);
        $contents = str_replace("4XsX", $plural, $contents);

        $copied_file = $destinationDir."/".$file_name;
        
        File::put($copied_file, $contents);

        $this->info('File '.$file_name.' created at: '.$copied_file);
    }
}
