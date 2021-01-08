<?php

class CRUD{
    public $file_path;

    function __construct(string $file){
        $this->file_path = $file;
    }

    private function ValidateUser($login,$password,$email,$name){
        $xml = simplexml_load_file($this->file_path);
        //check if user already exists
        foreach ($xml->children() as $child) {
            if (($child->login == $login) || ($child->email == $email)) {
                return false;
            }
        }
        return true;
    }

    private function WriteUserToXML($login,$password,$email,$name){
        //create a new XML node
        $xml = simplexml_load_file($this->file_path);
        $user=$xml->addChild('user');
        $user->addChild('login',$login);
        $user->addChild('name',$name);
        $user->addChild('email',$email);
        $user->addChild('password',crypt($password,'test'));
        //save XML file
        $xml->asXML($this->file_path);
    }

    public function RegisterUser($login,$password,$email,$name){
        //check user
        if(!$this->ValidateUser($login,$password,$email,$name)){
            echo 0;
            exit;
        }
        
        //add element        
        $this->WriteUserToXML($login,$password,$email,$name);
        echo 1;
    }

    public function LogIn($login,$password){
        $exists = false;
        $xml = simplexml_load_file($this->file_path);
        //check if user exists
        foreach ($xml->children() as $child) {
            if (($child->login == $login) && (password_verify($password,$child->password))) {
                $exists = true;
            break;
            }
        }
        if($exists){
            echo 1;
        }else{
            echo 0;
        }
    }
}

?>