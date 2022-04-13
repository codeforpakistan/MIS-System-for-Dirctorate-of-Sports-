<footer class="main-footer">
        <div class="footer-left">
          <strong style="color:#000;"> &copy; 2020-2021 <a href="https://codeforpakistan.org/" target="_blank"><span style="color:#000;">Code For pakistan/</span></a>.</strong><span style="color:#000;font-weight: bold;">
    All rights reserved.</span>
          <img src="assets/images/kpitb.png" style="width:30%;width:30%;padding: 0px 10px">
          <img src="assets/images/Code_for_Pakistan.png" style="width:20%;width:20%">
        </div>
      </footer>
    </div>
  </div>
  <!-- General JS Scripts -->
  <script src="assets/js/app.min.js"></script>
  <!-- JS Libraies -->
  <script src="assets/bundles/datatables/datatables.min.js"></script>
  <script src="assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="assets/bundles/jquery-ui/jquery-ui.min.js"></script>

  <script src="assets/bundles/cleave-js/dist/cleave.min.js"></script>
  <script src="assets/bundles/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="assets/bundles/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="assets/bundles/bootstrap-daterangepicker/daterangepicker.js"></script>

  <script src="assets/bundles/select2/dist/js/select2.full.min.js"></script>

  <script src="assets/bundles/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <!-- Page Specific JS File -->
   <script src="assets/js/page/datatables.js"></script>
  <!-- Template JS File -->
  <script src="assets/js/scripts.js"></script>
  <script src="assets/bundles/izitoast/js/iziToast.min.js"></script>
  <script type="text/javascript" src="https://jeremyfagis.github.io/dropify/dist/js/dropify.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://jeremyfagis.github.io/dropify/dist/css/dropify.min.css">
  <!-- Custom JS File -->
  <script src="assets/js/custom.js"></script>
  <script src="breadcrumb_assets/script.js"></script>
  <script src="assets/js/jquery.inputmask.bundle.js"></script>

  <script src="assets/bundles/apexcharts/apexcharts.min.js"></script>
  <!-- Page Specific JS File -->
  <script src="assets/js/page/chart-apexcharts.js"></script>
  
 
</body>
<style type="text/css">
  .select2-container--default .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: #888 transparent transparent transparent;
    border-style: solid;
    border-width: 5px 4px 0 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}

.select2-container--open .select2-selection--multiple:before {
    content: ' ';
    display: block;
    position: absolute;
    border-color: transparent transparent #888 transparent;
    border-width: 0 4px 5px 4px;
    height: 0;
    right: 6px;
    margin-left: -4px;
    margin-top: -2px;top: 50%;
    width: 0;cursor: pointer
}
</style>


<!-- index.html  21 Nov 2019 03:47:04 GMT -->
</html>

<script>
    
   function onlyCNIC(obj, evt) {
    
    obj.on('paste', function(e){
        /// v variable have paste value
        //var v = e.originalEvent.clipboardData.getData('Text');
        return false;
        obj.val('');       
    });
    
    var charCode = (evt.which) ? evt.which : event.keyCode;
    
    if(obj.val().length < 15)
    {
        if(onlyDigits(charCode))
        {
            if(obj.val().length == 5 || obj.val().length == 13)
                obj.val(obj.val()+'-');
        }
        else
            return false;
    }
    else
        return false;
}



//// only digits function
function onlyDigits(charCode)
{
    
    if(charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }    
    else
    {
        return true;
    }
}

 function onlyNumber(obj, evt) {
   
    obj.on('paste', function(e){
        /// v variable have paste value
        //var v = e.originalEvent.clipboardData.getData('Text');
        return false;
        obj.val('');       
    });
    
    var charCode = (evt.which) ? evt.which : event.keyCode;
    
   
     return  onlyDigits(charCode);
      
    }
    
//// only digits function
function onlyDigits(charCode)
{
    
    if(charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }    
    else
    {
        return true;
    }
}

function message(status,response_msg)
{
    if(status == 1)
    {
        
        iziToast.success({
        title: 'Success:',
        message: response_msg,
        position: 'topRight'
        });
    }
    else
    { 
    iziToast.error({
        title: 'Error:',
        message: response_msg,
        position: 'topRight'
        });

    }
}
</script>


</script>