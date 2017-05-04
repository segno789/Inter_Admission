<footer>
    <p>
        &copy; BiseAdmin 2015
    </p>
</footer>

<!--Add the following script at the bottom of the web page (before </body></html>)-->


<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/bootstrap.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery.scrollUp.js"></script>
<script src="<?php echo base_url(); ?>assets/js/wysiwyg/bootstrap-wysihtml5.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.mask.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/alertify.min.js"></script>
<script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jquery.fancybox.pack.js"></script>
<script src="<?php echo base_url(); ?>assets/js/jquery-ui.js"></script>

<script type="">
    $(document).ready(function () {
        $('#data-table').dataTable({
            "sPaginationType": "full_numbers",
            "cache": false
        });
        $('#data-tablereg').dataTable({
            "sPaginationType": "full_numbers",
            "cache": false
        });
    });

</script>
<script type="">

    function move() {
        var elem = document.getElementById("myBar");   
        var elem2 = document.getElementById("bartxt");   
        var width = 0;
        var id = setInterval(frame, 2000);
        function frame() {
            if (width >= 100) {
                clearInterval(id);
            } else {
                width++; 
                elem.style.width = width + '%'; 
                elem2.innerText = width * 1  + '%';
            }
        }
    }



    function downloadgroupwise12(isdownload)
    {
        $('.mPageloader').show();
        //  $('.donwlaodingbar').show();
        //  move();
        window.location.href = '<?=base_url()?>RollNoSlip/InterRollNoGroupwise/'+$("#std_group").val()+'/'+isdownload

        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }

    function downloadslip_Inter(rno)
    {
        window.location.href = '<?=base_url()?>RollNoSlip/InterRollNo/'+rno+'/2'
    }


    function downloadslip11th(rno,isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>RollNoSlip/EleventhRollNo/'+rno+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function downloadgroupwise11th(isdownload)
    {
        $('.mPageloader').show();
        window.location.href = '<?=base_url()?>RollNoSlip/InterP1RollNoGroupwise/'+$("#std_group").val()+'/'+isdownload
        if(isdownload == 1)
        {
            $('.mPageloader').hide();
        }
    }
    function logout(){
        var msg = "Are you Sure You want to LOGOUT?"

        alertify.confirm(msg, function (e) {

            if (e) {
                // user clicked "ok"
                window.location.href ='<?php echo base_url(); ?>index.php/login/logout';
            } 
        });
    }
</script>


</body>
</html>