
/**************************
 Initialize the Angular App
 **************************/

var app = angular.module("app", ["ngRoute", "ngAnimate", "ui.bootstrap", "easypiechart", "mgo-angular-wizard", "textAngular", "ui.tree", "ngMap", "ngTagsInput", "app.ui.ctrls", "app.ui.services", "app.controllers", "app.directives", "app.form.validation", "app.ui.form.ctrls", "app.ui.form.directives", "app.tables", "app.map", "app.task", "app.chart.ctrls", "app.chart.directives","countTo"]).run(["$rootScope", "$location",
    function ($rootScope, $location) {

        $(window).load(function(){

            setTimeout(function(){
                $('.page-loading-overlay').addClass("loaded");
                $('.load_circle_wrapper').addClass("loaded");
            },1000);

        });

    }] ).config(["$routeProvider",
    function($routeProvider) {
        return $routeProvider.when("/", {
            redirectTo: "/dashboard"
        }).when("/dashboard", {
                templateUrl: "app/views/dashboards/dashboard.html"
            }).when("/dashboard/dashboard", {
                templateUrl: "app/views/dashboards/dashboard.html"
            }).when("/dashboard/dashboard2", {
                templateUrl: "app/views/dashboards/dashboard2.html"
            }).when("/dashboard/dashboard3", {
                templateUrl: "app/views/dashboards/dashboard3.html"
            }).when("/ui/typography", {
                templateUrl: "app/views/ui_elements/typography.html"
            }).when("/ui/buttons", {
                templateUrl: "app/views/ui_elements/buttons.html"
            }).when("/ui/icons", {
                templateUrl: "app/views/ui_elements/icons.html"
            }).when("/ui/grids", {
                templateUrl: "app/views/ui_elements/grids.html"
            }).when("/ui/widgets", {
                templateUrl: "app/views/ui_elements/widgets.html"
            }).when("/ui/components", {
                templateUrl: "app/views/ui_elements/components.html"
            }).when("/ui/timeline", {
                templateUrl: "app/views/ui_elements/timeline.html"
            }).when("/ui/nested-lists", {
                templateUrl: "app/views/ui_elements/nested-lists.html"
            }).when("/forms/elements", {
                templateUrl: "app/views/forms/elements.html"
            }).when("/forms/layouts", {
                templateUrl: "app/views/forms/layouts.html"
            }).when("/forms/validation", {
                templateUrl: "app/views/forms/validation.html"
            }).when("/forms/wizard", {
                templateUrl: "app/views/forms/wizard.html"
            }).when("/maps/gmap", {
                templateUrl: "app/views/maps/gmap.html"
            }).when("/maps/jqvmap", {
                templateUrl: "app/views/maps/jqvmap.html"
            }).when("/tables/static", {
                templateUrl: "app/views/tables/static.html"
            }).when("/tables/responsive", {
                templateUrl: "app/views/tables/responsive.html"
            }).when("/tables/dynamic", {
                templateUrl: "app/views/tables/dynamic.html"
            }).when("/charts/others", {
                templateUrl: "app/views/charts/charts.html"
            }).when("/charts/morris", {
                templateUrl: "app/views/charts/morris.html"
            }).when("/charts/chartjs", {
                templateUrl: "app/views/charts/chartjs.html"
            }).when("/charts/flot", {
                templateUrl: "app/views/charts/flot.html"
            }).when("/mail/inbox", {
                templateUrl: "app/views/mail/inbox.html"
            }).when("/mail/compose", {
                templateUrl: "app/views/mail/compose.html"
            }).when("/mail/single", {
                templateUrl: "app/views/mail/single.html"
            }).when("/pages/features", {
                templateUrl: "app/views/pages/features.html"
            }).when("/pages/signin", {
                templateUrl: "app/views/pages/signin.html"
            }).when("/pages/signup", {
                templateUrl: "app/views/pages/signup.html"
            }).when("/pages/forgot", {
                templateUrl: "app/views/pages/forgot-password.html"
            }).when("/pages/profile", {
                templateUrl: "app/views/pages/profile.html"
            }).when("/404", {
                templateUrl: "app/views/pages/404.html"
            }).when("/pages/500", {
                templateUrl: "app/views/pages/500.html"
            }).when("/pages/blank", {
                templateUrl: "app/views/pages/blank.html"
            }).when("/pages/contact", {
                templateUrl: "app/views/pages/contact.html"
            }).when("/tasks", {
                templateUrl: "app/views/tasks/tasks.html"
            }).otherwise({
                redirectTo: "/404"
            });
    }
]);


/**************************
 App Map
 **************************/

angular.module("app.map", []).directive("uiJqvmap", [
        function() {
            return {
                restrict: "A",
                scope: {
                    options: "="
                },
                link: function(scope, ele) {
                    var options;
                    return options = scope.options, ele.vectorMap(options);
                }
            };
        }
    ]).controller("jqvmapCtrl", ["$scope",
        function($scope) {
            var sample_data;
            return sample_data = {
                af: "16.63",
                al: "11.58",
                dz: "158.97",
                ao: "85.81",
                ag: "1.1",
                ar: "351.02",
                am: "8.83",
                au: "1219.72",
                at: "366.26",
                az: "52.17",
                bs: "7.54",
                bh: "21.73",
                bd: "105.4",
                bb: "3.96",
                by: "52.89",
                be: "461.33",
                bz: "1.43",
                bj: "6.49",
                bt: "1.4",
                bo: "19.18",
                ba: "16.2",
                bw: "12.5",
                br: "2023.53",
                bn: "11.96",
                bg: "44.84",
                bf: "8.67",
                bi: "1.47",
                kh: "11.36",
                cm: "21.88",
                ca: "1563.66",
                cv: "1.57",
                cf: "2.11",
                td: "7.59",
                cl: "199.18",
                cn: "5745.13",
                co: "283.11",
                km: "0.56",
                cd: "12.6",
                cg: "11.88",
                cr: "35.02",
                ci: "22.38",
                hr: "59.92",
                cy: "22.75",
                cz: "195.23",
                dk: "304.56",
                dj: "1.14",
                dm: "0.38",
                "do": "50.87",
                ec: "61.49",
                eg: "216.83",
                sv: "21.8",
                gq: "14.55",
                er: "2.25",
                ee: "19.22",
                et: "30.94",
                fj: "3.15",
                fi: "231.98",
                fr: "2555.44",
                ga: "12.56",
                gm: "1.04",
                ge: "11.23",
                de: "3305.9",
                gh: "18.06",
                gr: "305.01",
                gd: "0.65",
                gt: "40.77",
                gn: "4.34",
                gw: "0.83",
                gy: "2.2",
                ht: "6.5",
                hn: "15.34",
                hk: "226.49",
                hu: "132.28",
                is: "12.77",
                "in": "1430.02",
                id: "695.06",
                ir: "337.9",
                iq: "84.14",
                ie: "204.14",
                il: "201.25",
                it: "2036.69",
                jm: "13.74",
                jp: "5390.9",
                jo: "27.13",
                kz: "129.76",
                ke: "32.42",
                ki: "0.15",
                kr: "986.26",
                undefined: "5.73",
                kw: "117.32",
                kg: "4.44",
                la: "6.34",
                lv: "23.39",
                lb: "39.15",
                ls: "1.8",
                lr: "0.98",
                ly: "77.91",
                lt: "35.73",
                lu: "52.43",
                mk: "9.58",
                mg: "8.33",
                mw: "5.04",
                my: "218.95",
                mv: "1.43",
                ml: "9.08",
                mt: "7.8",
                mr: "3.49",
                mu: "9.43",
                mx: "1004.04",
                md: "5.36",
                mn: "5.81",
                me: "3.88",
                ma: "91.7",
                mz: "10.21",
                mm: "35.65",
                na: "11.45",
                np: "15.11",
                nl: "770.31",
                nz: "138",
                ni: "6.38",
                ne: "5.6",
                ng: "206.66",
                no: "413.51",
                om: "53.78",
                pk: "174.79",
                pa: "27.2",
                pg: "8.81",
                py: "17.17",
                pe: "153.55",
                ph: "189.06",
                pl: "438.88",
                pt: "223.7",
                qa: "126.52",
                ro: "158.39",
                ru: "1476.91",
                rw: "5.69",
                ws: "0.55",
                st: "0.19",
                sa: "434.44",
                sn: "12.66",
                rs: "38.92",
                sc: "0.92",
                sl: "1.9",
                sg: "217.38",
                sk: "86.26",
                si: "46.44",
                sb: "0.67",
                za: "354.41",
                es: "1374.78",
                lk: "48.24",
                kn: "0.56",
                lc: "1",
                vc: "0.58",
                sd: "65.93",
                sr: "3.3",
                sz: "3.17",
                se: "444.59",
                ch: "522.44",
                sy: "59.63",
                tw: "426.98",
                tj: "5.58",
                tz: "22.43",
                th: "312.61",
                tl: "0.62",
                tg: "3.07",
                to: "0.3",
                tt: "21.2",
                tn: "43.86",
                tr: "729.05",
                tm: 0,
                ug: "17.12",
                ua: "136.56",
                ae: "239.65",
                gb: "2258.57",
                us: "14624.18",
                uy: "40.71",
                uz: "37.72",
                vu: "0.72",
                ve: "285.21",
                vn: "101.99",
                ye: "30.02",
                zm: "15.69",
                zw: "5.57"
            }, $scope.worldMap = {
                map: "world_en",
                backgroundColor: null,
                color: "#ffffff",
                hoverOpacity: 0.7,
                selectedColor: "#db5031",
                hoverColor: "#db5031",
                enableZoom: !0,
                showTooltip: !0,
                values: sample_data,
                scaleColors: ["#F1EFF0", "#c1bfc0"],
                normalizeFunction: "polynomial"
            }, $scope.USAMap = {
                map: "usa_en",
                backgroundColor: null,
                color: "#ffffff",
                selectedColor: "#db5031",
                hoverColor: "#db5031",
                enableZoom: !0,
                showTooltip: !0,
                selectedRegion: "MO"
            }, $scope.europeMap = {
                map: "europe_en",
                backgroundColor: null,
                color: "#ffffff",
                hoverOpacity: 0.7,
                selectedColor: "#db5031",
                hoverColor: "#db5031",
                enableZoom: !0,
                showTooltip: !0,
                values: sample_data,
                scaleColors: ["#F1EFF0", "#c1bfc0"],
                normalizeFunction: "polynomial"
            };
        }
    ]);

