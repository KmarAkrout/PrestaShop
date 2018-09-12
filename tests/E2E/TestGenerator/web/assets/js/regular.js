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
        var selected = '../../test/campaigns/regular/' + $('#listFolders :selected').text();
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
    $('input[type="checkbox"][name="module"]').change(function () {
        if (this.checked) {
            $("#divMod").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpMod",
                name: "MODULE",
                placeholder: "Module technical name to install (default to \"gadwords\")"
            })).show();
        }
        else {
            $("#divMod").hide();
            $("#InpMod").remove();
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
    $('input[type="checkbox"][name="dbServer"]').change(function () {
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
    $('input[type="checkbox"][name="dbUser"]').change(function () {
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
    $('input[type="checkbox"][name="dbPwd"]').change(function () {
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

    ///////*******////////*********///////
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
    $('input[type="checkbox"][name="moduleSpec"]').change(function () {
        if (this.checked) {
            $("#divModSpec").append($("<input />", {
                type: "text",
                class: "form-control",
                id: "InpModSpec",
                name: "MODULE",
                placeholder: "Module technical name to install (default to \"gadwords\")"
            })).show();
        }
        else {
            $("#divModSpec").hide();
            $("#InpModSpec").remove();
        }
    });


    $('input[type="checkbox"][name="dbEmptyPwdSpec"]').change(function () {
        if (this.checked) {
            $("#divDbEPSpec").show();
        }
        else {
            $("#divDbEPSpec").hide();
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
    $('input[type="checkbox"][name="dbServerSpec"]').change(function () {
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
    $('input[type="checkbox"][name="dbUserSpec"]').change(function () {
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
    $('input[type="checkbox"][name="dbPwdSpec"]').change(function () {
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

    $('#install_check').popover({
        trigger: 'focus'
    });
    $('#testAddons_check').popover({
        trigger: 'focus'
    });
    $('#dbEmptyPwd_check').popover({
        trigger: 'focus'
    });
    $('#installSpec_check').popover({
        trigger: 'focus'
    });
    $('#testAddonsSpec_check').popover({
        trigger: 'focus'
    });
    $('#dbEmptyPwdSpec_check').popover({
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

});


function generateCmdSpec() {
    var folder = document.getElementById("listFolders").options[document.getElementById("listFolders").selectedIndex].value;
    if ("" === folder) {
        swal({
            title: "Error !",
            text: "You have to select a path, if you don't have one, you can run All the compaign Regular",
            icon: "error",
            button: "Okay",
        });
        return false;
    }
    var file = document.getElementById("listFiles");
    var url = document.getElementById("InpUrlSpec");
    var module = document.getElementById("InpModSpec");
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
    var install = null;
    if (document.getElementById("installSpec_check").checked) {
        install = document.getElementById("installSpec_check");
    }
    var headless = null;
    if (document.getElementById("headlessSpec").checked) {
        headless = document.getElementById("headlessSpec");
    }
    var testAddons = null;
    if (document.getElementById("testAddonsSpec_check").checked) {
        testAddons = document.getElementById("testAddonsSpec_check");
    }
    var db_ep = null;
    if (document.getElementById("dbEmptyPwdSpec_check").checked) {
        db_ep = document.getElementById("dbEmptyPwdSpec_check");
    }

    var params = {
        URL: url,
        MODULE: module,
        INSTALL: install,
        TEST_ADDONS: testAddons,
        LANGUAGE: language,
        COUNTRY: country,
        DB_SERVER: db_s,
        DB_USER: db_u,
        DB_PASSWD: db_p,
        DB_EMPTY_PASSWD: db_ep,
        HEADLESS: headless
    };
    cmd = "path=regular/" + folder + file + " npm run specific-test --";
    var check_if_null = "";
    for (var param in params) {
        check_if_null = check_if_null + params[param];
        if (null !== params[param]) {
            if ("" !== params[param].value) {
                cmd = cmd + " --" + param + "=" + params[param].value;
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
    if (check_if_null.includes("object") === false) {
        var cmd = "path=regular/" + folder + file + " npm run specific-test";

    }

    swal({
        title: "Your Command Is :",
        text: cmd,
        icon: "success",
        button: "Okay",
    });


}

function generateCmd() {
    var url = document.getElementById("InpUrl");
    var module = document.getElementById("InpMod");
    var language = document.getElementById("InpLan");
    var country = document.getElementById("InpCou");
    var db_s = document.getElementById("InpDbS");
    var db_u = document.getElementById("InpDbU");
    var db_p = document.getElementById("InpDbP");

    var install = null;
    if (document.getElementById("install_check").checked) {
        install = document.getElementById("install_check");
    }
    var headless = null;
    if (document.getElementById("headless").checked) {
        headless = document.getElementById("headless");
    }
    var testAddons = null;
    if (document.getElementById("testAddons_check").checked) {
        testAddons = document.getElementById("testAddons_check");
    }
    var db_ep = null;
    if (document.getElementById("dbEmptyPwd_check").checked) {
        db_ep = document.getElementById("dbEmptyPwd_check");
    }

    var params = {
        URL: url,
        MODULE: module,
        INSTALL: install,
        TEST_ADDONS: testAddons,
        LANGUAGE: language,
        COUNTRY: country,
        DB_SERVER: db_s,
        DB_USER: db_u,
        DB_PASSWD: db_p,
        DB_EMPTY_PASSWD: db_ep,
        HEADLESS: headless
    };
    cmd = 'npm test --';
    var check_if_null = "";
    for (var param in params) {
        check_if_null = check_if_null + params[param];
        if (null !== params[param]) {
            if ("" !== params[param].value) {
                cmd = cmd + " --" + param + "=" + params[param].value;
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
    if (check_if_null.includes("object") === false) {
        cmd = "npm test";

    }

    swal({
        title: "Your Command Is :",
        text: cmd,
        icon: "success",
        button: "Okay",
    });

    document.getElementById("cmd").value = cmd;
    console.log(document.getElementById("cmd").value);
}