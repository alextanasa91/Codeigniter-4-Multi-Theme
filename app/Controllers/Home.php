<?php

namespace App\Controllers;


class Home extends BaseController
{

    public function index()
    {
  
     return $this->render(template_view().'/welcome_bts');
    }
}