/**************************
 Timer
 **************************/
angular.module('countTo', []).controller("countTo", ["$scope",
        function($scope) {

            return $scope.countersmall1 = {
                countTo: 20,
                countFrom: 0
            },$scope.countersmall2 = {
                countTo: 42,
                countFrom: 0
            },$scope.countersmall3 = {
                countTo: 90,
                countFrom: 0
            },$scope.countersmall1dash = {
                countTo: 420,
                countFrom: 0
            },$scope.countersmall2dash = {
                countTo: 742,
                countFrom: 0
            },$scope.countersmall3dash = {
                countTo: 100,
                countFrom: 0
            };

        }]).directive('countTo', ['$timeout', function ($timeout) {
        return {
            replace: false,
            scope: true,
            link: function (scope, element, attrs) {

                var e = element[0];
                var num, refreshInterval, duration, steps, step, countTo, value, increment;

                var calculate = function () {
                    refreshInterval = 30;
                    step = 0;
                    scope.timoutId = null;
                    countTo = parseInt(attrs.countTo) || 0;
                    scope.value = parseInt(attrs.value, 10) || 0;
                    duration = (parseFloat(attrs.duration) * 1000) || 0;

                    steps = Math.ceil(duration / refreshInterval);
                    increment = ((countTo - scope.value) / steps);
                    num = scope.value;
                };

                var tick = function () {
                    scope.timoutId = $timeout(function () {
                        num += increment;
                        step++;
                        if (step >= steps) {
                            $timeout.cancel(scope.timoutId);
                            num = countTo;
                            e.textContent = countTo;
                        } else {
                            e.textContent = Math.round(num);
                            tick();
                        }
                    }, refreshInterval);

                };

                var start = function () {
                    if (scope.timoutId) {
                        $timeout.cancel(scope.timoutId);
                    }
                    calculate();
                    tick();
                };

                attrs.$observe('countTo', function (val) {
                    if (val) {
                        start();
                    }
                });

                attrs.$observe('value', function (val) {
                    start();
                });

                return true;
            }
        };

    }]);
/*
 Application controllers
 Main controllers for the app
 */

angular.module("app.controllers", []).controller("AdminAppCtrl", ["$scope", "$location",
        function($scope, $location) {
            $scope.checkIfOwnPage = function() {

                return _.contains(["/404", "/pages/500", "/pages/login", "/pages/signin", "/pages/signin1", "/pages/signin2", "/pages/signup", "/pages/signup1", "/pages/signup2", "/pages/forgot", "/pages/lock-screen"], $location.path());

            };

            $scope.info = {
                theme_name: "ADMIN BOX",
                user_name: "Jane Doe"
            };


        }
    ]).controller("NavCtrl", ["$scope",
        function($scope) {

            $scope.navInfo = {
                tasks_number: 5,
                widgets_number: 13
            };

        }
    ]).controller("DashboardCtrl", ["$scope",
        function($scope) {


        }
    ]);



/*

 Chart controllers

 Includes controller for :

 https://github.com/rendro/easy-pie-chart - Easypiechart
 Morris charts
 FlotCharts
 http://omnipotent.net/jquery.sparkline/ - Sparkline

*/

