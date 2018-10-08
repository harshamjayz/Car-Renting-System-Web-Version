$(document).ready(loadAllVehicles);

function loadAllVehicles(){

    var ajaxConfig = {
        method: "GET",
        url:"api/vehicle.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        console.log("vehicle load eka wada kla");
        response.forEach(function (vehicle){
            var html = "<tr>" +
                "<td>" + vehicle.vID + "</td>" +
                "<td>" + vehicle.vNo + "</td>" +
                "<td>" + vehicle.category + "</td>" +
                "<td>" + vehicle.brand + "</td>" +
                "<td>" + vehicle.vRate + "</td>" +
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";

            $("#tblVehicle tbody").append(html);

            $(".recycle").off();
            $(".recycle").click(function(){

                var vID = ($(this).parents("tr").find("td:first-child").text());
                console.log(vID);

                if (confirm("Are you sure that you want to delete?")){

                    $.ajax({
                        method:"DELETE",
                        url:"api/vehicle.php?vID="+vID,
                        // data:{
                        //     vID: vID
                        // },
                        async: true
                    }).done(function(response){
                        if (response){
                            alert("Vehicle has been successfully deleted");
                            $("#tblVehicle tbody tr").remove();
                            loadAllVehicles();
                        } else{
                            alert("Failed to delete the Vehicle");
                        }
                    });

                }

            });

        });

        $("#tblVehicle tbody tr").click(function (){
            console.log("row ekak ebuva")
            var vID = ($(this).find("td:first-child").text());
            console.log(vID);
            var ajaxconfig5 = {
                method: "GET",
                url:"api/vehicle.php",
                data:{
                    action:"one",
                    ID:vID
                },
                async:true
            }

            $.ajax(ajaxconfig5).done(function(response){
                $("#vID").val(response.vID);
                $("#vNo").val(response.vNo);
                $("#category").val(response.category);
                $("#brand").val(response.brand);
                $("#vRate").val(response.vRate);
            });
        });

    });

}

$("#btnadd").click(function(){

    console.log("Add button eka click una");
    var vID = $("#vID").val();
    var vNo = $("#vNo").val();
    var category = $("#category").val();
    var brand = $("#brand").val();
    var vRate = $("#vRate").val();
    var states = "free";
    var equal = false;
    console.log("--"+vID+"--")
    var ajaxConfig1 = {
        method: "GET",
        url:"api/vehicle.php?action=all",
        async: true
    };
    $.ajax(ajaxConfig1).done(function(response){
        console.log("for each ekata aava");
        response.forEach(function (vehicle){
            if(vID===(vehicle.vID)){
                equal = true;
                console.log("id deka samanai");
            }
        });

        if(equal == true) {
            console.log("update una");
            var ajaxconfig2 = {
                method: "POST",
                url: "api/vehicle.php",
                data: {
                    action: "update",
                    vID: vID,
                    vNo:vNo,
                    category: category,
                    brand:brand,
                    vRate: vRate,
                    state: states
                },
                async: true
            }
            $.ajax(ajaxconfig2).done(function (response) {
                console.log("done eka athulatath aava")
                if (response === true) {
                        $("#tblVehicle > tbody").html("");
                        loadAllVehicles();
                    alert("Vehicle has been updated succesfully.");
                } else {
                    alert("Something went wrong when updating   .");
                }

                $("#vID").val("");
                $("#vNo").val("");
                $("#category").val("");
                $("#brand").val("");
                $("#vRate").val("");

            });

        }
        else{
            console.log("save una");
            var ajaxconfig3 = {
                method: "POST",
                url: "api/vehicle.php",
                data: {
                    action: "save",
                    vID: vID,
                    vNo:vNo,
                    category: category,
                    brand:brand,
                    vRate: vRate,
                    state:states
                },
                async: true

            }

            $.ajax(ajaxconfig3).done(function (response) {

                if (response == true) {
                    $("#tblVehicle > tbody").html("");
                    loadAllVehicles();
                    alert("Vehicle has been saved succesfully.");
                } else {
                    alert("please enter a valid Vehicle ID.");
                }
                $("#vID").val("");
                $("#vNo").val("");
                $("#category").val("");
                $("#brand").val("");
                $("#vRate").val("");

            });

        }

    });

});

$("#btncancel").click(function(){

    console.log("cancel button eka click una");
    $("#vID").val("");
    $("#vNo").val("");
    $("#category").val("");
    $("#brand").val("");
    $("#vRate").val("");
});
