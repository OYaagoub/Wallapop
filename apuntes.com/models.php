<?php
class Models
{
    private function getConnection($sql)
    {
        $conn = new mysqli('localhost', 'root', '', 'daw2');

        $result = $conn->query($sql);
        $content = [];
        while ($row = $result->fetch_assoc()) {
            $content[] = $row;
        }
        $conn->close();

        return $content;
    }
    private function setConnection($sql)
{
    $conn = new mysqli('localhost', 'root', '', 'daw2');

    $result = $conn->query($sql);
    if (!$result) {
        die('Error executing query: ' . $conn->error);
    }

    $conn->close();

    return $result;
}
    public function getTemas($id)
    {
        $sql = " select   temas.* from temas where asignatura_id={$id} order by fecha desc ";
        $temas = $this->getConnection($sql);

        return $temas;
    }
    public function getApuntes($id)
    {
        $sql = " select   apuntes.* from apuntes where tema_id={$id} order by fecha desc";
        $temas = $this->getConnection($sql);

        return $temas;
    }
    public function setApunte($id,$apunte,$nombre){
        $sql = " insert into apuntes (nombre,apunte,tema_id) VALUES ('{$nombre}','{$apunte}','{$id}')";
        $ckeck = $this->setConnection($sql);
        return $ckeck;

    }
    public function delApunte($id)
    {
        $sql = " delete from apuntes where id={$id} ";

        $result = $this->setConnection($sql);

        return $result;
    }
    public function getSearch($string)
    {
        $sql = " select  DISTINCT * FROM apuntes WHERE nombre LIKE '%{$string}%' ";
        $apuntes = $this->getConnection($sql);

        return $apuntes;
    }
    public function getSearchIn($string,$id)
    {
        $sql = " select DISTINCT apuntes.* from apuntes,temas,asignaturas WHERE apuntes.tema_id=temas.id and temas.asignatura_id =$id and apuntes.nombre LIKE '%$string%'   ";
        $apuntes = $this->getConnection($sql);

        return $apuntes;
    }
}
?>