angular.module("app.chart.ctrls", []).controller("chartingCtrl", ["$scope",
        function($scope) {
            return $scope.easypie1 = {
                percent: 25,
                options: {
                    animate: {
                        duration: 1e2,
                        enabled: !0
                    },
                    barColor: "#c1bfc0",
                    lineCap: "round",
                    size: 130,
                    lineWidth: 8
                },
                name:"Bounce rate"
            }, $scope.easypie2 = {
                percent: 35,
                options: {
                    animate: {
                        duration: 1e2,
                        enabled: !0
                    },
                    barColor: "#383d43",
                    lineCap: "round",
                    size: 130,
                    lineWidth: 8
                },
                name:"Daily active user activation"
            }, $scope.easypie3 = {
                percent: 87,
                options: {
                    animate: {
                        duration: 1e2,
                        enabled: !0
                    },
                    barColor: "#db5031",
                    lineCap: "round",
                    size: 130,
                    lineWidth: 8
                },
                name:"registration / unique visit"
            },$scope.easypiesmall1 = {
                percent: 25,
                options: {
                    animate: {
                        duration: 1e2,
                        enabled: !0
                    },
                    barColor: "#c1bfc0",
                    lineCap: "round",
                    size: 67,
                    lineWidth: 5
                },
                name:"Bounce rate"
            }, $scope.easypiesmall2 = {
                percent: 35,
                options: {
                    animate: {
                        duration: 1e2,
                        enabled: !0
                    },
                    barColor: "#383d43",
                    lineCap: "round",
                    size: 67,
                    lineWidth: 5
                },
                name:"Daily active user activation"
            }, $scope.easypiesmall3 = {
                percent: 87,
                options: {
                    animate: {
                        duration: 1e2,
                        enabled: !0
                    },
                    barColor: "#db5031",
                    lineCap: "round",
                    size: 67,
                    lineWidth: 5
                },
                name:"registration / unique visit"
            };
        }
    ]).controller("gaugeCtrl", ["$scope",
        function($scope) {
            return $scope.gauge1 = {
                gaugeData: {
                    maxValue: 3e3,
                    animationSpeed: 100,
                    val: 1075
                },
                gaugeOptions: {
                    lines: 12,
                    angle: 0,
                    lineWidth: 0.47,
                    pointer: {
                        length: 0.6,
                        strokeWidth: 0.03,
                        color: "#555555"
                    },
                    limitMax: "false",
                    colorStart: "#c1bfc0",
                    colorStop: "#c1bfc0",
                    strokeColor: "#F5F5F5",
                    generateGradient: !0,
                    percentColors: [
                        [0, "#c1bfc0"],
                        [1, "#c1bfc0"]
                    ]
                }
            }, $scope.gauge2 = {
                gaugeData: {
                    maxValue: 3e3,
                    animationSpeed: 100,
                    val: 1300
                },
                gaugeOptions: {
                    lines: 12,
                    angle: 0,
                    lineWidth: 0.47,
                    pointer: {
                        length: 0.6,
                        strokeWidth: 0.03,
                        color: "#555555"
                    },
                    limitMax: "false",
                    colorStart: "#383d43",
                    colorStop: "#383d43",
                    strokeColor: "#F5F5F5",
                    generateGradient: !0,
                    percentColors: [
                        [0, "#383d43"],
                        [1, "#383d43"]
                    ]
                }
            }, $scope.gauge3 = {
                gaugeData: {
                    maxValue: 3e3,
                    animationSpeed: 100,
                    val: 1500
                },
                gaugeOptions: {
                    lines: 12,
                    angle: 0,
                    lineWidth: 0.47,
                    pointer: {
                        length: 0.6,
                        strokeWidth: 0.03,
                        color: "#555555"
                    },
                    limitMax: "false",
                    colorStart: "#db5031",
                    colorStop: "#db5031",
                    strokeColor: "#F5F5F5",
                    generateGradient: !0,
                    percentColors: [
                        [0, "#db5031"],
                        [1, "#db5031"]
                    ]
                }
            };
        }
    ]).controller("morrisChartCtrl", ["$scope",
        function($scope) {
            return $scope.mainData = [{
                month: "2013-01",
                xbox: 294e3,
                will: 136e3,
                playstation: 244e3
            }, {
                month: "2013-02",
                xbox: 228e3,
                will: 335e3,
                playstation: 127e3
            }, {
                month: "2013-03",
                xbox: 199e3,
                will: 159e3,
                playstation: 13e4
            }, {
                month: "2013-04",
                xbox: 174e3,
                will: 16e4,
                playstation: 82e3
            }, {
                month: "2013-05",
                xbox: 255e3,
                will: 318e3,
                playstation: 82e3
            }, {
                month: "2013-06",
                xbox: 298400,
                will: 401800,
                playstation: 98600
            }, {
                month: "2013-07",
                xbox: 37e4,
                will: 225e3,
                playstation: 159e3
            }, {
                month: "2013-08",
                xbox: 376700,
                will: 303600,
                playstation: 13e4
            }, {
                month: "2013-09",
                xbox: 527800,
                will: 301e3,
                playstation: 119400
            }], $scope.simpleData = [{
                year: "2008",
                value: 20
            }, {
                year: "2009",
                value: 10
            }, {
                year: "2010",
                value: 5
            }, {
                year: "2011",
                value: 5
            }, {
                year: "2012",
                value: 20
            }, {
                year: "2013",
                value: 19
            }], $scope.comboData = [{
                year: "2008",
                a: 20,
                b: 16,
                c: 12
            }, {
                year: "2009",
                a: 10,
                b: 22,
                c: 30
            }, {
                year: "2010",
                a: 5,
                b: 14,
                c: 20
            }, {
                year: "2011",
                a: 5,
                b: 12,
                c: 19
            }, {
                year: "2012",
                a: 20,
                b: 19,
                c: 13
            }, {
                year: "2013",
                a: 28,
                b: 22,
                c: 20
            }], $scope.donutData = [{
                label: "Download Sales",
                value: 12
            }, {
                label: "In-Store Sales",
                value: 30
            }, {
                label: "Mail-Order Sales",
                value: 20
            }, {
                label: "Online Sales",
                value: 19
            }];
        }
    ]).controller("chartjsCtrl", ["$scope",
        function($scope) {
            return $scope.chartjsLine = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(56, 61, 67, 0.5)",
                        strokeColor: "rgba(56, 61, 67, 0.5)",
                        pointColor: "#fff",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "rgba(56, 61, 67, 0.5)",
                        pointHighlightStroke: "rgba(220,220,220,1)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(219, 80, 49, 0.8)",
                        strokeColor: "rgba(219, 80, 49, 0.8)",
                        pointColor: "#fff",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "rgba(219, 80, 49, 0.8)",
                        pointHighlightStroke: "rgba(151,187,205,1)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            },$scope.chartjsBar = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(56, 61, 67, 0.5)",
                        strokeColor: "rgba(56, 61, 67, 0.5)",
                        highlightFill: "rgba(56, 61, 67, 0.8)",
                        highlightStroke: "rgba(56, 61, 67, 0.8)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(219, 80, 49, 0.8)",
                        strokeColor: "rgba(219, 80, 49, 0.8)",
                        highlightFill: "rgba(219, 80, 49, 0.9)",
                        highlightStroke: "rgba(219, 80, 49, 0.9)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            },$scope.chartjsRadar = {
                labels: ["Eating", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(56, 61, 67, 0.8)",
                        strokeColor: "rgba(56, 61, 67, 1)",
                        pointColor: "rgba(56, 61, 67, 1)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(56, 61, 67, 1)",
                        data: [65, 59, 90, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(219, 80, 49, 0.8)",
                        strokeColor: "rgba(219, 80, 49, 1)",
                        pointColor: "rgba(219, 80, 49, 0.8)",
                        pointStrokeColor: "#fff",
                        pointHighlightFill: "#fff",
                        pointHighlightStroke: "rgba(219, 80, 49, 0.8)",
                        data: [28, 48, 40, 19, 96, 27, 100]
                    }
                ]
            },$scope.chartjsPolarArea = [{
                value: 300,
                color:"#383d43",
                highlight: "#383d43",
                label: "Blue"
            },
                {
                    value: 50,
                    color: "#db5031",
                    highlight: "#db5031",
                    label: "Orange"
                },
                {
                    value: 100,
                    color: "#fef9d9",
                    highlight: "#fef9d9",
                    label: "Yellow"
                },
                {
                    value: 40,
                    color: "#c1bfc0",
                    highlight: "#c1bfc0",
                    label: "Grey"
                },
                {
                    value: 120,
                    color: "#503f3c",
                    highlight: "#503f3c",
                    label: "Dark Brown"
                }],$scope.chartjsPie = [{
                value: 300,
                color:"#383d43",
                highlight: "#383d43",
                label: "Blue"
            },
                {
                    value: 50,
                    color: "#db5031",
                    highlight: "#db5031",
                    label: "Orange"
                },
                {
                    value: 100,
                    color: "#c1bfc0",
                    highlight: "#c1bfc0",
                    label: "Gray"
                }],$scope.chartjsDoughnut = [{
                value: 300,
                color:"#383d43",
                highlight: "#383d43",
                label: "Blue"
            },
                {
                    value: 50,
                    color: "#db5031",
                    highlight: "#db5031",
                    label: "Orange"
                },
                {
                    value: 100,
                    color: "#c1bfc0",
                    highlight: "#c1bfc0",
                    label: "Gray"
                }];
        }
    ]).controller("flotChartCtrl", ["$scope",
        function($scope) {
            var areaChart, barChart, lineChart1;

            return lineChart1 = {}, lineChart1.data1 = [
                [1, 15],
                [2, 20],
                [3, 14],
                [4, 10],
                [5, 10],
                [6, 20],
                [7, 28],
                [8, 26],
                [9, 22],
                [10, 23],
                [11, 24]
            ], lineChart1.data2 = [
                [1, 9],
                [2, 15],
                [3, 17],
                [4, 21],
                [5, 16],
                [6, 15],
                [7, 13],
                [8, 15],
                [9, 29],
                [10, 21],
                [11, 29]
            ], $scope.line1 = {}, $scope.line1.data = [{
                data: lineChart1.data1,
                label: "New visitors",
                lines: {
                    fill: !0
                }
            }, {
                data: lineChart1.data2,
                label: "Returning visitors",
                lines: {
                    fill: !1
                }
            }], $scope.line1.options = {
                series: {
                    lines: {
                        show: !0,
                        fill: !1,
                        lineWidth: 3,
                        fillColor: {
                            colors: [{
                                opacity: 0.3
                            }, {
                                opacity: 0.3
                            }]
                        }
                    },
                    points: {
                        show: !0,
                        lineWidth: 3,
                        fill: !0,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 5
                    },
                    shadowSize: 0

                },
                colors: ["#c1bfc0", "#db5031"],
                tooltip: !0,
                tooltipOpts: {
                    defaultTheme: !1
                },
                grid: {
                    hoverable: !0,
                    clickable: !0,
                    tickColor: "#f9f9f9",
                    borderWidth: 1,
                    borderColor: "#eeeeee"
                },
                xaxis: {
                    ticks: [
                        [1, "Jan."],
                        [2, "Feb."],
                        [3, "Mar."],
                        [4, "Apr."],
                        [5, "May"],
                        [6, "June"],
                        [7, "July"],
                        [8, "Aug."],
                        [9, "Sept."],
                        [10, "Oct."],
                        [11, "Nov."],
                        [12, "Dec."]
                    ]
                }
            }, areaChart = {}, areaChart.data1 = [
                [2007, 15],
                [2008, 20],
                [2009, 10],
                [2010, 5],
                [2011, 5],
                [2012, 20],
                [2013, 28]
            ], areaChart.data2 = [
                [2007, 15],
                [2008, 16],
                [2009, 22],
                [2010, 14],
                [2011, 12],
                [2012, 19],
                [2013, 22]
            ], $scope.area = {}, $scope.area.data = [{
                data: areaChart.data1,
                label: "Value A",
                lines: {
                    fill: !0
                }
            }, {
                data: areaChart.data2,
                label: "Value B",
                points: {
                    show: !0
                },
                yaxis: 2
            }], $scope.area.options = {
                series: {
                    lines: {
                        lineWidth: 3,
                        show: !0,
                        fill: !1
                    },
                    points: {
                        show: !0,
                        lineWidth: 3,
                        fill: !0,
                        fillColor: "#ffffff",
                        symbol: "circle",
                        radius: 5
                    },
                    shadowSize: 0
                },
                grid: {
                    hoverable: !0,
                    clickable: !0,
                    tickColor: "#f9f9f9",
                    borderWidth: 1,
                    borderColor: "#eeeeee"
                },
                colors: ["#c1bfc0", "#db5031"],
                tooltip: !0,
                tooltipOpts: {
                    defaultTheme: !1
                },
                xaxis: {
                    mode: "time"
                },
                yaxes: [{}, {
                    position: "right"
                }]
            }, barChart = {}, barChart.data1 = [
                [2008, 20],
                [2009, 10],
                [2010, 5],
                [2011, 5],
                [2012, 20],
                [2013, 28]
            ], barChart.data2 = [
                [2008, 16],
                [2009, 22],
                [2010, 14],
                [2011, 12],
                [2012, 19],
                [2013, 22]
            ], barChart.data3 = [
                [2008, 12],
                [2009, 30],
                [2010, 20],
                [2011, 19],
                [2012, 13],
                [2013, 20]
            ], $scope.barChart = {}, $scope.barChart.data = [{
                label: "Value A",
                data: barChart.data1
            }, {
                label: "Value B",
                data: barChart.data2
            }, {
                label: "Value C",
                data: barChart.data3
            }], $scope.barChart.options = {
                series: {
                    stack: !0,
                    bars: {
                        show: !0,
                        fill: 1,
                        barWidth: 0.3,
                        align: "center",
                        horizontal: !1,
                        order: 1
                    }
                },
                grid: {
                    hoverable: !0,
                    borderWidth: 1,
                    borderColor: "#eeeeee"
                },
                tooltip: !0,
                tooltipOpts: {
                    defaultTheme: !1
                },
                colors: ["#383d43", "#db5031", "#fef9d9"]
            }, $scope.pieChart = {}, $scope.pieChart.data = [{
                label: "Download Sales",
                data: 12
            }, {
                label: "In-Store Sales",
                data: 30
            }, {
                label: "Mail-Order Sales",
                data: 20
            }, {
                label: "Online Sales",
                data: 19
            }], $scope.pieChart.options = {
                series: {
                    pie: {
                        show: !0
                    }
                },
                legend: {
                    show: !0
                },
                grid: {
                    hoverable: !0,
                    clickable: !0
                },
                colors: ["#383d43", "#db5031", "#fef9d9","#503f3c"],
                tooltip: !0,
                tooltipOpts: {
                    content: "%p.0%, %s",
                    defaultTheme: !1
                }
            }, $scope.donutChart = {}, $scope.donutChart.data = [{
                label: "Download Sales",
                data: 12
            }, {
                label: "In-Store Sales",
                data: 30
            }, {
                label: "Mail-Order Sales",
                data: 20
            }, {
                label: "Online Sales",
                data: 19
            }], $scope.donutChart.options = {
                series: {
                    pie: {
                        show: !0,
                        innerRadius: 0.5
                    }
                },
                legend: {
                    show: !0
                },
                grid: {
                    hoverable: !0,
                    clickable: !0
                },
                colors: ["#383d43", "#db5031", "#c1bfc0","#503f3c"],
                tooltip: !0,
                tooltipOpts: {
                    content: "%p.0%, %s",
                    defaultTheme: !1
                }
            }, $scope.donutChart2 = {}, $scope.donutChart2.data = [{
                label: "Download Sales",
                data: 12
            }, {
                label: "In-Store Sales",
                data: 30
            }, {
                label: "Mail-Order Sales",
                data: 20
            }, {
                label: "Online Sales",
                data: 19
            }, {
                label: "Direct Sales",
                data: 15
            }], $scope.donutChart2.options = {
                series: {
                    pie: {
                        show: !0,
                        innerRadius: 0.5
                    }
                },
                legend: {
                    show: !1
                },
                grid: {
                    hoverable: !0,
                    clickable: !0
                },
                colors: ["#2693E9", "#F5862C", "#43B040", "#619CC4", "#6D90C5"],
                tooltip: !0,
                tooltipOpts: {
                    content: "%p.0%, %s",
                    defaultTheme: !1
                }
            };
        }
    ]).controller("flotChartCtrl.realtime", ["$scope",
        function() {}
    ]).controller("sparklineCtrl", ["$scope",
        function($scope) {
            return $scope.demoData1 = {
                sparkData: [3, 1, 2, 2, 4, 6, 4, 5, 2, 4, 5, 3, 4, 6, 4, 7],
                sparkOptions: {
                    type: "line",
                    lineColor: "#fff",
                    highlightLineColor: "#fff",
                    fillColor: "#383d43",
                    spotColor: !1,
                    minSpotColor: !1,
                    maxSpotColor: !1,
                    width: "100%",
                    height: "150px"
                }
            },$scope.simpleChart1 = {
                sparkData: [3, 1, 2, 3, 5, 3, 4, 2],
                sparkOptions: {
                    type: "line",
                    lineColor: "#db5031",
                    fillColor: "#c1bfc0",
                    spotColor: !1,
                    minSpotColor: !1,
                    maxSpotColor: !1,
                    width: "100px",
                    height: "50px"
                }
            }, $scope.simpleChart2 = {
                sparkData: [3, 1, 2, 3, 5, 3, 4, 2],
                sparkOptions: {
                    type: "bar",
                    barColor: "#db5031",
                    width: "100px",
                    height: "50px"
                }
            },$scope.simpleChartlong = {
                sparkData: [1, 3, 2, 5, 4, 2, 1, 7, 1, 8, 4, 3, 5, 2, 4, 5, 1, 7, 1, 8],
                sparkOptions: {
                    type: "bar",
                    barColor: "#c1bfc0",
                    width: "250px",
                    height: "30px"
                }
            },$scope.simpleChart2long = {
                sparkData: [3, 1, 2, 3, 5, 3, 4, 2, 5, 4, 2, 6, 2, 4, 3, 1],
                sparkOptions: {
                    type: "bar",
                    barColor: "#383d43",
                    width: "200px",
                    height: "30px"
                }
            }, $scope.simpleChart2info = {
                sparkData: [3, 1, 2, 3, 5, 3, 4, 2],
                sparkOptions: {
                    type: "bar",
                    barColor: "#FFFFFF",
                    width: "100px",
                    height: "30px"
                }
            }, $scope.simpleChart3 = {
                sparkData: [3, 1, 2, 3, 5, 3, 4, 2],
                sparkOptions: {
                    type: "pie",
                    sliceColors: ["#383d43", "#db5031", "#c1bfc0", "#fef9d9", "#503f3c", "#365340"],
                    width: "50px",
                    height: "50px"
                }
            }, $scope.tristateChart1 = {
                sparkData: [1, 2, -3, -5, 3, 1, -4, 2],
                sparkOptions: {
                    type: "tristate",
                    posBarColor: "#383d43",
                    negBarColor: "#c1bfc0",
                    width: "100%",
                    height: "50px"
                }
            }, $scope.largeChart1 = {
                sparkData: [3, 1, 2, 3, 5, 3, 4, 2],
                sparkOptions: {
                    type: "line",
                    lineColor: "#db5031",
                    highlightLineColor: "#7ACBEE",
                    fillColor: "#c1bfc0",
                    spotColor: !1,
                    minSpotColor: !1,
                    maxSpotColor: !1,
                    width: "100%",
                    height: "150px"
                }
            }, $scope.largeChart2 = {
                sparkData: [3, 1, 2, 3, 5, 3, 4, 2],
                sparkOptions: {
                    type: "bar",
                    barColor: "#383d43",
                    barWidth: 10,
                    width: "100%",
                    height: "150px"
                }
            }, $scope.largeChart3 = {
                sparkData: [3, 1, 2, 3, 5],
                sparkOptions: {
                    type: "pie",
                    sliceColors: ["#383d43", "#db5031", "#c1bfc0", "#fef9d9", "#503f3c", "#365340"],
                    width: "150px",
                    height: "150px"
                }
            };
        }
    ]);



