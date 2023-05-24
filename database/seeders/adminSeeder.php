<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=new Admin();
        $admin->fname='Super';
        $admin->lname='Admin';
        $admin->email='superadmin@gmail.com';
        $admin->dept='cse';
        $admin->phone='01916813369';
        $admin->password=Hash::make('12345678');
        $data=$admin->save();
        $admin->assignRole('superAdmin');
    }
}
