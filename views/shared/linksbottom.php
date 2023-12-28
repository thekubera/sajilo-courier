<!-- JQuery (JavaScript base library)-->
<script src="<?= URLROOT;?>/libraries/js/jquery.min.js"></script>

<!-- JS file of bootstrap -->
<script src="<?= URLROOT;?>/libraries/bootstrap/js/bootstrap.min.js"></script>

<!-- Popper js -->

<!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.6.0/umd/popper.min.js"></script> -->


<!-- Bootstrap Select plugin for country selector -->
<!-- <script type="text/javascript" src="<?= URLROOT;?>/libraries/bootstrapSelect/js/bootstrap-select.min.js"></script> -->

<!-- Data Table Bootstrap -->

<!-- <script type="text/javascript" src="<?= URLROOT;?>/libraries/dataTables/datatables.min.js"></script>

<script type="text/javascript" src="<?= URLROOT;?>/libraries/dataTables/js/dataTables.bootstrap4.js"></script> -->

<script type="text/javascript">
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
            $(this).toggleClass('active');
        });

        // for datatable 
        //$('#branchInfo').DataTable();
    });
</script>