var editingUUID = "";
            $( document ).ready(function() {
                getUsers();
            });
            function getUsers() {
                $("#usersTableBody").html("");
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
                        getUsers: '1'
                    },
                    success:function(response) {
                        var obj = JSON.parse(response);
                        for (i = 0; i < obj.length; i++) {
                            console.log(obj[i].id);
                            var level = "";
                            if (obj[i].level == 9) {
                                level = "User";
                            } else if (obj[i].level == 1) {
                                level = "Administrator";
                            } else if (obj[i].level == 0) {
                                level = "Super Administrator";
                            }
                            $("#usersTableBody").html($("#usersTableBody").html() + '<tr><td>' + obj[i].username + '</td><td>' + level + '</td><td><button class="btn btn-primary" data-toggle="modal" data-target="#editUserModal" onclick="editUser(' + "'" + obj[i].uuid + "'" + ');">Edit</button><button style="margin-left:5px;" class="btn btn-danger" onclick="deleteUser(' + "'" + obj[i].uuid + "'" + ');">Delete</button></td></tr>');
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
                    url:"actions.php",
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
                        url:"actions.php",
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
                    url:"actions.php",
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
                            $("#unitsTableBody").html($("#unitsTableBody").html() + '<tr><td>' + obj[i].callsign + '</td><td><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="dispatchAccessCB-' + obj[i].uuid + '" ' + dispatch + '><label class="custom-control-label" for="dispatchAccessCB-' + obj[i].uuid + '">Dispatch</label></div></td><td><div class="custom-control custom-checkbox"><input type="checkbox" class="custom-control-input" id="mdtAccessCB-' + obj[i].uuid + '" ' + mdt + '><label class="custom-control-label" for="mdtAccessCB-' + obj[i].uuid + '">MDT</label></div></td></tr>');
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
                    url:"actions.php",
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
                            url:"actions.php",
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
                        url:"actions.php",
                        method:"GET",
                        data:{
                            deleteUser: uuid
                        },
                        success:function(response) {
                            getUsers();
                        },
                        error:function(){
                            console.log("ajax error");
                        }
                    });
                }
                
            }