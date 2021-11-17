<?php
define('DB_SERVER', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'dbshop');

class DB_con
{
    function __construct()
    {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $this->dbcon = $conn;

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL:" . mysqli_connect_error();
        }
    }

    public function emailavailable($uemail) {
        $checkuser = mysqli_query($this->dbcon, "SELECT email FROM sellers WHERE email = '$uemail'");
        return $checkuser;
    }

   

    public function registration($fastname, $lastname, $email, $password, $gender, $phone)
    {
        $reg = mysqli_query($this->dbcon, "INSERT INTO users(fastname, lastname, email, password,gender, phone)
            VALUES('$fastname', '$lastname', '$email', '$password', '$gender', '$phone')");
        return $reg;
    }
    public function registrationseller($fastname, $lastname, $idcard, $email, $password, $gender, $phone, $birthday, $role)
    {
        $reg = mysqli_query($this->dbcon, "INSERT INTO sellers(fastname, lastname, idcard, email, password,gender, phone,birthday,role)
            VALUES('$fastname', '$lastname','$idcard', '$email', '$password', '$gender', '$phone', '$birthday','$role')");
        return $reg;
    }
   public function createshop($id_seller,$nameshop,$lat,$lng,$imgUrl){
        $reg = mysqli_query($this->dbcon, "INSERT INTO shops(id_seller,nameshop,lat,lng,image)
        VALUES('$id_seller','$nameshop','$lat','$lng','$imgUrl')");
        return $reg;
    }
    
     public function createarea($namearea, $lat, $lng, $imgUrl,$detail,$scale,$rentalfee ){
        $reg = mysqli_query($this->dbcon, "INSERT INTO area(namearea,lat,lng,image,detail,scale,rentalfee)
        VALUES('$namearea','$lat','$lng','$imgUrl','$detail','$scale','$rentalfee')");
        return $reg;
    }
  
  
    public function signin($email, $new_password)
    {
        $signinquery = mysqli_query(
            $this->dbcon,
            "SELECT id_user, firstname,role FROM users WHERE email = '$email' AND password ='$new_password'"
        );
        return $signinquery;
    }
    public function signinseller($email, $password)
    {
        $signinquery = mysqli_query(
            $this->dbcon,
            "SELECT * FROM sellers WHERE email = '$email' AND password ='$password'"
        );
        return $signinquery;
    }
    public function signinadmin($email, $password)
    {
        $signinquery = mysqli_query(
            $this->dbcon,
            "SELECT * FROM admins WHERE email = '$email' AND password ='$password'"
        );
        return $signinquery;
    }
    public function signinmanager($email, $password)
    {
        $signinquery = mysqli_query(
            $this->dbcon,
            "SELECT * FROM managers WHERE email = '$email' AND password ='$password'"
        );
        return $signinquery;
    }

    public function quertyidseller($id_seller)
    {
        $checkidseller = mysqli_query($this->dbcon, "SELECT id_seller FROM shops WHERE id_seller = '$id_seller'");
        return $checkidseller;
    }
    public function quertyshops($id_seller)
    {
        $quertyshop = mysqli_query(
            $this->dbcon,
            "SELECT id_shop FROM shops WHERE id_seller='$id_seller'"
        );
        return $quertyshop;
    }
    public function createproducts($id_shop, $name, $description, $price, $category, $imgUrl)
    {
        $reg = mysqli_query($this->dbcon, "INSERT INTO products(id_shop,nameproduct,detail,price,id_subcategory,image)
            VALUES('$id_shop','$name','$description','$price','$category','$imgUrl')");
        return $reg;
    }
    public function quertyproducts()
    {
        $reg = mysqli_query($this->dbcon, "SELECT * FROM products");
        return $reg;
    }
    public function createpromotion($imgUrl)
    {
        $reg = mysqli_query($this->dbcon, "INSERT INTO promotion(imgUrl)
            VALUES('$imgUrl')");
        return $reg;
    }
   public function createcategory($namecategory, $imgUrl)
    {
        $reg = mysqli_query($this->dbcon, "INSERT INTO categorys(namecategory,imgUrl)
            VALUES('$namecategory','$imgUrl')");
        return $reg;
    }
    public function createpromotionseller($id_selle, $description, $imgUrl,$status)
    {
        $reg = mysqli_query($this->dbcon, "INSERT INTO promotionseller(id_seller,detailpromotion,image,status)
            VALUES('$id_selle','$description','$imgUrl','$status')");
        return $reg;
    }
}