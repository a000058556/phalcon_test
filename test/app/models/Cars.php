<?php
use Phalcon\Mvc\Model\Validator\PresenceOf;
use Phalcon\Mvc\Model\Validator\Uniqueness;
use Phalcon\Mvc\Model\Validator\Regex;

class Cars extends \Phalcon\Mvc\Model

{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $owner_name;

    /**
     *
     * @var string
     */
    public $reg_date;

    /**
     *
     * @var string
     */
    public $license_plate_no;

    /**
     *
     * @var integer
     */
    public $engine_no;

    /**
     *
     * @var string
     */
    public $tax_payment;

    /**
     *
     * @var string
     */
    public $car_model;

    /**
     *
     * @var string
     */
    public $car_model_year;

    /**
     *
     * @var integer
     */
    public $seating_capacity;

    /**
     *
     * @var integer
     */
    public $horse_power;

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("test");
        $this->setSource("cars");
    }

    public function validation()
    {
        // licence_plate_number is required
        $this->validate(
            new PresenceOf(
                array(
                    "field"		=>	"license_plate_no",
    				"message"	=>	"The licence plate number is required."
                )
            )
        );

        // engine number is required
        $this->validate(
    		new PresenceOf(
    			array(
    				"field"		=>	"engine_no",
    				"message"	=>	"The engine number is required."
				)
			)
		);

		// Owner's name is required
    	$this->validate(
    		new PresenceOf(
    			array(
    				"field"		=>	"owner_name",
    				"message"	=>	"The owner name is required."
				)
			)
		);

		// licence_plate_number uniqueness check
    	$this->validate(
    		new Uniqueness(
    			array(
    				"field"		=>	"license_plate_no",
    				"message"	=>	"The license_plate_no is already used."
				)
			)
		);

		// engine number's uniqueness check
    	$this->validate(
    		new Uniqueness(
    			array(
    				"field"		=>	"engine_no",
    				"message"	=>	"The engine number is already used."
				)
			)
		);

		// Regular Expression to verify licence_plate_number's pattern 
    	$this->validate(
    		new Regex(
    			array(
    				"field"		=>	"license_plate_no",
    				"pattern"	=>	"/^[A-Z]{3}-[0-9]{3}$/",
    				"message"	=>	"Invalid license plate number."
				)
			)
		);
        // Custom Validation 
		if($this->car_model_year < 0){
			$this->appendMessage(new Message("Car's model year can not be zero."));
		}

		if ($this->validationHasFailed() == true) {
			return false;
		}
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cars[]|Cars|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null): \Phalcon\Mvc\Model\ResultsetInterface
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Cars|\Phalcon\Mvc\Model\ResultInterface|\Phalcon\Mvc\ModelInterface|null
     */
    public static function findFirst($parameters = null): ?\Phalcon\Mvc\ModelInterface
    {
        return parent::findFirst($parameters);
    }

}
