$(document).ready(loadAllCustomers);

function loadAllCustomers(){

    var ajaxConfig = {
        method: "GET",
        url:"api/customers.php?action=all",
        async: true
    };

    $.ajax(ajaxConfig).done(function(response){
        response.forEach(function (customer){
            var html = "<tr>" +
                "<td>" + customer.cID + "</td>" +
                "<td>" + customer.nIC + "</td>" +
                "<td>" + customer.name + "</td>" +
                "<td>" + customer.telNo + "</td>" +
                "<td>" + customer.address + "</td>" +
                '<td class="recycle"><i class="fa fa-2x fa-trash"></i></td>' +
                "</tr>";

            $("#tblCustomers tbody").append(html);

            $(".recycle").off();
            $(".recycle").click(function(){

                var customerID = ($(this).parents("tr").find("td:first-child").text());

                if (confirm("Are you sure that you want to delete?")){

                    $.ajax({
                        method:"DELETE",
                        url:"api/customers.php?id=" + customerID,
                        async: true
                    }).done(function(response){
                        if (response){
                            alert("Customer has been successfully deleted");
                            $("#tblCustomers tbody tr").remove();
                            loadAllCustomers();
                        } else{
                            alert("Failed to delete the customer");
                        }
                    });

                }

            });

        });

        $("#tblCustomers tbody tr").click(function (){
            console.log("ebuva")
            var customerID = ($(this).find("td:first-child").text());
            var ajaxconfig5 = {
                method: "GET",
                url:"api/customers.php",
                data:{
                    action:"row",
                    id:customerID
                },
                async:true
            }

            $.ajax(ajaxconfig5).done(function(response){
                $("#cID").val(response.cID);
                $("#nIC").val(response.nIC);
                $("#name").val(response.name);
                $("#telNo").val(response.telNo);
                $("#address").val(response.address);
            });
        });

    });

}

$("#btnadd").click(function(){

    var ID = $("#cID").val();
    var nic = $("#nIC").val();
    var name = $("#name").val();
    var telno = $("#telNo").val();
    var address = $("#address").val();
    var equal = false;
    console.log("--"+ID+"--")
    var ajaxConfig1 = {
        method: "GET",
        url:"api/customers.php?action=all",
        async: true
    };
    $.ajax(ajaxConfig1).done(function(response){
        console.log("for each ekata aava");
        response.forEach(function (customer){
            if(ID===(customer.cID)){
                equal = true;
                console.log("id deka samanai");
            }
        });

        if(equal == true) {
            console.log("update una");
            var ajaxconfig2 = {
                method: "POST",
                url: "api/customers.php",
                data: {
                    action: "update",
                    id: ID,
                    nic:nic,
                    name: name,
                    telno:telno,
                    address: address
                },
                async: true
            }
            $.ajax(ajaxconfig2).done(function (response) {
                console.log("done eka athulatath aava")
                if (response === true) {
                    $("#tblCustomers > tbody").html("");
                    loadAllCustomers();
                    alert("Customer has been updated succesfully.");
                } else {
                    alert("Something went wrong when updating   .");
                }

                $("#cID").val("");
                $("#nIC").val("");
                $("#name").val("");
                $("#telNo").val("");
                $("#address").val("");

            });

        }
        else{
            console.log("save una");
            var ajaxconfig3 = {
                method: "POST",
                url: "api/customers.php",
                data: {
                    action: "save",
                    id: ID,
                    nic:nic,
                    name: name,
                    telno:telno,
                    address: address
                },
                async: true

            }

            $.ajax(ajaxconfig3).done(function (response) {

                if (response == true) {
                    $("#tblCustomers > tbody").html("");
                    loadAllCustomers();
                    alert("Customer has been saved succesfully.");
                } else {
                    alert("please enter a valid customer ID.");
                }
                $("#cID").val("");
                $("#nIC").val("");
                $("#name").val("");
                $("#telNo").val("");
                $("#address").val("");

            });

        }

    });

});

$("#btncancel").click(function(){
    $("#cID").val("");
    $("#nIC").val("");
    $("#name").val("");
    $("#telNo").val("");
    $("#address").val("");
});
