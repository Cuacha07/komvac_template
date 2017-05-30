<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;
use Hash;
use App\CMSUser;

class AddUserCMS extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cms:adduser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add new user to CMS.';

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
        $this->info('Add new user to CMS');
        $this->info('*********************************');

        if ($this->confirm('Continue creating a new user? [y|N]')) {
            while (!$this->createUser()){}
            $this->info('User Added!');
            $this->info('May the Force be with you!');
        } else {
            $this->info('Adding user cancelled!');
            $this->info('Its a trap!');
        }
    }

    protected function createUser()
    {
        $data = [];
        $data['name'] = $this->ask('Choose a name?');
        $data['email'] = $this->ask('Choose an e-mail?');
        $data['password'] = $this->secret('Set password:');
        $data['password_confirmation'] = $this->secret('Set password again:');

        $validator = Validator::make($data, [
            'name'     => 'required',
            'email'    => 'required|email|unique:cms_users',
            'password' => 'required|confirmed',
        ]);

        if ($validator->fails()) {
            foreach($validator->errors()->all() as $error) {
                $this->error('Error: ' . $error);
            }
            $this->info('--------------------------------------');
            return false;
        }

        $data['type'] = $this->choice('Choose an user type(role):', config('cms.user_types'), 0);
        $data['password'] = Hash::make($data['password']);
        $data['avatar'] = "img/cms/pug.png";

        CMSUser::create($data);

        return true;
    }
}
