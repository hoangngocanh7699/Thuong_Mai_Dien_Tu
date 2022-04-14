<?php

namespace App\Compoments;

use App\Menu;

class MenuRecusive
{
    private $html;

    public function __construct()
    {
        $this->html = '';
    }


    public function menuRecusiveAdd($parent_id = 0, $submark = '')
    {
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $value) {
            $this->html .= "<option value='$value->id'>" . $submark . "$value->name</option>";

            $this->menuRecusiveAdd($value->id, $submark . '&nbsp&nbsp&nbsp&nbsp&nbsp');
        }
        return $this->html;
    }

    public function menuRecusiveEdit($parent_idmenuEdit, $parent_id = 0, $submark = '')
    {
        $data = Menu::where('parent_id', $parent_id)->get();
        foreach ($data as $value) {
            if ($parent_idmenuEdit == $value->id) {
                $this->html .= "<option selected value='$value->id'>" . $submark . "$value->name</option>";
            } else {
                $this->html .= "<option value='$value->id'>" . $submark . "$value->name</option>";
            }


            $this->menuRecusiveEdit($parent_idmenuEdit,$value->id, $submark . '&nbsp&nbsp&nbsp&nbsp&nbsp');
        }
        return $this->html;
    }
}
