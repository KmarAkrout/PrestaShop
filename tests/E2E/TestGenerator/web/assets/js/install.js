$(document).ready(function () {
    $('#listFiles').select2({

        width: 'resolve',
        placeholder: 'Select a File'
    });
    $('#listFolders').select2({
        placeholder: 'Select a Folder',
        width: 'resolve',

    });
    $('#listFolders').on('change', function () {
        var selected = '../../test/campaigns/install_upgrade/' + $('#listFolders :selected').text();
        if ("01_install.js" === $.trim($('#listFolders :selected').text())) {
            $("#alertId").show();
        }
        else {
            $("#alertId").hide();
        }

        $.ajax({
            type: "POST",
            url: "/getFiles",
            data: {'selected': selected},
            success: function (data) {
                var allFiles = $.map(data.split("***"), function (v) {
                    return v === "" ? null : v;
                });
                $("#listFiles").find('option')
                    .remove();


                $("#listFiles").append($("<option />", {
                    value: '',

                }));
                for (var val in allFiles) {

                    $("#listFiles").append($("<option />", {
                        value: '/' + allFiles[val],
                        text: allFiles[val]
                    }));
                }
            },
            error: function (response, xhr, status) {
                alert("error" + status);
            }
        });
    });
    $('input[type="checkbox"][name="url"]').change(function () {
        if (this.checked) {
            $("#divUrl").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpUrl",
                name: "URL",
                placeholder: "Front office URL of your PrestaShop website without the 'http://'"
            })).show();
        }
        else {
            $("#divUrl").hide();
            $("#InpUrl").remove();
        }
    });
    $('input[type="checkbox"][name="language"]').change(function () {
        if (this.checked) {
            $("#divLan").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpLan",
                name: "LANGUAGE",
                placeholder: "Language to install with (default to \"en\")"
            })).show();
        }
        else {
            $("#divLan").hide();
            $("#InpLan").remove();
        }
    });
    $('input[type="checkbox"][name="country"]').change(function () {
        if (this.checked) {
            $("#divCou").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpCou",
                name: "COUNTRY",
                placeholder: "Country to install with (default o \"france\")"
            })).show();
        }
        else {
            $("#divCou").hide();
            $("#InpCou").remove();
        }
    });
    $('input[type="checkbox"][name="db_s"]').change(function () {
        if (this.checked) {
            $("#divDbS").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpDbS",
                name: "DB_SERVER",
                placeholder: "DataBase server (default to \"mysql\")"
            })).show();
        }
        else {
            $("#divDbS").hide();
            $("#InpDbS").remove();
        }
    });
    $('input[type="checkbox"][name="db_u"]').change(function () {
        if (this.checked) {
            $("#divDbU").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpDbU",
                name: "DB_USER",
                placeholder: "DataBase user (default to \"root\")"
            })).show();
        }
        else {
            $("#divDbU").hide();
            $("#InpDbU").remove();
        }
    });
    $('input[type="checkbox"][name="db_pwd"]').change(function () {
        if (this.checked) {
            $("#divDbP").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpDbP",
                name: "DB_PASSWD",
                placeholder: "DataBase password (default to \"doge\")"
            })).show();
        }
        else {
            $("#divDbP").hide();
            $("#InpDbP").remove();
        }
    });
    ///////*****////*******///////***//
    $('input[type="checkbox"][name="rcLink"]').change(function () {
        if (this.checked) {
            $('#rcLink_check').prop("checked", false);
            $.confirm({
                title: 'Encountered an error!',
                content: "You Can't Select RC_LINK and FILENAME Together !",
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Try again',
                        btnClass: 'btn-red',
                        action: function () {
                        }
                    },

                }
            });
        }
        else {

            $("#divLink").hide();
            $("#Inplink").remove();

            $('#fileName_check').prop("checked", true);
            $('#rcLink_check').prop("checked", false);
            $("#divFileName").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "Inpfile",
                required: "true",
                name: "FILENAME",
                placeholder: "RC FileName"
            })).show();
        }
    });
    $('input[type="checkbox"][name="fileName"]').change(function () {
        if (this.checked) {
            $('#fileName_check').prop("checked", false);
            $.confirm({
                title: 'Encountered an error!',
                content: "You Can't Select RC_LINK and FILENAME Together !",
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Try again',
                        btnClass: 'btn-red',
                        action: function () {
                        }
                    },

                }
            });

        }
        else {
            $("#divFileName").hide();
            $("#Inpfile").remove();
            $("#Inplink").remove();
            $('#fileName_check').prop("checked", false);
            $('#rcLink_check').prop("checked", true);
            $("#divLink").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "Inplink",
                name: "RC_LINK",
                required: "true",
                placeholder: "RC Download Link"
            })).show();
        }
    });
    ///*******//////////*******///////
    $('input[type="checkbox"][name="rcLinkSpec"]').change(function () {
        if (this.checked) {
            $('#rcLinkSpec_check').prop("checked", false);
            $.confirm({
                title: 'Encountered an error!',
                content: "You Can't Select RC_LINK and FILENAME Together !",
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Try again',
                        btnClass: 'btn-red',
                        action: function () {
                        }
                    },

                }
            });
        }
        else {

            $("#divLinkSpec").hide();
            $("#InplinkSpec").remove();

            $('#fileNameSpec_check').prop("checked", true);
            $('#rcLinkSpec_check').prop("checked", false);
            $("#divFileNameSpec").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpfileSpec",
                required: "true",
                name: "FILENAME",
                placeholder: "RC FileName"
            })).show();
        }
    });
    $('input[type="checkbox"][name="fileNameSpec"]').change(function () {
        if (this.checked) {
            $('#fileNameSpec_check').prop("checked", false);
            $.confirm({
                title: 'Encountered an error!',
                content: "You Can't Select RC_LINK and FILENAME Together !",
                type: 'red',
                typeAnimated: true,
                buttons: {
                    tryAgain: {
                        text: 'Try again',
                        btnClass: 'btn-red',
                        action: function () {
                        }
                    },

                }
            });

        }
        else {
            $("#divFileNameSpec").hide();
            $("#InpfileSpec").remove();
            $("#InplinkSpec").remove();
            $('#fileNameSpec_check').prop("checked", false);
            $('#rcLinkSpec_check').prop("checked", true);
            $("#divLinkSpec").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InplinkSpec",
                name: "RC_LINK",
                required: "true",
                placeholder: "RC Download Link"
            })).show();
        }
    });

    $('#dbEmptyPwd_check').popover({
        trigger: 'focus'
    });
    $('#fileName_check').popover({
        trigger: 'focus'
    });
    $('input[type="checkbox"][name="urlSpec"]').change(function () {
        if (this.checked) {
            $("#divUrlSpec").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpUrlSpec",
                name: "URL",
                placeholder: "Front office URL of your PrestaShop website without the 'http://'"
            })).show();
        }
        else {
            $("#divUrlSpec").hide();
            $("#InpUrlSpec").remove();
        }
    });
    $('input[type="checkbox"][name="languageSpec"]').change(function () {
        if (this.checked) {
            $("#divLanSpec").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpLanSpec",
                name: "LANGUAGE",
                placeholder: "Language to install with (default to \"en\")"
            })).show();
        }
        else {
            $("#divLanSpec").hide();
            $("#InpLanSpec").remove();
        }
    });
    $('input[type="checkbox"][name="countrySpec"]').change(function () {
        if (this.checked) {
            $("#divCouSpec").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpCouSpec",
                name: "COUNTRY",
                placeholder: "Country to install with (default o \"france\")"
            })).show();
        }
        else {
            $("#divCouSpec").hide();
            $("#InpCouSpec").remove();
        }
    });
    $('input[type="checkbox"][name="db_sSpec"]').change(function () {
        if (this.checked) {
            $("#divDbSSpec").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpDbSSpec",
                name: "DB_SERVER",
                placeholder: "DataBase server (default to \"mysql\")"
            })).show();
        }
        else {
            $("#divDbSSpec").hide();
            $("#InpDbSSpec").remove();
        }
    });
    $('input[type="checkbox"][name="db_uSpec"]').change(function () {
        if (this.checked) {
            $("#divDbUSpec").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpDbUSpec",
                name: "DB_USER",
                placeholder: "DataBase user (default to \"root\")"
            })).show();
        }
        else {
            $("#divDbUSpec").hide();
            $("#InpDbUSpec").remove();
        }
    });
    $('input[type="checkbox"][name="db_pwdSpec"]').change(function () {
        if (this.checked) {
            $("#divDbPSpec").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpDbPSpec",
                name: "DB_PASSWD",
                placeholder: "DataBase password (default to \"doge\")"
            })).show();
        }
        else {
            $("#divDbPSpec").hide();
            $("#InpDbPSpec").remove();
        }
    });


    $('#dbEmptyPwdSpec_check').popover({
        trigger: 'focus'
    });
    $('#fileNameSpec_check').popover({
        trigger: 'focus'
    });
    $('#headless').change(function () {
        if (this.checked) {
            $('#headlessAlert').show();
        }
        else {
            $('#headlessAlert').hide();
        }
    });
    $('#headlessSpec').change(function () {
        if (this.checked) {
            $('#headlessSpecAlert').show();
        }
        else {
            $('#headlessSpecAlert').hide();
        }
    });
    $('#myTab a').click(function (e) {
        e.preventDefault()
        $(this).tab('show')
    })
});

