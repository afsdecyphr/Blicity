var discordModule = 0;
var editingID = "";
function getUrlVars() {
    var vars = {};
    var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
        vars[key] = value;
    });
    return vars;
}
function getUrlParam(parameter, defaultvalue){
    var urlparameter = defaultvalue;
    if(window.location.href.indexOf(parameter) > -1){
        urlparameter = getUrlVars()[parameter];
        }
    return urlparameter;
}
  var page = getUrlParam("page", "1");
    var search = getUrlParam("search", "");
            $( document ).ready(function() {
                getApplications(page, search);
                if (search != "") {
                  $('#searchParam').val(search);
                }
            });
            function getApplications(page, search) {
                $("#usersTableBody").html("");
                if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                    jQuery.ajaxSettings.xhr = function() {
                        try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                        catch(e) { }
                        jQuery.support.cors = true;
                    };
                }
                $.ajax({
                    url:"assets/app_actions.php",
                    method:"GET",
                    data:{
                        getApplications: page,
                        search: search
                    },
                    success:function(response) {
                      $("#usersTable").html("");
                        var obj = JSON.parse(response);
                        for (i = 0; i < obj.length; i++) {
                            console.log(obj[i].id);
                            var level = "";
                            if (obj[i].level == 9) {
                                level = "<span class='badge bg-light-blue'>User</span>";
                            } else if (obj[i].level == 1) {
                                level = "<span class='badge bg-yellow'>Administrator</span>";
                            } else if (obj[i].level == 0) {
                                level = "<span class='badge bg-red'>Super Administrator</span>";
                            }
                            var discord = '<td>' + obj[i].discord + '</td>';
                            if (discordModule == 0) {
                              discord = "";
                            }
                            console.log(discord);
                            $("#usersTable").html($("#usersTable").html() + '<tr><td>' + obj[i].id + '</td><td>' + obj[i].submitted_by + '</td><td>' + obj[i].status + '</td><td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUserModal" onclick="viewApplication(' + "'" + obj[i].id + "'" + ');">View</button><button class="btn btn-success btn-sm" style="margin-left: 5px;" onclick="acceptApplication(' + "'" + obj[i].id + "'" + ');">Accept</button><button class="btn btn-danger btn-sm" style="margin-left: 5px;" onclick="denyApplication(' + "'" + obj[i].id + "'" + ');">Deny</button></td></tr>');
                        }
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
            function viewApplication(id) {
                editingID = id;
                if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                    jQuery.ajaxSettings.xhr = function() {
                        try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                        catch(e) { }
                        jQuery.support.cors = true;
                    };
                }
                $.ajax({
                    url:"assets/app_actions.php",
                    method:"GET",
                    data:{
                        getAppInfo: id
                    },
                    success:function(response) {
                        var obj = JSON.parse(response);
                        $("#applyingFor").val(obj.applying_for);
                        $("#submittedBy").val(obj.submitted_by);
                        $("#age").val(obj.age);
                        $("#time").val(obj.time);
                        $("#purpose").val(obj.purpose);
                        $("#interest").val(obj.interest);
                        $("#offer").val(obj.offer);
                        $("#respect").val(obj.respect);
                        $("#coc").val(obj.coc);
                        $("#noDiscussion").val(obj.no_discussion);
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
            function denyApplication(id) {
                editingID = id;
                if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                    jQuery.ajaxSettings.xhr = function() {
                        try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                        catch(e) { }
                        jQuery.support.cors = true;
                    };
                }
                $.ajax({
                    url:"assets/app_actions.php",
                    method:"GET",
                    data:{
                        denyApp: id
                    },
                    success:function(response) {
                        getApplications(page, search);
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
            function acceptApplication(id) {
                editingID = id;
                if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                    jQuery.ajaxSettings.xhr = function() {
                        try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                        catch(e) { }
                        jQuery.support.cors = true;
                    };
                }
                $.ajax({
                    url:"assets/app_actions.php",
                    method:"GET",
                    data:{
                        acceptApp: id
                    },
                    success:function(response) {
                        getApplications(page, search);
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