/*
 App tasks controllers
 Main task controllers (includes saving tasks into localStorage)
 */

angular.module("app.task", []).factory("taskStorage", function() {

    /**************************
     Saves and loads tasks from the localStorage
     **************************/

    var DEMO_TASKS, STORAGE_ID;
    return STORAGE_ID = "tasks",
        DEMO_TASKS = '[ ' +
            '{"title": "Call customer X", "completed": true}, ' +
            '{"title": "Review marketing system", "completed": true}, ' +
            '{"title": "Do the twist!", "completed": false}, ' +
            '{"title": "Watch over the mars scheme", "completed": false}, ' +
            '{"title": "Complete proposal for spaceship", "completed": false}, ' +
            '{"title": "Do inventory of everything", "completed": false} ]', {
        get: function() {
            return JSON.parse(localStorage.getItem(STORAGE_ID) || DEMO_TASKS);
        },
        put: function(tasks) {
            return localStorage.setItem(STORAGE_ID, JSON.stringify(tasks));
        }
    };
}).controller("taskCtrl", ["$scope", "taskStorage", "filterFilter", "$rootScope", "loggit",
        function($scope, taskStorage, filterFilter, $rootScope, loggit) {
            var tasks;
            return tasks = $scope.tasks = taskStorage.get(),
                $scope.newTask = "",
                $scope.countTasksLeft = filterFilter(tasks, {
                    completed: !1
                }).length, $scope.editedTask = null, $scope.statusFilter = {
                completed: !1
            }, $scope.filter = function(filterType) {
                switch (filterType) {
                    case "all":
                        $scope.statusFilter = "";
                        break;
                    case "active":
                        $scope.statusFilter = {
                            completed: !1
                        };
                        break;
                    case "completed":
                        $scope.statusFilter = {
                            completed: !0
                        };
                        break;
                }
            }, $scope.add = function() {
                var newTask;
                return newTask = $scope.newTask.trim(), 0 !== newTask.length ? (tasks.push({
                    title: newTask,
                    completed: !1
                }), loggit.logSuccess('New task added : "' + newTask + '"'), taskStorage.put(tasks), $scope.newTask = "", $scope.countTasksLeft++) : void 0;
            }, $scope.edit = function(task) {
                $scope.editedTask = task;
            }, $scope.doneEditing = function(task) {
                return $scope.editedTask = null, task.title = task.title.trim(), task.title ? loggit.log("Task was updated") : $scope.remove(task), taskStorage.put(tasks);
            }, $scope.remove = function(task) {
                var index;
                return $scope.countTasksLeft -= task.completed ? 0 : 1, index = $scope.tasks.indexOf(task), $scope.tasks.splice(index, 1), taskStorage.put(tasks), loggit.logError("Task was removed");
            }, $scope.completed = function(task) {
                return $scope.countTasksLeft += task.completed ? -1 : 1, taskStorage.put(tasks), task.completed ? $scope.countTasksLeft > 0 ? loggit.log(1 === $scope.countTasksLeft ? "Only " + $scope.countTasksLeft + " task left" : "Well done! Only " + $scope.countTasksLeft + " tasks left") : loggit.logSuccess("Yay!! All tasks are done :)") : void 0;
            }, $scope.clearCompleted = function() {
                return $scope.tasks = tasks = tasks.filter(function(val) {
                    return !val.completed;
                }), taskStorage.put(tasks);
            }, $scope.markAll = function(completed) {
                return tasks.forEach(function(task) {
                    task.completed = completed;
                }), $scope.countTasksLeft = completed ? 0 : tasks.length, taskStorage.put(tasks), completed ? loggit.logSuccess("Yay!! All tasks are done :)") : void 0;
            }, $scope.$watch("countTasksLeft == 0", function(val) {
                $scope.allChecked = val;
            }), $scope.$watch("countTasksLeft", function(newVal) {
                $rootScope.$broadcast("taskRemaining:changed", newVal);
            });
        }
    ]);



