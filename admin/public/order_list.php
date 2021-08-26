<?php require_once("../includes/Helpers/initialize.php"); ?>
<?php
//Activating our pagination system
//1. The current page number($current_page)
$page = !empty($_GET['page']) ? (int)$_GET['page']: 1;


//2. Records per page($per_page)
$per_page = 2;


//3. total record count ($total_count)
$total_count = Men::count_all();

//Find all photos
//use pagination instead
//$photos = Photograph::find_all();

$pagination = new Pagination($page, $per_page, $total_count);
//instead of finding all records, just find the record
//for this page
$sql  = "SELECT * FROM men ";
$sql .= "LIMIT {$per_page} ";
$sql .= "OFFSET {$pagination->offset()}";
$items = Men::find_by_sql($sql);

//Need to add ?page=$page to all links we want to
//maintain the current page (or store $page in session)


//Deleting Item
$item_control = new MenControl();
//Deleting Item
if($item_control->deleteItem()){
redirect_to('men_list.php');
}

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
                   Men Products List
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
                            <th>Item ID </th>
                            <th>Item Name</th>
                            <th>Price</th>
                            <th>Category</th>
                            <th>Date Stocked</th>
                          
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($items as $item): ?>
                            <tr data-expanded="true">
                                <td><?php echo $item->id; ?></td>
                                <td><?php echo $item->name; ?></td>
                                <td>#<?php echo $item->price; ?></td>
                                <td><?php echo $item->category; ?></td>
                                <td><?php echo $item->stock_date; ?></td>
                            
                                <td><a href="men_update.php?key=<?php echo $item->id;?>"><button type="submit" class="btn btn-send">View</button></a> </td>
                                <td><a href="men_list.php?del_key=<?php echo $item->id;?>"><button type="submit" class="btn btn-danger">Delete</button></a></td>
                            </tr>

                        <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div id="pagination" style="clear: both; ">
                        <?php
                        if($pagination->total_pages() > 1){

                            if($pagination->has_prevoius_page()){
                                echo "<a href=\"men_list.php?page=";
                                echo $pagination->previous_page();
                                echo "\">&laquo; Previous</a> ";
                            }

                            for($i=1; $i <= $pagination->total_pages(); $i++){
                                if($i == $page){
                                    echo " <span class=\"selected\">{$i}</span> ";
                                } else {
                                    echo " <a href=\"men_list.php.?page={$i}\">{$i}</a> ";
                                }

                            }

                            if($pagination->has_next_page()){
                                echo "<a href=\"men_list.php?page=";
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
