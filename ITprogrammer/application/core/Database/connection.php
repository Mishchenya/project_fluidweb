<?php 

class DataBase
{
  private $link;
  
  function __construct()
  {
    $this->connect();
  }
  private function connect()
  {

    $dsn = "mysql:host=localhost;port=3306;dbname=register_bd;charset=utf8";
    $this->link = new \PDO($dsn,'root', '');
      
  }
  public function execute($sql)
  {
    $sth= $this->link->prepare($sql);
    return $sth->execute(); 
  }
  public function query($sql)
  {
    $sth= $this->link->prepare($sql);
    $sth->execute();
    $result=$sth->fetchAll(PDO::FETCH_ASSOC);
    if($result===0)
    {
      return[''];
    }
    return $result;
  }

}
?>