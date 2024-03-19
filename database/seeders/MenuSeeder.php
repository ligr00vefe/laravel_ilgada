<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menus = [];

        //TODO : 1. 배열을 좀더 쉽게 정의하는 방법이 있다면 그것 사용하면 좋겠음!
        //       2. MenuSeeder가 DatabaseSeeder가 실행될때 같이 연동되도록 하였으면 졸겠음! (migrate:refresh 한이후 db:seed하기가 매우 불편

        /*1차 메뉴 */
        array_push($menus, [
            'depth' => 1,
            'title' => '대시보드',
            'type' => 'dashboard',
            'icon' => 'fa-th-list',
            'order' => 1
        ]);

        array_push($menus, [
            'depth' => 1,
            'title' => '사용자관리',
            'type' => 'user',
            'icon' => 'fa-user-alt',
            'order' => 2
        ]);

        array_push($menus, [
            'depth' => 1,
            'title' => '설문',
            'type' => 'survey',
            'icon' => 'fa-poll',
            'order' => 3
        ]);

        array_push($menus, [
            'depth' => 1,
            'title' => '환경설정',
            'type' => 'setting',
            'icon' => 'fa-cog',
            'order' => 4
        ]);


        /*2차 메뉴*/
        array_push($menus, [
            'depth' => 2,
            'parent' => 1,
            'title' => '대시보드',
            'type' => 'dashboard',
            'route' => 'dashboard',
            'order' => 1
        ]);

        array_push($menus, [
            'depth' => 2,
            'parent' => 2,
            'title' => '사용자 정보',
            'type' => 'userList',
            'route' => 'user/list',
            'order' => 1
        ]);

        array_push($menus, [
            'depth' => 2,
            'parent' => 4,
            'title' => '메뉴 정보',
            'type' => 'menuList',
            'route' => 'setting/menu',
            'order' => 1
        ]);

        foreach ($menus as $key => $value) {
            \App\Models\Menu::create($menus[$key]);
        }

        // php artisan db:seed --class=MenuSeeder

    }
}
