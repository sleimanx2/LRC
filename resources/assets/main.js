/*
 * Formatting Functions
 */
$(document).on('input', '.format-title-case', function(event) {
    $(this).val($(this).val().replace(/[^a-zA-Z\-\s]/g,'').toLowerCase().replace( /\b\w/g, function (m) {
        return m.toUpperCase();
    }));
});

$(document).on('input', '.format-number', function(event) {
    $(this).val($(this).val().replace(/[^0-9]/g,''));
});

$(document).on('input', '.format-phone', function(event) {
    //$(this).val($(this).val().replace(/^[^+]?[^0-9]/g,''));
});

/*
 * Phonebook Functions
 */
 function initPhonebook() {
    $('#table-FirstAiders').DataTable({
        "paging": false,
        "info": false,
        "ordering": true,
        "scrollY": ($(window).height() - 170) + "px",
        "scrollCollapse": false,
        "order": [ [1,'desc'], [2,'desc'], [6,'asc'], [3,'asc'] ],
        "columnDefs": [
            { "visible": false, "targets": [0, 1, 2] }
        ],
        "oLanguage": {
            "sEmptyTable": function() { return "No First Aiders Found"; },
            "sZeroRecords": function() { return "No First Aiders Found" }
        },
        "ajax": "/phonebook/get-first-aiders-json"
    });
    $('#table-FirstAiders').DataTable().column(0).search("0").draw();

    $('#table-MedicalCenters').DataTable({
        "paging": false,
        "info": false,
        "ordering": false,
        "order": [[ 1, "desc" ]],
        "scrollY": ($(window).height() - 170) + "px",
        "scrollCollapse": false,
        "columnDefs": [
            { "visible": false, "targets": [0] }
        ],
        "oLanguage": {
            "sEmptyTable": function() { return "No Medical Centers Found"; },
            "sZeroRecords": function() { return "No Medical Centers Found" }
        },
        "ajax": "/phonebook/get-medical-centers-json"
    });
    $('#table-MedicalCenters').DataTable().column(0).search("favorite").draw();

    $('#table-LrcCenters').DataTable({
        "paging": false,
        "info": false,
        "ordering": false,
        "filter": false,
        "scrollY": ($(window).height() - 111) + "px",
        "scrollCollapse": false,
        "oLanguage": {
            "sEmptyTable": function() { return "No LRC Centers Found"; },
            "sZeroRecords": function() { return "No LRC centers Found" }
        },
        "ajax": "/phonebook/get-lrc-centers-json"
    });

    $('#table-Organizations').DataTable({
        "paging": false,
        "info": false,
        "ordering": false,
        "scrollY": ($(window).height() - 170) + "px",
        "scrollCollapse": false,
        "columnDefs": [
            { "visible": false, "targets": [0] }
        ],
        "oLanguage": {
            "sEmptyTable": function() { return "Nothing Found"; },
            "sZeroRecords": function() { return "Nothing Found" }
        },
        "ajax": "/phonebook/get-organizations-json"
    });
    $('#table-Organizations').DataTable().column(0).search("favorite").draw();

    $(document).on('click', '.table-filter-btn', function() {
        $(this).closest(".phonebook-filter-pills").find("li").removeClass("active");

        if($(this).hasClass("sub"))
            $(this).closest(".btn-group").addClass("active");
        else if(!$(this).hasClass("dropdown-toggle"))
            $(this).closest("li").addClass("active");

        if($(this).hasClass("fav-title"))
            $(this).closest(".phonebook-filter-pills").find(".nav-pills-title .sub-title").text("Favorites");
        else
            $(this).closest(".phonebook-filter-pills").find(".nav-pills-title .sub-title").text($(this).text());

        $(this).closest(".tab-pane").find(".phonebook-table").DataTable().column($(this).data('filter-column')).search($(this).data('filter')).draw();
    });

    $(document).on('click', '.phonebook-nav li > a', function () {
        setTimeout(function() { $(window).trigger('resize') }, 200);
    });

    $(document).on('click', '.dial-item-btn', function () {
        var $modal = $("#modalDial");

        $modal.find(".modal-title b").text($(this).data("dial-name").toUpperCase());
        $modal.find(".dial-buttons").html("");

        $.each(JSON.parse($(this).data("dial")), function(i, item) {
            $modal.find(".dial-buttons").append("<a class='btn btn-default btn-phone-number' data-phone-number='" + item + "'>" + formatPhone(item) + "</button>")
        });

        $modal.data("phone-number", $modal.find(".dial-buttons .btn-phone-number:first-child").data("phone-number"));
        $modal.find(".dial-buttons .btn-phone-number:first-child").removeClass("btn-default").addClass("btn-success");

        $modal.modal("show");
    });

    $(document).on('click', '.btn-phone-number', function () {
        $(this).closest(".dial-buttons").find(".btn-phone-number").removeClass("btn-success");
        $(this).addClass("btn-success");
        $("#modalDial").data("phone-number", $(this).data("phone-number"));
    });

    $(document).on('click', '.btn-ip-phone', function () {
        var $modal = $(this).closest(".modal");
        var $phone_number = $modal.data("phone-number");
        var $ip_address = $(this).data("ip-address");

        // $.post("/phonebook/dial-number-api", { phone_number: $phone_number, ip_address: $ip_address }, 'json')
        //     .success(function(result) {
        //         toastr.success("", "Dialing " + $phone_number + "...", { timeOut: 3000, positionClass: "toast-top-center" });
        //     })
        //     .fail(function(result) {
        //         toastr.error("Please try again later", "Error dialing number!", { timeOut: 3000, positionClass: "toast-top-center" });
        //     })
        //     .always(function() {
        //         $modal.modal("hide");
        //     });

        toastr.success("", "Dialing " + $phone_number + "...", { timeOut: 3000, positionClass: "toast-top-center" });
        $modal.modal("hide");
    });
}

