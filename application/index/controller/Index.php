<?php
namespace app\index\controller;

use think\Controller;
use think\Log;

class Index extends Controller
{
    public function index()
    {
        Log::write('o2o_JJJJJ','log');
        trace('o2o-trace','log');
        return $this->fetch();
    }
}
