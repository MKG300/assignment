<?php if(isset($_POST['submit'])==false)
{?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
</head>
<body>
<div class="container">
<?php
    session_start();
    if(isset($_SESSION['visitcount']))
    {
        $_SESSION['visitcount']++;
    }
    else
    {
        $_SESSION['visitcount']=0;
    }
    echo "<p style='color:red; font-size: 22px;'> <b> the visiter no. is : </b></p>".$_SESSION['visitcount'];
    ?>
        <h1>Application Form </h1>
        
    </div>
    <div class="container1">
        <form  method="post" enctype="multipart/form-data">
            <!-- 1.for animal name -->
        <label>Name of the animal</label><br>
        <input type="text" name="name" id="name" placeholder="Name of the animal" required><br>

        <!-- 2.for category -->
        <label>Category</label><br>
        <select name="cat" required>
            <option value="none">--select--</option>
                <option value="herbivores">herbivores</option>
                <option value="omnivores">omnivores</option>
                <option value="carnivores">carnivores</option>
            </select><br>

            <!-- 3.for image -->
        <label for="">Image</label><br>
        <input type="file" name="uploadfile" required><br>

        <!-- 4.For description area -->
        <label for="">Description</label><br>
        <textarea name="area" id="" cols="30" rows="5" required></textarea><br>

        <!-- 5.For Life expectancy -->
        <label>Life expectancy</label><br>
        <select name="life" required>
            <option value="none">--select--</option>
                <option value="0-1 years">0-1 years</option>
                <option value="1-5 years">1-5 years</option>
                <option value="5-10 years">5-10 years</option>
                <option value="10+ years">10+ years</option>
            </select><br><br>

            <!-- 6.google recaptcha -->
        <div class="g-recaptcha" data-sitekey="6LfHPOMdAAAAANxbgYnKzSBIso9ISuWM2pe7Xvb4" required></div><br>


        <input type="submit" name='submit' class="btn">

</form>
</div>
</body>
</html>
<?php
}
if(isset($_POST['submit']))
{
    date_default_timezone_set("Asia/Kolkata");
    $TIME=date("G:i:s A");
    $DATE=date("d/M/Y");

    $DATA=$TIME.' '.$DATE;


$name=$_POST['name'];
$cate=$_POST['cat'];
$filename=$_FILES['uploadfile']['name'];
$tempname=$_FILES['uploadfile']['tmp_name'];
$folder="student/".$filename;
move_uploaded_file($tempname,$folder);
$area=$_POST['area'];
$ca=$_POST['life'];


if($name!="" && $cate!="" && $filename!="" && $area!="" && $ca!="")
{
    $con=mysqli_connect('localhost','root','8093391881','assignment');
    $sql="insert into animal values('$name','$cate','$folder','$area','$ca','$DATA')";
    if(mysqli_query($con,$sql))
    {
        echo"inserted data";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>upload pic</title>
</head>
<body>
    <br><br>
    <br>
    <a href="animals.php">Click here to display all the image stored in database</a>
</body>
</html>
<?php
}
else
{
    die(mysqli_error($con));
}
}
else
{
echo"you must fill all the filds....";
}
}
?>
