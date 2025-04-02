<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
function checkUsername() {
    
    jQuery.ajax({
    url: "admincustomeravailability.php",
    data:'username='+$("#username").val(),
    type: "POST",
    success:function(data){
        $("#check-username").html(data);
    },
    error:function (){}
    });
}


</script>