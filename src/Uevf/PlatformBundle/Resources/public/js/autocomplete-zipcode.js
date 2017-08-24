$(document).ready(function(){
    function autocomplete(){
        var input = txt_zipcode.val();
        if(input.length >= 2){
            $.ajax({
                type: "post",
                url: ROOT_URL,
                data: {input: input},
                success: function(response){
                    $.each( response.citylist, function( i, city ) {
                        if(i == 0){
                            txt_zipcode.val(city.zipcode);
                        }
                        cityList.append($('<option>',{value: city.name, text: city.name, zipcode: city.zipcode}));
                    });
                },
                error:function(err){
                    alert("something is wrong!!!")
                }
            });
        }
    }
    autocomplete();
    txt_zipcode.on('change',function(){
        cityList.empty();
        autocomplete();
    });

    cityList.on('change',function(){
        var zipcode = $("option:selected",this).attr("zipcode");
        txt_zipcode.val(zipcode);
    });
 });
