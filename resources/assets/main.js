// CSRF protection
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

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
 var table_FirstAiders, table_MedicalCenters, table_LrcCenters, table_Organizations;

 function initPhonebook() {
    table_FirstAiders = $('#table-FirstAiders').DataTable({
        "tabIndex": -1,
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

    table_MedicalCenters = $('#table-MedicalCenters').DataTable({
        "tabIndex": -1,
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

    table_LrcCenters = $('#table-LrcCenters').DataTable({
        "tabIndex": -1,
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

    table_Organizations = $('#table-Organizations').DataTable({
        "tabIndex": -1,
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

        $data = $(this).data("dial");

        if(isJSONString($data))
            $returnData = JSON.parse($data);
        else
            $returnData = $data;
        
        $.each($returnData, function(i, item) {
            if(item) $modal.find(".dial-buttons").append("<a class='btn btn-default btn-phone-number' data-phone-number='" + item + "'>" + formatPhone(item) + "</button>")
        });
 
        if($(this).data("log-request-id") && $(this).data("log-call-type")) {
            $modal.data("log-request-id", $(this).data("log-request-id"));
            $modal.data("log-call-type", $(this).data("log-call-type"));
            if($(this).data("log-donor-id"))
                $modal.data("log-donor-id", $(this).data("log-donor-id"));
            else
                $modal.data("log-donor-id", 0);
        }

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

        if($modal.data("log-request-id"))
            $.post("/blood/requests/append-call-log", { blood_request_id: $modal.data("log-request-id"), donor_id: $modal.data("log-donor-id"), call_type: $modal.data("log-call-type") });

        $.post("/phonebook/dial-number-api", { phone_number: $phone_number, ip_address: $ip_address }, 'json')
            .success(function(result) {
                toastr.success("", "Dialing " + formatPhone($phone_number) + "...", { timeOut: 3000, positionClass: "toast-top-center" });
            })
            .fail(function(result) {
                toastr.error("Please try again later", "Error dialing number!", { timeOut: 3000, positionClass: "toast-top-center" });
            })
            .always(function() {
                $modal.modal("hide");
                hidePhonebookSidebar();
            });
    });

    $(".dataTables_filter").find("input").attr("tabindex", "-1");

    $(".quickdial-OR").data("dial", '["05458204"]');
    $(".quickdial-206").data("dial", '["140"]');
}

function formatPhone(phoneNumber) {
    if(phoneNumber.length == 8)
        return phoneNumber.substring(0, 2) + " " + phoneNumber.substring(2, 5) + " " + phoneNumber.substring(5, 8);

    return phoneNumber;
}

function refreshPhonebook() {
    table_FirstAiders.ajax.reload();
    table_MedicalCenters.ajax.reload();
    table_LrcCenters.ajax.reload();
    table_Organizations.ajax.reload();
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
    location_latitude_value = location_latitude.val();
    location_longitude_value = location_longitude.val();
    location_name_value = location_name.val();

    // Getting coordinates
    var location_coordinates = new google.maps.LatLng(location_latitude_value, location_longitude_value);

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
        title: location_name_value,
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
    map.setZoom(17);
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
    $("select:not(.blood-type-select):not(.tagsinput):not(.ajax-search-select)").select2({
        placeholder: "Select One"
    });

    $("select.ajax-search-select").select2({
        ajax: {
            url: "/blood/donors/search",
            method: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                    term: params.term
                };
            },
            processResults: function (data, params) {
                return {
                    results: data
                };
            },
            cache: false
        },
        escapeMarkup: function (markup) { return markup; },
        placeholder: "Search...",
        minimumInputLength: 3,
        multiple: true,
        maximumSelectionSize: 1,
        templateResult: formatDonorSearchResult,
        templateSelection: formatDonorSearchSelection
    });

    $("select.blood-type-select").select2({
        minimumResultsForSearch: Infinity,
        placeholder: " "
    });

    function formatDonorSearchResult ($search) {
        if ($search.loading) return "Searching...";

        var markup = "<div class='select2-result-item clearfix'>" +
            "   <div class='select2-result-item-icon'><i class='fa fa-user'></i></div>" +
            "   <div class='select2-result-item-title with-icon'>" + $search.name + "</div>" +
            "   <div class='select2-result-item-info with-icon'>" +
            "       <div><i class='fa fa-phone'></i> " + $search.phone + "</div>" +
            "       <div><i class='fa fa-map-marker'></i> " + $search.location + "</div>" +
            "   </div>" +
            "</div>";

        return markup;
    }

    function formatDonorSearchSelection ($search) {
        return $search.name;
    }

    $(document).on('click', '.ajax-search-select + .select2 .select2-selection--multiple', function() {
        if($(this).find(".select2-selection__choice").length)
            $("body > .select2-container.select2-container--open").addClass("hidden");
        else
            $("body > .select2-container.select2-container--open").removeClass("hidden");
    });

    $(document).on('input', '.ajax-search-select + .select2 .select2-search.select2-search--inline', function() {
        $("body > .select2-container.select2-container--open").removeClass("hidden");
    });
}

function initDateTimePicker() {
    $('.datetimepicker').datetimepicker();
    $('.datepicker').datetimepicker({ format:'YYYY-MM-DD'});
    $('.timepicker').datetimepicker({ format: 'LT'});
}

function initTagsInput() {
    $('.tagsinput').tagsinput({
        tagClass: 'tagsinput-tag',
        trimValue: true,
        allowDuplicates: false,
        confirmKeys: [32]
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

function initCheckbox() {
    $(document).on('click', '.ui-checkbox', function(event) {
        var checkbox = $(this).find("input");
        if(checkbox.prop("checked"))
            checkbox.removeProp("checked").removeAttr("checked");
        else
            checkbox.prop("checked", true).attr("checked", true);
    });
}

function initAutoSearch() {
    $(document).on('change', '.auto-search', function(event) {
        $(this).closest("form").submit();
    });
}

function initDonorsSearchSelect() {
    $(document).find(".donors-search-select").on("select2:select", function (e) {
        $selectedDonor_id = e.params.data.id;
        $selectedDonor_gender = e.params.data.gender;
        $selectedDonor_golden = e.params.data.golden;
        $selectedDonor_name = e.params.data.name;
        $selectedDonor_age = e.params.data.age;
        $selectedDonor_phonePrimary = e.params.data.phone_primary;
        $selectedDonor_phoneSecondary = e.params.data.phone_secondary;
        $selectedDonor_notes = e.params.data.notes;

        $container = $("#modalSearchDonor").find(".search-result-container");
        
        // Reset values
        $container.find(".badge-gender").removeClass("badge-male").removeClass("badge-female").addClass("badge-" + $selectedDonor_gender);
        $container.find(".badge-gender").find("i.fa").removeClass("fa-male").removeClass("fa-female").addClass("fa-" + $selectedDonor_gender);

        if($selectedDonor_golden) $container.find(".badge-golden").show();
        else $container.find(".badge-golden").hide();
        
        $container.find(".donor-name").html("<b>" + $selectedDonor_name + "</b>");
        $container.find(".badge-age").text($selectedDonor_age + " Years");
        $container.find(".donor-notes").html($selectedDonor_notes);

        $container.find("#donorId").val($selectedDonor_id);
        $container.find("#bloodDonorId").val($selectedDonor_id);

        $container.find(".dial-item-btn").attr("data-dial", '["' + $selectedDonor_phonePrimary + '", "' + $selectedDonor_phoneSecondary + '"]');
        $container.find(".dial-item-btn").attr("data-dial-name", $selectedDonor_name);
        $container.find(".dial-item-btn").attr("data-log-donor-id", $selectedDonor_id);

        $container.show();
    });

    $(document).find(".donors-search-select").on("select2:unselect", function (e) {
        $container.hide();
    });

    $('#modalSearchDonor').on('hidden.bs.modal', function () {
        $(".donors-search-select").val(null).trigger("change");
        $("#modalSearchDonor").find(".search-result-container").hide();
    });
}

/*
* Helper Functions
*/
function isJSONString(str) {
    try {
        JSON.parse(str);
    } catch (e) {
        return false;
    }
    return true;
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
        initCheckbox();
        initAutoSearch();
        initDonorsSearchSelect();
    });
}

boot();