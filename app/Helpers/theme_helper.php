<?php
use CodeIgniter\CodeIgniter;
use App\Models\Themes as ThemeManager;
use App\Libraries\Theme;
if (! function_exists('active_theme')) {
    function active_theme(){
        $Theme = new ThemeManager();
        $active = $Theme->where("active",1)->first();
        if ($active) {
            return $active["name"];
        }else{
            $active = $Theme->where("def",1)->first();
            return $active["name"];
        }
    }
   
}
if (! function_exists('template_view')) {
    function template_view(){
        return '../'.Theme::current();
    }

}