var discordModule = 0;
var editingUUID = "";
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
                getUsers(page, search);
                if (search != "") {
                  $('#searchParam').val(search);
                }
            });
            function getUsers(page, search) {
                $("#usersTableBody").html("");
                if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                    jQuery.ajaxSettings.xhr = function() {
                        try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                        catch(e) { }
                        jQuery.support.cors = true;
                    };
                }
                $.ajax({
                    url:"assets/actions.php",
                    method:"GET",
                    data:{
                        getUsers: page,
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
                            $("#usersTable").html($("#usersTable").html() + '<tr><td>' + obj[i].id + '</td><td>' + obj[i].username + '</td><td>' + obj[i].discord + '</td><td>' + level + '</td>' + discord + '<td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editUserModal" onclick="editUser(' + "'" + obj[i].uuid + "'" + ');">Edit</button><button style="margin-left:5px;" class="btn btn-danger btn-sm" onclick="deleteUser(' + "'" + obj[i].uuid + "'" + ');">Delete</button></td></tr>');
                        }
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
            function editUser(uuid) {
                editingUUID = uuid;
                if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                    jQuery.ajaxSettings.xhr = function() {
                        try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                        catch(e) { }
                        jQuery.support.cors = true;
                    };
                }
                $.ajax({
                    url:"assets/actions.php",
                    method:"GET",
                    data:{
                        getUserInfo: uuid
                    },
                    success:function(response) {
                        var obj = JSON.parse(response);
                        $("#username").val(obj.username);
                        $("#levelSelect").val(obj.level);
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
            function saveUser() {
                var username = $("#username").val();
                var password = $("#editPass").val();
                var confPassword = $("#editConfPass").val();
                var level = $("#levelSelect").val();
                if (password != confPassword) {
                    $("#editConfPassHelp").html("Passwords do not match.");
                    $("#editConfPassHelp").show();
                } else {
                    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                        jQuery.ajaxSettings.xhr = function() {
                            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                            catch(e) { }
                            jQuery.support.cors = true;
                        };
                    }
                    $.ajax({
                        url:"assets/actions.php",
                        method:"GET",
                        data:{
                            saveUser: editingUUID,
                            username: username,
                            password: password,
                            level: level
                        },
                        success:function(response) {
                            if (response == "success") {
                                $("#editUserModal").modal("toggle");
                            }
                                getUsers(page, search);
                        },
                        error:function(){
                            console.log("ajax error");
                        }
                    });
                }
            }
            function loadUnits() {
                if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                    jQuery.ajaxSettings.xhr = function() {
                        try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                        catch(e) { }
                        jQuery.support.cors = true;
                    };
                }
                $.ajax({
                    url:"assets/actions.php",
                    method:"GET",
                    data:{
                        getUnits: editingUUID
                    },
                    success:function(response) {
                        $("#unitsTableBody").html("");
                        var obj = JSON.parse(response);
                        for (i = 0; i < obj.length; i++) {
                            console.log(obj[i].id);
                            var dispatch = "";
                            if (obj[i].dispatch == "1") {
                                dispatch = "checked=''";
                            } else {
                                dispatch = "";
                            }
                            var mdt = "";
                            if (obj[i].mdt == "1") {
                                mdt = "checked=''";
                            } else {
                                mdt = "";
                            }
                            $("#unitsTableBody").html($("#unitsTableBody").html() + '<tr><td>' + obj[i].callsign + '</td><td><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="dispatchAccessCB-' + obj[i].uuid + '" ' + dispatch + '><label class="custom-control-label" for="dispatchAccessCB-' + obj[i].uuid + '">Dispatch</label></div></td><td><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mdtAccessCB-' + obj[i].uuid + '" ' + mdt + '><label class="custom-control-label" for="mdtAccessCB-' + obj[i].uuid + '">MDT</label></div></td><td><button class="btn btn-danger btn-sm" onclick="deleteUnit(' + "'" + obj[i].uuid +  "'" + ');loadUnits();")>Delete</button></td></tr>');
                        }
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
            function saveUnits() {
                var unitsJSON = { units: [] };
                if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                    jQuery.ajaxSettings.xhr = function() {
                        try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                        catch(e) { }
                        jQuery.support.cors = true;
                    };
                }
                $.ajax({
                    url:"assets/actions.php",
                    method:"GET",
                    data:{
                        getUnits: editingUUID
                    },
                    success:function(response) {
                        var obj = JSON.parse(response);
                        for (i = 0; i < obj.length; i++) {
                            var dispatchAccess = "0";
                            if ($("#dispatchAccessCB-" + obj[i].uuid).prop('checked')) {
                                dispatchAccess = "1";
                            }
                            var mdtAccess = "0";
                            if ($("#mdtAccessCB-" + obj[i].uuid).prop('checked')) {
                                mdtAccess = "1";
                            }
                            var uuid = obj[i].uuid;
                            unitsJSON.units.push({"uuid" : uuid, "dispatch" : dispatchAccess, "mdt" : mdtAccess});
                        }
                        if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                            jQuery.ajaxSettings.xhr = function() {
                                try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                                catch(e) { }
                                jQuery.support.cors = true;
                            };
                        }
                        console.log(JSON.stringify(unitsJSON));
                        var jsonString = encodeURIComponent(JSON.stringify(unitsJSON));
                        console.log(jsonString);
                        $.ajax({
                            url:"assets/actions.php",
                            method:"GET",
                            data:{
                                saveUnits: jsonString
                            },
                            success:function(response) {

                            },
                            error:function(){
                                console.log("ajax error");
                            }
                        });
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
            function deleteUnit(uuid) {
                console.log(uuid);

                $.ajax({
                    url:"assets/actions.php",
                    method:"GET",
                    data:{
                        deleteUnit: uuid
                    },
                    success:function(response) {
                        loadUnits();
                    },
                    error:function(){
                        console.log("ajax error");
                    }
                });
            }
            function deleteUser(uuid) {
                var answer = confirm("Are you sure you want to delete this user?");
                if (answer) {
                    if ('XDomainRequest' in window && window.XDomainRequest !== null) {
                        jQuery.ajaxSettings.xhr = function() {
                            try { return new ActiveXObject("Microsoft.XMLHTTP"); }
                            catch(e) { }
                            jQuery.support.cors = true;
                        };
                    }
                    $.ajax({
                        url:"assets/actions.php",
                        method:"GET",
                        data:{
                            deleteUser: uuid
                        },
                        success:function(response) {
                            getUsers(page, search);
                        },
                        error:function(){
                            console.log("ajax error");
                        }
                    });
                }

            }
