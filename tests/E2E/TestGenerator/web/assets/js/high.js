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
        var selected = '../../test/campaigns/high/' + $('#listFolders :selected').text();
        $.ajax({
            type: "POST",
            url: "/getFiles",
            data: {'selected': selected},
            success: function (data) {
                var allFiles = $.map(data.split("***"), function (v) {
                    return v === "" ? null : v;
                });
                $("#FileDiv").show();
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

function generateCmd() {
    var headless = "";
    if (document.getElementById("headless").checked) {
        headless = document.getElementById("headless").value;
    }
    var dir = document.getElementById("dir").value;
    if ("" === dir) {
        swal({
            title: "Error !",
            text: "You forgot to specify your Download Directory (exp: /home/toto/Downloads/), IT IS A REQUIRED OPTION !",
            icon: "error",
            button: "Okay",
        });
        return false;
    }
    var module = document.getElementById("module").value;
    var url = document.getElementById("url").value;
    var params = {
        URL: url,
        MODULE: module,
        DIR: dir,
        HEADLESS: headless
    };

    var cmd = "npm run high-test --";

    for (var param in params) {

        if ("" !== params[param]) {
            cmd = cmd + " --" + param + "=" + params[param];
        }
    }
    swal({
        title: "Your Command Is :",
        text: cmd,
        icon: "success",
        button: "Okay",
    });
}

function generateSpecCmd() {
    var listFolders = document.getElementById("listFolders");
    var folder = listFolders.options[listFolders.selectedIndex].value;
    if ("" === folder) {
        swal({
            title: "Error !",
            text: "You have to select a path, if you don't have one, you can run All compaign High",
            icon: "error",
            button: "Okay",
        });
        return false;
    }
    var listFiles = document.getElementById("listFiles");
    var file = "";
    if (listFiles !== null) {
        file = listFiles.options[listFiles.selectedIndex].value;
    }
    var headless = "";
    if (document.getElementById("headlessSpec").checked) {
        headless = document.getElementById("headlessSpec").value;
    }
    var dir = document.getElementById("dirSpec").value;
    if ("" === dir) {
        swal({
            title: "Error !",
            text: "You forgot to specify your Download Directory (exp: /home/toto/Downloads/), IT IS A REQUIRED OPTION !",
            icon: "error",
            button: "Okay",
        });
        return false;
    }
    var module = document.getElementById("moduleSpec").value;
    var url = document.getElementById("urlSpec").value;
    var params = {
        URL: url,
        MODULE: module,
        DIR: dir,
        HEADLESS: headless
    };
    var cmd = "path=high/" + folder + file + " npm run specific-test --";

    for (var param in params) {

        if ("" !== params[param]) {
            cmd = cmd + " --" + param + "=" + params[param];
        }
    }
    swal({
        title: "Your Command Is :",
        text: cmd,
        icon: "success",
        button: "Okay",
    });
}