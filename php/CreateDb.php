<?php

class CreateDb
{
    public $servername;
    public $username;
    public $password;
    public $dbname;
    public $tablename;
    public $con;

    public function __construct(
        $dbname="Newdb",
        $tablename="Product_db",
        $servername="localhost",
        $username="felipe",
        $password="1235"
    )
    {
        //Inicializando as variáveis
        $this->dbname = $dbname;
        $this->tablename = $tablename;
        $this->servername = $servername;
        $this->username = $servername;
        $this->password = $password;
        
        //Criando uma nova conexão
        $this->con = mysqli_connect($servername, $username, $password);

        //Checando a conexão
        if($this->$con){
            die("Connection Failed:" .mysqli_connect_error());
        }

        //Query
        $sql = "CREATE DATABASE IF NOT EXISTS $dbname";

        if($tablename == 'Product_tb'){

            
            //Execute query
            if(mysqli_query($this->con, $sql)){
                $this->con = mysqli_connect($servername, $username, $password, $dbname);

                //Comando para criar uma nova tabela
                $sql = "CREATE TABLE IF NOT EXISTS $tablename
                            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            product_name VARCHAR(25) NOT NULL,
                            product_price FLOAT,
                            product_image VARCHAR(100),
                            product_qtd INT);";

                if(!mysqli_query($this->con, $sql)){
                    echo "Erro criando a tabela:".mysqli_error($this->con);

                }
               //Para caso algo de errado 
            }
            else{
                return false;
            }
    }
        elseif($tablename == 'Client_tb'){
            //Execute query
            if(mysqli_query($this->con, $sql)){
                $this->con = mysqli_connect($servername, $username, $password, $dbname);
            
                //Comando para criar uma nova tabela
                $sql = "CREATE TABLE IF NOT EXISTS $tablename
                            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            client_name VARCHAR(25) NOT NULL,
                            client_email VARCHAR(25),
                            client_address VARCHAR(60),
                            client_num INT,
                            client_pass VARCHAR(8)
                            );";

                if(!mysqli_query($this->con, $sql)){
                    echo "Erro criando a tabela:".mysqli_error($this->con);
                
                }
               //Para caso algo de errado 
            }
            else{
                return false;
            }
        
        }
        elseif($tablename == 'Orders_tb'){
            //Execute query
            if(mysqli_query($this->con, $sql)){
                $this->con = mysqli_connect($servername, $username, $password, $dbname);
            
                //Comando para criar uma nova tabela
                $sql = "CREATE TABLE IF NOT EXISTS $tablename
                            (id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                            client_id INT,
                            product_id INT,
                            FOREIGN KEY (client_id) REFERENCES Client_tb(id),
                            FOREIGN KEY (product_id) REFERENCES Product_tb(id)

                            );";

                if(!mysqli_query($this->con, $sql)){
                    echo "Erro criando a tabela:".mysqli_error($this->con);
                
                }
               //Para caso algo de errado 
            }
            else{
                return false;
            }
        
        }
}
    //Pegar produtos do database
    public function getData(){
        $sql="SELECT*FROM $this->tablename";

        $result = mysqli_query($this->con, $sql);
        
        if(mysqli_num_rows($result)>0){
            return $result;

        }
    }
    


}
?>