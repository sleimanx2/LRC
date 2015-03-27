/*
 Application controllers
 Main controllers for the app
 */

angular.module("app.controllers", []).controller("AdminAppCtrl", ["$scope",
    function ($scope) {
        $scope.info = {
            theme_name: "LRC Intranet",
            user_name: "Jane Doe"
        };


    }
]).controller("NavCtrl", ["$scope",
    function ($scope) {


    }
]).controller("DashboardCtrl", ["$scope",
    function ($scope) {


    }
]);


/*
 App Form validations
 Validator functions for form elements
 */

angular.module("app.form.map", [])
    .controller("locationFormCtrl", ["$scope",
        function ($scope) {

            //Initializing Google map
            $scope.location_marker = null;
            $scope.destination_marker = null;


            function initialize() {
                var mapOptions = {
                    center: {lat: -34.397, lng: 150.644},
                    zoom: 12
                };
                $scope.formMap = new google.maps.Map(document.getElementById('map-canvas'),
                    mapOptions);

                $scope.$apply();

                $scope.moveMap();
            }

            google.maps.event.addDomListener(window, 'load', initialize);
            //End Google map Init


            function moveMap() {
                // Getting coordinates
                var location_coordinates = new google.maps.LatLng($scope.form.location_latitude, $scope.form.location_longitude);
                var destination_coordinates = new google.maps.LatLng($scope.form.destination_latitude, $scope.form.destination_longitude);

                //Removing destination marker if available
                if ($scope.destination_marker !== null) {
                    $scope.destination_marker.setMap(null);
                }

                //Removing location marker if available
                if ($scope.location_marker !== null) {
                    $scope.location_marker.setMap(null);
                }

                // Setting up the location marker.
                var location_pinColor = "E74C3C";
                var location_pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + location_pinColor,
                    new google.maps.Size(21, 34),
                    new google.maps.Point(0, 0),
                    new google.maps.Point(10, 34));

                $scope.location_marker = new google.maps.Marker({
                    position: location_coordinates,
                    map: $scope.formMap,
                    title: $scope.form.location,
                    icon: location_pinImage
                });


                // Setting up the location marker.
                var destination_pinColor = "27AE60";
                var destination_pinImage = new google.maps.MarkerImage("http://chart.apis.google.com/chart?chst=d_map_pin_letter&chld=%E2%80%A2|" + destination_pinColor,
                    new google.maps.Size(21, 34),
                    new google.maps.Point(0, 0),
                    new google.maps.Point(10, 34));

                $scope.destination_marker = new google.maps.Marker({
                    position: destination_coordinates,
                    map: $scope.formMap,
                    title: $scope.form.destination,
                    icon: destination_pinImage
                });

                // Moving the map to the marker
                $scope.formMap.panTo(location_coordinates);
                $scope.formMap.setZoom(12);

            }

            $scope.moveMap = moveMap;

            // Form content
            $scope.form = {

                location: $('#location').val(),
                location_latitude: $('#location_latitude').val(),
                location_longitude: $('#location_longitude').val(),
                destination: $('#destination').val(),
                destination_latitude: $('#destination_latitude').val(),
                destination_longitude: $('#destination_longitude').val()
            };


            return $scope.form;
        }
    ])
    .directive('googleLocation', function () {
        return {
            restrict: 'E',
            replace: true,
            scope: true,
            template: '<input id="google_places_location" name="google_places_location" type="text" class="form-control" data-ng-model="form.location" data-ng-value="form.location" required/>',
            link: function ($scope, elm, attrs) {

                var autocomplete = new google.maps.places.Autocomplete($("#google_places_location")[0], {});
                google.maps.event.addListener(autocomplete, 'place_changed', function () {

                    // Getting place info from autocomplete
                    var place = autocomplete.getPlace();

                    $scope.form.location = place.formatted_address;
                    $scope.form.location_latitude = place.geometry.location.lat();
                    $scope.form.location_longitude = place.geometry.location.lng();

                    $scope.$apply();
                    $scope.moveMap();

                });
            }
        }
    })
    .directive('googleDestination', function () {
        return {
            restrict: 'E',
            replace: true,
            scope: true,
            template: '<input id="google_places_destination" placeholder="Enter a destination" name="google_places_destination" type="text" class="form-control" data-ng-model="form.destination" data-ng-value="form.destination" required/>',
            link: function ($scope, elm, attrs) {

                var autocomplete = new google.maps.places.Autocomplete($("#google_places_destination")[0], {});
                google.maps.event.addListener(autocomplete, 'place_changed', function () {

                    // Getting place info from autocomplete
                    var place = autocomplete.getPlace();

                    $scope.form.destination = place.formatted_address;
                    $scope.form.destination_latitude = place.geometry.location.lat();
                    $scope.form.destination_longitude = place.geometry.location.lng();

                    $scope.$apply();
                    $scope.moveMap();

                });
            }
        }
    });
