$(document).ready(loadAvailables);

function loadAvailables(){
    var ajaxconfig ={
        method:"GET",
        url:"api/vehicle.php?action=ava",
        async:true
    }
    $.ajax(ajaxconfig).done(function(response){
        var vehicleArray;
        response.forEach(function(vehicle){
            var html = "<tr>" +
                "<td>" + vehicle.vID + "</td>" +
                "<td>" + vehicle.vNo + "</td>" +
                "<td>" + vehicle.category + "</td>" +
                "<td>" + vehicle.brand + "</td>" +
                "<td>" + vehicle.vRate + "</td>"
                // '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";


            $("#tblRentVehicle tbody").append(html);
        });



        $("#tblRentVehicle tbody tr").click(function (){
            console.log("row ekak ebuva")
            var vID = ($(this).find("td:first-child").text());
            console.log(vID);
            $("#vID").val(vID);

        });



    });
}


$("#btnadd").click(function () {
    var cusID = $("#cID").val();
    var vehiID = $("#vID").val();
    var fromDate = $("#fromDate").val();
    var toDate = $("#toDate").val();
    var rentalState = "continue";

    var ajaxconfig2 = {
        method:"POST",
        url:"api/rent.php",
        data:{
            action:"save",
            cID:cusID,
            vID:vehiID,
            rentalState:rentalState,
            rentFrom:fromDate,
            rentTo:toDate
        },
        async:true
    }
    $.ajax(ajaxconfig2).done(function (response) {
        console.log("vada kala save eka");
        if(response == true){
            var status = "busy";
            var ajaxconfig3 = {
                method: "POST",
                url: "api/vehicle.php",
                data: {
                    action: "updateState",
                    vID: vehiID,
                    state: status
                },
                async: true
            }
            $.ajax(ajaxconfig3).done(function (response) {
                console.log("")
                if (response === true) {
                    $("#tblRentVehicle > tbody").html("");
                    loadAvailables();
                    alert("YOur Booking is successfull.");
                }else{
                    alrt("transaction Failed.please select Again");
                }
            });
        }else{
            alert("please select different Vehicle.");
        }


    });
})