<?php


namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userAdmin = User::create([
            'name' => 'admin',
            'email' => 'admin@qwiktest.com',
            'password' => Hash::make('password'),
            'email_verified_at' => Carbon::now()->toDateTimeString()
        ]);

        $roleAdmin = Role::create(['name' => 'administrator']);
        $roleReader = Role::create(['name' => 'reader']);

        $permissionReadAuthors = Permission::create(['name' => 'read authors']);
        $permissionManageAuthors = Permission::create(['name' => 'manage authors']);

        $roleAdmin->givePermissionTo($permissionReadAuthors);
        $roleAdmin->givePermissionTo($permissionManageAuthors);

        $roleReader->givePermissionTo($permissionReadAuthors);

        $userAdmin->assignRole($roleAdmin);

    }
}
