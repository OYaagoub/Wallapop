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
    public function delete($id)
    {
        $stmt = $this->connection->prepare("DELETE FROM anuncios WHERE id=?");
        if (!$stmt) {
            $_SESSION['error'] = "Error preparing statement";
            header("Location: /Wallapop/index.php?page=misanoncios");
            exit(); // Exit the script after redirection
        }

        $bindResult = $stmt->bind_param("i", $id);
        if (!$bindResult) {
            $_SESSION['error'] = "Error binding parameters";
            header("Location: /Wallapop/index.php?page=misanoncios");
            exit(); // Exit the script after redirection
        }

        $executeResult = $stmt->execute();
        if (!$executeResult) {
            $_SESSION['error'] = "Error executing statement";
            header("Location: /Wallapop/index.php?page=misanoncios");
            exit(); // Exit the script after redirection
        }

        if ($stmt->affected_rows == 1) {
            $_SESSION['success'] = "Anuncio eliminado correctamente";
            return true;
        } else {
            $_SESSION['error'] = "Anuncio no está eliminado debido a permisos o no existe";
            return false;
        }
    }

    public function removeImages(int $id) {
        $stmt = $this->connection->prepare("DELETE FROM images WHERE id_ano=?");
    
        if (!$stmt) {
            $_SESSION['error'] = "Error preparing statement: " . $this->connection->error;
            header("Location: /Wallapop/index.php?page=misanoncios");
            exit();
        }
    
        if (!$stmt->bind_param("i", $id)) {
            $_SESSION['error'] = "Error binding parameters: " . $stmt->error;
            header("Location: /Wallapop/index.php?page=misanoncios");
            exit();
        }
    
        if (!$stmt->execute()) {
            $_SESSION['error'] = "Error executing statement: " . $stmt->error;
            header("Location: /Wallapop/index.php?page=misanoncios");
            exit();
        }
    
        // Handle successful deletion
        // Redirect or perform other actions
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
    public function getImagesAnu($id){
        $images = array();
        if (!$stmt = $this->connection->prepare("SELECT * FROM images WHERE id_ano=?"))
        {
            $_SESSION['error'] = "Error preparing statement";
            header("Location: /Wallapop/index.php?page=misanoncios");
        }
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        while ($image = $result->fetch_object(Image::class)){
            $images[] = $image;
        }
        return $images;
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
    public function updateImageAnu($id,$image)
{
    if (!$stmt = $this->connection->prepare("UPDATE anuncios SET image = ? WHERE id = ?")) {
       $_SESSION['error'] = "Error preparing statement";
       header("Location: /Wallapop/index.php?page=misanoncios");
       exit(); // Terminate script execution after redirection
    }

    // Bind parameters separately and execute the statement
    

    if (!$stmt->bind_param("si", $image, $id)) {
        $_SESSION['error'] = "Error binding parameters";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }

    if ($stmt->execute()) {
        $_SESSION['access'] = "Imagen actualizada correctamente";
        return true;
    } else {
        $_SESSION['error'] = "La imagen no se ha actualizado";
        return false;
    }

}

public function updatePrice($id,$price)
{
    if (!$stmt = $this->connection->prepare("UPDATE anuncios SET price = ? WHERE id = ?")) {
       $_SESSION['error'] = "Error preparing statement";
       header("Location: /Wallapop/index.php?page=misanoncios");
       exit(); // Terminate script execution after redirection
    }

    // Bind parameters separately and execute the statement
    

    if (!$stmt->bind_param("si", $price, $id)) {
        $_SESSION['error'] = "Error binding parameters";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }

    if ($stmt->execute()) {
        $_SESSION['access'] = "Precio actualizado correctamente";
        return true;
    } else {
        $_SESSION['error'] = "El precio no se ha actualizado";
        return false;
    }
}
public function updateTitle($id,$title)
{
    if (!$stmt = $this->connection->prepare("UPDATE anuncios SET title = ? WHERE id = ?")) {
       $_SESSION['error'] = "Error preparing statement";
       header("Location: /Wallapop/index.php?page=misanoncios");
       exit(); // Terminate script execution after redirection
    }

    // Bind parameters separately and execute the statement
    
    if (!$stmt->bind_param("si", $title, $id)) {
        $_SESSION['error'] = "Error binding parameters";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }

    if ($stmt->execute()) {
        $_SESSION['access'] = "Título actualizado correctamente";
        return true;
    } else {
        $_SESSION['error'] = "El título no se ha actualizado";
        return false;
    }
}


public function updateDescription($id ,$description)
{
    if (!$stmt = $this->connection->prepare("UPDATE anuncios SET description = ? WHERE id = ?")) {
       $_SESSION['error'] = "Error preparing statement";
       header("Location: /Wallapop/index.php?page=misanoncios");
       exit(); // Terminate script execution after redirection
    }

    // Bind parameters separately and execute the statement
    

    if (!$stmt->bind_param("si", $description, $id)) {
        $_SESSION['error'] = "Error binding parameters";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }

    if ($stmt->execute()) {
        $_SESSION['access'] = "Descripción actualizada correctamente";
        return true;
    } else {
        $_SESSION['error'] = "La descripción no se ha actualizado";
        return false;
    }
}



public function updateImage($id, $image)
{
    if (!$stmt = $this->connection->prepare("UPDATE images SET image = ? WHERE id = ?")) {
        $_SESSION['error'] = "Error preparing statement";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }

    if (!$stmt->bind_param("si", $image, $id)) {
        $_SESSION['error'] = "Error binding parameters";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }

    if ($stmt->execute()) {
        return true;
    } else {
        return false;
    }
}

public function searchByTitle($title)
{
    if (!$stmt = $this->connection->prepare("SELECT * FROM anuncios WHERE title LIKE ?")) {
        $_SESSION['error'] = "Error preparing statement";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }

    $title = '%' . $title . '%'; // Add wildcards to search for partial matches

    if (!$stmt->bind_param("s", $title)) {
        $_SESSION['error'] = "Error binding parameters";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $advertisements = array();

        while ($row = $result->fetch_assoc()) {
            // Create Anuncio objects from the retrieved data and add them to the array
            $anuncio = new Anuncio();
            $anuncio->setId($row['id']);
            $anuncio->setTitle($row['title']);
            $anuncio->setDescription($row['description']);
            $anuncio->setPrice($row['price']);
            $anuncio->setId_user($row['id_user']);
            $anuncio->setImage($row['image']);

            $advertisements[] = $anuncio;
        }

        return $advertisements;
    } else {
        $_SESSION['error'] = "Error executing statement";
        header("Location: /Wallapop/index.php?page=misanoncios");
        exit(); // Terminate script execution after redirection
    }
}









}












?>