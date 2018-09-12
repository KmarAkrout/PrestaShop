$('#screen').on('click', function () {
    $('#load').show();
    $('#links').empty();
    $.ajax({
        url: "/getScreenShots",
        success:
            function (data) {
                res = data.split("\n");
                for (i = 0; i < res.length - 1; i++) {
                    $('#links').append($("<div />", {
                            class: 'column1',


                        }).append($("<div />", {
                            class: 'gallery',

                        }).append($("<a />", {
                            href: 'assets/screenshots/' + res[i],
                            title: res[i]

                        }).append($("<img />", {
                            src: 'assets/screenshots/' + res[i],
                            alt: res[i],

                        })))
                        )
                    );
                }

            },
        complete: function () {
            $('#load').hide();
        }
    });
});
document.getElementById('links').onclick = function (event) {
    event = event || window.event;
    var target = event.target || event.srcElement,
        link = target.src ? target.parentNode : target,
        options = {index: link, event: event},
        links = this.getElementsByTagName('a');
    blueimp.Gallery(links, options);
};