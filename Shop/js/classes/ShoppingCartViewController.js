export default class ShoppingCart{
    
    getAllData()
    {
        //e.preventDefault();
        
        //svar formData = data;
        $.ajax(
        {
            url : "./php/ShoppingCartController.php",
            type: "GET",
            cache:false,
            data: {action:'get_data'},
            success:function(response)
            {
                $("#productData").html(response);
                //$("#input-id").starRating();
            }
        });
        
    }
    buy(e,data)
    {
        e.preventDefault();
        var formData = data;
        if ( !($("#customRadio1").is(':checked')) && !($("#customRadio2").is(':checked')) ) 
        { 
            alert('You must select shipping type');   
            return;  
        }

        $.ajax(
        {
            url : "./php/ShoppingCartController.php",
            type:"POST",
            cache:false,
            data: formData,
            success:function(response)
            {
                data = JSON.parse(response);
                if (data.error == "1") 
                {
                    $('.message-message').replaceWith('<div class="alert alert-danger alert-dismissible" role="alert">'
                    + data.message + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }
                else
                {
                    window.location.replace("billingInvoice.php");
                }
            }
        });

       
    }
    getAllRate(e,id_product)
    {
        let str1='./php/ShoppingCartController.php?product=';
        let url=str1.concat(id_product);
        $.ajax(
        {
            
            url :url ,
            type: "GET",
            cache:false,
            data: {action:'get_rate'},
            success:function(response)
            {
                $("#productData").html(response);
                //$("#input-id").starRating();
            }
        });
        
    }
    registerOpinon(e,data,id_product)
    {
        e.preventDefault();
        var formData = data;
        let str1='./php/ShoppingCartController.php?product=';
        let url=str1.concat(id_product);
        
        $.ajax(
        {
            url : url,
            type: "POST",
            cache:false,
            data: formData,
            success:function(response)
            {
                data = JSON.parse(response);
                if (data.error == "1") 
                {
                    $('.message-message').replaceWith('<div class="alert alert-danger alert-dismissible" role="alert">'
                    + data.message + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }
                else
                {
                    $('.message-message').replaceWith('<div class="alert alert-success alert-dismissible" role="alert">'
                    + data.message + ' <button type="button" class="close" data-dismiss="alert">&times;</button></div>');
                }
            }
        });
        
        
    }

};