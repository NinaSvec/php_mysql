<?php

class Validation{

    private $db;
    private $errors = array();
    private $passed = false;

    public function __construct(){
        $this->db = DB::getInstance();
    }

    public function check($inputs = array()){
        foreach ($inputs as $input => $rules) {
            foreach ($rules as $rule => $rule_value) {

                $input_value = escape(trim(Input::get($input)));

                if ($rule === 'required' && empty($input_value)) {
                    $this->addError($input, "Field $input is required.");
                }elseif(!empty($input_value)){
                    switch ($rule) {
                        case 'min':
                            if (strlen($input_value) < $rule_value ) {
                                $this->addError($input, "Field $input must have minimum of $rule_value characters.");
                            }
                            break;
                        case 'max':
                            if (strlen($input_value) > $rule_value ) {
                                $this->addError($input, "Field $input must have maximum of $rule_value characters.");
                            }
                            break;
                        case 'unique':
                        // SELECT * FRM users WHERE username = $input_value
                            $check = $this->db->select('*', $rule_value, [$input, '=', $input_value]);
                            if($check->count()){
                                $this->addError($input, "$input $input_value already exists.");
                            }
                            break;
                        case 'matches':
                            # DZ - provjeriti da li se polje password i polje password_confirmation
                            # podudaraju, ako  ne upisati grešku
                            # pripazit da vrijedi za sve forme!!!

                            if ($_POST["password"] != $_POST["password_confirmation"]) {
                                $this->addError($input, "Field Confirm password must match field Password");
                             }
                            break;
                        case 'pattern':
                                    //$regex = array(Config::get('app')['register_password_regex']);
                                   /* if(ctype_alnum('register_password_regex', $input_value) {
                                        $this->addError($input, "Field $input must include at least one Upper case and one Lower case, one number and one special character.")
                                    }*/
                                
                                    /*if (!preg_match(Config::get('app')['register_password_regex'], $input_value)) {
                                        $this->addError($input, "Field $input must include at least one Upper case and one Lower case, one number and one special character.");
                                    }
                            Config::get('app')['register_password_regex'];  */
                                if(!ctype_alnum($input_value)){
                                    $this->addError($input, "Field $input must include at least one Upper case and one Lower case, one number and one special character.");
                            }
                            // ctype_alnum()
                            // DZ - provjeriti uvjet za password sa php ugradenim funkcijama
                            // ctype_alnum()
                            break;
                     
                        }
                }
            }
        }
        if (empty($this->errors)) {
            $this->passed = true;
        }

        return $this;
    }

    private function addError($input, $error){
        $this->errors[$input] = $error;
    }

    public function hasError($input){
        if (isset($this->errors[$input])) {
            return $this->errors[$input];
        }
        return false;
    }

    public function getErrors(){
        return $this->errors;
    }

    public function passed(){
        return $this->passed;
    }
}