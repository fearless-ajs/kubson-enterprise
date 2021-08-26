<?php require_once("../includes/Helpers/initialize.php"); ?>
<?php
//Activating our pagination system
//1. The current page number($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page']: 1;


//2. Records per page($per_page)
$per_page = 2;


//3. total record count ($total_count)
$total_count = Customers::count_all();

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$pagination = new Pagination($page, $per_page, $total_count);
//instead of finding all records, just find the record
//for this page
$sql  = "SELECT * FROM customers ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$staffs = Customers::find_by_sql($sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)


//Deleting Ward
$staff = new CustomersControl();
$staff->deleteStaff();
?>


<?php if(!empty($_GET['msg'])){ ?>
    <script type="text/javascript">
        alert("<?php echo $_GET['msg']; ?>");
    </script>
<?php  } ?>

<?php  include_layout_template("header.php"); ?>
<?php  include_layout_template("sidebar.php"); ?>

<section id="main-content" style="background-image: url(images/ban2.jpg); background-repeat: no-repeat; background-size: cover;">
    <section class="wrapper">

        <!-- The list section-->
        <div class="table-agile-info">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Customers Information
                </div>
                <div>
                    <table class="table" ui-jq="footable" ui-options='{
        "paging": {
          "enabled": true
        },
        "filtering": {
          "enabled": true
        },
        "sorting": {
          "enabled": true
        }}'>
                        <thead>
                        <tr>

                            <th>ID</th>
                            <th>Full Name</th>
                            <th>email</th>
                            <th>Phone Number</th>
                      
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($staffs as $staff): ?>
                            <tr data-expanded="true">
                                <td><?php echo $staff->id; ?></td>
                                <td><?php echo $staff->fullname; ?></td>
                                <td><?php echo $staff->email; ?></td>
                                <td><?php echo $staff->phone; ?></td>
                        
                                <td><a href="customers_update.php?key=<?php echo $staff->id;?>"><button type="submit" class="btn btn-send">Update Info</button></a> </td>
                                <td><a href="customers_list.php?key=<?php echo $staff->id;?>"><button type="submit" class="btn btn-danger">Delete</button></a></td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div id="pagination" style="clear: both; ">
                        <?php
                        if($pagination->total_pages() > 1){

                            if($pagination->has_prevoius_page()){
                                echo "<a href=\"customers_list.php?page=";
                                echo $pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $pagination->total_pages(); $i++){
                                if($i == $page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"customers_list.php.?page={$i}\">{$i}</a> ";
                                }

                            }

                            if($pagination->has_next_page()){
                                echo "<a href=\"customers_list.php?page=";
                                echo $pagination->next_page();
                                echo "\">&raquo; Next</a> ";
                            }

                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>





    </section>
    <?php include_layout_template("footer.php"); ?>


