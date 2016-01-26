/**
 * @author Emmanuel John
 *
 */

$(function () {
    if (typeof (WSBF) == 'undefined') {
        WSBF = {};
    }
    var MAX_PREVIOUS = 3;
    initPageItems();

    var isMWidgetPlaying = false;
    var isMCenterPlaying = false;
    var isMediaCenterVisible = false;


    $("#menubtn").click(function (e) {
        e.preventDefault();
        $("#wrapper").toggleClass("active");
        $('.side_name').toggleClass("active");
    });

    //fixed header
    var shrinkHeader = 150;
    $(window).scroll(function () {
        var scroll = getCurrentScroll();
        if (scroll >= shrinkHeader) {
            $('div.nav').addClass('shrink').removeClass('hide').addClass('shadow');
            $('div.nav .logo-img img').attr('src', "images/logo_small.png").css("margin-top", "25px");
            ;
            //$('div.nav .logo-img img').css("margin-top","25px");
        }
        else {
            $('div.nav .logo-img img').attr('src', "images/logo.png").css("margin-top", "0");
            $('div.nav').removeClass('shrink');
            $('div.nav').removeClass('shadow');
        }
    });
    //returns current scroll position
    function getCurrentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
    }

    function getBrowserWidth() {
        var x = 0;
        if (self.innerHeight) {
            x = self.innerWidth;
        }
        else if (document.documentElement && document.documentElement.clientHeight) {
            x = document.documentElement.clientWidth;
        }
        else if (document.body) {
            x = document.body.clientWidth;
        }
        return x;
    }

    //load now playing info on player widget
    var widgetReloader;
    function loadInfoWidgetSmall() {
        
        //load now playing
        WSBF.playlist.getInfo( function (trackinfo) {
            //trackinfo = JSON.parse(trackinfo);
            //console.log("tryna load info: " + JSON.stringify(trackinfo));

            $(".media-widget-small .track_name").html(trackinfo.lb_track_name);
            $(".media-widget-small .artist_name").html(trackinfo.lb_artist_name);

            //load album art
            getArtwork(trackinfo.album, trackinfo.artist, ".media-widget-small .songart");

        });
    }
    function getArtwork(album, artist, img_container) {
        //load album art
        WSBF.lastfm.getAlbumInfo(album, artist, function (albuminfo) {

            //load artist image if album was not found
            if (albuminfo.hasOwnProperty("error")) {
                WSBF.lastfm.getArtistInfo(artist, function (artistinfo) {
                    if (!artistinfo.hasOwnProperty("error")) {
                        var images = artistinfo.artist.image;
                        if (images[1]["#text"] !== "" && typeof (images) !== "undefined") {
                            $(img_container).attr("src", images[1]["#text"]);
                        } else {
                            $(img_container).attr("src", "images/media_small.png");
                        }

                    } else {
                        $(img_container).attr("src", "images/media_small.png");
                    }
                });
            } else {
                var images = albuminfo.album.image;
                if (images[1]["#text"] !== "" && typeof (images) !== "undefined") {
                    $(img_container).attr("src", images[1]["#text"]);
                } else {
                    $(img_container).attr("src", "images/media_small.png");
                }

            }
        });
    }
    function getArtworkLarge(album, artist, img_container) {
        //load album art
        WSBF.lastfm.getAlbumInfo(album, artist, function (albuminfo) {
            
            //load artist image if album was not found
            if (albuminfo.hasOwnProperty("error")) {
                WSBF.lastfm.getArtistInfo(artist, function (artistinfo) {
                    if (!artistinfo.hasOwnProperty("error")) {
                        var images = artistinfo.artist.image;
                        if (images[1]["#text"] !== "" && typeof (images) !== "undefined") {
                            $(img_container).attr("src", images[1]["#text"]);
                        } else {
                            $(img_container).attr("src", "images/media_large.png");
                        }

                    } else {
                        $(img_container).attr("src", "images/media_large.png");
                    }
                });
            } else {
                var images = albuminfo.album.image;
                if (images[1]["#text"] !== "" && typeof (images) !== "undefined") {
                    $(img_container).attr("src", images[1]["#text"]);
                } else {
                    $(img_container).attr("src", "images/media_large.png");
                }

            }
        });
    }
    //load now playing information on media center
    function loadInfoMC() {
        //load now playing
        WSBF.playlist.nowplaying.getInfo(function (trackinfo) {
            $(".wsbf-player-widget .song-album").html(trackinfo.song + "/" + trackinfo.album);
            $(".wsbf-player-widget .artist-name").html(trackinfo.artist);
            var show_name_info = trackinfo.show.show_name;
            if (trackinfo.show.show_alias !== null) {
                show_name_info += "(" + trackinfo.show.show_alias + ")";
            }

            $(".wsbf-player-widget .show-name").html(show_name_info);
            $(".wsbf-player-widget .show-host").html(trackinfo.show.show_host);

            //load album art
            getArtworkLarge(trackinfo.album, trackinfo.artist, ".wsbf-player-widget .song-art");
        });
    }

    loadInfoWidgetSmall();
    //refresh nowplaying every few seconds
    widgetReloader = setInterval(function () {
        loadInfoWidgetSmall();
    }, 10000);

    $('.listen, .listen-small').on("vclick", function () {
        alert("hahah");
        displayMediaCenter();
        return false;
    });

    var playerReloader;
    var iWebcamInterval
    function displayMediaCenter() {

        $("#pageDialog").modal("show");
        isMediaCenterVisible = true;
        var root = $("#pageDialog .modal-body");
        $("#jquery_jplayer_1").jPlayer("stop");
        root.load("views/fragments/mediacenter.php", function (response, status, xhr) {
            root.css("background-color", "#000000");
            $("#media-center").fadeIn("slow");
            loadMostRecentPlaylist(".mc-playlist-container");
            //media center player control
            $("#jquery_jplayer_2").jPlayer({
                ready: function (event) {
                    $(this).jPlayer("setMedia", {
                        oga: "http://stream.wsbf.net:8000/v8",
                        mp3: "http://stream.wsbf.net:8000/high"
                    });
                },
                play: function (event) {
                    loadInfoMC();
                    //refresh nowplaying every few seconds
                    playerReloader = setInterval(function () {
                        loadInfoMC();
                    }, 8000);
                    
                    
                },
                swfPath: "js/libs/jQuery.jPlayer.2.6.0/",
                supplied: "oga, mp3",
                solution: "flash, html",
                wmode: "window",
                globalVolume: true,
                cssSelectorAncestor: '#jp_container_2',
                cssSelector: {
                    play: '.jp-play',
                    pause: '.jp-pause',
                    mute: '.jp-mute',
                    unmute: '.jp-unmute',
                    volumeBar: '.jp-volume-bar',
                    volumeBarValue: '.jp-volume-bar-value',
                    gui: '.jp-gui',
                    noSolution: '.jp-no-solution'
                }
            });
        });
        iWebcamInterval = setInterval(function () {
                $("img#webcam").attr("src","http://wsbf.net/camera/studioa.jpg?"+new Date().getTime());
        }, 5000);
        
    }
    //slider actions
    $(".rslides").responsiveSlides({
        auto: true,
        pager: true,
        nav: true,
        speed: 500,
        maxwidth: 800,
        namespace: "slider-controls",
        prevText: "",
        nextText: ""
    });

    //media widget player control
    $("#jquery_jplayer_1").jPlayer({
        ready: function (event) {
            $(this).jPlayer("setMedia", {
                oga: "http://stream.wsbf.net:8000/v8",
                mp3: "http://stream.wsbf.net:8000/high"
            });
        },
        swfPath: "js/libs/jQuery.jPlayer.2.6.0/",
        supplied: "oga, mp3",
        solution: "flash, html",
        wmode: "window",
        cssSelectorAncestor: '#jp_container_1',
        globalVolume: true
    });

    $(".close-page-dialog").click(function () {
        //$("#wrapper").show();
        //$(".media-widget-small").show();
        $("#pageDialog").modal("hide");
        // logic moved to #pageDialog modal hide event handler below - dcohen
    });

    /** 
     * Event handler - Bootstrap Modal Close
     * Moved from close-page-dialog click handler
     * (because it didn't handle the case for when the
     * user clicks outside the modal.)
     * dcohen 9/29/2014
     */
    $('#pageDialog').on('hidden.bs.modal', function (e) {
        var root = $("#pageDialog .modal-body");
        root.css("background-color", "#FFFFFF");
        $("#jquery_jplayer_2").jPlayer("stop");
        clearInterval(playerReloader);
        clearInterval(iWebcamInterval);
        if (isMediaCenterVisible === true) {
            isMediaCenterVisible = false;
        } else {
            window.history.back();
        }
    });


    //load recent playlist on home page
    function loadMostRecentPlaylist(container) {

        var parent = $(container);

        WSBF.playlist.getMostRecent( function (data) {
            parent.empty();
            $.each(data, function (key, obj) {
                var contentStr = "<div class='views-row'>" +
                                    "<div class='views-field field-icon'>" +
                                        "<div class='field-content'>" +
                                            "<img class='song-art' alt='album art' src='images/media_small.png' width='60' height='60'>" +
                                        "</div>" +
                                    "</div>" +
                                    "<div class='views-field views-field-time'>" +
                                        "<span class='field-content time'>07:00 - 11:00</span>" +
                                    "</div>" +
                                    "<div class='views-field views-field-title'>" +
                                        "<span class='field-content song-artist'>First Song</span>" +
                                    "</div>" +
                                 "</div>";

                var content = $(contentStr);
                var time_played = obj.time_played.split(" ")[1];
                time_played = tConvert(time_played);
                content.find(".time").html(time_played);
                content.find(".song-artist").html(obj.lb_track_name + " - " + obj.lb_artist);

                //retrieve album art
                getArtwork(obj.lb_album, obj.lb_artist, content.find(".song-art"));
                parent.append(content);
            });
        });
    }

    loadMostRecentPlaylist(".playlist-container");

    //refresh playlist
    setInterval(function () {
        loadMostRecentPlaylist(".playlist-container");
    }, 60000);


    $(".footer-nav-unit").hover(function () {
        $(this).find("a").css("color", "#FFFFFF");
        $(this).find("h5").css("color", "#A0BD2B");
    }, function () {
        $(this).find("a").css("color", "#AAAAAA");
        $(this).find("h5").css("color", "#72861F");
    });

    $(".footer-nav-unit a").hover(function () {
        $(this).css("color", "#FF0000");
    }, function () {
        $(this).css("color", "#FFFFFF");
    });

    $('.join-content').scrollspy({target: '.join-nav'});
    function loadSchedule(container, day) {
        var parent = $(container);
        $(".program").remove();
        $(".active").removeClass("active");
        $("#" + day).addClass("active");
        $(".date_header").html(moment().format("MMMM Do"));

        WSBF.schedule.getScheduleByDay(day, function (data) {
            var data = JSON.parse(data);
            if (data.length) {
                $.each(data, function (key, obj) {
                    var contentStr = "<div class='program'>\
                                            <p>" + tConvert(obj.start_time) + " - " + tConvert(obj.end_time) + "</p>\
                                            <p>" + obj.show_name + "</p>\
                                            <p> <strong>" + obj.preferred_name + "</strong></p>\
                                        </div>";
                    var content = $(contentStr);
                    parent.append(content);
                });
            } else {
                var contentStr = "<div class='program'>\
                                            <p></p>\
                                            <p></p>\
                                            <p> <strong>No event scheduled for this date. Check back for updates.</strong></p>\
                                        </div>";
                var content = $(contentStr);
                parent.append(content);
            }
        });
    }
    loadScheduleOnWidget(".schedule-current");
    function loadScheduleOnWidget(container) {
        var days = {
            '0': 'SUN',
            '1': 'MON',
            '2': 'TUE',
            '3': 'WED',
            '4': 'THU',
            '5': 'FRI',
            '6': 'SAT'
        };

        var day = moment().day();
        //show formatted date
        var dtoday = moment().format("MM[/]DD");

        $(".schedule-current-day").html(days[day] + " " + dtoday);

        var parent = $(container);
        $(".active").removeClass("active");
        $("#" + day).addClass("active");
        $(".date_header").html(moment().format("MMMM Do"));

        WSBF.schedule.getScheduleByDay(day, function (data) {
            //var data2 = JSON.parse(data);
            if (data.length) {
                $.each(data, function (key, obj) {
                    var contentStr = "<div class='views-row'>\
                            <div class='views-field field-icon'>\
                                <div class='field-content'><img typeof='foaf:Image' src='http://www.offradio.gr/sites/default/files/icon_18.png' width'54' height='54' alt=''>\
                                </div>\
                            </div>\
                            <div class='views-field views-field-time'>\
                                <span class='field-content'>" + tConvert(obj.start_time) + " - " + tConvert(obj.end_time) + "</span>\
                            </div>\
                            <div class='views-field views-field-title'>\
                                <span class='field-content'><strong>" + obj.show_name + "</strong></span>\
                            </div>\
                            <div class='views-field views-field-title'>\
                                <span class='field-content'><strong>" + obj.preferred_name + "</strong></span>\
                            </div>\
                        </div>";
                    /* var contentStr = "<div class='program'>\
                     <p>"+tConvert(obj.start_time)+" - "+tConvert(obj.end_time)+"</p>\
                     <p>"+obj.show_name+"</p>\
                     <p> <strong>"+obj.preferred_name+"</strong></p>\
                     </div>";*/
                    var content = $(contentStr);
                    parent.append(content);
                });
                parent.append("<a href='schedule.php' class='btn btn-default pull-right view-more'>View More</a>");
            } else {
                var contentStr = "<div class='program'>\
                                            <p></p>\
                                            <p></p>\
                                            <p> <strong>No event scheduled for this date. Check back for updates.</strong></p>\
                                        </div>";
                var content = $(contentStr);
                parent.append(content);
            }
        });
    }

    $("#showModalBtn").click(function () {
        $('#pageDialog').modal('show');
    });

    var container = document.querySelector('.blog-boxes');
    if (container) {
        var msnry;
        // initialize Masonry after all images have loaded
        imagesLoaded(container, function () {
            msnry = new Masonry(container, {
                // options
                itemSelector: '.blog-item',
                "gutter": 5
            });
        });
    }

    //load the social stream widget dynamically
    function showSocialStream() {
        $.get("views/fragments/socialstream.home.php", function (data) {
            $(".social-stream-widget").html(data);
        });
    }


    function initPageItems() {
        //slim scroll for divs
        if (getBrowserWidth() >= 768) {
            $('#in-page-content').slimScroll({
                height: '350px',
                size: '4px',
                color: "red",
                allowPageScroll: false,
                wheelStep: 10
            });
            $('.stream').slimScroll({
                height: '350px',
                size: '4px',
                color: "red",
                allowPageScroll: false,
                wheelStep: 10
            });
            //slim scroll for divs
            $('.inner-content-div').slimScroll({
                height: '350px',
                size: '4px',
                color: "red",
                allowPageScroll: false,
                wheelStep: 10
            });
        }
        $('.listen, .listen-small').click(function () {
            displayMediaCenter();
            return false;
        });
        $(".this-week li a").on('click', function () {
            loadSchedule(".programs", $(this).attr("id"));
            return false;
        });
        $('#ca-container').contentcarousel();
    }
    //returns index of string
    function istr(str, str_to_find) {
        return str.indexOf(str_to_find);
    }
    //util for ajaxifying pages

    //See http://takazudo.github.io/jQuery.LazyJaxDavis/doc/ for hel using this plugin
    new $.LazyJaxDavis(function (router) {
        var $root = $('#wrapper');
        var $dialog = $("#pageDialog");
        var $dialog_root = $("#pageDialog .modal-body");
        //router options
        router.option({
            davis: {
                throwErrors: false,
                handleRouteNotFound: true
            }
        });

        router.bind('everyfetchstart', function (page) {
            window.scrollTo(0, 0);
            $root.css('opacity', 0.5);
            //TODO: Display Loading...
            //$root.empty().append("Loading...").css("text-align","center");
        });

        router.bind('everyfetchsuccess', function (page) {
            $root.css('opacity', 1);

            $newcontent = $(page.rip('content')).hide();

            var pt = page.path;
            //the following pages are loaded into a dialog if needed otherwise embeded
            // MAF 10/16/2014 removed "staff" because it isn't an interactive page
            if (istr(pt, "contact") !== -1 || istr(pt, "equipment") !== -1) {
                $dialog_root.empty().append($newcontent);
                $dialog.modal('show');
            } else if (istr(pt, "join") !== -1) {
                $dialog_root.empty().append($newcontent);
                $dialog.modal('show');
                $('.join-content').scrollspy({target: '.join-nav'});
            } else if (istr(pt, "schedule") !== -1) {
                $dialog_root.empty().append($newcontent);
                $(".this-week li a").on('click', function () {
                    loadSchedule(".programs", $(this).attr("id"));
                    return false;
                });
                $dialog.modal('show');
            } else {//its not a dialog page
                $dialog_root.empty();
                $dialog.modal("hide");
                $newcontent.find('.dropdown-toggle').dropdownHover();
                $root.empty().append($newcontent);
                initPageItems();
                $newcontent.find('.listen, .listen-small').click(function () {
                    displayMediaCenter();
                    return false;
                });

                //dynamically load all the widgets
                loadScheduleOnWidget(".schedule-current");
                loadMostRecentPlaylist(".playlist-container");
                showChartsWidget();
                showSocialStream();
                !function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location) ? 'http' : 'https';
                    if (!d.getElementById(id)) {
                        js = d.createElement(s);
                        js.id = id;
                        js.src = p + "://platform.twitter.com/widgets.js";
                        fjs.parentNode.insertBefore(js, fjs);
                    }
                }(document, "script", "twitter-wjs");
            }

            if (istr(pt, "index") !== -1) {
                //slider actions
                $(".rslides").responsiveSlides({
                    auto: true,
                    pager: true,
                    nav: true,
                    speed: 500,
                    maxwidth: 800,
                    namespace: "slider-controls",
                    prevText: "",
                    nextText: ""
                });
            }
            if (istr(pt, "blog") !== -1) {
                var container = document.querySelector('.blog-boxes');
                if (container) {
                    var msnry;
                    // initialize Masonry after all images have loaded
                    imagesLoaded(container, function () {
                        msnry = new Masonry(container, {
                            // options
                            itemSelector: '.blog-item',
                            "gutter": 5
                        });
                    });
                }
            }
            $newcontent.fadeIn();
            page.trigger('pageready');
        });

        router.bind('everyfetchfail', function () {
            alert('ajax error!');
            $root.css('opacity', 1);
        });
        router.route([
            {
                path: '/wsbf/',
                fetchstart: function (page) {
                },
                fetchsuccess: function (page) {
                },
                pageready: function () {

                    $(".rslides").responsiveSlides({
                        auto: true,
                        pager: true,
                        nav: true,
                        speed: 500,
                        maxwidth: 800,
                        namespace: "slider-controls",
                        prevText: "",
                        nextText: ""
                    });
                }
            },
            {
                path: '/schedule.php',
                fetchstart: function (page) {
                },
                fetchsuccess: function (page) {

                },
                pageready: function () {
                    loadSchedule(".programs", moment().day());
                }
            },
            {
                path: '/charts.php',
                fetchstart: function (page) {
                },
                fetchsuccess: function (page) {

                },
                pageready: function () {
                    loadChartsPage();
                }
            }
        ]);
    });

    showChartsWidget();
    function loadChartsPage() {
        var wk_end = new Date();
        var wk_start = new Date();
        var prev_wk_start = new Date();

        wk_end = getLastSaturday(wk_end);
        wk_start.setDate(wk_end.getDate() - 7);
        prev_wk_start.setDate(wk_start.getDate() - 7);

        $(".chart-main .week-date span:first-child").html(moment(wk_start).format("ddd. MM/DD"));
        $(".chart-main .week-date span:last-child").html(moment(wk_end).format("ddd. MM/DD"));

        showCharts(prev_wk_start, wk_start, wk_end);

        //previous action
        var num_clicks = 0;
        $(".chart-main .prev-wk").click(function () {
            var next = $(".chart-main .next-wk");
            var curr = $(".chart-main .curr-wk");
            if (num_clicks < MAX_PREVIOUS) {

                wk_start.setDate(wk_start.getDate() - 7);
                prev_wk_start.setDate(prev_wk_start.getDate() - 7);
                wk_end.setDate(wk_end.getDate() - 7);

                $(".chart-main .week-date span:first-child").html(moment(wk_start).format("ddd. MM/DD"));
                $(".chart-main .week-date span:last-child").html(moment(wk_end).format("ddd. MM/DD"));

                showCharts(prev_wk_start, wk_start, wk_end);

                if (next.attr("disabled") === "disabled") {
                    $(next).attr("disabled", false);
                }
                if (curr.attr("disabled") === "disabled") {
                    $(curr).attr("disabled", false);
                }
            }
            if (num_clicks !== MAX_PREVIOUS)
                ++num_clicks;

            if (num_clicks === MAX_PREVIOUS) {
                //disable button
                $(this).attr("disabled", true);
            }
        });

        //next action
        $(".chart-main .next-wk").click(function () {
            var prev = $(".chart-main .prev-wk");
            var curr = $(".chart-main .curr-wk");
            if (num_clicks > 0) {

                wk_start.setDate(wk_start.getDate() + 7);
                prev_wk_start.setDate(prev_wk_start.getDate() + 7);
                wk_end.setDate(wk_end.getDate() + 7);

                $(".chart-main .week-date span:first-child").html(moment(wk_start).format("ddd. MM/DD"));
                $(".chart-main .week-date span:last-child").html(moment(wk_end).format("ddd. MM/DD"));

                showCharts(prev_wk_start, wk_start, wk_end);

                if (prev.attr("disabled") === "disabled") {
                    $(prev).attr("disabled", false);
                }
                if (curr.attr("disabled") === "disabled") {
                    $(curr).attr("disabled", false);
                }
            }

            if (num_clicks !== 0)
                --num_clicks;

            if (num_clicks === 0) {
                //disable button
                $(this).attr("disabled", true);
                $(curr).attr("disabled", true);
            }
        });

        //current button action
        $(".chart-main .curr-wk").click(function () {
            num_clicks = 0;
            $(this).attr("disabled", true);
            $(".chart-main .next-wk").attr("disabled", true);
            $(".chart-main .prev-wk").attr("disabled", false);

            wk_end = new Date();
            wk_start = new Date();
            prev_wk_start = new Date();

            wk_end = getLastSaturday(wk_end);
            wk_start.setDate(wk_end.getDate() - 7);
            prev_wk_start.setDate(wk_start.getDate() - 7);

            $(".chart-main .week-date span:first-child").html(moment(wk_start).format("ddd. MM/DD"));
            $(".chart-main .week-date span:last-child").html(moment(wk_end).format("ddd. MM/DD"));

            showCharts(prev_wk_start, wk_start, wk_end);

        });


    }

    function showCharts(prev_wk_start, wk_start, wk_end) {


        WSBF.charts.getCharts(prev_wk_start.getTime(), wk_start.getTime(), wk_end.getTime(), function (data) {
            data = JSON.parse(data);

            var thead = $(".chart-main .charts-table .chart-table-head");
            $(".chart-main .charts-table").empty().append(thead);

            if (!data.error) {

                $.each(data, function (key, obj) {

                    if (parseInt(obj.rank) > 100) {
                        return false;
                    }

                    var tr = $("<tr></tr>").hide();
                    var td = $("<td></td>");
                    var ul = $("<ul></ul>");
                    var li = $("<li></li>");
                    var img = $("<img src='' />");

                    //display position
                    var pos = td.clone().addClass("position").append("<h1>" + obj.rank + "</h1>");
                    tr.append(pos); //append position


                    //display change
                    var chng = td.clone().addClass("change");
                    var chng_icon = $("<i class='fa'></i>");

                    if (obj.change === "NEW!") {
                        chng.append(obj.change);
                    } else {
                        var poschange = parseInt(obj.change);
                        if (poschange === 0) {
                            //no change
                            chng_icon.addClass("fa-minus");
                        } else if (poschange > 0) {
                            //change up
                            chng_icon.addClass("fa-long-arrow-up");
                            chng.addClass("up");
                        } else {
                            //change down
                            chng_icon.addClass("fa-long-arrow-down");
                            poschange *= -1;
                            chng.addClass("down");
                        }
                        chng.append(chng_icon);
                        if (poschange !== 0) {
                            chng.append("<span>" + poschange + "</span>");
                        }
                    }
                    tr.append(chng); //append change

                    //display # of plays
                    tr.append(td.clone().addClass("plays").append(obj.count));

                    //display album info and album art
                    var songinfo = td.clone().addClass("songinfo");
                    img.addClass("img").addClass("img-rounded").addClass("pull-left").attr("alt", "album art for " + obj.album);
                    getArtwork(obj.album, obj.artist, img);
                    var s_ul = ul.clone();
                    s_ul.append(li.clone().append(img));
                    s_ul.append(
                            li.clone().append(
                            ul.clone().append(li.clone().append("<strong>" + obj.album + "</strong>"))
                            .append(li.clone().append(obj.artist))
                            .append(li.clone().append("(" + obj.label + ")"))
                            )
                            );

                    songinfo.append(s_ul);
                    tr.append(songinfo);
                    tr.attr("id", obj.rank);
                    imagesLoaded(tr, function () {
                        $(".chart-main .charts-table").append(tr);
                        tr.fadeIn();
                    });

                });
            }
            else {
                alert("No more charts found");
            }
        });
    }

    function showChartsWidget() {
        var wk_end = new Date();
        var wk_start = new Date();
        var prev_wk_start = new Date();

        wk_end = getLastSaturday(wk_end);
        wk_start.setDate(wk_end.getDate() - 7);
        prev_wk_start.setDate(wk_start.getDate() - 7);

        WSBF.charts.getCharts(prev_wk_start.getTime(), wk_start.getTime(), wk_end.getTime(), function (data) {
            data = JSON.parse(data);
            var table_container = $(".chart-home table");
            if (!data.error) {
                $.each(data, function (key, obj) {
                    if (parseInt(obj.rank) > 10) {
                        return false;
                    }
                    var tr = $("<tr></tr>").hide();
                    var td = $("<td></td>");
                    var img = $("<img src='' />");

                    //display position
                    var pos = td.clone().addClass("position").append("<span>" + obj.rank + "</span>");
                    tr.append(pos); //append position

                    //display change
                    var chng = td.clone().addClass("change");
                    var chng_icon = $("<i class='fa'></i>");

                    if (obj.change === "NEW!") {
                        chng.append(obj.change);
                    } else {
                        var poschange = parseInt(obj.change);
                        if (poschange === 0) {
                            //no change
                            chng_icon.addClass("fa-minus");
                        } else if (poschange > 0) {
                            //change up
                            chng_icon.addClass("fa-long-arrow-up");
                            chng.addClass("up");
                        } else {
                            //change down
                            chng_icon.addClass("fa-long-arrow-down");
                            poschange *= -1;
                            chng.addClass("down");
                        }
                        chng.append(chng_icon);
                    }
                    tr.append(chng); //append change

                    //display album info and album art
                    img.addClass("img").addClass("img-rounded").addClass("pull-left").attr("alt", "album art for " + obj.album);
                    getArtwork(obj.album, obj.artist, img);
                    //display image
                    tr.append(td.clone().addClass("artwork").append(img));

                    var songinfo = td.clone().addClass("songinfo");

                    songinfo.append("<h3>" + obj.album + "</h3>");
                    songinfo.append("<h4>" + obj.artist + "</h4>");
                    tr.append(songinfo);
                    imagesLoaded(tr, function () {
                        table_container.append(tr);
                        tr.fadeIn();
                    });

                });
            }
        });
    }

    function getLastSaturday(date) {
        if (date.getDay() !== 6) {
            date.setDate(date.getDate() - (6 - date.getDay() + 1));
        }
        return date;
    }
});
