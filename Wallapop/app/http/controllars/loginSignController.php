<?php 

class LoginController
{
    private $connection ;

    function __construct(){
        $c = new ConnexionController();
        $this->connection = $c->getConnection();
    }
    
    public function login($email,$password){
        if (!$stmt= $this->connection->prepare("SELECT * FROM users WHERE email=? limit 1")) {
            echo 'Error sql';
        }
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows==1) {
            $user =$result->fetch_object(User::class);
            if (password_verify($password, $user->getPassword())) {
                $logcodeNew = $this->generateRandomString(250); 
                $this->saveLogcode($logcodeNew, $user->getEmail());
                $_SESSION['logcode'] =$logcodeNew;
                $cookieValue = $logcodeNew . ";;;" . $email;
                // Set the cookie
                setcookie('logcode', $cookieValue, time() + (86400 * 7), '/', '', false, true);
                $_SESSION['access'] = "login done!";
            } else {
                $_SESSION['error'] = "Password is incorrect!";
            }
        }else {
            $_SESSION['error'] ="no User found!";
        }

    }
    public function getBylogCode($logcode){
        if (!$stmt= $this->connection->prepare("SELECT * FROM users WHERE logcode=? limit 1")) {
            echo 'Error sql';
        }
        $stmt->bind_param('s', $logcode);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows==1) {
            $user =$result->fetch_object(User::class);
            return $user;
        }else {
            $_SESSION['error'] ="no User found!";
            return null;
        }

    }
    function generateRandomString($length = 250) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charLength = strlen($characters);
        $randomString = '';
    
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charLength - 1)];
        }
    
        return $randomString;
    }
    function checklogcode(){
        if (isset($_COOKIE['logcode']) & !isset($_SESSION['logcode'])){
            
            $keys=explode(";;;",$_COOKIE['logcode']);
            if(!$stmt=$this->connection->prepare("SELECT * FROM users WHERE logcode=? and email=? limit 1")){
                echo "Error checking logcode sql";
            }
            $email=$keys[1];
            $stmt->bind_param("ss",$keys[0],$email);
            $stmt->execute();
            $result=$stmt->get_result();
            if ($result->num_rows==1) {
                $logcode = $this->generateRandomString(250); // Generates a random string of length 100
                $this->saveLogcode($logcode,$email);
                $cookie=$logcode.";;;".$email;
                setcookie('logcode', $cookie, time() + (86400 * 7), '/'); // Sets the cookie for 30 days
                $_SESSION['logcode']=$logcode;
                
                //header('Location: /Wallapop/index.php');
            }
        }
    }
    function logout(){
        unset($_SESSION['logcode']);
        unset($_SESSION['email']); 
        setcookie('logcode', '', time() - 1, '/');
        header('Location: /Wallapop/index.php');
    }
    function saveLogcode($logcode,$email){
        if (!$stmt=$this->connection->prepare("update users set logcode =? where email=?")) {
            $_SESSION['error']="Error saving logcode";
            //header('Location: /Wallapop/index.php');
        }
        $stmt->bind_param("ss",$logcode,$email);
        $stmt->execute();

    }
    function signUp(User $user){
        if (!$stmt=$this->connection->prepare("INSERT INTO users (email,password,fullname,photo,poblacion,phone)values(?,?,?,?,?,?)")){
            $_SESSION['error']="Error saving user";
            header('Location: /Wallapop/index.php');
        }
        $email=$user->getEmail();
        $pass=$user->getPassword();
        $name=$user->getFullname();
        $photo=$user->getPhoto();
        $pob=$user->getPoblacion();
        $phone=$user->getPhone();
        $stmt->bind_param("ssssss",$email,$pass,$name,$photo,$pob,$phone);
        $stmt->execute();
        $_SESSION['success']="User saved";
        header('Location: /Wallapop/index.php?page=login');
    }
    
    








}





?>