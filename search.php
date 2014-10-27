<html>
<head>
<Title>Search</Title>
<style type="text/css">
    body { background-color: #fff; border-top: solid 10px #000;
        color: #333; font-size: .85em; margin: 20; padding: 20;
        font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }
    h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
    h1 { font-size: 2em; }
    h2 { font-size: 1.75em; }
    h3 { font-size: 1.2em; }
    table { margin-top: 0.75em; }
    th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
    td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
</style>
</head>
<body>
<h1>Search</h1>
<p>Just enter the name that you are looking for and click on <strong>Search</strong>.</p>
<form method="post" action="search.php" enctype="multipart/form-data" >
      Enter here<input type="text" name="name" id="name"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-north-b.cloudapp.net";
    $user = "b8aaca4ce18287";
    $pwd = "9a6de041";
    $db = "momshadAqBLAQNTz";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    
$name = "";
 if(!empty($_POST)) {
    try {


        $name .= $_POST['name'];
            $sql_select = "SELECT * FROM registration_tbl WHERE name LIKE '%<?php echo $name ?>%'";
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
        echo "<h2>Search results:</h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Date</th>";
        echo "<th>Company Name</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['date']."</td>";
            echo "<td>".$registrant['company_name']."</td>"."</tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>Sorry, nothing found.</h3>";
    }
    }
     catch(Exception $e) {
        die(var_dump($e));
    }
}
    // Retrieve data

?>
</body>
</html>