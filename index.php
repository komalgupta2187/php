<?php
include 'DBController.php';
$db_handle = new DBController();
//$productResult = $db_handle->runQuery("select * from tbl_products");
$date=$_POST["date"];
$productResult = $db_handle->runQuery("SELECT * from registered_users WHERE date='$date' ");


if (isset($_POST["export"])) {
    $filename = "Export_excel.xls";
    header("Content-Type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=\"$filename\"");
    $isPrintHeader = false;
    if (! empty($productResult)) {
        foreach ($productResult as $row) {
            if (! $isPrintHeader) {
                echo implode("\t", array_keys($row)) . "\n";
                $isPrintHeader = true;
            }
            echo implode("\t", array_values($row)) . "\n";
        }
    }
    exit();
}
?>
<html>
<head>

<style>
body {
    font-size: 0.95em;
    font-family: arial;
    color: #212121;
}

th {
    background: #E6E6E6;
    border-bottom: 1px solid #000000;
}

#table-container {
    width: 850px;
    margin: 50px auto;
}

table#tab {
    border-collapse: collapse;
    width: 100%;
}

table#tab th, table#tab td {
    border: 1px solid #E0E0E0;
    padding: 8px 15px;
    text-align: left;
    font-size: 0.95em;
}

.btn {
    padding: 8px 4px 8px 1px;
}
#btnExport {
    padding: 10px 40px;
    background: #499a49;
    border: #499249 1px solid;
    color: #ffffff;
    font-size: 0.9em;
    cursor: pointer;
}
</style>
</head>
   
<body>
    <div id="table-container">
        <table id="tab">
            <thead>
                <tr>
                    <th width="35%">FirstName</th>
                    <th width="20%">LastName</th>
                    <th width="25%">Email</th>
                    <th width="20%">Date</th>
                </tr>
            </thead>
            <tbody>
 
            <?php
            if (! empty($productResult)) {
                foreach ($productResult as $key => $value) {
                    ?>
                 
                     <tr>
                    <td><?php echo $productResult[$key]["first_name"]; ?></td>
                    <td><?php echo $productResult[$key]["last_name"]; ?></td>
                    <td><?php echo $productResult[$key]["email"]; ?></td>
                    <td><?php echo $productResult[$key]["date"]; ?></td>
                </tr>
             <?php
                }
            }
            ?>
      </tbody>
        </table>

        <div class="btn">
            <form action="" method="post">
                <button type="submit" id="btnExport"
                    name='export' value="Export to Excel"
                    class="btn btn-info">Export to Excel</button>
                <table border="0" width="500" align="center" class="demo-table">
<td>Date</td>
<td><input type="date" class="demoInputBox" name="date" value="<?php if(isset($_POST['date'])) echo $_POST['date']; ?>"></td>
</tr>
                <tr>
<td colspan=2>
<input type="checkbox" name="terms"> I accept Terms and Conditions <input type="submit" name="register-user" value="Register" class="btnRegister"></td>
</tr>
    
</table>

            </form>
        </div>
    </div>
</body>
</html>