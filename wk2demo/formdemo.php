<?php
$dsn = "mysql:host=localhost;dbname=dogs";
$username = "dogs";
$password = "se266";
try{
    $db = new PDO($dsn, $username, $password);

}catch(PDOException $e){
    die("There was a problem connecting to the database. See ur database admin pls thx");
}

/*if(isset($_POST['submit'])){
    $submit = $_POST['submit'];
}else{
    $submit = "";
}*/

//$submit = isset($_POST['submit']) ? $_POST['submit'] : ""; //ternary

$submit = $_POST['submit'] ?? ""; //null colescense operator
if($submit == "Submit"){
    $name = $_POST['name'] ?? "";
    $gender = $_POST['gender'] ?? "F";
    $fixed = $_POST['fixed'] ?? false;

    $sql = $db->prepare("INSERT INTO animals VALUES (null, :name, :gender, :fixed)");
    $sql->bindParam(':name', $name);
    $sql->bindParam(':gender', $gender);
    $sql->bindParam(':fixed', $fixed);
    $sql->execute();
    echo $sql->rowCount() . "rows inserted.";
}
?>
<form method="post" action="#">
    Name: <input type="text" name="name"><br>
    Gender: Male: <input type="radio" name="gender" value="M">Female: <input type="radio" name="gender" value="F"><br>
    Fixed: <input type="checkbox" name="fixed" value="true"><br>
    <input type="submit" name="submit" value="Submit">
</form>
<?php
    $sql = $db->prepare("SELECT * FROM animals");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
    if(count($results)){
        foreach($results as $dog){
            print_r($dog);
            echo "<br>";
        }
    }
?>