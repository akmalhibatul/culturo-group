<script src="js/jquery-3.5.1.js"></script>
<script src="js/jquery.dataTables.min.js"></script>
<script src="js/dataTables.bootstrap5.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>

<script>
    $(document).ready(function() {
        $('#datatable').DataTable({
            paging: false,
            info: true,
            dom: 'Bfrtip',
            select: true,
            pageLength: 5,
            recordsTotal: 10,
        });
    });
</script>
</body>

</html>