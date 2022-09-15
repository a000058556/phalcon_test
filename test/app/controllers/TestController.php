<?php
declare(strict_types=1);

class TestController extends \Phalcon\Mvc\Controller
{

    public function indexAction()
    {
        $this->view->Users = Users::find();
        $this->view->title = "Users";
    }

    public function newAction() // 新增資料頁
    {
    }

    public function editAction($id) // 修改資料頁
    {
        // 因為在更新資料時就有傳輸狀態驗證，所以這裡不用重複做
        // if(!$this->request->isPost()){ // 確認傳輸狀態
        
        $user = Users::findFirst($id); // 從資料庫取得id的資料
        if(!$user){ // 若沒有資料時
            $this->flash->error("無效的編輯項目");
            $this->dispatcher->forward(['action' => 'index']);
        }
        else{ // 若有資料構建 HTML input[type=”datetime-local”] 標籤
            $this->tag->displayTo("id", $user->id);
            $this->tag->displayTo("name", $user->name);
            $this->tag->displayTo("email", $user->email);
        }

        // }
        // else{
        //     $this->flash->error("無效的資料請求");
        // }
    }

    public function createAction() // 新增資料動作
    {
        $user = new Users();
        $user->id = $this->request->getPost('id');
        $user->name = $this->request->getPost('name');
        $user->email = $this->request->getPost('email');
        $success = $user->save();
        // 簡寫為下
        // $success = $user->save($this->request->getPost(), array('name', 'email'));

        if ($success){
            $this->flash->success("新增成功!");
            $this->dispatcher->forward(['action' => 'index']); // 回首頁
        }else{

            foreach($user->getMessages() as $message) { // 取得失敗訊息
                $this->flash->outputMessage("error", ("新增失敗: ".$message));
            }

            $this->dispatcher->forward(['action' => 'new']); // 回到原編輯頁面
        }

    }

    public function updateAction() // 修改資料動作
    {
        if(!$this->request->isPost()){ // 確認傳輸狀態

            $this->flash->error("無效的資料請求");
            // $this->dispatcher->forward(['action' => 'index']);
        }
        else{

            $id = $this->request->getPost("id"); // 取修改的id
            $user = Users::findFirst($id); // 從資料庫取得id的資料

            if(!$user){ // 若沒有資料時
                $this->flash->error("沒有該筆資料");
                // $this->dispatcher->forward(['action' => 'index']);
            }
            else{ // 若有資料 修改資料
                
                $user->id = $this->request->getPost('id');
                $user->name = $this->request->getPost('name');
                $user->email = $this->request->getPost('email');
                $success = $user->save();

                // if ($success){
                //     $this->flash->success("更新成功!");
                //     // $this->dispatcher->forward(['action' => 'index']); // 回首頁
                // }else{

                //     foreach($user->getMessages() as $message) { // 取得失敗訊息
                //         $this->flash->outputMessage("error", ("更新失敗: ".$message));
                //     }

                //     return $this->dispatcher->forward(array(
                //         "action" => "edit", // 回編輯頁面
                //         "params" => array($user->id) // 並用id帶出資料
                //     )); 
                // }

                if (!$success){

                    foreach($user->getMessages() as $message) { // 取得失敗訊息
                        $this->flash->outputMessage("error", ("更新失敗: ".$message));
                    }

                    return $this->dispatcher->forward(array(
                        "action" => "edit", // 回編輯頁面
                        "params" => array($user->id) // 並用id帶出資料
                    )); 
                }
                $this->flash->success("更新成功!");
            }
            
        }
        $this->dispatcher->forward(['action' => 'index']); // 回首頁
    }

    public function deleteAction($id)
    {
        $user = Users::findFirst($id);

        if(!$user){
            $this->flash->error("找不到刪除項目");
        }else{
            if(!$user->delete()){ // 刪除失敗回傳訊息

            foreach($user->getMessages() as $message) {
                $this->flash->outputMessage("error", $message);
            }

            }else{
                $this->flash->success("刪除成功");
            }
        }

        $this->dispatcher->forward(['action' => 'index']);
    }


}

