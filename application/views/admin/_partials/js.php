<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/jquery/jquery.min.js') ?>"></script>
<script src="<?php echo base_url('assets/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/jquery-easing/jquery.easing.min.js') ?>"></script>
<!-- Page level plugin JavaScript-->
<!-- <script src="<?php echo base_url('assets/chart.js/Chart.min.js') ?>"></script> -->
<script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
<script src="<?php echo base_url('assets/datatables/dataTables.bootstrap4.js') ?>"></script>
<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('js/sb-admin.min.js') ?>"></script>
<!-- Demo scripts for this page-->
<script src="<?php echo base_url('js/demo/datatables-demo.js') ?>"></script>
<!-- <script src="<?php echo base_url('js/demo/chart-area-demo.js') ?>"></script> -->


<!-- js for clockpicker-->
<script src="<?php echo base_url('js/bootstrap-clockpicker.min.js') ?>"></script>

<!-- js for select2-->
<script src="<?php echo base_url('js/select2.min.js') ?>"></script>

<!-- js for highstock -->
<script src="https://code.highcharts.com/stock/highstock.js"></script>
<script src="https://code.highcharts.com/stock/modules/exporting.js"></script>

<!-- jquery ui for datepicker-->
<script src="<?php echo base_url('js/jquery-ui-1.10.1.custom.min.js') ?>"></script>

<script>
$(document).ready(function(){
    //var strnotif = "<a class='dropdown-item' href='#'>Actionbbbbbb</a> <a class='dropdown-item' href='#'>Another action</a>";
    //$('.dropdown-menu-notif').html(strnotif);
    //$('.count').html(34);

    function load_unseen_notification(view = '')
    {
    $.ajax({
    url:"<?php echo site_url('admin/notif_bk/fetch')?>",
    method:"POST",
    data:{view:view},
    dataType:"json",
    success:function(data)
    {
        $('.dropdown-menu-notif').html(data.notification);
        if(data.unseen_notification > 0)
        {
        $('.count').html(data.unseen_notification);
        }
    }
    });
    }
    
    load_unseen_notification();

    $(document).on('click', '.dropdown-toggle-clicker', function(){
        $('.dropdown-toggle-bell').html('');
        load_unseen_notification('yes');
    });

    setInterval(function(){
        load_unseen_notification();; 
    }, 5000);

});
</script>