function makeid() {
    var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
    for (var i = 0; i < 5; i++)
        text += possible.charAt(Math.floor(Math.random() * possible.length));
    return text;
}

bootstrap_alert = function() {};
bootstrap_alert.success = function(message) {
    var name = makeid();
    $('#alert_placeholder').html($('#alert_placeholder').html() + '<div class="alert alert-dismissible alert-success fade show" id="' + name + '"><button type="button" class="close" data-dismiss="alert">&times;</button><strong>' + message + '</div>');
    var height = $('#name').height();
    setTimeout(function () {
        $('#'+name).alert('close');
        $('#alert_placeholder').height($('#alert_placeholder').height() - height);
    }, 3000);
};

var rawNotesText = "";

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
    $('.sidebarCollapse').on('click', function () {
        $('#sidebar').toggleClass('active');
    });
    $('#addBoloBtn').on('click', function () {
        var vehMakeModel = $('#vehMakeModelText').val();
        var vehColor = $('#vehColorText').val();
        var lp = $('#lpText').val();
        addBolo(lp, vehMakeModel, vehColor);
    });
    $(".updateunitbtn").on('click', function () {
        console.log($(this).attr('id'));
    });
    $('#testsel').on('select2:select', function (e) {
        var data = e.params.data;
        console.log(data);
    });
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
            getNotes: '1'
        },
        success:function(response) {
            $('#notesTA').html(response);
            rawNotesText = response;
        },
        error:function(){
            console.log("ajax error");
        }
    });
    refresh();
});

$(document).keypress(function(e) {
    if ($("#addBoloModal").hasClass('show') && (e.keycode == 13 || e.which == 13)) {
        var vehMakeModel = $('#vehMakeModelText').val();
        var vehColor = $('#vehColorText').val();
        var lp = $('#lpText').val();
        addBolo(lp, vehMakeModel, vehColor);
    }
});

function showChar(uuid) {
    console.log(uuid);
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
            searchChar: uuid
        },
        success:function(response) {
            $("#showChar").html(response);
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function setStatus(uuid, status) {
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
            setStatus: status,
            uuid: uuid
        },
        success:function(response) {
            
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function refresh() {
    setTimeout(function () {    //  call a 3s setTimeout when the loop is called
        var status = "1";
        $.ajax({
            url:"actions.php",
            method:"GET",
            data:{
                getStatus: '1'
            },
            success:function(response) {
                if (response == 1) {
                    $("#status_1").addClass("disabled");
                    $("#status_0").removeClass("disabled");
                    $("#status_2").removeClass("disabled");
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
                            getBolos: '1'
                        },
                        success:function(response) {
                            $('#bolosTableBody').html(response);
                        },
                        error:function(){
                            console.log("ajax error");
                        }
                    });
                    var isupdating = false;
                    $( ".unitchange" ).each(function( index ) {
                        if ($( ".unitchange" ).hasClass('show')) {
                            isupdating = true;
                        }
                    });
                    if (!isupdating) {
                        $.ajax({
                            url:"actions.php",
                            method:"GET",
                            data:{
                            getUnits: '1'
                            },
                            success:function(response) {
                                $('#unitsTableBody').html(response);
                            },
                            error:function(){
                            console.log("ajax error");
                            }
                        });
                    }
                    } else if (response == 0) {
                    $("#status_0").addClass("disabled");
                    $("#status_1").removeClass("disabled");
                    $("#status_2").addClass("disabled");
                    $('#unitsTableBody').html("");
                    $('#bolosTableBody').html("");
                } else if (response == 2) {
                    $("#status_2").addClass("disabled");
                    $("#status_1").removeClass("disabled");
                    $("#status_0").removeClass("disabled");
                    $('#unitsTableBody').html("");
                    $('#bolosTableBody').html("");
                    }
                status = response;
                },
            error:function(){
                console.log("ajax error");
                }
        });
        refresh();
    }, 1000);
}

function updateStatus(status) {
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
            updateStatus: status
        },
        success:function(response) {
            if (status == 1) {
                $("#status_1").addClass("disabled");
                $("#status_0").removeClass("disabled");
                $("#status_2").removeClass("disabled");
            } else if (status == 0) {
                $("#status_0").addClass("disabled");
                $("#status_1").removeClass("disabled");
                $("#status_2").addClass("disabled");
            } else if (status == 2) {
                $("#status_2").addClass("disabled");
                $("#status_1").removeClass("disabled");
                $("#status_0").removeClass("disabled");
            }
        },
        error:function(){
            console.log("ajax error");
        }
    });
}

function removeBolo(id) {
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
            remBolo: id
        },
        success:function(response) {
            bootstrap_alert.success('Successfully deleted bolo.');
        },
        error:function(){
            console.log("ajax error");
        }
    });
}
function addBolo(plate, makemodel, color) {
    if (makemodel === "") {
        $('#vehMakeModelHelp').show();
        if (makemodel === "") {
            $('#vehColorHelp').show();
        }
    } else {
        if (makemodel === "") {
            $('#vehColorHelp').show();
        } else {
            $('#vehMakeModelText').val("");
            $('#vehColorText').val("");
            $('#lpText').val("");
            if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                jQuery.ajaxSettings.xhr = function() {
                    try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                    catch(e) { }
                    jQuery.support.cors = true;
                };
            }
            $.ajax({
                url:"actions.php",
                method:"POST",
                data:{
                    makemodel: makemodel,
                    color: color,
                    lp: plate
                },
                success:function(response) {
                    $('#addBoloModal').modal('toggle');
                    bootstrap_alert.success('Successfully added bolo.');
                },
                error:function(){
                    console.log("ajax error");
                }
            });
        }
    }
}

function issueTicket() {
    if ($("#reasonText").val() == "") {
        $("#reasonHelp").show();
    } else {
        if ($("#amountText").val() == "") {
            $("#amountHelp").show();
        } else {
            if (document.getElementById("testsel2").value == "default") {
                $("#characterHelp").show();
            } else {
                var cite = document.getElementById("testsel2").value;
                var reason = $("#reasonText").val();
                var amount = $("#amountText").val();
                $.ajax({
                    url:"actions.php?ticket="+cite+"&reason="+reason+"&amount="+amount,
                    method:"GET",
                    data:{
                    },
                    success:function(response) {
                        if (response == "success") {
                            $("#ticketModal").modal('toggle');
                        }
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
        }
    }
}

function saveNotes() {
    var notes = $("#notesTA").html();
    $.ajax({
        url:"actions.php",
        method:"GET",
        data:{
            saveNotes: notes
        },
        success:function(response) {
            
        },
        error:function(){
            console.log("ajax error");
        }
    });
}