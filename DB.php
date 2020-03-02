<?php
class DB {
    private  $dbname = "android";
    private  $hostDB = "localhost";
    private  $pwdBD = "";
    private  $userDB = "root";

    private $pdo ;

    public  function  __construct()
    {
        try{
            $this->pdo = new PDO("mysql:host=".$this->hostDB."; dbname=".$this->dbname, $this->userDB, $this->pwdBD);

            $this->pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);


        }catch (PDOException $e)
        {
            die("Erreur survenue :" . $e->getMessage()) ;
        }
    }
    /**
     * @param $sql
     * @param bool|array $params
     * @return bool|array
     */
    public  function  myQuery($sql, $params= false)
    {
        try{
            if($params)
            {
                $req = $this->pdo->prepare($sql);
                $req->execute($params) ;
                return $req ;
            }else{
                return $this->pdo->query($sql);
            }
        }catch (PDOException $ex)

        {
            die("errors : " . $ex->getMessage()  . $ex->getLine());
        }
    }
    public  function  getLastInsert()
    {
        return $this->pdo->lastInsertId();
    }


}