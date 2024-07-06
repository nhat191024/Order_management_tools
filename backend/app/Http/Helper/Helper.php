<?php
namespace App\Http\Helper;

class Helper {
    const ROLE_ADMIN = 1;
    const ROLE_STAFF = 2;
    const ROLE_CHEF = 3;
    public static function getAllRole() {
        return [
            [
                'id' => Helper::ROLE_ADMIN,
                'name' => 'Admin'
            ],    
            [
                'id' => Helper::ROLE_STAFF,
                'name' => 'Nhân viên'
            ],    
            [
                'id' => Helper::ROLE_CHEF,
                'name' => 'Bếp'
            ],    
        ];
    }
}