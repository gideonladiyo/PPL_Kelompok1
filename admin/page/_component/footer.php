<footer class="main-footer">
    <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
</footer>


<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<script>
$('#summernote').summernote({
    placeholder: 'Hello stand alone ui',
    tabsize: 2,
    height: 120,
    toolbar: [
        ['style', ['style']],
        ['font', ['bold', 'underline', 'clear']],
        ['color', ['color']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['table', ['table']],
        ['insert', ['link', 'picture', 'video']],
        ['view', ['fullscreen', 'codeview', 'help']]
    ]
});
$(document).ready(function() {
    $('#summernote').summernote({
        height: 300,
        theme: 'bs4-dark'
    });
});
</script>
<!-- jQuery -->
<script src="../../src/admin/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../src/admin/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../src/admin/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../src/admin/js/demo.js"></script>

</body>

</html>