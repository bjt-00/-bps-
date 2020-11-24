<?php 
$viewMode = (isset($_GET['viewMode'])?$_GET['viewMode']:'default');
?>
<style>
@media print {
            @page {
                margin-bottom: .5em;
                margin-left: .5em;
                margin-right: .5em;
                margin-top: .5em;
                size: A4;
                size: portrait;
            }
        }
</style>
<input type="hidden" id="viewMode2" value="<?php echo $viewMode;?>">
<!-- table table-bordered -->
<table class="display cell-border compact nowrap" id="userTable" width="100%">
    <thead>
        <tr>
            <th>ID</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Role</th>
            <th>Store Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        
    </tbody>
    <tfoot>
      <tr>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </tr>
    </tfoot>
</table>



   <!-- Page level custom scripts -->
  <script src="js/bpos/bpos-user-datatable.js"></script>

  