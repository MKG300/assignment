
<!DOCTYPE html>
<html lang="en">
<head>
    <title>details</title>
</head>
<style>
    th,td{
        font-size: 15px;
        padding: 20px;
    }
</style>
<body>
    <!-- visitor counter -->
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
    <!-- END visitor counter -->

    <!-- Sorting Part Start -->
        <form class="container" method="GET"action="" >
            <table align="center">

            
            <th>
            <div>
            <select name="sort_alphabet" id="">
                <option value="">--Alphabatical order--</option>
                <option value="A-Z" <?php if(isset($_GET['sort_alphabet']) && $_GET['sort_alphabet']=="A-Z"){echo "selected";}?> >A-Z</option>
                <option value="Z-A" <?php if(isset($_GET['sort_alphabet']) && $_GET['sort_alphabet']=="Z-A"){echo "selected";}?> >Z-A</option>
            </select>
            <button name="alpha" type="submit" value="search">search</button>
            </div>
            </th>


        <div>
            <th>
                <div>
                    <label for="">From date</label>
                    <input type="date" name="From_date" value="From_date">
                </div>
            </th>
            <th>
                <div>
                    <label for="">To date</label>
                    <input type="date" name="To_date" value="To_date">
                </div>
            </th>
            <th>
                <div>
                    <label for="">click to filter</label>
                    <button name="dt" type="submit" value="search">filter</button>
                </div>
            </th>
        </div>



            <th>
            <div>
            <select name="category" id="">
                <option value="">--category order--</option>
                <option value="herbivores" <?php if(isset($_GET['category']) && $_GET['category']=="herbivores"){echo "selected";}?> >herbivores</option>
                <option value="omnivores"  <?php if(isset($_GET['category']) && $_GET['category']=="omnivores"){echo "selected";}?> >omnivores</option>
                <option value="carnivores" <?php if(isset($_GET['category']) && $_GET['category']=="carnivores"){echo "selected";}?> >carnivores</option>
            </select>
            <button name="categ" type="submit" value="search">search</button>
            </div>
            </th>


            <th>
            <div>
            <select name="life1" id="">
                <option value="">--Lifeexpectancy order--</option>
                <option value="0-1 years" <?php if(isset($_GET['life1']) && $_GET['life1']=="0-1 years"){echo "selected";}?> >0-1 years</option>
                <option value="1-5 years" <?php if(isset($_GET['life1']) && $_GET['life1']=="1-5 years"){echo "selected";}?> >1-5 years</option>
                <option value="5-10 years"<?php if(isset($_GET['life1']) && $_GET['life1']=="5-10 years"){echo "selected";}?> >5-10 years</option>
                <option value="10+ years" <?php if(isset($_GET['life1']) && $_GET['life1']=="10+ years"){echo "selected";}?> >10+ years</option>
            </select>
            <button name="life" type="submit" value="search">search</button>
            </div>
            </th>
            </table>
        </form>
        <!-- Sorting Part End-->
    <br>
    <!-- header part start -->
    <div style="text-align:center" class="container">
            <table border="1" align="center" style="border-collapse:collapse">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Image</th>
                        <th>Description</th>
                        <th>Lifeexpectancy</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <!-- header part end -->

                <!-- body part start -->
                <tbody>

                    <?php
                    
                    if(isset($_GET['alpha']))
                    {

                     $con=mysqli_connect('localhost','root','8093391881','assignment');
                    
                     $sort_option = "";
                     if(isset($_GET["sort_alphabet"]))
                     {
                         if($_GET["sort_alphabet"]=="A-Z")
                         {
                            $sort_option = "ASC";
                         }
                         elseif($_GET["sort_alphabet"]=="Z-A")
                         {
                            $sort_option = "DESC";
                         }
                     }
                     $sql="SELECT * FROM animal ORDER BY Name $sort_option";
                     $query_run=mysqli_query($con,$sql);

                     if(mysqli_num_rows($query_run)>0)
                     {
                        while ($row=mysqli_fetch_array( $query_run))
                        {
                             ?>
                             <tr>
                                 <td><?= $row['Name']?></td>
                                 <td><?= $row['Category']?></td>
                                 <td><img src="<?php echo $row['Image'];?>" height='100' width='100'></td>
                                 <td><?= $row['Description']?></td>
                                 <td><?= $row['Lifeexpectancy']?></td>
                                 <td><?= $row['Date']?></td>
                             </tr>
                             <?php
                         }
                     }
                    }
                    elseif(isset($_GET['dt']))
                    {
                        $con=mysqli_connect('localhost','root','8093391881','assignment');
                        
                        if(isset($_GET['From_date']) && isset($_GET['To_date']))
                        {
                            $from_date=$_GET['From_date'];
                            $to_date=$_GET['To_date'];

                            $sql= "SELECT * FROM animal WHERE Date BETWEEN '$from_date' AND '$to_date' ";
                            $query_run=mysqli_query($con,$sql);
                        }
                        

                     if(mysqli_num_rows($query_run)>0)
                     {
                        while ($row=mysqli_fetch_array( $query_run))
                        {
                             ?>
                             <tr>
                                 <td><?= $row['Name']?></td>
                                 <td><?= $row['Category']?></td>
                                 <td><img src="<?php echo $row['Image'];?>" height='100' width='100'></td>
                                 <td><?= $row['Description']?></td>
                                 <td><?= $row['Lifeexpectancy']?></td>
                                 <td><?= $row['Date']?></td>
                             </tr>
                             <?php
                         }
                     }
                     else
                     {
                        mysqli_error($con));
                     }

                    }
                    elseif(isset($_GET['categ']))
                    {
                        $con=mysqli_connect('localhost','root','8093391881','assignment');
                        $sort_category = "";
                        if(isset($_GET["category"]))
                        {
                            if($_GET["category"]=="herbivores")
                            {
                               $sort_category = "herbivores";
                            }
                            elseif($_GET["category"]=="omnivores")
                            {
                               $sort_category = "omnivores";
                            }
                            elseif($_GET["category"]=="carnivores")
                            {
                               $sort_category = "carnivores";
                            }
                        }
                        $sql="SELECT * FROM animal WHERE Category = '$sort_category'";
                        $query_run=mysqli_query($con,$sql);

                     if(mysqli_num_rows($query_run)>0)
                     {
                        while ($row=mysqli_fetch_array( $query_run))
                        {
                             ?>
                             <tr>
                                 <td><?= $row['Name']?></td>
                                 <td><?= $row['Category']?></td>
                                 <td><img src="<?php echo $row['Image'];?>" height='100' width='100'></td>
                                 <td><?= $row['Description']?></td>
                                 <td><?= $row['Lifeexpectancy']?></td>
                                 <td><?= $row['Date']?></td>
                             </tr>
                             <?php
                         }
                     }

                    }
                    elseif(isset($_GET['life']))
                    {
                        $con=mysqli_connect('localhost','root','8093391881','assignment');
                        $sort_love = "";
                        if(isset($_GET["life1"]))
                        {
                            if($_GET["life1"]=="0-1 years")
                            {
                               $sort_love = "0-1 years";
                            }
                            elseif($_GET["life1"]=="1-5 years")
                            {
                               $sort_love = "1-5 years";
                            }
                            elseif($_GET["life1"]=="5-10 years")
                            {
                               $sort_love = "5-10 years";
                            }
                            elseif($_GET["life1"]=="10+ years")
                            {
                               $sort_love = "10+ years";
                            }
                        }
                        $sql="SELECT * FROM animal WHERE Lifeexpectancy = '$sort_love' ";
                        $query_run=mysqli_query($con,$sql);

                     if(mysqli_num_rows($query_run)>0)
                     {
                        while ($row=mysqli_fetch_array( $query_run))
                        {
                             ?>
                             <tr>
                                 <td><?= $row['Name']?></td>
                                 <td><?= $row['Category']?></td>
                                 <td><img src="<?php echo $row['Image'];?>" height='100' width='100'></td>
                                 <td><?= $row['Description']?></td>
                                 <td><?= $row['Lifeexpectancy']?></td>
                                 <td><?= $row['Date']?></td>
                             </tr>
                             <?php
                         }
                     }

                    }
                     else
                     {
                         ?>
                         <tr>
                             <td colspan="6">choose the filter option</td>
                         </tr>
                         <?php
                     }
                     
                    ?>
                </tbody>
                <!-- body part end -->
            </table>
        </div>
</body>
</html>
<?php

// $con=mysqli_connect('localhost','root','8093391881','assignment');
// $sql="select Name,Category,Image,Description,Lifeexpectancy from animal";
// $output=mysqli_query($con,$sql);
// echo mysqli_num_rows($output);
// if(mysqli_num_rows($output)>0)
// {
//     echo'<table>';
//     echo'<tr>';
//     echo'<th> id </th>';
//     echo'<th> Name </th>';
//     echo'<th> Category </th>';
//     echo'<th> Image </th>';
//     echo'<th> Description </th>';
//     echo'<th> Lifeexpectancy </th>';
//     echo'</tr>';
// while ($row=mysqli_fetch_array($output))
//  {
//     echo'<tr>';
//     echo"<td>".$row['Name']."<td>".$row['Category']."<td><a href='$row[Image]'><img src='".$row['Image']."' height='100' width='100'></a>"."<td>".$row['Description']."<td>".$row['Lifeexpectancy'];
//     echo '</tr>';

// }
//     echo '</table>';
// }

?>