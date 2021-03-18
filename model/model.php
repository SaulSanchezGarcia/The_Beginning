<?php
require_once("../dbConnection/conection.php");

class Model{

    function login(){

        $conn = new ConectarDB();
        $conection = $conn->conectar();

        $user_name = $_REQUEST['user_name'];
        $password = $_REQUEST['password'];
        session_start();
        $_SESSION['user_name'] = $user_name;
        // $variable = array("encontrado" => false, "mensaje" => array());
        $variable = array("encontrado" => false, "mensaje" => "");

        $query = "SELECT * FROM employees WHERE user_name = '$user_name' AND password = '$password'";
        $result = mysqli_query($conection,$query);
        $filas = mysqli_num_rows($result);
        $row = mysqli_fetch_array($result);

        if($filas >= 1){
            if($row['idEMPLOYEE'] == 1){
                $variable["encontrado"] = true;
                $variable["mensaje"] = "Eres el administrador WELCOME...";
            }else{
                $variable["encontrado"] = true;
                $variable["mensaje"] = "You are an employee WELCOME...";
            }
        }else{
            $variable["encontrado"] = false;
            $variable["mensaje"] = "The user or the employee are incorrect...";
        }
        echo json_encode($variable);
        mysqli_close($conection); 
        



        // if($user_name == "Saul01" && $password == "1234"){
        //     echo "You are the admin... BIENVENIDO...";
        // }else if($filas){
        //     echo "You are a employee... BIENVENIDO... ";
        // }else{
        //     echo "USUARIO O CONTRASEÑA INCORRECTOS...";
        //     echo "ERROR".$sql."<br>".mysqli_error($conection);
        // }

        // if($filas){
        //     echo "BIENVENIDO...";
        // }else{
        //     echo "USUARIO O CONTRASEÑA INCORRECTOS...";
        //     echo "ERROR".$sql."<br>".mysqli_error($conection);
        // }
        // mysqli_close($conection); 
        // print_r(mysqli_fetch_assoc($result));
        

        // if($result){
            
        //     // while ($row = mysqli_fetch_assoc($result)) {
        //     //     // $arr[] = $fila;
        //     //     $arr[] = $row;
        //     //     // print_r($fila['name']);
        //     // }
        //     // print_r($arr[0]);
            
        //     // if(arr[0]['user_name']== $user_name){
        //     //     echo "BIENVENIDO...";
        //     // }else{
        //     //     echo "TU USUARIO O CONTRASEÑA NO SON VALIDOS";
        //     // }       
        // }else{
        //     echo "ERROR".$sql."<br>".mysqli_error($conection);
        // }
        // mysqli_close($conection);      
    }

    function insert(){
        $conn = new ConectarDB();
        $conection = $conn->conectar();

        $name = $_REQUEST['name'];
        $last_name = $_REQUEST['last_name'];
        $email = $_REQUEST['email'];
        $phone = $_REQUEST['phone'];

        $query = "INSERT INTO customers(name, last_name, email, phone) VALUES ('$name','$last_name','$email','$phone')";
        $result = mysqli_query($conection,$query);

        if($result){
            echo "REGISTRO EXITOSO...";
        }else{
            echo "ERROR".$sql."<br>".mysqli_error($conection);
        }
        mysqli_close($conection);


    }

    function showData(){

        $conn = new ConectarDB();
        $conection = $conn->conectar();

        $sql = "SELECT idCUSTOMER, name, last_name, email, phone FROM customers";
        $result = mysqli_query($conection,$sql);

        if($result){
            while($row = mysqli_fetch_assoc($result)){
                $arr[] = $row;
            }
            return $arr;
        }else{
            echo "ERROR".$sql."<br>".mysqli_error($conection);
        }
        mysqli_close($conection);

    }

    function delete(){
        $conn = new ConectarDB();
        $conection = $conn->conectar();

        $idCUSTOMER = $_POST['idCUSTOMER'];
        $sql = "DELETE FROM customers WHERE idCUSTOMER = '$idCUSTOMER'";
        $result = mysqli_query($conection,$sql);

        if($result){
            echo "Se elimino el cliente correctamente";
        }else{
            echo "Algo salio mal";
            echo "ERROR".$sql."<br>".mysqli_error($conection);
        }
        mysqli_close($conection);
    }

    function update(){

    }
}
?>