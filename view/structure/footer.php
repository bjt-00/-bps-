      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; <a href="https://www.bitguiders.com" target="_new">bitguiders</a> 2020</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
      
        <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="rest/services/security.php?logout">Logout</a>
        </div>
      </div>
    </div>
  </div>
      
  <!-- User Modal-->
  <div class="modal fade" id="userFormModal" tabindex="-1" role="dialog" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="userModalLabel">User Details</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
           <?php include 'view/contents/user/userForm.php';?>
        </div>
        <div class="modal-footer">
          <input type="button" id="userFormPopupActionButton" class="btn btn-info" value="Add" >
          <button onclick="location.reload()" class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
  <script src="js/bpos/bpos-user-form.js"></script>
      
         <!-- datatable -->
  <script src="js/datatables/jquery.dataTables.min.js"></script>
  <!-- script src="js/datatables/dataTables.bootstrap4.min.js"></script-->
    <!-- datatable buttons -->  
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
    <!-- datatable pdf support -->  
   	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
      