/*
 App Form validations
 Validator functions for form elements (signIn,signUp and custom forms)
 */

angular.module("app.form.validation", []).controller("wizardFormCtrl", ["$scope",
        function($scope) {
            return $scope.wizard = {
                firstName: "some name",
                lastName: "",
                email: "",
                password: "",
                age: "",
                address: ""
            }, $scope.isValidateStep1 = function() {
                return void 0;
            }, $scope.finishedWizard = function() {
                return void 0;
            };
        }
    ]).controller("formConstraintsCtrl", ["$scope",
        function($scope) {
            var original;
            return $scope.form = {
                required: "",
                minlength: "",
                maxlength: "",
                length_rage: "",
                type_something: "",
                confirm_type: "",
                foo: "",
                email: "",
                url: "",
                num: "",
                minVal: "",
                maxVal: "",
                valRange: "",
                pattern: ""
            }, original = angular.copy($scope.form), $scope.revert = function() {
                return $scope.form = angular.copy(original), $scope.form_constraints.$setPristine();
            }, $scope.canRevert = function() {
                return !angular.equals($scope.form, original) || !$scope.form_constraints.$pristine;
            }, $scope.canSubmit = function() {
                return $scope.form_constraints.$valid && !angular.equals($scope.form, original);
            };
        }
    ]).controller("signinCtrl", ["$scope",
        function($scope) {
            var original;
            return $scope.user = {
                email: "",
                password: ""
            }, $scope.showInfoOnSubmit = !1, original = angular.copy($scope.user), $scope.revert = function() {
                return $scope.user = angular.copy(original), $scope.form_signin.$setPristine();
            }, $scope.canRevert = function() {
                return !angular.equals($scope.user, original) || !$scope.form_signin.$pristine;
            }, $scope.canSubmit = function() {
                return $scope.form_signin.$valid && !angular.equals($scope.user, original);
            }, $scope.submitForm = function() {
                return $scope.showInfoOnSubmit = !0, $scope.revert();
            };
        }
    ]).controller("signupCtrl", ["$scope",
        function($scope) {
            var original;
            return $scope.user = {
                name: "",
                email: "",
                password: "",
                confirmPassword: "",
                age: ""
            }, $scope.showInfoOnSubmit = !1, original = angular.copy($scope.user), $scope.revert = function() {
                return $scope.user = angular.copy(original), $scope.form_signup.$setPristine(), $scope.form_signup.confirmPassword.$setPristine();
            }, $scope.canRevert = function() {
                return !angular.equals($scope.user, original) || !$scope.form_signup.$pristine;
            }, $scope.canSubmit = function() {
                return $scope.form_signup.$valid && !angular.equals($scope.user, original);
            }, $scope.submitForm = function() {
                return $scope.showInfoOnSubmit = !0, $scope.revert();
            };
        }
    ]).directive("validateEquals", [
        function() {
            return {
                require: "ngModel",
                link: function(scope, ele, attrs, ngModelCtrl) {
                    var validateEqual;
                    return validateEqual = function(value) {
                        var valid;
                        return valid = value === scope.$eval(attrs.validateEquals), ngModelCtrl.$setValidity("equal", valid), "function" == typeof valid ? valid({
                            value: void 0
                        }) : void 0;
                    }, ngModelCtrl.$parsers.push(validateEqual), ngModelCtrl.$formatters.push(validateEqual), scope.$watch(attrs.validateEquals, function(newValue, oldValue) {
                        return newValue !== oldValue ? ngModelCtrl.$setViewValue(ngModelCtrl.$ViewValue) : void 0;
                    });
                }
            };
        }
    ]);



/*
 App Form Ui Controls
 Controllers for form Ui components
 */