function formatPhone(phoneNumber) {
    if(phoneNumber.length == 8)
        return phoneNumber.substring(0, 2) + " " + phoneNumber.substring(2, 5) + " " + phoneNumber.substring(5, 8);

    return phoneNumber;
}

function showPhonebookSidebar() {
    $(".phonebook-container").addClass("open");
}

function hidePhonebookSidebar() {
    $(".phonebook-container").removeClass("open");
}

/*
 * Init a blank google map
 */
function initMap() {
    var mapOptions = {
        center: {lat: 33.891995, lng: 35.501337},
        zoom: 9
    };
    window.map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
}

/*
* Helper method called when the location is changed in the location/destination fields
*/
function moveMap() {
    if( isNaN(location_latitude) && isNaN(location_longitude) )
    {
      location_latitude = location_latitude.val();
      location_longitude = location_longitude.val();
      location_name = location_name.val();
  }

    // Getting coordinates
    var location_coordinates = new google.maps.LatLng(location_latitude, location_longitude);

    //Removing location marker if available
    if (location_marker !== null) {
        location_marker.setMap(null);
    }

    // Setting up the location marker.
    var location_pinColor = "E74C3C";
    var location_pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + location_pinColor,
        new google.maps.Size(21, 34),
        new google.maps.Point(0, 0),
        new google.maps.Point(10, 34));

    location_marker = new google.maps.Marker({
        position: location_coordinates,
        map: map,
        title: location_name,
        icon: location_pinImage
    });


    if(typeof destination_latitude !== 'undefined') {

        var destination_coordinates = new google.maps.LatLng(destination_latitude.val(), destination_longitude.val());

        //Removing destination marker if available
        if (destination_marker !== null) {
            destination_marker.setMap(null);
        }
        // Setting up the location marker.
        var destination_pinColor = "27AE60";
        var destination_pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + destination_pinColor,
            new google.maps.Size(21, 34),
            new google.maps.Point(0, 0),
            new google.maps.Point(10, 34));

        destination_marker = new google.maps.Marker({
            position: destination_coordinates,
            map: map,
            title: destination_name.val(),
            icon: destination_pinImage
        });
    }

    // Moving the map to the marker
    map.panTo(location_coordinates);
    map.setZoom(12);
}

