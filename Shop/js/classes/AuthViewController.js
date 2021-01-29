export default class Auth{
    register(e,data)
    {
        e.preventDefault();
        
        var formData = data;
        $.ajax(
        {
            url : "./php/AuthController.php",
            type: "POST",
            cache:false,
            data: formData,
            success:function(response)
            {
              data = JSON.parse(response);
              if (data.error == "0") 
              {
                $("#signupForm").trigger("reset");
                $('.message-message').replaceWith('<div class="alert alert-success alert-dismissible" role="alert">'
                 + data.message + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
              }
              else if(data.error == "1") 
              {
               $('.message-message').replaceWith('<div class="alert alert-danger alert-dismissible" role="alert">'
                 + data.message + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
              }
            }
        });
        
    }
    login(e,formData)
    {
        e.preventDefault();

        
        $.ajax(
        {
            url : "./php/AuthController.php",
            type:"POST",
            cache:false,
            data: formData,
            success:function(response)
            {
                if(response == '1') 
                {
                    window.location.replace("shoppingCart.php");
                }
                else if(response=='0')
                {
                      $(".show-message").show();
                      $(".ajax-message").text('Email or Password is Invalid');
                }
            }
        });

       
    }

};