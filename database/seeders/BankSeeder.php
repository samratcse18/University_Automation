<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;
use Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin=new Bank();
        $admin->fname='bank';
        $admin->lname='bank2';
        $admin->employeeId='606060';
        $admin->phone='01916813369';
        $admin->email='bank@gmail.com';
        $admin->title='cash-officer';
        $admin->street='gobra';
        $admin->city='gopalgonj';
        $admin->district='gopalgonj';
        $admin->password=Hash::make('12345678');
        $data=$admin->save();
        $admin->assignRole('bank_manager');
    }
}
