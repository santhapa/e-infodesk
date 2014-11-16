<script src="js/jquery.js"></script>
<!-- Jquery for select option of view_schedule.php page -->
    <script type="text/javascript">

        $(document).ready(function(){
    
            $("#viewType").change(function() {
    
                if ($("#viewType").val()==1)
                {
                    $("#department").show();
                    $("#lblDepartment").show();
                    $("#level").hide();
                    $("#lblLevel").hide();
                    $("#section").hide();
                    $("#lblSection").hide();
                }
                                        
                else if($("#viewType").val()==2)
                {                    
                    $("#level").show();
                    $("#lblLevel").show();
                    $("#department").hide();
                    $("#lblDepartment").hide();
                    $("#section").hide();
                    $("#lblSection").hide();
                }

                else if($("#viewType").val()==3)
                {                    
                    $("#department").show();
                    $("#lblDepartment").show();
                    $("#level").show();
                    $("#lblLevel").show();
                    $("#section").show();
                    $("#lblSection").show();
                }

                else
                {
                    $("#department").hide();
                    $("#lblDepartment").hide();
                    $("#level").hide();
                    $("#lblLevel").hide();
                    $("#section").hide();
                    $("#lblSection").hide();
                }
    
            });

            $("#viewType").change();
    
        });
         
    </script>


     <!-- Jquery for show upload image option of edit_delete_schedule.php page or update schedule -->
    <script type="text/javascript">
        $('#changeImage').click(function() 
        {
            $('#showImage').show();
        });
        
        $('#showImage').hide();


        $(document).ready(function(){
    
            $("#department").change(function() {
    
                if ($("#department").val()=="BARCH")
                {
                    $("#archLevel").show();
                }
                                                
            });
            $("#archLevel").hide();  
            $("#viewType").change();
    
        });
    </script>



    <!-- Jquery for select option of add_user.php page -->
    <script type="text/javascript">

        $(document).ready(function(){
    
            $("#userType").change(function() {
    
                if ($("#userType").val()==1 || $("#userType").val()==2 || $("#userType").val()==3)
                {
                    $("#username").show();
                    $("#password").show();
                    $("#fname").show();
                    $("#lname").show();
                    $("#email").show();
                    $("#contact").show();
                    $("#image").show();
                }

                else
                {
                    $("#username").hide();
                    $("#password").hide();
                    $("#fname").hide();
                    $("#lname").hide();
                    $("#email").hide();
                    $("#contact").hide();
                    $("#image").hide();
                }

                if ($("#userType").val()==2 || $("#userType").val()==3)
                {
                    $("#dob").show();
                    $("#permAddress").show();
                    $("#tempAddress").show(); 
                }

                else
                {
                    $("#dob").hide();
                    $("#permAddress").hide();
                    $("#tempAddress").hide();
                }
                                        
                if($("#userType").val()==2)
                {                    
                    $("#batch").show();
                    $("#departmentStudent").show();
                    $("#roll").show();
                    $("#fatherName").show();
                    $("#motherName").show();
                    $("#guardianName").show();
                }

                else
                {
                    $("#batch").hide();
                    $("#departmentStudent").hide();
                    $("#roll").hide();
                    $("#fatherName").hide();
                    $("#motherName").hide();
                    $("#guardianName").hide();
                }

                if($("#userType").val()==3)
                {                    
                    $("#departmentStaff").show();
                    $("#jobPosition").show();
                    $("#workTime").show();
                    $("#bio").show();
                }

                else
                {
                    $("#departmentStaff").hide();
                    $("#jobPosition").hide();
                    $("#workTime").hide();
                    $("#bio").hide();
                }

    
            });

           
            
            $("#userType").change();
    
        });
        
         
    </script>

<!-- user availability checking js-->

    <script type="text/javascript">
        $(document).ready(function()//When the dom is ready 
        {
            $("#inputUsername").change(function() 
            { 
                //if theres a change in the username textbox

                var username = $("#inputUsername").val();//Get the value in the username textbox
               
                
                if(username.length < 5)//if the lenght greater than 3 characters
                {
                    $("#user_status").html('Username too short. Must be 5 characters long.');
                    //if in case the username is less than or equal 3 characters only 
                }
                else
                    $("#user_status").html('*');

                return false;
            });
    });
</script>


<!-- useename short checking js-->

    <script type="text/javascript">
        $(document).ready(function()//When the dom is ready 
        {
            $("#inputusername").change(function() 
            { 
                //if theres a change in the username textbox

                var username = $("#inputusername").val();//Get the value in the username textbox
               
                
                if(username.length < 5)//if the lenght greater than 3 characters
                {
                    $("#username_status").html('Username too short. Must be 5 characters long.');
                    //if in case the username is less than or equal 3 characters only 
                }
                else
                    $("#username_status").html('');

                return false;
            });

            $("#inputrepassword").change(function() 
            {
                var password= $("#inputpassword").val();
                var repassword = $("#inputrepassword").val();

                if(repassword!=password)
                {
                    $("#repassword_status").html('Password mismatch. Re-enter your password.');
                }
                else
                    $("#repassword_status").html('');
                return false;

            });
    });
