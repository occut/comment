<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin\Controller;

use Think\Controller;

class IndexController extends SuperController {

    /**
     * 展示后台首页
     */
    public function index() {
        $this->display('Index/index');
    }

}
