<?php
declare(strict_types=1);

class IndexController extends ControllerBase
{

    public function indexAction()
    {
        // 顯示所有用戶的搜索結果，這只需調用find()模型（Users::find()）上的靜態方法
        $this->view->users = Users::find();
    }

}

