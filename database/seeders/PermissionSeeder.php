<?php


namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{

    public function run()
    {

        $userAdmin = User::create(['name' => 'elyes', 'email' => 'elyes@gmail.com', 'password' => '123']);

        $roleAdmin = Role::create(['name' => 'administateur']);
        $roleReader = Role::create(['name' => 'reader']);




        $permissionReadAuthors = Permission::create(['name' => 'read authors']);
        $permissionManageAuthors = Permission::create(['name' => 'manage authors']);

        $roleAdmin->givePermissionTo($permissionReadAuthors);
        $roleAdmin->givePermissionTo($permissionManageAuthors);

        $roleReader->givePermissionTo($permissionReadAuthors);

        $userAdmin->assignRole($roleAdmin);



    }


}