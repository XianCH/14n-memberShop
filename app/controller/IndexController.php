<?php
namespace app\controller;

use app\BaseController;

class IndexController extends BaseController
{
    public function index(){
        $action = $this->request->action();

    }

    public function hello()
    {
        $data = ['name' => 'thinkphp', 'status' => '1'];
        return json($data);
    }

}
