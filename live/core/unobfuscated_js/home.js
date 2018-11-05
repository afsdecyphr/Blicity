$('#ageSpinner').bootstrapNumber({
    // default, danger, success , warning, info, primary
    upClass: 'default',
    downClass: 'default',
    center: true
});

function createIdentity() {
    if ($("#csText").val() == "") {
        $("#csHelp2").html("Cannot be empty.");
        $("#csHelp2").show();
    } else {
        if ('XDomainRequest' in window && window.XDomainRequest !== null) {
            jQuery.ajaxSettings.xhr = function() {
                try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                catch(e) { }
                jQuery.support.cors = true;
            };
        }
        var cs = $("#csText").val();
        $.ajax({
            url:"actions.php",
            method:"GET",
            data:{
                createIdentity: cs
            },
            success:function(response) {
                if (response == "success") {
                    $('#createIdentityModal').modal('toggle');
                    $.ajax({
                        url:"actions.php",
                        method:"GET",
                        data:{
                            getIdentitiesDisp: "1"
                        },
                        success:function(response) {
                            $("#identifierSelect").html(response);
                        },
                        error:function(){
                            console.log("ajax error");
                        }
                    });
                    $.ajax({
                        url:"actions.php",
                        method:"GET",
                        data:{
                            getIdentitiesMDT: "1"
                        },
                        success:function(response) {
                            $("#identifierSelectMDT").html(response);
                        },
                        error:function(){
                            console.log("ajax error");
                        }
                    });
                } else if (response == "exists") {
                    $("#csHelp2").html("An identity with that callsign already exists.");
                    $("#csHelp2").show();
                }
            },
            error:function(){
                console.log("ajax error");
            }
        });
    }
}
function createCharacter() {
    if ($("#nameText").val() == "") {
        $("#nameTextHelp").html("Cannot be empty.");
        $("#nameTextHelp").show();
    } else {
        if ($("#addressText").val() == "") {
            $("#addressTextHelp").html("Cannot be empty.");
            $("#addressTextHelp").show();
        } else {
            if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                jQuery.ajaxSettings.xhr = function() {
                    try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                    catch(e) { }
                    jQuery.support.cors = true;
                };
            }
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
            $.ajax({
                url:"actions.php",
                method:"GET",
                data:{
                    createCharacter: name,
                    address: address,
                    age: age,
                    gender: gender
                },
                success:function(response) {
                    if (response == "success") {
                        $('#createCharacterModal').modal('toggle');
                        $.ajax({
                            url:"actions.php",
                            method:"GET",
                            data:{
                                getCharacters: "1"
                            },
                            success:function(response) {
                                $("#characterSelect").html(response);
                            },
                            error:function(){
                                console.log("ajax error");
                            }
                        });
                    }
                },
                error:function(){
                    console.log("ajax error");
                }
            });
        }
    }
}

function changeColor(color) {
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
                    changeColor: color
                },
                success:function(response) {
                    if (response == "success") {
                        location.reload();
                    }
                },
                error:function(){
                    console.log("ajax error");
                }
            });
}