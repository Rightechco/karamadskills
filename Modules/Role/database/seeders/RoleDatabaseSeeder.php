<?php

namespace Modules\Role\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Hash;
use Modules\Role\Http\Services\RoleService;
use Modules\Role\Models\Permission;
use Modules\Role\Models\Role;
use Modules\User\Models\User;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::query()->firstOrCreate(['slug' => 'UserPermission'], ['name' => 'دسترسی کاربران', 'slug' => 'UserPermission']);
        Permission::query()->firstOrCreate(['slug' => 'AddUserPermission'], ['name' => 'دسترسی ایجاد کاربران', 'slug' => 'AddUserPermission']);
        Permission::query()->firstOrCreate(['slug' => 'RolePermission'], ['name' => 'دسترسی نقش ها', 'slug' => 'RolePermission']);
        Permission::query()->firstOrCreate(['slug' => 'NotifPermission'], ['name' => 'دسترسی اعلانات', 'slug' => 'NotifPermission']);
        Permission::query()->firstOrCreate(['slug' => 'CategoryPermission'], ['name' => 'دسترسی دسته بندی ها', 'slug' => 'CategoryPermission']);
        Permission::query()->firstOrCreate(['slug' => 'CompanyPermission'], ['name' => 'دسترسی شرکت ها', 'slug' => 'CompanyPermission']);
        Permission::query()->firstOrCreate(['slug' => 'AnnouncementPermission'], ['name' => 'دسترسی آگهی ها', 'slug' => 'AnnouncementPermission']);
        Permission::query()->firstOrCreate(['slug' => 'RequestPermission'], ['name' => 'دسترسی درخواست های شغلی', 'slug' => 'RequestPermission']);
        Permission::query()->firstOrCreate(['slug' => 'CardPermission'], ['name' => 'دسترسی کارت ها', 'slug' => 'CardPermission']);
        Permission::query()->firstOrCreate(['slug' => 'WithdrawPermission'], ['name' => 'دسترسی برداشت ها', 'slug' => 'WithdrawPermission']);
        Permission::query()->firstOrCreate(['slug' => 'TicketPermission'], ['name' => 'دسترسی تیکت ها', 'slug' => 'TicketPermission']);
        Permission::query()->firstOrCreate(['slug' => 'UniversityPermission'], ['name' => 'دسترسی دانشگاه ها', 'slug' => 'UniversityPermission']);
        Permission::query()->firstOrCreate(['slug' => 'Counselor'], ['name' => 'مشاور', 'slug' => 'Counselor']);
        Permission::query()->firstOrCreate(['slug' => 'CounselorPermission'], ['name' => 'دسترسی مشاور', 'slug' => 'CounselorPermission']);
        Permission::query()->firstOrCreate(['slug' => 'CoursePermission'], ['name' => 'دسترسی دوره ها', 'slug' => 'CoursePermission']);
        Permission::query()->firstOrCreate(['slug' => 'CommentPermission'], ['name' => 'دسترسی نظرات', 'slug' => 'CommentPermission']);
        Permission::query()->firstOrCreate(['slug' => 'IncentivePermission'], ['name' => 'دسترسی مشوق ها', 'slug' => 'IncentivePermission']);
        Permission::query()->firstOrCreate(['slug' => 'VisitPermission'], ['name' => 'دسترسی بازدید ها', 'slug' => 'VisitPermission']);
        Permission::query()->firstOrCreate(['slug' => 'PostPermission'], ['name' => 'دسترسی مطالب', 'slug' => 'PostPermission']);
        Permission::query()->firstOrCreate(['slug' => 'ّIntershipPermission'], ['name' => 'دسترسی کارآموزی', 'slug' => 'ّIntershipPermission']);

        $user = User::query()->firstOrCreate([
            'mobile' => Config::get('user.adminMobile')
        ], [
            'name' => 'مدیریت',
            'slug' => 'admin',
            'mobile' => Config::get('user.adminMobile'),
            'nationalCode' => '12345678',
            'status' => User::STATUS_VERIFIED,
            'password' => Hash::make(Config::get('user.adminPass'))
        ]);

        $role = Role::query()->firstOrCreate(['slug' => 'admin'], ['name' => 'مدیر', 'slug' => 'admin']);
        Role::query()->firstOrCreate(['slug' => 'teacher'], ['name' => 'مدرس', 'slug' => 'teacher']);
        Role::query()->firstOrCreate(['slug' => 'counselor'], ['name' => 'مشاور', 'slug' => 'counselor']);
        $permissions = Permission::query()->where('slug','!=','Counselor')->get();
        RoleService::syncPermission($permissions, $role);
        RoleService::syncRoles($role, $user);
    }
}