function generateCmd() {
    var url = document.getElementById("InpUrl");
    var dir = document.getElementById("dir");
    var target = document.getElementById("target");
    var last = document.getElementById("last");
    var link = document.getElementById("Inplink");
    var file_name = document.getElementById("Inpfile");
    var language = document.getElementById("InpLan");
    var country = document.getElementById("InpCou");
    var db_s = document.getElementById("InpDbS");
    var db_u = document.getElementById("InpDbU");
    var db_p = document.getElementById("InpDbP");
    var headless = null;
    if (document.getElementById("headless").checked) {
        headless = document.getElementById("headless");
    }
    var db_ep = null;
    if (document.getElementById("dbEmptyPwd_check").checked) {
        db_ep = document.getElementById("dbEmptyPwd_check");
    }
    if ("" === dir.value || "" === target.value || "" === last.value) {
        swal({
            title: "Error !",
            text: "You have to fill all the REQUIRED fields !",
            icon: "error",
            button: "Okay",
        });
        return false;
    }

    var params = {
        URL: url,
        DIR: dir,
        RCLINK: link,
        FILENAME: file_name,
        URLLASTSTABLEVERSION: last,
        RCTARGET: target,
        LANGUAGE: language,
        COUNTRY: country,
        DB_SERVER: db_s,
        DB_USER: db_u,
        DB_PASSWD: db_p,
        DB_EMPTY_PASSWD: db_ep,
        HEADLESS: headless
    };
    var cmd = "npm run install-upgrade-test --";

    for (var param in params) {
        if (null !== params[param]) {

            if ("" !== params[param].value) {

                cmd = cmd + " --" + param + "=" + params[param].value;
            }
            else if (param === "FILENAME" || param === "RCLINK") {

                swal({
                    title: "Error !",
                    text: "You have to provide either an RC_LINK or a FILENAME ! It IS REQUIRED !",
                    icon: "error",
                    button: "Okay",
                });
                return false;
            }

            else {
                swal({
                    title: "Error !",
                    text: "You have to fill the options you chose, or uncheck them.",
                    icon: "error",
                    button: "Okay",
                });
                return false;
            }
        }
    }
    swal({
        title: "Your Command Is :",
        text: cmd,
        icon: "success",
        button: "Okay",
    });

}


