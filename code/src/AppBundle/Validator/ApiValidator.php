<?php

namespace AppBundle\Validator;

class ApiValidator
{

    private $gump;

    private $routeValidationArray = array(

        '_api_user_company_blacklist' => array(
            'unique_symbol' => 'alpha_colon|max_len,20',
            'bulk' => 'valid_json_string'
        )
        #Further validations can be added here

    );


    private $validationRules;


    public function __construct($path)
    {
        $this->gump = new \GUMP();

        $this->addValidationRule();
        $this->setDefaultValidationRules($path);
        $this->setDefaultFilterRules();
    }

    private function setDefaultValidationRules($path){

        $rules = !empty($this->routeValidationArray[$path])?$this->routeValidationArray[$path]:array();

        $this->gump->validation_rules($rules);
        $this->validationRules = $rules;
    }


    private function setDefaultFilterRules(){

        $this->gump->filter_rules(array(
            'password' => 'trim',
            'email'    => 'trim|sanitize_email',
        ));
    }


    public function addValidationRule()
    {
        $GUMP = $this->gump;

        $GUMP::add_validator("alpha_colon", function($field, $input, $param = NULL) {
                return !empty($input[$field])? !empty(preg_match("/[\w\:]+/", $input[$field])) : false;
        });
    }


    public function run($dataArray){

        $validated_data = $this->gump->run($dataArray);

        if($validated_data === false) {
            return array(-1, $this->gump->get_readable_errors()) ;
        } else {
            return array(1, 'Successful');
        }

    }

    public function validate($dataArray){

        $validated_data = $this->gump->validate($dataArray, $this->validationRules);

        if($validated_data === true) {
            return array(1, 'Successful');
        } else {
            return array(-1, $validated_data) ;
        }

    }





}