</script>


<!--js for view_user.php to hide and show options on selecting user-->
    <script type="text/javascript">
        $(document).ready(function(){
    
            $("#viewUserType").change(function() 
            {
                if ($("#viewUserType").val()==1 || $("#viewUserType").val()==2 ||$("#viewUserType").val()==3)
                {
                    $("#viewUserAll").hide();
                }
                else
                    $("#viewUserAll").show();     

                
                if ($("#viewUserType").val()==1)
                {
                    $("#viewAdmin").show();
                }
                else
                    $("#viewAdmin").hide();

                if ($("#viewUserType").val()==2)
                {
                    $("#viewStudent").show();
                }
                else
                    $("#viewStudent").hide();
                      
                if ($("#viewUserType").val()==3)
                {
                    $("#viewStaff").show();
                }
                else
                    $("#viewStaff").hide();
            });
            $("#viewUserType").change();
            $("#updateUser").hide();
    
        });

        $('#changeUserImage').click(function() 
        {
            $('#showUserImage').show();
        });
        
        $('#showUserImage').hide();
    </script>




    <!--Sms length checker-->
    <script type="text/javascript">

    //for admin
    $(document).ready(function(){
        var $remaining = $('#remainingAd'),
        $messages = $remaining.next();

        $('#inMessageAd').keyup(function(){
        var chars = this.value.length,
            messages = Math.ceil(chars / 142),
            remaining = messages * 142 - (chars % (messages * 142) || messages * 142);

            if(remaining==0)
                $remaining.text('142 characters remaining');

            else
                $remaining.text(remaining + ' characters remaining');
        
        });
    });

    //For staff

    $(document).ready(function(){
        var $remaining = $('#remainingStf'),
        $messages = $remaining.next();

        $('#inMessageStf').keyup(function(){
        var chars = this.value.length,
            messages = Math.ceil(chars / 142),
            remaining = messages * 142 - (chars % (messages * 142) || messages * 142);

        if(remaining==0)
                $remaining.text('142 characters remaining');

        else
            $remaining.text(remaining + ' characters remaining');
        
        });
    });

    //For Student

    $(document).ready(function(){
        var $remaining = $('#remainingSt'),
        $messages = $remaining.next();

        $('#inMessageSt').keyup(function(){
        var chars = this.value.length,
            messages = Math.ceil(chars / 142),
            remaining = messages * 142 - (chars % (messages * 142) || messages * 142);

            if(remaining==0)
                $remaining.text('142 characters remaining');

            else
                $remaining.text(remaining + ' characters remaining');
        
        });
    });


    //For sms test
    $(document).ready(function(){
        var $remaining = $('#remaining'),
        $messages = $remaining.next();

        $('#inMessage').keyup(function(){
        var chars = this.value.length,
            messages = Math.ceil(chars / 140),
            remaining = messages * 140 - (chars % (messages * 140) || messages * 140);

            if(remaining==0)
                $remaining.text('140 characters remaining');

            else
                $remaining.text(remaining + ' characters remaining');
        
        });
    });

</script>

<!--Sms sidebar show hide-->

    <script type="text/javascript">
        $(document).ready(function(){
    
            $("#inTypeAd").change(function() 
            {
                if ($("#inTypeAd").val()==2)
                {
                    $("#side-barAd").show();
                }
                else
                {
                    $("#side-barAd").hide();
                }
                    
            });
            $("#inTypeAd").change();

            $("#inTypeStf").change(function() 
            {
                if ($("#inTypeStf").val()==3)
                {
                    $("#side-barStf").show();
                }
                else
                {
                    $("#side-barStf").hide();
                }

                if ($("#inTypeStf").val()==2)
                {
                    $("#deptStaff").show();
                }
                else
                {
                    $("#deptStaff").hide();
                }
                    
            });
            $("#inTypeStf").change();


            $("#inTypeSt").change(function() 
            {
                if ($("#inTypeSt").val()==4)
                {
                    $("#side-barSt").show();
                }
                else
                {
                    $("#side-barSt").hide();
                }

                if ($("#inTypeSt").val()==2 || $("#inTypeSt").val()==3)
                {
                    $("#deptStudent").show();
                }
                else
                {
                    $("#deptStudent").hide();
                }

                if ($("#inTypeSt").val()==3)
                {
                    $("#level").show();
                }
                else
                {
                     $("#level").hide();
                }
                    
            });
            $("#inTypeSt").change();

            $("#dept").change(function() 
            {
                if ($("#dept").val()=="BARCH")
                {
                    $("#arcLevel").show();
                }                    
            });
             $("#arcLevel").hide();

        });

       
    </script>

    <!--Note comment click option-->
    <script type="text/javascript">
        $('#comment-click').click(function() 
        {
            $('#comment-box').show();
        });
        
        $('#comment-box').hide();
    </script>


