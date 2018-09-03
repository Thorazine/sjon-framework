<?php

class User extends Model
{

    /**
     * @Type varchar(255)
     */
    protected $email;

    /**
     * @Type varchar(255)
     */
    protected $password;

    /**
     * @Type varchar(255)
     */
    protected $salt;

    /**
     * @Type varchar(40)
     */
    protected $role;

    /**
     * @Type varchar(255)
     */
    protected $firstname;

    /**
     * @Type varchar(255)
     */
    protected $lastname;


    private function __construct(){

    }

    public function getFullName(){
        return $this->firstname . " " . $this->lastname;
    }

    public function getRole()
    {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }


    private function setPassword($password)
    {
        $this->salt = self::generateSalt();
        $this->password = hash('sha256', $password . $this->salt);
    }



    private function checkPassword($password)
    {
        $hash = hash('sha256', $password . $this->salt);
        return ($hash == $this->password);
    }

    public static function generateSalt()
    {
        return uniqid();
    }

    protected static function newModel($obj){

        $email = $obj->email;

        $existing = User::findBy('email', $email);
        if(count($existing) > 0) return false;

        //Check if user is valid
        return true;

    }

    public static function register($form){
        if($form['password'] !== $form['repeat']) App::addError("passwords do not match");
        if(strlen($form['password']) < 8) App::addError("password is too short");

        $user = new User();
        $user->email = $form['email'];
        $user->setPassword($form['password']);
        $user->role = 'user';
        $user->firstname = $form['firstname'];
        $user->lastname = $form['lastname'];
        $user->save();
        if($user->getId()) {
            App::setLoggedInUser($user);
            return $user;
        } else {
            return false;
        }
    }

    public static function login($form)
    {
        $email = $form['email'];
        $password = $form['password'];
        $users = self::findBy('email', $email);
        if (count($users) > 0) {
            $user = $users[0];
            if ($user->checkPassword($password)) {
                App::setLoggedInUser($user);
                return $user;
            }
        }
        App::addError("Combination does not exist");
        return false;
    }

    public static function loginForm(){
        $form = new Form();

        $form->addField((new FormField("email"))
            ->type("email")
            ->placeholder("email")
            ->required());

        $form->addField((new FormField("password"))
            ->type("password")
            ->placeholder("password")
            ->required());

        return $form->getHTML();
    }

    public static function registerForm(){
        $form = new Form();

        $form->addField((new FormField("email"))
            ->type("email")
            ->placeholder("email")
            ->required());

        $form->addField((new FormField("password"))
            ->type("password")
            ->placeholder("password")
            ->required());

        $form->addField((new FormField("repeat"))
            ->type("password")
            ->placeholder("repeat")
            ->required());

        $form->addField((new FormField("firstname"))
            ->placeholder("first name")
            ->required());

        $form->addField((new FormField("lastname"))
            ->placeholder("last name")
            ->required());

        return $form->getHTML();
    }

}