/*
 * Element Initialization Functions
 */
function initNumberInput() {
    $('.btn-number').click(function(e){
        e.preventDefault();

        fieldName = $(this).attr('data-field');
        type      = $(this).attr('data-type');
        var input = $("input[name='"+fieldName+"']");
        var currentVal = parseInt(input.val());

        if (!isNaN(currentVal)) {
            if(type == 'minus') {

                if(currentVal > input.attr('min')) {
                    input.val(currentVal - 1).change();
                }
                if(parseInt(input.val()) == input.attr('min')) {
                    $(this).attr('disabled', true);
                }

            } else if(type == 'plus') {

                if(currentVal < input.attr('max')) {
                    input.val(currentVal + 1).change();
                }
                if(parseInt(input.val()) == input.attr('max')) {
                    $(this).attr('disabled', true);
                }

            }
        } else {
            input.val(0);
        }
    });

    $('.input-number').focusin(function(){
        $(this).data('oldValue', $(this).val());
    });

    $('.input-number').change(function() {

        minValue =  parseInt($(this).attr('min'));
        maxValue =  parseInt($(this).attr('max'));
        valueCurrent = parseInt($(this).val());

        name = $(this).attr('name');
        if(valueCurrent >= minValue) {
            $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the minimum value was reached');
            $(this).val($(this).data('oldValue'));
        }
        if(valueCurrent <= maxValue) {
            $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
        } else {
            alert('Sorry, the maximum value was reached');
            $(this).val($(this).data('oldValue'));
        }
    });

    $(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
             (e.keyCode == 65 && e.ctrlKey === true) ||
             // Allow: home, end, left, right
             (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
             return;
         }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
}

function initGenderToggle() {
    $('.btn-toggle-gender').each(function() {
        if($(this).closest('.input-group').find('.patient-gender-hidden-input').val() == "female")
            $(this).find("i.fa").removeClass("fa-male").addClass("fa-female");
    });

    $(document).on('click', ".btn-toggle-gender", function() {
        var gender = $("input[name='patient_gender']").val();

        if(gender == 'male') {
            $(this).find("i").removeClass("fa-male").addClass("fa-female");
            $("input[name='patient_gender']").val("female");
        }
        else {
            $(this).find("i").removeClass("fa-female").addClass("fa-male");
            $("input[name='patient_gender']").val("male");
        }
    });
}

function initAutoGrow() {
    $("textarea").autoGrow();
}

function initSelect2() {
    $("select:not(.blood-type-select)").select2({
        placeholder: "Select One"
    });

    $("select.blood-type-select").select2();
}

function initDateTimePicker() {
    $('.datetimepicker').datetimepicker();
    $('.datepicker').datetimepicker({ format:'YYYY-MM-DD'});
    $('.timepicker').datetimepicker({ format: 'LT'});
}

function initTagsInput() {
    $('.tagsinput').tagsinput({
        tagClass: 'tagsinput-tag',
        trimValue: false,
        confirmKeys: [13, 32]
    });

    $(document).on('beforeItemAdd', '.format-phone.tagsinput', function(event) {
        var tag = event.item.trim();
                
        if (!event.options || !event.options.checkFormat) {
            event.cancel = true;

            if(tag.match(/^[+]?[0-9]+$/))
                $(this).tagsinput('add', tag, { checkFormat: true });
        }
    });

    $(document).on('beforeItemAdd', '.format-number.tagsinput', function(event) {
        var tag = event.item.trim();
                
        if (!event.options || !event.options.checkFormat) {
            event.cancel = true;

            if(tag.match(/^[1-9]+$/))
                $(this).tagsinput('add', tag, { checkFormat: true });
        }
    });
}

/*
* Boot function that is called on each page request
*/
function boot(){
    $(document).ready(function() {
        initPhonebook();
        initSelect2();
        initDateTimePicker();
        initNumberInput();
        initAutoGrow();
        initGenderToggle();
        initTagsInput();
    });
}

boot();