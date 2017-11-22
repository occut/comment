<?php

/**
 * Functions: .
 * Author: Zhu Jinhao
 * Link: http://www.hfyefan.com
 * Copyright: HfYefan NetWork Co.,Ltd.
 */

namespace Admin \ Model;

use Think \ Model;

class WebConfigModel extends Model {

    /**
     * 根据WebConfig的id修改对象
     */
    public function saveWebConfig($configId, $webConfig) {
        $result = M('web_config')->where('config_id =' . $configId)->save($webConfig);
        return $result;
    }

    /**
     * 查找WebConfig
     */
    public function selectWebConfig() {
        $result = M('web_config')->find();
        return $result;
    }

}
