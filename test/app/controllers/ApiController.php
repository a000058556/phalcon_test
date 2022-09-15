<?php
declare(strict_types=1);
use Phalcon\Di;
use Phalcon\Mvc\Model\Query;
// use Phalcon\Mvc\View;

class ApiController extends \Phalcon\Mvc\Controller
{

    public function carsAction()
    {
    /**
     * 建立api
     */
        
    $q = $this->request->getPost('id');

    if(isset($q)){
        $id = $q;
    }else{
        $id = 1;
    }

    // 建立連線帶入sql語句
    $container = Di::getDefault();
    $query     = new Query(
        ('SELECT * FROM Cars WHERE id ='.$id),
        $container
    );

    $cars = $query->execute();
    // $this->view->setVar("cars", $cars);

    // $cars = new Cars();

    // $phql = "SELECT * FROM cars ORDER BY id DESC";
    // $cars->connection->executeQuery($phql);

    // 取得資料並轉換格式
    $data = array();
    foreach ($cars as $car){
        $data[] = array(
            'id'				=>	$car->id,
            'owner_name'		=>	$car->owner_name,			
            'reg_date'			=>	$car->reg_date,	
            'license_plate_no'	=>	$car->license_plate_no,		
            'engine_no'			=>	$car->engine_no,
            'tax_payment'		=>	$car->tax_payment,	
            'car_model'			=>	$car->car_model,
            'car_model_year'	=>	$car->car_model_year,		
            'seating_capacity'	=>	$car->seating_capacity,		
            'horse_power'		=>	$car->horse_power
        );
    }

    // 回傳資料為json格式
    return json_encode($data);

    }

}

