$(document).ready(function(){

    var ajaxConfig = {
        method:"GET",
        url:"api/customers.php",
        data:{
            action:"count"
        },
        async:true
    }

    $.ajax(ajaxConfig).done(function(response){
        $("#lblCustomersCount").text(response);
    });


    var ajaxConfig = {
        method:"GET",
        url:"api/vehicle.php",
        data:{
            action:"count"
        },
        async:true
    }

    $.ajax(ajaxConfig).done(function(response){
        $("#lblVehicleCount").text(response);
    });


    var ajaxConfig = {
        method:"GET",
        url:"api/rent.php",
        data:{
            action:"count"
        },
        async:true
    }

    $.ajax(ajaxConfig).done(function(response){
        $("#lblRentCount").text(response);
    });

});