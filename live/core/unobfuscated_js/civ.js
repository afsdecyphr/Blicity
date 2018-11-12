$(document).ready(function () {
    $('.js-example-basic-single').select2();
    $(".js-example-basic-single").select2({
        width: '100%',
        dropdownParent: "#charLookupModal"
    });
    $('.js-example-basic-single').select2({
        theme: "bootstrap4",
        minimumInputLength: 3
    });
    $('.js-example-basic-multiple').select2({
        theme: "bootstrap4"
    });
});
function checkTickets() {
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            getTickets: '1'
        },
        success:function(response) {
            $("#ticketsTableContainer").html(response);
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function checkWarrants() {
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            getWarrants: '1'
        },
        success:function(response) {
            $("#warrantsTableContainer").html(response);
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function loadDMVData() {
        if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            getDMVData: '1'
        },
        success:function(response) {
            $("#dmvContainer").html(response);
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function loadLicenseData() {
        if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            getLicenseData: '1'
        },
        success:function(response) {
            $("#licensesContainer").html(response);
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function loadCreateNewVehicle() {
    $('#vehicleModalLabel').html('Register New Vehicle');
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"../includes/vehicle_color_options.php",
        method:"GET",
        success:function(response) {
    $('#vehicleContainer').html('<div class="form-group"><label for="lpText">License Plate</label><input type="text" style="text-transform:uppercase;" class="form-control" id="lpText" placeholder="License Plate"><small id="lpHelp" class="form-text" style="color:red; display:none;">Cannot be left blank.</small></div><div class="form-group"><label for="mmText">Make/Model</label><input type="text" class="form-control" id="mmText" placeholder="Make/Model"><small id="mmHelp" class="form-text" style="color:red; display:none;">Cannot be left blank.</small></div><div class="form-group"><label for="colorSelect">Color</label><select class="js-example-basic-single" name="state" style="" id="colorSelect">' + response + '</select></div><script>$(".js-example-basic-single").select2();$(".js-example-basic-single").select2({width: "100%", dropdownParent: "#vehicleModal"});$(".js-example-basic-single").select2({theme: "bootstrap4"});$(".js-example-basic-multiple").select2({theme: "bootstrap4"});</script><div class="form-group"><label for="vehEditTagSelect">Vehicle Tag</label><select class="form-control js-example-basic-single selectpicker" id="vehEditTagSelect" name="vehEditTagSelect"><option value="0">None</option><option value="1">Stolen</option><option value="2">Wanted</option></select><small id="vehTagEditHelp" class="form-text" style="color:red; display:none;"></small></div><div class="form-group"><label for="insuranceEdit">Insurance Status</label><select class="form-control js-example-basic-single selectpicker" id="insuranceEdit" name="insuranceEdit"><option value="0">Uninsured</option><option value="1">Insured</option></select><small id="insuranceEditHelp" class="form-text" style="color:red; display:none;"></small></div>');
        },
        error:function(){
            console.log("ajax error");
        }
    });
    $('#vehicleModalFooter').html('<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button><button type="button" class="btn btn-success" onclick="registerVehicle();">Register New Vehicle</button>');
    
}

function registerVehicle() {
    var lp = $('#lpText').val();
    var mm = $('#mmText').val();
    var color = $('#colorSelect').val();
    var tag = $('#vehEditTagSelect').val();
    var insurance = $('#insuranceEdit').val();
    
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            createVehicle: lp,
            makeModel: mm,
            color: color,
            tag: tag, 
            insurance: insurance
        },
        success:function(response) {
            $("#vehicleModal").modal('toggle');
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function deleteVehicle(uvid) {
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            removeVehicle: uvid
        },
        success:function(response) {
            $("#dmvModal").modal('toggle');
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function editVehicle(uvid) {
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            editVehicle: uvid
        },
        success:function(response) {
            $("#dmvModal").modal('toggle');
            $("#vehicleContainer").html(response);
            $("#vehicleModalLabel").html("Edit Vehicle");
            $('#vehicleModalFooter').html('<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button><button type="button" class="btn btn-success" onclick="saveVehicle();">Append</button>');
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function saveVehicle() {
    var lp = $("#lpEditText").val();
    var mm = $("#mmEditText").val();
    var color = $("#colorSelect").val();
    var tag = $("#vehEditTagSelect").val();
    var insurance = $("#insuranceSelect").val();
    var uvid = $("#vehEditUVID").html().replace("UVID: ", "");
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            saveVehicle: uvid,
            lp: lp,
            mm: mm,
            color: color,
            tag: tag,
            insurance: insurance
        },
        success:function(response) {
            if (response == "success") {
                $("#vehicleModal").modal('toggle');
            }
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function saveLicenseData() {
    var dLicenseStatus = $("#dLicenseStatusSelect").val();
    var wLicenseStatus = $("#wLicenseStatusSelect").val();
    var fishingLicenseStatus = $("#fishingLicenseStatusSelect").val();
    var huntingLicenseStatus = $("#huntingLicenseStatusSelect").val();
    if (fishingLicenseStatus == undefined) {
      fishingLicenseStatus = 9;
    }
    if (huntingLicenseStatus == undefined) {
      huntingLicenseStatus = 9;
    }
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            dLicenseData: dLicenseStatus,
            wLicenseData: wLicenseStatus,
            fishingLicenseStatus: fishingLicenseStatus,
            huntingLicenseStatus: huntingLicenseStatus
        },
        success:function(response) {
            if (response == "success") {
                $("#licensesModal").modal('toggle');
            }
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function loadEditCharacter() {
    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
        jQuery.ajaxSettings.xhr = function() {
            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
            catch(e) { }
            jQuery.support.cors = true;
        };
    }
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            loadEditCharacter: '1'
        },
        success:function(response) {
            $('#editCharacterContainer').html(response);
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function editCharacter() {
    if ($("#nameText").val() == "") {
        $("#nameTextHelp").html("Cannot be empty.");
        $("#nameTextHelp").show();
    } else {
        if ($("#addressText").val() == "") {
            $("#addressTextHelp").html("Cannot be empty.");
            $("#addressTextHelp").show();
        } else {
            var name = $("#nameText").val();
            var address = $("#addressText").val();
            var age = $("#ageSpinner").val();
            var gender = 0;
            if (document.getElementById('genderRadio1').checked) {
                gender = 0;
            } else if (document.getElementById('genderRadio2').checked) {
                gender = 1;
            } else if (document.getElementById('genderRadio3').checked) {
                gender = 2;
            }
            if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                jQuery.ajaxSettings.xhr = function() {
                    try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                    catch(e) { }
                    jQuery.support.cors = true;
                };
            }
            $.ajax({
                url:"actions.php",
                method:"GET",
                data:{
                    saveCharacter: name,
                    address: address,
                    age: age,
                    gender: gender
                },
                success:function(response) {
                },
                error:function(){
                    console.log("ajax error");
                }
            });
        }
    }
    
}