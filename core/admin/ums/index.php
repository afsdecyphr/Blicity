<?php

/**
Blicity CAD/MDT
Copyright (C) 2018 Decyphr and Blicity.
 Credit is not allowed to be removed from this program, doing so will
 result in copyright takedown.
 WE DO NOT SUPPORT CHANGING CODE IN ANYWAY, AS IT WILL MESS WITH FUTURE
 UPDATES. NO SUPPORT IS PROVIDED FOR CODE THAT IS EDITED.
**/
if (session_id() == '' || !isset($_SESSION)) {
    session_start();
}
if (isset($_SESSION['uuid'])) {
    $uuid = $_SESSION['uuid'];
    $connection = new mysqli(MYSQL_HOST, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE);
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }
    $result = $connection->query("SELECT level FROM users WHERE uuid='$uuid'");
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            if ($row['level'] > 1) {
                echo "noAccess";
                exit();
            }
        }
    } else {
        echo "noAccess";
        exit();
    }
} else {
    echo "noAccess";
    exit();
}
$file_access = "11111111";
require '../../../core/includes/check_access.php';
renderPage("");
function renderPage($info) {
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo TITLE; ?> ● UMS</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.1.3/lux/bootstrap.min.css">
        <link rel="stylesheet" href="http://localhost:8080/Blicity/core/assets/style.css">
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
        <script src="http://localhost:8080/Blicity/core/assets/bootstrap-number-input.js"></script>
        <style>
            .col-centered {
                float: none;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <h1 class="text-center" style="margin-top: 10px;"><?php echo TITLE; ?> ● UMS</h1>
        <div class="col-centered" style="width:24%; height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:left; margin-left:5px;">
            <a href="<?php echo SITE_URL; ?>" style="width:100%;"><button class="btn btn-primary" style="width:100%;">Home</button></a>
            <a href="<?php echo SITE_URL; ?>admin/index.php" style="width:100%; margin-top:5px;"><button class="btn btn-primary" style="width:100%; margin-top:5px;">Admin Panel</button></a>
        </div>
        <div class="col-centered" style="width:75%; height:auto; border:1px solid black; border-radius:4px; padding:5px 5px; display:inline; float:right; margin-right:5px;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Username</th>
                        <th scope="col">Level</th>
                        <th scope="col">Edit</th>
                    </tr>
                </thead>
                <tbody id="usersTableBody">
                </tbody>
            </table>
        </div>
        
        <div class="modal fade" id="editUserModal" tabindex="-1" role="dialog" aria-labelledby="editUserModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <b>Username</b>
                            <input type="text" name="username" id="username" placeholder="Username" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <b>Password</b>
                            <input type="password" name="editPass" id="editPass" placeholder="Password" class="form-control" value="">
                        </div>
                        <div class="form-group">
                            <b>Password</b>
                            <input type="password" name="editConfPass" id="editConfPass" placeholder="Confirm Password" class="form-control" value="">
                            <small id="editConfPassHelp" class="form-text" style="color:red; display:none;">Cannot leave empty.</small>
                        </div>
                        <div class="form-group">
                            <b>Level</b>
                            <select class="form-control" id="levelSelect">
                                <option value="9">User</option>
                                <option value="1">Administrator</option>
                                <option value="0">Super Administrator</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary" data-toggle="modal" data-target="#identitiesModal" onclick="loadUnits();">View Identities</button>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="saveUser();">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="identitiesModal" tabindex="-1" role="dialog" aria-labelledby="identitiesModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="identitiesModalLabel">Identities</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Callsign</th>
                                    <th scope="col">Dispatch Access</th>
                                    <th scope="col">MDT Access</th>
                                </tr>
                            </thead>
                            <tbody id="unitsTableBody">
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-success" onclick="saveUnits();">Apply</button>
                    </div>
                </div>
            </div>
        </div>
        
        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
        <script src="http://localhost:8080/Blicity/core/assets/bootstrap-number-input.js"></script>
        <script>
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
        </script>
    </body>
</html>
<?php
}
?>