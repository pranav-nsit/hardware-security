<!DOCTYPE HTML>

<html>
	<head>
		<title>Hardware Security</title>

	</head>
	<body>
        
<?php 
        echo "<a href='index.php'>Go Back</a> <br>";
       $conn=mysqli_connect('hostname','database_user_name','database_password','database_name');
 
if(mysqli_connect_errno($conn))
{
		echo 'Cannot connect to server';
}
        
if (!empty($_POST))
{
    $i=0;
    $cid=$_POST['cmeasures'];
    while(!empty($cid[$i]))
    {
        $query="INSERT INTO solutions (sname) VALUES ('$cid[$i]')";
        if ($conn->query($query)===TRUE)
        {
                $i++;
        }
    }
    if($i>0)
    {
        echo $i ."Solutions Added.<br>";
    }
    else 
    {
	   echo "NOT Added<br/>";
    }
}
    
    ?>
        
    <form method="post" action="counter-measures.php">
        <?php
    for($i=0; $i<12; $i++)
    {
        
        echo "Counter measure ". ($i+1).": <input type='text' name='cmeasures[]' > <br>";
    }
?>
    <input type="submit" name="submit" value="Submit">
    </form>
<?php
        
$conn->close();

?>
	</body>
</html>