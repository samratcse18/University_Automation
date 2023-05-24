<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin_role = Role::create(['guard_name' => 'admin', 'name' => 'provost']);
        // $teacher_role = Role::create(['guard_name' => 'admin', 'name' => 'teacher']);
        // $office_role = Role::create(['guard_name' => 'admin', 'name' => 'office']);
        // $student_role = Role::create(['guard_name' => 'student', 'name' => 'student']);
        // $permission=[
        //     'student.dashboard',
        //     'admin.dashboard',
        //     'teacher.dashboard',
        //     'office_staff.dashboard',
        //     'Faculty.dashboard',
        // ];
        // $permission = Permission::create(['guard_name' => 'admin', 'name' =>'admin.dashboard']);
        // $permission = Permission::create(['guard_name' => 'admin', 'name' =>'teacher.dashboard']);
        $permission = Permission::create(['guard_name' => 'admin', 'name' =>'provost.dashboard']);
        // $permission = Permission::create(['guard_name' => 'student', 'name' =>'student.dashboard']);
        
        $admin_role->givePermissionTo('provost.dashboard');
        // $teacher_role->givePermissionTo('teacher.dashboard');
        // $office_role->givePermissionTo('office.dashboard');
        // $student_role->givePermissionTo('student.dashboard');
        // $permission->assignRole($admin_role);
        // for ($i=0; $i < count($permission); $i++) { 
        //         $permission = Permission::create(['guard_name' => 'student', 'name' =>$permission[i]]);
        // }


    }
}
