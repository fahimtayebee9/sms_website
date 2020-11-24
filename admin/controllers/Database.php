<?php
    class Database{
        private $dbHost = "localhost";
        private $dbUser = "root";
        private $dbPass = "";
        private $dbName = "sms_website";
        private $pdoCon ;

        function __construct()
        {
            if( !isset($this->pdoCon)){
                try{
                    $con_link = new PDO("mysql:host=" . $this->dbHost . ";dbname=" . $this->dbName,$this->dbUser, $this->dbPass );
                    $con_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $con_link->exec("SET CHARACTER SET utf8");

                    $this->pdoCon = $con_link; 
                }
                catch(PDOException $e){
                    die("DATABASE CONNECTION FAILED.. <br>" . $e->getMessage());
                }
            }
        }

        // SELECT METHOD (READ)
        public function select($table, $data = array()){
            // $value = null;
            $sql  = "SELECT ";
            $sql .= array_key_exists("select", $data) ? $data['select'] : "*";
            $sql .= " FROM $table";

            if(array_key_exists('where',$data)){
                $sql .= " WHERE ";
                $i = 0;
                foreach($data['where'] as $key => $value){
                    $add  = ( $i > 0 ) ? ' AND ' : '';
                    $sql .= "$add" . "$key='$value'";
                    $i++; 
                }
            }

            if(array_key_exists('order_by',$data)){
                $sql .= " ORDER BY " . $data['order_by'];
            }

            $query = $this->pdoCon->prepare($sql);

            if(array_key_exists('where',$data)){
                foreach($data['where'] as $key => $value){
                    $query->bindValue(":$key", $value);
                }
            }

            $query->execute();

            // RETURN RESULT FROM DATABASE
            if(array_key_exists('return_type',$data)){
                switch($data['return_type']){
                    case "count":
                        $value = $query->rowCount();
                    break;
                    case "single":
                        $value = $query->fetch(PDO::FETCH_OBJ);
                    break;
                    default:
                        $value = ""; 
                    break;
                }
            }
            else{
                if($query->rowCount() > 0){
                    $value = $query->fetchAll(PDO::FETCH_OBJ);
                }
            }

            return !empty($value) ? $value : false;
        }

        // INSERT METHOD (CREATE)
        public function insert($table,$data){
            if( !empty($data) && is_array($data)){
                $key = "";
                $value = "";
                $keyValue = "";
                $i = 0;

                $keys = implode(',', array_keys($data));
                $values = ":" . implode(', :', array_keys($data));
                
                $i = 0;
                foreach ($data as $key => $val) {
                    $add  = ( $i > 0 ) ? ' , ' : '';
                    $keyValue .= $add . "'" . $val . "'";
                    $i++;
                }

                $sql = "INSERT INTO " . $table . " (" . $keys . ") VALUES (" . $keyValue . ")";
                
                $query = $this->pdoCon->prepare($sql);

                foreach($data as $key => $value){
                    $query->bindValue(":$key",$value);
                }

                $insertData = $query->execute();

                if($insertData){
                    return $this->pdoCon->lastInsertId();
                }
                else{
                    return false;
                }
            }
        }

        // UPDATE METHOD (UPDATE)
        public function update( $table , $data , $whereCondition){
            if( !empty($data) && is_array($data)){
                $keyValue = "";
                $value = "";
                
                $sql = "UPDATE " . $table . " SET ";
                $dataSet = array();

                // ADDING KEY AND VALUES FOR EACH DATA
                $i = 0;
                foreach ($data as $key => $value) {
                    $add  = ( $i > 0 ) ? ' , ' : '';
                    $keyValue .= $add . $key . "= '" . $value . "'";
                    $i++;
                }

                $sql .= $keyValue;

                // ADD WHERE CONDITION (as before in select function)
                if(array_key_exists('where',$whereCondition)){
                    $sql .= " WHERE ";
                    $whereArr['where'] = $whereCondition['where'];
                    $ix = 0;
                    foreach($whereCondition['where'] as $key => $val){
                        $add  = ( $ix > 0 ) ? ' AND ' : '';
                        $sql .= "$add" . "$key = '$val'";
                        $ix++; 
                    }
                }

                // Preparing the query string
                $query = $this->pdoCon->prepare($sql);

                // ADD VALUES OF WHERE CONDITION
                if(array_key_exists('where',$whereCondition)){
                    foreach($whereCondition['where'] as $key => $value){
                        $query->bindValue(":$key", $value);
                    }
                }
                
                // Execute query
                $updateData = $query->execute($data);

                if($updateData){
                    return true;
                }
                else{
                    return false;
                }
            }
        }

        // DELETE METHOD (DELETE)
        public function delete( $table , $data ){
            if( !empty($data) && is_array($data)){
                $key = "";
                $value = "";
                $i = 0;

                $keys = implode(',', array_keys($data));
                $values = ":" . implode(', :', array_keys($data));
                $sql = "DELETE FROM " . $table . " WHERE " . $keys . " = " . $values;
                $query = $this->pdoCon->prepare($sql);

                foreach($data as $key => $value){
                    $query->bindValue(":$key",$value);
                }

                $deleteData = $query->execute();

                if($deleteData){
                    return $this->pdoCon->lastInsertId();
                }
                else{
                    return false;
                }
            }
        }
    }
?>