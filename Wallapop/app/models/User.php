<?php
//Class to create a user
class User 
{
    //Attributes
    private $id;
    private $email;
    private $password;
    private $logcode;
    private $fullname;
    private $phone;
    private $poblacion;
    private $photo;

    

    
    
    /** returns the id of the user
     * 
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    /** returns the email of the user
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    /** returns the email of the user
     * 
     * @return string
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    /** returns the getPassword of the user
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /** returns the getLogcode of the user
     * 
     * @return string
     */
    public function getLogcode()
    {
        return $this->logcode;
    }
    /** returns the getFullname of the user
     * 
     * @return string
     */
    public function getFullname()
    {
        return $this->fullname;
    }
    /** returns the getPhone of the user
     * 
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }
    /** returns the getPoblacion of the user
     * 
     * @return string
     */
    public function getPoblacion()
    {
        return $this->poblacion;
    }

    // Setters
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setLogcode($logcode)
    {
        $this->logcode = $logcode;
    }

    public function setFullname($fullname)
    {
        $this->fullname = $fullname;
    }
    public function setPhoto($photo)
    {
        $this->photo = $photo;
    }

    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function setPoblacion($poblacion)
    {
        $this->poblacion = $poblacion;
    }
}
?>