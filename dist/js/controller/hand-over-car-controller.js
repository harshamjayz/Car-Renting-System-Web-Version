$(document).ready(function () {
    loadAllRentalDetails();
});


function loadAllRentalDetails() {
    console.log("document ready eka fire una");
    var ajaxconfig = {
        method:"GET",
        url:"api/rent.php?action=all",
        async:true
    }

    $.ajax(ajaxconfig).done(function (response) {

        response.forEach(function (rental) {
            if(rental.rentalState === "continue"){
                var tbl = "<tr>" +
                    "<td>" + rental.cID + "</td>" +
                    "<td>" + rental.vID + "</td>" +
                    "<td>" + rental.rentFrom + "</td>" +
                    "<td>" + rental.rentTo + "</td>" +
                    "<td>" + rental.rentalState + "</td>" +
                    "</tr>";

                $("#tblrentalInfo tbody").append(tbl);
            }

        })

        $("#tblrentalInfo tbody tr").click(function (){
            console.log("row ekak ebuva")
            var cID = ($(this).find("td:nth-child(1)").text());
            var vID = ($(this).find("td:nth-child(2)").text());
             var fromDate = ($(this).find("td:nth-child(3)").text());
             var toDate = ($(this).find("td:nth-child(4)").text());
            var today = new Date().toISOString().slice(0,10);
            var vehicleRate;
            var panelty = 0;
            var total = 0;
            var rentdays;
            var paneltydays;

            vehicleRate = getvrent(vID);
            console.log(vehicleRate);
            rentdays = getnormalDays(fromDate,toDate);
            console.log(rentdays);
            paneltydays = getpaneltyDays(toDate,today);
            console.log(paneltydays);


            if(today > toDate){
                panelty = paneltydays*(vehicleRate+vehicleRate);
            }else{
                panelty = 0.00;
            }

            $("#paneltyFee").val(panelty);
            total = rentdays*vehicleRate+panelty;
            $("#totalAmount").val(total);

            var ajaxconfig5 = {
                method: "GET",
                url:"api/customers.php",
                data:{
                    action:"row",
                    id:cID
                },
                async:true
            }

            $.ajax(ajaxconfig5).done(function(response){
                $("#cID").val(response.cID);
                $("#nIC").val(response.nIC);
                $("#name").val(response.name);
                $("#vID").val(vID);


            });

        });
    })
}

function getvrent(vID){
    var vRate;
    var ajaxconfig = {
        method: "GET",
        url:"api/vehicle.php",
        data:{
            action:"one",
            ID:vID
        },
        async:false
    }
    $.ajax(ajaxconfig).done(function(response){
        vRate = parseFloat(response.vRate);
    });
    return vRate;
}

function getnormalDays(fromDate,toDate){
    var days;
    var ajaxconfig = {
        method: "GET",
        url:"api/handover.php",
        data:{
            action:"difference",
            fromDate:fromDate,
            toDate:toDate
        },
        async:false
    }
    $.ajax(ajaxconfig).done(function(response){
        days = parseFloat(response);
    });
    return days;

}

function getpaneltyDays(toDate,today){
    var pdays;
    var ajaxconfig = {
        method: "GET",
        url:"api/handover.php",
        data:{
            action:"difference",
            fromDate:toDate,
            toDate:today
        },
        async:false
    }
    $.ajax(ajaxconfig).done(function(response){
        pdays = parseFloat(response);
    });
    return pdays;
}


$("#btnadd").click(function () {
    console.log("call una.")
    var cID = $("#cID").val();
    var vID = $("#vID").val();
    var paymentmethod = $("#pmethod").val();
    var paneltyfee = $("#paneltyFee").val();
    var totalAmount = $("#totalAmount").val();

    var ajaxconfig = {
        method: "POST",
        url: "api/payment.php",
        data: {
            action: "save",
            cID: cID,
            vID: vID,
            pMethod: paymentmethod,
            paneltyFee: paneltyfee,
            totalAmount: totalAmount
        },
        async: false
    }
    $.ajax(ajaxconfig).done(function (response) {
        console.log("save ekata aava");
        if (response === true) {
            console.log("save una");
            var ajaxconfig = {
                method: "POST",
                url: "api/vehicle.php",
                data: {
                    action: "updateState",
                    vID:vID,
                    state: "free"
                },
                async: true
            }
            $.ajax(ajaxconfig).done(function (response) {
                if (response === true) {
                    var ajaxconfig6 = {
                        method: "POST",
                        url: "api/rent.php",
                        data: {
                            action: "updatestatus",
                            cID: cID,
                            vID: vID,
                            rentalState:"finished"
                        },
                        async: false
                    }
                    $.ajax(ajaxconfig6).done(function (response) {
                        if(response === true){
                            alert("Rental has been successfully finished.");
                            $("#cID").val("");
                            $("#nIC").val("");
                            $("#name").val("");
                            $("#vID").val("");
                            $("#paneltyFee").val("");
                            $("#totalAmount").val("");
                            $("#tblrentalInfo > tbody").html("");
                            loadAllRentalDetails()
                        }else{
                            alert("Transaction Failed....please try Again.");
                        }
                    });
                }
                else {
                    alert("Transaction Failed.please try Again.");
                }
            });
        } else {
            alert("something went Wrong .Please try again later.");
        }
    });

});
// alert("Rental has been successfully finished.");
// $("#tblrentalInfo > tbody").html("");
// loadAllRentalDetails()