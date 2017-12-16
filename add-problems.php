<!DOCTYPE HTML>
<html>
	<head>
		<title>Hardware Security</title>

	</head>
	<body>
<?php
echo "<a href='index.php'>Go Back</a> <br>";
        echo"<p><a href='counter-measures.php' >Add counter measures</a></p>";
$conn=mysqli_connect('hostname','database_user_name','database_password','database_name');
 
if(mysqli_connect_errno($conn))
{
		echo 'Cannot connect to server';
}
        
if (!empty($_POST))
{
        $problem=$_POST['problems'];
        if(!empty($_POST['sol'])&& strlen($problem)>1)
        {
           $i=0; 
            $sol_id=$_POST['sol'];
        while(!empty($sol_id[$i]))
        {
            $i++;
        }
        for($j=$i; $j<10; $j++)
            $sol_id[$j]=-1;
    
        $query="INSERT INTO problems (name, f_id0, f_id1, f_id2, f_id3, f_id4, f_id5, f_id6, f_id7, f_id8, f_id9) VALUES ('$problem', '$sol_id[0]','$sol_id[1]','$sol_id[2]','$sol_id[3]','$sol_id[4]','$sol_id[5]','$sol_id[6]','$sol_id[7]','$sol_id[8]','$sol_id[9]')";


        if ($conn->query($query)===TRUE)
        {
        echo "<p>Added</p>";
        echo "<a href='index.php'>Go Back</a>";
        } 
        else 
        {
           echo "NOT Added<br/>";
           echo mysqli_error ($connect);    
        }
        }
        else
            echo "Something is missing";
        

}
        
$query = "SELECT * FROM solutions";
$solutions = $conn->query($query);
    
if ($solutions->num_rows > 0) 
{
    ?>
        
        
<form method="post" action="add-problems.php">
Problem: <input type="text" name="problems" >

<br><br>

<?php
  
   while($one = $solutions->fetch_assoc()) {       
    echo "<input type='checkbox' name='sol[]' value='".$one["sid"]."'/>". $one["sname"]."<br>" ;
    }	
    ?>
    <input type="submit" name="submit" value="Submit">
        </form>
        <?php
}
else
{
    echo "No Countermeasures found in Database. First add countermeasures by <a href='counter-measures.php'> clicking here</a>";
}
$conn->close();
?>


</div>

	</body>
</html>