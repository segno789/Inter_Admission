
<h1 align="center"> Download Your Admission Form</h1>
<form enctype="multipart/form-data" id="ReturnStatus" name="ReturnStatus" method="post" action="<?php echo base_url(); ?>index.php/Admission/checkFormNo_then_download/<?php echo @$msg; ?>" >
    <div class="form-group">
        <div class="row">
            <h2 align="center">Your Form No.<?php echo @$msg; ?> </h2>
        </div>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-offset-2 col-md-4">
                <input type="submit" value="Download" id="btnDownloadForm" class="btn btn-primary btn-block">
            </div>
            <div class="col-md-4">
                <input type="button" class="btn btn-danger btn-block" value="Cancel" id="btnCancel" name="btnCancel" onclick="return CancelAlert();" >
            </div>
        </div>
    </div>
</form>
<script type="text/javascript">
    var formno = '<?php echo @$msg; ?>';
    function CancelAlert()
    {
        var msg = "Are You Sure You want to Cancel this Form ?"
        alertify.confirm(msg, function (e) {
            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>index.php/Admission/';
            } else {
                // user clicked "cancel"
            }
        });
    }
</script>