;


/*
 App Form Ui Controls
 Controllers for form Ui components
 */

angular.module("app.ui.form.ctrls", [])
    .controller("TagsDemoCtrl", ["$scope",
        function ($scope) {
            $scope.tags = ["foo", "bar"];
        }
    ]).controller("DatepickerCtrl", ["$scope",
        function ($scope) {
            return $scope.today = function () {
                if ($('#datepicker').val() != undefined) {
                    $scope.dt = $('#datepicker').val();
                }
                else {
                    $scope.dt = new Date();
                }

            }, $scope.today(), $scope.showWeeks = !0, $scope.toggleWeeks = function () {
                $scope.showWeeks = !$scope.showWeeks;
            }, $scope.clear = function () {
                $scope.dt = null;
            }, $scope.toggleMin = function () {
                var _ref;
                $scope.minDate = null !== (_ref = $scope.minDate) ? _ref : {
                    "null": new Date()
                };
            }, $scope.toggleMin(), $scope.open = function ($event) {
                return $event.preventDefault(), $event.stopPropagation(), $scope.opened = !0;
            }, $scope.dateOptions = {
                "year-format": "'yy'",
                "starting-day": 1
            }, $scope.formats = ["dd-MMMM-yyyy", "yyyy/MM/dd", "shortDate"], $scope.format = $scope.formats[0];
        }
    ]).controller("DonateDatepickerCtrl", ["$scope",
        function ($scope) {
            return $scope.today = function () {
                if ($('#donordatepicker').val() != undefined) {
                    $scope.dt = $('#donordatepicker').val();
                }
                else {
                    $scope.dt = new Date();
                }

            }, $scope.today(), $scope.showWeeks = !0, $scope.toggleWeeks = function () {
                $scope.showWeeks = !$scope.showWeeks;
            }, $scope.clear = function () {
                $scope.dt = null;
            }, $scope.toggleMin = function () {
                var _ref;
                $scope.minDate = null !== (_ref = $scope.minDate) ? _ref : {
                    "null": new Date()
                };
            }, $scope.toggleMin(), $scope.open = function ($event) {
                return $event.preventDefault(), $event.stopPropagation(), $scope.opened = !0;
            }, $scope.dateOptions = {
                "year-format": "'yy'",
                "starting-day": 1
            }, $scope.formats = ["dd-MMMM-yyyy", "yyyy/MM/dd", "shortDate"], $scope.format = $scope.formats[0];
        }
    ]).controller("TimepickerCtrl", ["$scope",
        function ($scope) {
            return $scope.mytime = new Date(), $scope.hstep = 1, $scope.mstep = 15, $scope.options = {
                hstep: [1, 2, 3],
                mstep: [1, 5, 10, 15, 25, 30]
            }, $scope.ismeridian = !0, $scope.toggleMode = function () {
                $scope.ismeridian = !$scope.ismeridian;
            }, $scope.update = function () {
                var d;
                return d = new Date(), d.setHours(14), d.setMinutes(0), $scope.mytime = d;
            }, $scope.changed = function () {
                return void 0;
            }, $scope.clear = function () {
                $scope.mytime = null;
            };
        }
    ]).controller("TypeaheadCtrl", ["$scope",
        function ($scope) {
            return $scope.selected = void 0, $scope.states = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"];
        }
    ]).controller("RatingDemoCtrl", ["$scope",
        function ($scope) {
            return $scope.rate = 7, $scope.max = 10, $scope.isReadonly = !1, $scope.hoveringOver = function (value) {
                return $scope.overStar = value, $scope.percent = 100 * (value / $scope.max);
            }, $scope.ratingStates = [{
                stateOn: "glyphicon-ok-sign",
                stateOff: "glyphicon-ok-circle"
            }, {
                stateOn: "glyphicon-star",
                stateOff: "glyphicon-star-empty"
            }, {
                stateOn: "glyphicon-heart",
                stateOff: "glyphicon-ban-circle"
            }, {
                stateOn: "glyphicon-heart"
            }, {
                stateOff: "glyphicon-off"
            }];
        }
    ]);


