<?php
declare(strict_types=1);

class StorkController extends \Phalcon\Mvc\Controller
{

    public function testAction()
    {
        /**
         * 建立api(透過外部資源)
         */
            
        $q = $this->request->getPost('id');

        if(isset($q)){
            $id = $q;
        }else{
            return "無效的股票代號。";
        }

        
        // 建立連線
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ez-gu.info/EPS',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => 'name='.$id,
            CURLOPT_HTTPHEADER => array(
                'name: '.$id,
                'Content-Type: application/x-www-form-urlencoded'
        ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);

        // 回傳資料為json格式
        return $response;
    }

}

