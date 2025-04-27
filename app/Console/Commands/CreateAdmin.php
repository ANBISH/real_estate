<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create user and role admin';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $data = [];

        $data['name'] = $this->ask('What this is name?');
        $data['email'] = $this->ask('What this is email?');
        $data['phone'] = $this->ask('What this is phone?');
        $data['password'] = $this->ask('What this is password?');
        $data['password_confirmation'] = $this->ask('What this is password_confirmation?');

        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {

            $this->error('Error validations:');

            foreach ($validator->errors()->all() as $error) {
                $this->line("- $error");
            }
            return 1;
        }

        $user = User::create([
            'name' =>  $data['name'],
            'email' =>  $data['email'],
            'phone' => $data['phone'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole('admin');

        $this->info("User {$user->email} is role 'admin' succesful!");

        return 0;

    }
}
