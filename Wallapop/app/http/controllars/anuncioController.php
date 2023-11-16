<?php


class AnuncioController
{
    private $connection ;

    function __construct(){
        $c = new ConnexionController();
        $this->connection = $c->getConnection();
    }
    /**
     * 
     * @param type Anuncio:class
     * @return type Anuncio::class
     */
    public function insert(Anuncio $anuncio)
{
    if (!$stmt = $this->connection->prepare("INSERT INTO anuncios (title, description, price, id_user, image) VALUES (?, ?, ?, ?, ?)")) {
       $_SESSION['error'] = "Error preparing statement";
       header("Location: /Wallapop/index.php?page=misanoncios");
       exit(); // Terminate script execution after redirection
    }

    // Bind parameters separately and execute the statement
    $title = $anuncio->getTitle();
    $des = $anuncio->getDescription();
    $price = $anuncio->getPrice();
    $id_user = $anuncio->getId_user();
    $image = $anuncio->getImage();

    if (!$stmt->bind_param("sssis", $title, $des, $price, $id_user, $image)) {
        $_SESSION['error'] = "Error binding parameters";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }

    if ($stmt->execute()) {
        $anuncio->setId($stmt->insert_id);
        $_SESSION['access'] = "Anuncio creado correctamente";
        return $anuncio;
    } else {
        $_SESSION['error'] = "Anuncio no está creado";
        return null;
    }
}

    /**
     * 
     * @param type Anuncio::class
     * @return type Anuncio::class
     */
    public function update(Anuncio $anuncio)
    {
        if (!$stmt = $this->connection->prepare("UPDATE anuncios SET titulo=?, description=?, price=?, image=? WHERE   id=? and id_user=?"))
        {
            $_SESSION['error'] = "Error preparing statement";
            header("Location: /Wallapop/index.php?page=misanoncios");
        }
        $title=$anuncio->getTitulo();
        $des=$anuncio->getDescripcion();
        $price=$anuncio->getPrecio();
        $id_user=$anuncio->getId_user();
        $id=$anuncio->getId();
        $image=$anuncio->getImagen();
        $stmt=$stmt->bind_param("ssssii",$title,$des,$price,$image,$id,$id_user);
        
        if ($stmt->execute()) {
            $_SESSION['success'] = "Anuncio actualizado correctamente";
            return true;
        }
        else{
            return null;
        }
    }
    /**
     * 
     * @param type Anuncio::class
     * @return type boolean
     */
    public function delete(Anuncio $anuncio)
    {

        if (!$stmt = $this->connection->prepare("DELETE FROM anuncios WHERE id=? and id_user=?"))
        {
            $_SESSION['error'] = "Error preparing statement";
            header("Location: /Wallapop/index.php?page=misanoncios");
        }
        $stmt=$stmt->bind_param("ii",$anuncio->getId(),$anuncio->getId_user());
        $stmt->execute();
        if ($stmt->affected_rows == 1) {
            $_SESSION['success'] = "Anuncio eliminado correctamente";
            return true;
        }
        else{
            return false;
        }
    }
    /**
     *  
     * @return type array   
     */
    public function getAll()
    {
        $anuncios = array();
        if (!$stmt = $this->connection->prepare("SELECT * FROM anuncios"))
        {
            $_SESSION['error'] = "Error preparing statement";
            header("Location: /Wallapop/index.php?page=misanoncios");
        }
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($anuncio = $result->fetch_object(Anuncio::class)){
            $anuncios[] = $anuncio;
        }
        
        
        return $anuncios;
        
    }
    /**
     * 
     * @param type $id
     * @return type Anuncio:class
     */
    public function getById($id){
        $anuncio = null;
        if (!$stmt = $this->connection->prepare("SELECT * FROM anuncios WHERE id=?"))
        {
            $_SESSION['error'] = "Error preparing statement";
            header("Location: /Wallapop/index.php?page=misanoncios");
        }
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $anuncio=$result->fetch_object(Anuncio::class);
        }
        return $anuncio;
        
    }
    /**
     * 
     * @param type $id_user
     * @return type Array
     */
    public function getByUser($id_user){
        $anuncios = array();
        if (!$stmt = $this->connection->prepare("SELECT * FROM anuncios WHERE id_user=?"))
        {
            $_SESSION['error'] = "Error preparing statement";
            header("Location: /Wallapop/index.php?page=misanoncios");
        }
        $stmt->bind_param("i",$id_user);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($anuncio = $result->fetch_object(Anuncio::class)){
            $anuncios[] = $anuncio;
        }
        return $anuncios;
    }
    /**
     * 
     * @param type $id_anuncio,$image
     * @return type Array
     */
    public function insertImage($id_anuncio, $image){
        if (!$stmt =$this->connection->prepare("INSERT INTO images (id_ano, image) VALUES (?,?)")){
            $_SESSION['error'] = "Error preparing statement";
            header("Location: /Wallapop/index.php?page=misanoncios");
        }
        $stmt->bind_param("is",$id_anuncio, $image);
        if ($stmt->execute()) {
            # code..
            return true;
        }else{
            return false;
        }

    }















}












?>