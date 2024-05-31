<?php

namespace App\Helpers;

use App\Models\Menu;
use Illuminate\Support\Str;

class Helper
{
    public static function menu($menus, $parent_id = 0, $char = '')
    {
        $html  = '';

        foreach ($menus as $key => $menu) {
            if ($menu->parent_id == $parent_id) {
                $html .= '
                <tr>
                    <td>' . $menu->id. '</td>
                    <td>' . $char .  $menu->name. '</td>
                    <td>' . self::active($menu->active). '</td>
                    <td>' . $menu->updated_at. '</td>
                    <td>
                        <a class="btn btn-primary btn-sm" href="/admin/menus/edit/' . $menu->id . '" >
                            <i class="fas fa-edit"></i>
                        </a>
                        <a class="btn btn-danger btn-sm" href="#"
                        onclick="removeRow(' . $menu->id . ', \'/admin/menus/destroy\' )">
                            <i class="fas fa-trash"></i>
                        </a>
                    </td>
                </tr>
                ';

                unset($menus[$key]);

                $html .= self::menu($menus, $menu->id, $char . '-');
            }
        }
        return $html;
    }

    public static function active($active = 0) : string
    {
        return $active == 0 ? '<span class="btn btn-danger btn-xs">Inactive</span>' :
            '<span class="btn btn-success btn-xs">Active</span>';
    }


//    public static function menus($menus, $parent_id = 0)
//    {
//        $html='';
//        foreach ($menus as $key => $menu) {
//            if ($menu->parent_id == $parent_id) {
//                $html .= '
//                    <li>
//                        <a href="/danh-muc/' . $menu->id . '-' . Str::slug($menu->name, '-') .'.html">
//                            ' .$menu->name. '
//                        </a>';
//                if (self::isChild($menus, $menu->id)){
//                    $html .= '<ul class="department-megamenu">';
//                    $html .= self::menus($menus, $menu->id);
//                    $html .= '</ul>';
//                }
//                    $html .= '</li>
//                ';
//            }
//        }
//
//        return $html;
//    }
//    public static function isChild($menus, $id)
//    {
//        foreach ($menus as $menu){
//            if($menu->parent_id == $id){
//                return true;
//            }
//        }
//        return false;
//    }
    public static function price($price = 0, $priceSale = 0)
    {
        if($priceSale != 0) return number_format($priceSale);
        if ($price != 0 ) return number_format($price);
        return '<a href="tel:0396586672">Liên Hệ</a>';
    }
}