angular.module("app.ui.form.ctrls", []).controller("TagsDemoCtrl", ["$scope",
        function($scope) {
            $scope.tags = ["foo", "bar"];
        }
    ]).controller("DatepickerDemoCtrl", ["$scope",
        function($scope) {
            return $scope.today = function() {
                $scope.dt = new Date();
            }, $scope.today(), $scope.showWeeks = !0, $scope.toggleWeeks = function() {
                $scope.showWeeks = !$scope.showWeeks;
            }, $scope.clear = function() {
                $scope.dt = null;
            }, $scope.disabled = function(date, mode) {
                return "day" === mode && (0 === date.getDay() || 6 === date.getDay());
            }, $scope.toggleMin = function() {
                var _ref;
                $scope.minDate = null !== (_ref = $scope.minDate) ? _ref : {
                    "null": new Date()
                };
            }, $scope.toggleMin(), $scope.open = function($event) {
                return $event.preventDefault(), $event.stopPropagation(), $scope.opened = !0;
            }, $scope.dateOptions = {
                "year-format": "'yy'",
                "starting-day": 1
            }, $scope.formats = ["dd-MMMM-yyyy", "yyyy/MM/dd", "shortDate"], $scope.format = $scope.formats[0];
        }
    ]).controller("TimepickerDemoCtrl", ["$scope",
        function($scope) {
            return $scope.mytime = new Date(), $scope.hstep = 1, $scope.mstep = 15, $scope.options = {
                hstep: [1, 2, 3],
                mstep: [1, 5, 10, 15, 25, 30]
            }, $scope.ismeridian = !0, $scope.toggleMode = function() {
                $scope.ismeridian = !$scope.ismeridian;
            }, $scope.update = function() {
                var d;
                return d = new Date(), d.setHours(14), d.setMinutes(0), $scope.mytime = d;
            }, $scope.changed = function() {
                return void 0;
            }, $scope.clear = function() {
                $scope.mytime = null;
            };
        }
    ]).controller("TypeaheadCtrl", ["$scope",
        function($scope) {
            return $scope.selected = void 0, $scope.states = ["Alabama", "Alaska", "Arizona", "Arkansas", "California", "Colorado", "Connecticut", "Delaware", "Florida", "Georgia", "Hawaii", "Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky", "Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan", "Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska", "Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York", "North Dakota", "North Carolina", "Ohio", "Oklahoma", "Oregon", "Pennsylvania", "Rhode Island", "South Carolina", "South Dakota", "Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington", "West Virginia", "Wisconsin", "Wyoming"];
        }
    ]).controller("RatingDemoCtrl", ["$scope",
        function($scope) {
            return $scope.rate = 7, $scope.max = 10, $scope.isReadonly = !1, $scope.hoveringOver = function(value) {
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
 App Tables
 Controller for dynamic and other tables
 */

angular.module("app.tables", []).controller("tableCtrl", ["$scope", "$filter",
    function($scope, $filter) {
        var init;
        return $scope.stores = [{
            name: "Nijiya Market",
            price: "$$",
            sales: 292,
            rating: 4
        }, {
            name: "Eat On Monday Truck",
            price: "$",
            sales: 119,
            rating: 4.3
        }, {
            name: "Tea Era",
            price: "$",
            sales: 874,
            rating: 4
        }, {
            name: "Rogers Deli",
            price: "$",
            sales: 347,
            rating: 4.2
        }, {
            name: "MoBowl",
            price: "$$$",
            sales: 24,
            rating: 4.6
        }, {
            name: "The Milk Pail Market",
            price: "$",
            sales: 543,
            rating: 4.5
        }, {
            name: "Nob Hill Foods",
            price: "$$",
            sales: 874,
            rating: 4
        }, {
            name: "Scratch",
            price: "$$$",
            sales: 643,
            rating: 3.6
        }, {
            name: "Gochi Japanese Fusion Tapas",
            price: "$$$",
            sales: 56,
            rating: 4.1
        }, {
            name: "Cost Plus World Market",
            price: "$$",
            sales: 79,
            rating: 4
        }, {
            name: "Bumble Bee Health Foods",
            price: "$$",
            sales: 43,
            rating: 4.3
        }, {
            name: "Costco",
            price: "$$",
            sales: 219,
            rating: 3.6
        }, {
            name: "Red Rock Coffee Co",
            price: "$",
            sales: 765,
            rating: 4.1
        }, {
            name: "99 Ranch Market",
            price: "$",
            sales: 181,
            rating: 3.4
        }, {
            name: "Mi Pueblo Food Center",
            price: "$",
            sales: 78,
            rating: 4
        }, {
            name: "Cucina Venti",
            price: "$$",
            sales: 163,
            rating: 3.3
        }, {
            name: "Sufi Coffee Shop",
            price: "$",
            sales: 113,
            rating: 3.3
        }, {
            name: "Dana Street Roasting",
            price: "$",
            sales: 316,
            rating: 4.1
        }, {
            name: "Pearl Cafe",
            price: "$",
            sales: 173,
            rating: 3.4
        }, {
            name: "Posh Bagel",
            price: "$",
            sales: 140,
            rating: 4
        }, {
            name: "Artisan Wine Depot",
            price: "$$",
            sales: 26,
            rating: 4.1
        }, {
            name: "Hong Kong Chinese Bakery",
            price: "$",
            sales: 182,
            rating: 3.4
        }, {
            name: "Starbucks",
            price: "$$",
            sales: 97,
            rating: 3.7
        }, {
            name: "Tapioca Express",
            price: "$",
            sales: 301,
            rating: 3
        }, {
            name: "House of Bagels",
            price: "$",
            sales: 82,
            rating: 4.4
        }], $scope.searchKeywords = "", $scope.filteredStores = [], $scope.row = "", $scope.select = function(page) {
            var end, start;
            return start = (page - 1) * $scope.numPerPage, end = start + $scope.numPerPage, $scope.currentPageStores = $scope.filteredStores.slice(start, end);
        }, $scope.onFilterChange = function() {
            return $scope.select(1), $scope.currentPage = 1, $scope.row = "";
        }, $scope.onNumPerPageChange = function() {
            return $scope.select(1), $scope.currentPage = 1;
        }, $scope.onOrderChange = function() {
            return $scope.select(1), $scope.currentPage = 1;
        }, $scope.search = function() {
            return $scope.filteredStores = $filter("filter")($scope.stores, $scope.searchKeywords), $scope.onFilterChange();
        }, $scope.order = function(rowName) {
            return $scope.row !== rowName ? ($scope.row = rowName, $scope.filteredStores = $filter("orderBy")($scope.stores, rowName), $scope.onOrderChange()) : void 0;
        }, $scope.numPerPageOpt = [3, 5, 10, 20], $scope.numPerPage = $scope.numPerPageOpt[2], $scope.currentPage = 1, $scope.currentPageStores = [], (init = function() {
            return $scope.search(), $scope.select($scope.currentPage);
        });
    }
]);

/*
 App Ui Controllers
 Provides general controllers for the app
 */

angular.module("app.ui.ctrls", []).controller("NotifyCtrl", ["$scope", "loggit",
    function($scope, loggit) {
        $scope.notify = function(type) {
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
    function($scope) {
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

        $scope.addAlert = function() {
            $scope.alerts.push({msg: 'Another alert!'});
        };

        $scope.closeAlert = function(index) {
            $scope.alerts.splice(index, 1);
        };
    }
]).controller("ProgressDemoCtrl", ["$scope",
    function($scope) {
        $scope.max = 200;

        $scope.random = function() {
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

        $scope.randomStacked = function() {
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
    function($scope) {
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
        }, $scope.addItem = function() {
            var newItemNo;
            newItemNo = $scope.items.length + 1;
            $scope.items.push("Item " + newItemNo);
        };
    }
]).controller("CollapseDemoCtrl", ["$scope",
    function($scope) {
        $scope.isCollapsed = !1;
    }
]).controller("ModalDemoCtrl", ["$scope", "$modal", "$log",
    function($scope, $modal, $log) {
        $scope.items = ['item1', 'item2', 'item3'];

        $scope.open = function (size) {

            var modalInstance = $modal.open({
                templateUrl: 'myModalContent.html',
                controller: 'ModalInstanceCtrl',
                size: size,
                resolve: {
                    items: function () {
                        return $scope.items;
                    }
                }
            });

            modalInstance.result.then(function (selectedItem) {
                $scope.selected = selectedItem;
            }, function () {
                $log.info('Modal dismissed at: ' + new Date());
            });
        };
    }
]).controller("ModalInstanceCtrl", ["$scope", "$modalInstance", "items",
    function($scope, $modalInstance, items) {
        $scope.items = items;
        $scope.selected = {
            item: $scope.items[0]
        };

        $scope.ok = function () {
            $modalInstance.close($scope.selected.item);
        };

        $scope.cancel = function () {
            $modalInstance.dismiss('cancel');
        };
    }
]).controller("PaginationDemoCtrl", ["$scope",
    function($scope) {
        $scope.totalItems = 64;
        $scope.currentPage = 4;

        $scope.setPage = function (pageNo) {
            $scope.currentPage = pageNo;
        };

        $scope.pageChanged = function() {
            console.log('Page changed to: ' + $scope.currentPage);
        };

        $scope.maxSize = 5;
        $scope.bigTotalItems = 175;
        $scope.bigCurrentPage = 1;
    }
]).controller("MapDemoCtrl", ["$scope", "$http", "$interval",
    function($scope, $http, $interval) {
        var i, markers;
        for (markers = [], i = 0; 8 > i;){
            markers[i] = new google.maps.Marker({
                title: "Marker: " + i
            });
            i++;
        }
        $scope.GenerateMapMarkers = function() {
            var d, lat, lng, loc, numMarkers;
            for (d = new Date(), $scope.date = d.toLocaleString(), numMarkers = Math.floor(4 * Math.random()) + 4, i = 0; numMarkers > i;){
                lat = 38.73 + Math.random() / 100;
                lng = -9.14 + Math.random() / 100;
                loc = new google.maps.LatLng(lat, lng);
                markers[i].setPosition(loc);
                markers[i].setMap($scope.map);
                i++;
            }
        }; $interval($scope.GenerateMapMarkers, 2e3);
    }
]).controller("TreeDemoCtrl", ["$scope",
    function($scope) {
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

        $scope.callbacks = {
        };

        $scope.remove = function(scope) {
            scope.remove();
        };

        $scope.toggle = function(scope) {
            scope.toggle();
        };

        $scope.newSubItem = function(scope) {
            var nodeData = scope.$modelValue;
            nodeData.items.push({
                id: nodeData.id * 10 + nodeData.items.length,
                title: nodeData.title + '.' + (nodeData.items.length + 1),
                items: []
            });
        };
    }
]);




/*
 Charting directives
 Provides custom directives for charting elements
 */

angular.module("app.chart.directives", []).directive("gaugeChart", [
        function() {
            return {
                scope: {
                    gaugeData: "=",
                    gaugeOptions: "="
                },
                link: function(scope, ele) {
                    var data, gauge, options;

                    data = scope.gaugeData;
                        options = scope.gaugeOptions;

                        gauge = new Gauge(ele[0]).setOptions(options);
                        gauge.maxValue = data.maxValue;
                        gauge.animationSpeed = data.animationSpeed;
                        gauge.set(data.val);
                }
            };
        }
    ]).directive('chart', function () {
        var baseWidth = 600;
        var baseHeight = 400;

        return {
            restrict: 'E',
            template: '<canvas></canvas>',
            scope: {
                chartObject: "=value",
                data: "="
            },
            link: function (scope, element, attrs) {
                var canvas  = element.find('canvas')[0],
                    context = canvas.getContext('2d'),
                    chart;

                var options = {
                    type:   attrs.type   || "Line",
                    width:  attrs.width  || baseWidth,
                    height: attrs.height || baseHeight
                };
                canvas.width = options.width;
                canvas.height = options.height;
                chart = new Chart(context);

                var chartType = attrs.type;

                chart[chartType](scope.data, options);

                //Update when charts data changes
                scope.$watch(function() { return scope.chartObject; }, function(value) {
                    if(!value) return;
                    var chartType = options.type;
                    chart[chartType](scope.chartObject.data, scope.chartObject.options);
                });
            }
        };
    }).directive("flotChart", [
        function() {
            return {
                restrict: "A",
                scope: {
                    data: "=",
                    options: "="
                },
                link: function(scope, ele) {
                    var data, options, plot;


                    // hard-code color indices to prevent them from shifting as
                    // countries are turned on/off

                    var datasets;

                    datasets = scope.data;

                    var i = 0;
                    $.each(datasets, function(key, val) {
                        val.color = i;
                        ++i;
                    });

                    // insert checkboxes

                    if($(ele[0]).parent().find(".choices").length > 0){

                        // insert checkboxes
                        var choiceContainer = $(ele[0]).parent().find(".choices");

                        choiceContainer.html("");

                        $.each(datasets, function(key, val) {

                            choiceContainer.append("<br/><div class='choice-item'><label for='id" + key + "' class='ui-checkbox'>" +
                            "<input name='" + key +
                            "' type='checkbox' id='id" + key + "' checked='checked' value='option1'>" +
                            "<span>" + val.label + "</span>" +
                            "</label></div>");

                        });

                        var plotAccordingToChoices = function() {

                            var data_to_push = [];

                            choiceContainer.find("input:checked").each(function () {
                                var key = $(this).attr("name");
                                if (key && datasets[key]) {
                                    data_to_push.push(datasets[key]);
                                }
                            });

                            if (data_to_push.length > 0) {
                                $.plot(ele[0], data_to_push, scope.options);
                            }
                        };

                        choiceContainer.find("input").click(plotAccordingToChoices);

                    }



                    //plotAccordingToChoices();

                    return data = scope.data, options = scope.options, plot = $.plot(ele[0], data, options);
                }
            };
        }
    ]).directive("flotChartRealtime", [
        function() {
            return {
                restrict: "A",
                link: function(scope, ele) {
                    var data, getRandomData, plot, totalPoints, update, updateInterval;
                    return data = [], totalPoints = 300, getRandomData = function() {
                        var i, prev, res, y;
                        for (data.length > 0 && (data = data.slice(1)); data.length < totalPoints;){
                            if(data.length > 0){
                                prev = data[data.length - 1];
                            }
                            else{
                                prev = 50;
                            }
                            y = prev + 10 * Math.random() - 5;
                            if(0 > y){
                                y = 0;
                            }else{
                                if(y > 100){
                                    y = 100;
                                }
                            }
                            data.push(y);
                        }
                        for (res = [], i = 0; i < data.length;){
                            res.push([i, data[i]]);
                            ++i;
                        }
                        return res;
                    }, update = function() {
                        plot.setData([getRandomData()]);
                        plot.draw();
                        setTimeout(update, updateInterval);
                    }, data = [], totalPoints = 300, updateInterval = 200, plot = $.plot(ele[0], [getRandomData()], {
                        series: {
                            lines: {
                                show: !0,
                                fill: !0
                            },
                            shadowSize: 0
                        },
                        yaxis: {
                            min: 0,
                            max: 100,
                            show: !0,
                            color:"#f5f5f5"
                        },
                        xaxis: {
                            show: !0,
                            color:"#f5f5f5"
                        },
                        grid: {
                            hoverable: !0,
                            borderWidth: 1,
                            borderColor: "#fff"
                        },
                        colors: ["#383d43"]
                    }), update();
                }
            };
        }
    ]).directive("sparkline", [
        function() {
            return {
                scope: {
                    sparkData: "=",
                    sparkOptions: "="
                },
                link: function(scope, ele) {
                    var data, options, sparkResize, sparklineDraw;

                    data = scope.sparkData;
                        options = scope.sparkOptions;
                        sparkResize = void 0;
                        sparklineDraw = function() {

                            ele.sparkline(data, options);

                        };
                    $(window).resize(function() {
                        return clearTimeout(sparkResize), sparkResize = setTimeout(sparklineDraw, 200);
                    });
                    sparklineDraw();
                }
            };
        }
    ]).directive("morrisChart", [
        function() {
            return {
                scope: {
                    data: "="
                },
                link: function(scope, ele, attrs) {
                    var colors, data, func, options,chart;
                    switch (data = scope.data, attrs.type) {
                        case "line":
                            return colors = void 0 === attrs.lineColors || "" === attrs.lineColors ? null : JSON.parse(attrs.lineColors), options = {
                                element: ele[0],
                                data: data,
                                xkey: attrs.xkey,
                                ykeys: JSON.parse(attrs.ykeys),
                                labels: JSON.parse(attrs.labels),
                                lineWidth: attrs.lineWidth || 2,
                                lineColors: colors || ["#0b62a4", "#7a92a3", "#4da74d", "#afd8f8", "#edc240", "#cb4b4b", "#9440ed"]
                            },chart = new Morris.Line(options),$(window).resize(function(){
                                chart.redraw();
                            });
                        case "area":
                            return colors = void 0 === attrs.lineColors || "" === attrs.lineColors ? null : JSON.parse(attrs.lineColors), options = {
                                element: ele[0],
                                data: data,
                                xkey: attrs.xkey,
                                ykeys: JSON.parse(attrs.ykeys),
                                labels: JSON.parse(attrs.labels),
                                lineWidth: attrs.lineWidth || 2,
                                lineColors: colors || ["#0b62a4", "#7a92a3", "#4da74d", "#afd8f8", "#edc240", "#cb4b4b", "#9440ed"],
                                behaveLikeLine: attrs.behaveLikeLine || !1,
                                fillOpacity: attrs.fillOpacity || "auto",
                                pointSize: attrs.pointSize || 4
                            }, chart = new Morris.Area(options),$(window).resize(function(){
                                chart.redraw();
                            });
                        case "bar":
                            return colors = void 0 === attrs.barColors || "" === attrs.barColors ? null : JSON.parse(attrs.barColors), options = {
                                element: ele[0],
                                data: data,
                                xkey: attrs.xkey,
                                ykeys: JSON.parse(attrs.ykeys),
                                labels: JSON.parse(attrs.labels),
                                barColors: colors || ["#0b62a4", "#7a92a3", "#4da74d", "#afd8f8", "#edc240", "#cb4b4b", "#9440ed"],
                                stacked: attrs.stacked || null
                            }, chart = new Morris.Bar(options),$(window).resize(function(){
                                //chart.redraw();
                            });
                        case "donut":
                            /*jslint evil: true */
                            return colors = void 0 === attrs.colors || "" === attrs.colors ? null : JSON.parse(attrs.colors), options = {
                                element: ele[0],
                                data: data,
                                colors: colors || ["#0B62A4", "#3980B5", "#679DC6", "#95BBD7", "#B0CCE1", "#095791", "#095085", "#083E67", "#052C48", "#042135"]
                            }, attrs.formatter && (func = new Function("y", "data", attrs.formatter), options.formatter = func), chart = new Morris.Donut(options),$(window).resize(function(){
                                chart.redraw();
                            });
                    }
                }
            };
        }
    ]);


/*
 App custom Directives
 Custom directives for the app like custom background, minNavigation etc
 */

angular.module("app.directives", []).directive("imgHolder", [
        function() {
            return {
                link: function(scope, ele) {
                    return Holder.run({
                        images: ele[0]
                    });
                }
            };
        }
    ]).directive("customBackground", function() {
        return {
            controller: ["$scope", "$element", "$location",
                function($scope, $element, $location) {
                    var addBg, path;
                    return path = function() {
                        return $location.path();
                    }, addBg = function(path) {
                        switch ($element.removeClass("body-home body-special body-tasks body-lock"), path) {
                            case "/":
                                return $element.addClass("body-home");
                            case "/404":
                            case "/pages/500":
                            case "/pages/signin":
                            case "/pages/signup":
                            case "/pages/forgot":
                                return $element.addClass("body-special");
                            case "/pages/lock-screen":
                                return $element.addClass("body-special body-lock");
                            case "/tasks":
                                return $element.addClass("body-tasks");
                        }
                    }, addBg($location.path()), $scope.$watch(path, function(newVal, oldVal) {
                        return newVal !== oldVal ? addBg($location.path()) : void 0;
                    });
                }
            ]
        };
    }).directive("uiColorSwitch", [
        function() {
            return {
                restrict: "A",
                link: function(scope, ele) {
                    return ele.find(".color-option").on("click", function(event) {
                        var $this, hrefUrl, style;
                        if ($this = $(this), hrefUrl = void 0, style = $this.data("style"), "loulou" === style){
                            hrefUrl = "styles/main.css";
                            $('link[href^="styles/main"]').attr("href", hrefUrl);
                        }
                        else {
                            if (!style) return !1;
                            style = "-" + style;
                            hrefUrl = "styles/main" + style + ".css";
                            $('link[href^="styles/main"]').attr("href", hrefUrl);
                        }
                        return event.preventDefault();
                    });
                }
            };
        }
    ]).directive("toggleMinNav", ["$rootScope",
        function($rootScope) {
            return {
                link: function(scope, ele) {
                    var $content, $nav, $window, Timer, app, updateClass;

                    return app = $("#app"), $window = $(window), $nav = $("#nav-container"), $content = $("#content"), ele.on("click", function(e) {

                        if(app.hasClass("nav-min")){
                            app.removeClass("nav-min");
                        }
                        else{
                            app.addClass("nav-min");
                            $rootScope.$broadcast("minNav:enabled");
                            e.preventDefault();
                        }

                    }), Timer = void 0, updateClass = function() {
                        var width;
                        return width = $window.width(), 980 > width ? app.addClass("nav-min") : void 0;
                    },initResize = function() {
                        var width;
                        return width = $window.width(), 980 > width ? app.addClass("nav-min") : app.removeClass("nav-min");
                    }, $window.resize(function() {
                        var t;
                        return clearTimeout(t), t = setTimeout(updateClass, 300);
                    }),initResize();

                }
            };
        }
    ]).directive("collapseNav", [
        function() {
            return {
                link: function(scope, ele) {
                    var $a, $aRest, $lists, $listsRest, app;
                    return $lists = ele.find("ul").parent("li"),
                        $lists.append('<i class="fa fa-arrow-circle-o-right icon-has-ul"></i>'),
                        $a = $lists.children("a"),
                        $listsRest = ele.children("li").not($lists),
                        $aRest = $listsRest.children("a"),
                        app = $("#app"),
                        $a.on("click", function(event) {
                            var $parent, $this;
                            return app.hasClass("nav-min") ? !1 : ($this = $(this),
                                $parent = $this.parent("li"),
                                $lists.not($parent).removeClass("open").find("ul").slideUp(),
                                $parent.toggleClass("open").find("ul").stop().slideToggle(), event.preventDefault());
                        }), $aRest.on("click", function() {
                        return $lists.removeClass("open").find("ul").slideUp();
                    }), scope.$on("minNav:enabled", function() {
                        return $lists.removeClass("open").find("ul").slideUp();
                    });
                }
            };
        }
    ]).directive("highlightActive", [
        function() {
            return {
                controller: ["$scope", "$element", "$attrs", "$location",
                    function($scope, $element, $attrs, $location) {
                        var highlightActive, links, path;
                        return links = $element.find("a"), path = function() {
                            return $location.path();
                        }, highlightActive = function(links, path) {
                            return path = "#" + path, angular.forEach(links, function(link) {
                                var $li, $link, href;
                                return $link = angular.element(link), $li = $link.parent("li"), href = $link.attr("href"), $li.hasClass("active") && $li.removeClass("active"), 0 === path.indexOf(href) ? $li.addClass("active") : void 0;
                            });
                        }, highlightActive(links, $location.path()), $scope.$watch(path, function(newVal, oldVal) {
                            return newVal !== oldVal ? highlightActive(links, $location.path()) : void 0;
                        });
                    }
                ]
            };
        }
    ]).directive("toggleOffCanvas", [
        function() {
            return {
                link: function(scope, ele) {
                    return ele.on("click", function() {
                        return $("#app").toggleClass("on-canvas").toggleClass("nav-min");
                    });
                }
            };
        }
    ]).directive("slimScroll", [
        function() {
            return {
                link: function(scope, ele, attrs) {
                    return ele.slimScroll({
                        height: attrs.scrollHeight || "100%"
                    });
                }
            };
        }
    ]).directive("goBack", [
        function() {
            return {
                restrict: "A",
                controller: ["$scope", "$element", "$window",
                    function($scope, $element, $window) {
                        return $element.on("click", function() {
                            return $window.history.back();
                        });
                    }
                ]
            };
        }
    ]);



/*
 App Form Ui Directives
 Custom directives for Form Ui elements
 */

angular.module("app.ui.form.directives", []).directive("uiRangeSlider", [
        function() {
            return {
                restrict: "A",
                link: function(scope, ele) {
                    return ele.slider();
                }
            };
        }
    ]).directive("uiFileUpload", [
        function() {
            return {
                restrict: "A",
                link: function(scope, ele) {
                    return ele.bootstrapFileInput();
                }
            };
        }
    ]).directive("uiSpinner", [
        function() {
            return {
                restrict: "A",
                compile: function(ele) {
                    return ele.addClass("ui-spinner"), {
                        post: function() {
                            return ele.spinner();
                        }
                    };
                }
            };
        }
    ]).directive("uiWizardForm", [
        function() {
            return {
                link: function(scope, ele) {
                    return ele.steps();
                }
            };
        }
    ]);



/**************************
 App ui Services

 loggit - Creates a logit type message for all logging

 **************************/

angular.module("app.ui.services", []).factory("loggit", [
    function() {
        var logIt;
        return toastr.options = {
            closeButton: !0,
            positionClass: "toast-top-right",
            timeOut: "3000"
        }, logIt = function(message, type) {
            return toastr[type](message);
        }, {
            log: function(message) {
                logIt(message, "info");
            },
            logWarning: function(message) {
                logIt(message, "warning");
            },
            logSuccess: function(message) {
                logIt(message, "success");
            },
            logError: function(message) {
                logIt(message, "error");
            }
        };
    }
]);