/*
 App Ui Controllers
 Provides general controllers for the app
 */

angular.module("app.ui.ctrls", []).controller("NotifyCtrl", ["$scope", "loggit",
    function ($scope, loggit) {
        $scope.notify = function (type) {
            switch (type) {
                case "info":
                    return loggit.log("Hello! This is an alert of the info importance level.");
                case "success":
                    return loggit.logSuccess("Great! You did something successfully.");
                case "warning":
                    return loggit.logWarning("Warning! Something that happened that is not critical but important.");
                case "error":
                    return loggit.logError("Error! Something went terribly wrong and needs your attention.");
            }
        };
    }
]).controller("AlertDemoCtrl", ["$scope",
    function ($scope) {
        $scope.alerts = [{
            type: "success",
            msg: "Great! You did something successfully."
        }, {
            type: "info",
            msg: "Hello! This is an alert of the info importance level."
        }, {
            type: "warning",
            msg: "Warning! Something that happened that is not critical but important."
        }, {
            type: "danger",
            msg: "Error! Something went terribly wrong and needs your attention."
        }];

        $scope.addAlert = function () {
            $scope.alerts.push({msg: 'Another alert!'});
        };

        $scope.closeAlert = function (index) {
            $scope.alerts.splice(index, 1);
        };
    }
]).controller("ProgressDemoCtrl", ["$scope",
    function ($scope) {
        $scope.max = 200;

        $scope.random = function () {
            var value = Math.floor((Math.random() * 100) + 1);
            var type;

            if (value < 25) {
                type = 'success';
            } else if (value < 50) {
                type = 'info';
            } else if (value < 75) {
                type = 'warning';
            } else {
                type = 'danger';
            }

            $scope.showWarning = (type === 'danger' || type === 'warning');

            $scope.dynamic = value;
            $scope.type = type;
        };
        $scope.random();

        $scope.randomStacked = function () {
            $scope.stacked = [];
            var types = ['success', 'info', 'warning', 'danger'];

            for (var i = 0, n = Math.floor((Math.random() * 4) + 1); i < n; i++) {
                var index = Math.floor((Math.random() * 4));
                $scope.stacked.push({
                    value: Math.floor((Math.random() * 30) + 1),
                    type: types[index]
                });
            }
        };
        $scope.randomStacked();
    }
]).controller("AccordionDemoCtrl", ["$scope",
    function ($scope) {
        return $scope.oneAtATime = !0, $scope.groups = [{
            title: "First Group Header",
            content: "First Group Body"
        }, {
            title: "Second Group Header",
            content: "Second Group Body"
        }, {
            title: "Third Group Header",
            content: "Third Group Body"
        }], $scope.items = ["Item 1", "Item 2", "Item 3"], $scope.status = {
            isFirstOpen: !0,
            isFirstOpen1: !0,
            isFirstOpen2: !0,
            isFirstOpen3: !0,
            isFirstOpen4: !0,
            isFirstOpen5: !0,
            isFirstOpen6: !0
        }, $scope.addItem = function () {
            var newItemNo;
            newItemNo = $scope.items.length + 1;
            $scope.items.push("Item " + newItemNo);
        };
    }
]).controller("CollapseDemoCtrl", ["$scope",
    function ($scope) {
        $scope.isCollapsed = !1;
    }
]).controller("BloodDonationModalCtrl", ["$scope", "$modal", "$log",
    function ($scope, $modal, $log) {

        $scope.data = {
            userId: null,
            userName: null
        }

        $scope.openWontDonate = function (id) {

            $scope.data.userId = id;

            var modalInstance = $modal.open({
                templateUrl: 'wontDonate.html',
                controller: 'wontDonateCtrl',
                resolve: {
                    data: function () {
                        return $scope.data;
                    }
                }
            });


        };

        $scope.openWillDonate = function (id) {

            $scope.data.userId = id;

            var modalInstance = $modal.open({
                templateUrl: 'willDonate.html',
                controller: 'willDonateCtrl',
                resolve: {
                    data: function () {
                        return $scope.data;
                    }
                }
            });
        };
    }
]).controller("wontDonateCtrl", ["$scope", "$modalInstance", "data",
    function ($scope, $modalInstance, data) {

        $scope.user = {
            id: null,
            name: null
        }

        $scope.user.id = data.userId;

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    }
]).controller("willDonateCtrl", ["$scope", "$modalInstance", "data",
    function ($scope, $modalInstance, data) {

        $scope.user = {
            id: null,
            name: null
        }
        console.log(data.userId);

        $scope.user.id = data.userId;

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    }
]).controller("PaginationDemoCtrl", ["$scope",
    function ($scope) {
        $scope.totalItems = 64;
        $scope.currentPage = 4;

        $scope.setPage = function (pageNo) {
            $scope.currentPage = pageNo;
        };

        $scope.pageChanged = function () {
            console.log('Page changed to: ' + $scope.currentPage);
        };

        $scope.maxSize = 5;
        $scope.bigTotalItems = 175;
        $scope.bigCurrentPage = 1;
    }
]).controller("MapDemoCtrl", ["$scope", "$http", "$interval",
    function ($scope, $http, $interval) {
        var i, markers;
        for (markers = [], i = 0; 8 > i;) {
            markers[i] = new google.maps.Marker({
                title: "Marker: " + i
            });
            i++;
        }
        $scope.GenerateMapMarkers = function () {
            var d, lat, lng, loc, numMarkers;
            for (d = new Date(), $scope.date = d.toLocaleString(), numMarkers = Math.floor(4 * Math.random()) + 4, i = 0; numMarkers > i;) {
                lat = 38.73 + Math.random() / 100;
                lng = -9.14 + Math.random() / 100;
                loc = new google.maps.LatLng(lat, lng);
                markers[i].setPosition(loc);
                markers[i].setMap($scope.map);
                i++;
            }
        };
        $interval($scope.GenerateMapMarkers, 2e3);
    }
]).controller("TreeDemoCtrl", ["$scope",
    function ($scope) {
        // Parameters

        $scope.list = [{
            "id": 1,
            "title": "1. dragon-breath",
            "items": []
        }, {
            "id": 2,
            "title": "2. moiré-vision",
            "items": [{
                "id": 21,
                "title": "2.1. tofu-animation",
                "items": [{
                    "id": 211,
                    "title": "2.1.1. spooky-giraffe",
                    "items": []
                }, {
                    "id": 212,
                    "title": "2.1.2. bubble-burst",
                    "items": []
                }]
            }, {
                "id": 22,
                "title": "2.2. barehand-atomsplitting",
                "items": []
            }]
        }, {
            "id": 3,
            "title": "3. unicorn-zapper",
            "items": []
        }, {
            "id": 4,
            "title": "4. romantic-transclusion",
            "items": []
        }];

        $scope.callbacks = {};

        $scope.remove = function (scope) {
            scope.remove();
        };

        $scope.toggle = function (scope) {
            scope.toggle();
        };

        $scope.newSubItem = function (scope) {
            var nodeData = scope.$modelValue;
            nodeData.items.push({
                id: nodeData.id * 10 + nodeData.items.length,
                title: nodeData.title + '.' + (nodeData.items.length + 1),
                items: []
            });
        };
    }
]);