function generateCmdSpec() {
    var folder = document.getElementById("listFolders").options[document.getElementById("listFolders").selectedIndex].value;
    if ("" === folder) {
        swal({
            title: "Error !",
            text: "You have to select a path, if you don't have one, you can run All the Compaign Install-Upgrade",
            icon: "error",
            button: "Okay",
        });
        return false;
    }
    var file = document.getElementById("listFiles");
    var url = document.getElementById("InpUrlSpec");
    var dir = document.getElementById("dirSpec");
    var target = document.getElementById("targetSpec");
    var last = document.getElementById("lastSpec");
    var link = document.getElementById("InplinkSpec");
    var file_name = document.getElementById("InpfileSpec");
    var language = document.getElementById("InpLanSpec");
    var country = document.getElementById("InpCouSpec");
    var db_s = document.getElementById("InpDbSSpec");
    var db_u = document.getElementById("InpDbUSpec");
    var db_p = document.getElementById("InpDbPSpec");
    if (null !== file) {
        file = file.options[file.selectedIndex].value;
    }
    else {
        file = "";
    }
    var headless = null;
    if (document.getElementById("headlessSpec").checked) {
        headless = document.getElementById("headlessSpec");
    }
    var db_ep = null;
    if (document.getElementById("dbEmptyPwdSpec_check").checked) {
        db_ep = document.getElementById("dbEmptyPwdSpec_check");
    }
    if ("" === dir.value || "" === target.value || "" === last.value) {
        swal({
            title: "Error !",
            text: "You have to fill all the REQUIRED fields !",
            icon: "error",
            button: "Okay",
        });
        return false;
    }

    var params = {
        URL: url,
        DIR: dir,
        RCLINK: link,
        FILENAME: file_name,
        URLLASTSTABLEVERSION: last,
        RCTARGET: target,
        LANGUAGE: language,
        COUNTRY: country,
        DB_SERVER: db_s,
        DB_USER: db_u,
        DB_PASSWD: db_p,
        DB_EMPTY_PASSWD: db_ep,
        HEADLESS: headless
    };
    var cmd = "path= install_upgrade/" + folder + file + " npm run specific-test --";

    for (var param in params) {
        if (null !== params[param]) {

            if ("" !== params[param].value) {

                cmd = cmd + " --" + param + "=" + params[param].value;
            }
            else if (param === "FILENAME" || param === "RCLINK") {

                swal({
                    title: "Error !",
                    text: "You have to provide either an RC_LINK or a FILENAME ! It IS REQUIRED !",
                    icon: "error",
                    button: "Okay",
                });
                return false;
            }

            else {
                swal({
                    title: "Error !",
                    text: "You have to fill the options you chose, or uncheck them.",
                    icon: "error",
                    button: "Okay",
                });
                return false;
            }


        }


    }


    swal({
        title: "Your Command Is :",
        text: cmd,
        icon: "success",
        button: "Okay",
    });


}