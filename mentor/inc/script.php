    <script src="vendors/jquery/dist/jquery.min.js"></script>
    <script src="vendors/popper.js/dist/umd/popper.min.js"></script>
    <script src="vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/js/main.js"></script>


    <script src="vendors/chart.js/dist/Chart.bundle.min.js"></script>
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/widgets.js"></script>
    <script src="vendors/jqvmap/dist/jquery.vmap.min.js"></script>
    <script src="vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
    <script src="vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>

    <!-- DATATABLES -->
    <script src="../admin/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../admin/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <!-- jQuery -->
    <!-- <script src="../admin/plugins/jquery/jquery.min.js"></script> -->
    <!-- jQuery UI 1.11.4 -->
    <script src="../admin/plugins/jquery-ui/jquery-ui.min.js"></script>  

    <script>
        (function($) {
            "use strict";

            jQuery('#vmap').vectorMap({
                map: 'world_en',
                backgroundColor: null,
                color: '#ffffff',
                hoverOpacity: 0.7,
                selectedColor: '#1de9b6',
                enableZoom: true,
                showTooltip: true,
                values: sample_data,
                scaleColors: ['#1de9b6', '#03a9f5'],
                normalizeFunction: 'polynomial'
            });
        })(jQuery);
    </script>

    <!-- DATA TABLE INSTALLATION -->
    <script>
        (function($){
            jQuery('#courses').DataTable( {
                order: [[1, 'desc']],
                rowGroup: {
                    dataSrc: 1
                }
            } );
        })(jQuery); 

        // Assignments
        (function($){
            jQuery('#assignments').DataTable( {
                order: [[1, 'desc']],
                rowGroup: {
                    dataSrc: 1
                }
            } );
        })(jQuery);
    </script>

</body>
</html>
