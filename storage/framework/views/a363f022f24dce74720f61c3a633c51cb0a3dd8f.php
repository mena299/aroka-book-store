<!-- jQuery -->
<script src="<?php echo url('js/jquery.js'); ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.4/js/tether.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="<?php echo url('js/bootstrap.min.js'); ?>"></script>

<!-- Morris Charts JavaScript -->
<script src="<?php echo url('js/plugins/morris/raphael.min.js'); ?>"></script>
<script src="<?php echo url('js/plugins/morris/morris.min.js'); ?>"></script>
<script src="<?php echo url('js/plugins/morris/morris-data.js'); ?>"></script>


<script type="text/javascript">
    /*search Data*/
    function js_searchData(part) {
        location = part + "?search=" + encodeURIComponent($("#search").val());

        if ($("#search").val().trim() == "") {
            location = part;
        }

        return false;
    }
</script>
<?php /**PATH /home/vagrant/code/aroka-book-store/resources/views/layout/js.blade.php ENDPATH**/ ?>