var kendoWindow, kendoGridAll, kendoGridUser, kendoGridStruct, kendoGridManager, detailsTemplate, detailWindow, localization;

$(document).ready(function () {

    kendo.pdf.defineFont({
        "DejaVu Sans"             : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans.ttf",
        "DejaVu Sans|Bold"        : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Bold.ttf",
        "DejaVu Sans|Bold|Italic" : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf",
        "DejaVu Sans|Italic"      : "https://kendo.cdn.telerik.com/2016.2.607/styles/fonts/DejaVu/DejaVuSans-Oblique.ttf",
        "WebComponentsIcons"      : "https://kendo.cdn.telerik.com/2017.1.223/styles/fonts/glyphs/WebComponentsIcons.ttf"
    });

    kendo.culture("pl-PL");

    //////////////////////////////////////////////////////////////////////////////////////////////////////
    // GRID FOR ALL
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    kendoGridAll = $("#grid_all_leads").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    type: "POST",
                    url: API_URL+"lead/list",
                    dataType: "json"
                },
                update: {
                    type: "POST",
                    url: API_URL+"lead/edit_lead",
                    dataType: "json"
                },
                parameterMap: function (options, operation) {
                    if (operation !== "read" && options.models) {
                        return {
                            models: kendo.stringify(options.models),
                            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
                            user: user
                        };
                    }
                    if(operation == "read") {
                        return {
                            user: user
                        };
                    }
                }
            },
            batch: true,
            pageSize: 12,
            schema: {
                model: {
                    id: "ID",
                    fields: {
                        ID: {type: "number", editable: false},
                        StartEvent: {type: "date", from: "StartEvent"},
                        AddDate: {type: "date", from: "AddDate"},
                        ApproximateEventDate: {type: "date", from: "ApproximateEventDate"},
                        VictimStreet: {type: "text"},
                        VictimHome: {type: "text"},
                        VictimPostCode: {type: "text"},
                        VictimPhone: {type: "text"},
                        VictimAge: {type: "text"},
                        Contract: {type: "number"},
                        Unit: {type: "text"},
                        UnitID: {type: "number"},
                        EventType: {type: "text"},
                        EventTypeID: {type: "number"},
                        Basket: {type: "text"},
                        BasketID: {type: "number"},
                        Status: {type: "text"},
                        StatusID: {type: "number"},
                        StatusAuxiliary: {type: "text"},
                        StatusAuxiliaryID: {type: "number"},
                        Competition: {type: "text"},
                        CompetitionID: {type: "number"},
                        Relationship: {type: "text"},
                        StructID: {type: "number"}
                    }
                }
            },
            sort: {
                field: "ID",
                dir: "desc"
            }
        },
        toolbar: [
            {
                name: "adding",
                text: "Dodaj leada",
                iconClass: "k-icon k-i-plus",
            },
            {
                name: "clear_filter",
                text: "Wyczyść filtry",
                iconClass: "k-icon k-i-reset",
            },
        ],
        pageable: {
            refresh: true
        },
        filterable: true,
        height: 720,
        sortable: {
            mode: "single",
            allowUnsort: true,
            showIndexes: true
        },
        columns: [
            {
                command:
                    [
                        {
                            text: "Edytuj",
                            name: "edit",
                            iconClass: "k-icon k-i-edit",
                            className: "btn-edit",
                            visible: function(dataItem) {

                                if (edytuj_tylko_swoje && dataItem.UserLogin==user) {
                                    return true;
                                } else if (edytuj_przypisane && dataItem.AgentNumber==user) {
                                    return true;
                                } else if (edycja_leada) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        },
                        {
                            text: "Szczegóły",
                            name: "details",
                            iconClass: "k-icon k-i-preview",
                            className: "btn-edit",
                            click: showDetails
                        },
                        {
                            text: "Przejmij",
                            name: "get",
                            iconClass: "k-icon k-i-cart",
                            className: "btn-edit",
                            visible: function(dataItem) {

                                if (przejmowanie_leada) {
                                    return true;
                                } else {
                                    return false;
                                }
                            },
                            click: assignLead
                        }
                    ],
                width: '150px'
            },
            { field: "ID", title: "ID", filterable: false, width: '100px'},
            { field: "AddDate", title: "Data dodania", format: "{0:yyyy-MM-dd}", width: '120px',
                filterable: {
                    ui: function(element) {
                        element.kendoDatePicker({
                            format: "yyyy-MM-dd"
                        })
                    },
                    mode: "menu, row",
                    extra: true,
                    operators: {
                        date: {
                            gt: "od dnia",
                            lt: "do dnia",
                            eq: "jest równe"
                        }
                    }
                }
            },
            { field: "UserLogin", title: "Wprowadzajcy", width: '150px',
                filterable: {
                    extra: false,
                    search: true
                }
            },
            { title: 'Struktura',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "AgentNumber", title: "Numer agenta", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "AgentName", title: "Nazwa przedstawiciela", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "DirectorNumber", title: "Numer dyrektora", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    {
                        field: "DirectorName", title: "Nazwa dyrektora", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { title: 'Data zdarzenia',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "StartEvent", title: "Dokładna data", format: "{0:yyyy-MM-dd}", width: '120px',
                        filterable: {
                            ui: function(element) {
                                element.kendoDatePicker({
                                    format: "yyyy-MM-dd"
                                })
                            },
                            mode: "menu, row",
                            extra: true,
                            operators: {
                                date: {
                                    gt: "od dnia",
                                    lt: "do dnia",
                                    eq: "jest równe"
                                }
                            }
                        }
                    },
                    { field: "ApproximateEventDate", title: "Przybliżona data", format: "{0:yyyy-MM}", width: '140px',
                        filterable: {
                            ui: function(element) {
                                element.kendoDatePicker({
                                    format: "MMMM yyyy"
                                })
                            },
                            mode: "menu, row",
                            extra: true,
                            operators: {
                                date: {
                                    gt: "od dnia",
                                    lt: "do dnia",
                                    eq: "jest równe"
                                }
                            }
                        }
                    }

                ]
            },
            { title: 'Poszkodowany',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    {
                        field: "VictimFirstName", title: "Imię", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "VictimLastName", title: "Nazwisko", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "VictimCity", title: "Miejscowość", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { title: 'Miejsce zdarzenia',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "EventCommune", title: "Gmina", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "EventDistrict", title: "Powiat", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "EventProvince", title: "Województwo", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { field: "Contract", title: "Ilość umów", filterable: false, width: '120px'},
            { field: "Unit", title: "Jednostka",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_unit",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name",
                        messages: {
                            clear: "Wyczyść filtr",
                            filter: "Filtr"
                        }
                    },
                    multi: true
                },
                width: '120px'
            },
            { field: "EventType", title: "Typ zdarzenia",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_event_type",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '140px'
            },
            { field: "Basket", title: "Koszyk",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_basket",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '120px'
            },
            { field: "Status", title: "Status",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_status",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '120px'
            }
        ],
        columnMenu: true,
        editable: {
            mode: "popup",
            template: $("#editTemplate").html(),
            window: {
                title: "Lead",
                width: "60%",
                minWidth: 100,
                visible: false,
                position: {
                    top: 100,
                    left: "20%"
                }
            },
        },
        dataBound: function (){

            $(".k-grid-adding", "#grid_all_leads").bind("click", function () {

                openWindow('add_leads_window', 'Dodaj leada');
                var dialog = kendoWindow.data("kendoWindow").open();

            });

            $(".k-grid-clear_filter", "#grid_all_leads").bind("click", function () {

                $("form.k-filter-menu button[type='reset']").trigger("click");

            });

            var button = this.tbody.find('tr').each(function(){

                if (!dodawanie_leada) {
                    $(".k-grid-adding").hide();
                } else {
                    $(".k-grid-adding").show();
                }

            });

            if (!przypisz_agenta) {
                $(".assign_agent").hide();
            } else {
                $(".assign_agent").show();
            }

            if (!przypisz_dyrektora) {
                $(".assign_director").hide();
            } else {
                $(".assign_director").show();
            }
        },
        edit: function (e) {

            var buttons = e.container.find('.k-edit-buttons');

            var model = e.model;

            $( "<a role=\"button\" href=\"https://umowy.votum-sa.pl/moduly/druki/\" class=\"k-button k-button-icontext k-primary k-grid-add-contract\"><span class=\"k-icon k-i-paste-plain-text\"></span>Wypisz umowę</a>" ).appendTo(buttons);

            $('.k-grid-add-contract').on("click", function () {

                setCookie('aktywnaZakladka','zakladka_wypelnij_druk');
                mainPanel.zaladujTrescAjax('ajax/widoki/widok_zakladka_wypelnij_druk', null);
                setCookie('EventTypeID', model.EventTypeID);
                setCookie('Leads', model.ID);
                setCookie('VictimFirstName', model.VictimFirstName);
                setCookie('VictimLastName', model.VictimLastName);
            });

            $(".k-grid-save-changes", "#comment_list").bind("click", function () {

                if (!navigator.geolocation){
                    return;
                }

                function success(position) {

                    $.ajax({
                        url: API_URL+"lead/add_geolocalization_comment",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            leadId: model.ID
                        }
                    });

                }

                function error() {
                }

                navigator.geolocation.getCurrentPosition(success, error);

            });

            $(".refresh-grid", "#comment_list").bind("click", function () {



            });
        }
    });

    //////////////////////////////////////////////////////////////////////////////////////////////////////
    // GRID FOR AGENTS
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    kendoGridUser = $("#grid_user_leads").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    type: "POST",
                    url: API_URL+"lead/list_for_agent",
                    dataType: "json"
                },
                update: {
                    type: "POST",
                    url: API_URL+"lead/edit_lead",
                    dataType: "json"
                },
                parameterMap: function (options) {
                        return {
                            models: kendo.stringify(options.models),
                            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
                            user: user
                        };
                }
            },
            batch: true,
            pageSize: 12,
            schema: {
                model: {
                    id: "ID",
                    fields: {
                        ID: {type: "number", editable: false},
                        StartEvent: {type: "date", from: "StartEvent"},
                        AddDate: {type: "date", from: "AddDate"},
                        ApproximateEventDate: {type: "date", from: "ApproximateEventDate"},
                        VictimStreet: {type: "text"},
                        VictimHome: {type: "text"},
                        VictimPostCode: {type: "text"},
                        VictimPhone: {type: "text"},
                        VictimAge: {type: "text"},
                        Contract: {type: "number"},
                        Unit: {type: "text"},
                        UnitID: {type: "number"},
                        EventType: {type: "text"},
                        EventTypeID: {type: "number"},
                        Basket: {type: "text"},
                        BasketID: {type: "number"},
                        Status: {type: "text"},
                        StatusID: {type: "number"},
                        StatusAuxiliary: {type: "text"},
                        StatusAuxiliaryID: {type: "number"},
                        Competition: {type: "text"},
                        CompetitionID: {type: "number"},
                        Relationship: {type: "text"},
                        StructID: {type: "number"}
                    }
                }
            },
            sort: {
                field: "ID",
                dir: "desc"
            }
        },
        pageable: {
            refresh: true
        },
        filterable: true,
        height: 720,
        sortable: {
            mode: "single",
            allowUnsort: true,
            showIndexes: true
        },
        columns: [
            {
                command: [
                    {
                        text: "Edytuj",
                        name: "edit",
                        iconClass: "k-icon k-i-edit",
                        className: "btn-edit",
                        visible: function(dataItem) {

                            if (edytuj_tylko_swoje && dataItem.UserLogin==user) {
                                return true;
                            } else if (edytuj_przypisane && dataItem.AgentNumber==user) {
                                return true;
                            } else if (edycja_leada) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    {
                        text: "Szczegóły",
                        name: "details",
                        iconClass: "k-icon k-i-preview",
                        className: "btn-edit",
                        click: showDetails
                    }
                ]
                ,width: '150px'
            },
            { field: "ID", title: "ID", filterable: false, width: '100px' },
            { field: "AddDate", title: "Data dodania", format: "{0:yyyy-MM-dd}", width: '120px',
                filterable: {
                    ui: function(element) {
                        element.kendoDatePicker({
                            format: "yyyy-MM-dd"
                        })
                    },
                    mode: "menu, row",
                    extra: true,
                    operators: {
                        date: {
                            gt: "od dnia",
                            lt: "do dnia",
                            eq: "jest równe"
                        }
                    }
                }
            },
            { field: "UserLogin", title: "Wprowadzajcy", width: '150px',
                filterable: {
                    extra: false,
                    search: true
                }
            },
            { title: 'Struktura',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "AgentNumber", title: "Numer agenta", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "AgentName", title: "Nazwa przedstawiciela", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "DirectorNumber", title: "Numer dyrektora", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    {
                        field: "DirectorName", title: "Nazwa dyrektora", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { title: 'Data zdarzenia',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "StartEvent", title: "Dokładna data", format: "{0:yyyy-MM-dd}", width: '120px',
                        filterable: {
                            ui: function(element) {
                                element.kendoDatePicker({
                                    format: "yyyy-MM-dd"
                                })
                            },
                            mode: "menu, row",
                            extra: true,
                            operators: {
                                date: {
                                    gt: "od dnia",
                                    lt: "do dnia",
                                    eq: "jest równe"
                                }
                            }
                        }
                    },
                    { field: "ApproximateEventDate", title: "Przybliżona data", format: "{0:yyyy-MM}", width: '140px',
                        filterable: {
                            ui: function(element) {
                                element.kendoDatePicker({
                                    format: "MMMM yyyy"
                                })
                            },
                            mode: "menu, row",
                            extra: true,
                            operators: {
                                date: {
                                    gt: "od dnia",
                                    lt: "do dnia",
                                    eq: "jest równe"
                                }
                            }
                        }
                    }

                ]
            },
            { title: 'Poszkodowany',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    {
                        field: "VictimFirstName", title: "Imię", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "VictimLastName", title: "Nazwisko", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "VictimCity", title: "Miejscowość", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { title: 'Miejsce zdarzenia',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "EventCommune", title: "Gmina", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "EventDistrict", title: "Powiat", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "EventProvince", title: "Województwo", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { field: "Contract", title: "Ilość umów", filterable: false, width: '120px'},
            {
                field: "Unit",
                title: "Jednostka",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_unit",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name",
                        messages: {
                            clear: "Wyczyść filtr",
                            filter: "Filtr"
                        }
                    },
                    multi: true
                },
                width: '120px'
            },
            {
                field: "EventType",
                title: "Typ zdarzenia",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_event_type",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '140px'
            },
            {
                field: "Basket",
                title: "Koszyk",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_basket",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '120px'
            },
            {
                field: "Status",
                title: "Status",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_status",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '120px'
            },

        ],
        columnMenu: true,
        toolbar: [
            {
                name: "adding",
                text: "Dodaj leada",
                iconClass: "k-icon k-i-plus",
            },
            {
                name: "clear_filter",
                text: "Wyczyść filtry",
                iconClass: "k-icon k-i-reset",
            },
        ],
        editable: {
            mode: "popup",
            template: $("#editTemplate").html(),
            window: {
                title: "Lead",
                width: "60%",
                minWidth: 100,
                visible: false,
                position: {
                    top: 100,
                    left: "20%"
                }
            },
        },
        dataBound: function (){

            $(".k-grid-adding", "#grid_user_leads").bind("click", function () {

                openWindow('add_leads_window', 'Dodaj leada');
                var dialog = kendoWindow.data("kendoWindow").open();

            });

            $(".k-grid-clear_filter", "#grid_user_leads").bind("click", function () {

                $("form.k-filter-menu button[type='reset']").trigger("click");

            });

            var button = this.tbody.find('tr').each(function(){

                if (!dodawanie_leada) {
                    $(".k-grid-adding").hide();
                } else {
                    $(".k-grid-adding").show();
                }

            });

            if (!przypisz_agenta) {
                $(".assign_agent").hide();
            } else {
                $(".assign_agent").show();
            }

            if (!przypisz_dyrektora) {
                $(".assign_director").hide();
            } else {
                $(".assign_director").show();
            }
        },
        edit: function (e) {
            var buttons = e.container.find('.k-edit-buttons');

            var model = e.model;

            $( "<a role=\"button\" href=\"https://umowy.votum-sa.pl/moduly/druki/\" class=\"k-button k-button-icontext k-primary k-grid-add-contract\"><span class=\"k-icon k-i-paste-plain-text\"></span>Wypisz umowę</a>" ).appendTo(buttons);

            $('.k-grid-add-contract').on("click", function () {

                setCookie('aktywnaZakladka','zakladka_wypelnij_druk');
                mainPanel.zaladujTrescAjax('ajax/widoki/widok_zakladka_wypelnij_druk', null);
                setCookie('EventTypeID', model.EventTypeID);
                setCookie('Leads', model.ID);
                setCookie('VictimFirstName', model.VictimFirstName);
                setCookie('VictimLastName', model.VictimLastName);
            });

            $(".k-grid-save-changes", "#comment_list").bind("click", function () {

                if (!navigator.geolocation){
                    return;
                }

                function success(position) {

                    $.ajax({
                        url: API_URL+"lead/add_geolocalization_comment",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            leadId: model.ID
                        }
                    });

                }

                function error() {
                }

                navigator.geolocation.getCurrentPosition(success, error);

            });
        }
    });

    //////////////////////////////////////////////////////////////////////////////////////////////////////
    // GRID LEADS MANAGER
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    kendoGridManager = $("#grid_manager_leads").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    type: "POST",
                    url: API_URL+"lead/list",
                    dataType: "json"
                },
                update: {
                    type: "POST",
                    url: API_URL+"lead/edit_lead",
                    dataType: "json"
                },
                parameterMap: function (options, operation) {
                    if (operation !== "read" && options.models) {
                        return {
                            models: kendo.stringify(options.models),
                            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
                            user: user
                        };
                    }
                    if(operation == "read") {
                        return {
                            user: user
                        };
                    }
                }
            },
            batch: true,
            pageSize: 12,
            schema: {
                model: {
                    id: "ID",
                    fields: {
                        ID: {type: "number", editable: false},
                        StartEvent: {type: "date", from: "StartEvent"},
                        AddDate: {type: "date", from: "AddDate"},
                        ApproximateEventDate: {type: "date", from: "ApproximateEventDate"},
                        VictimStreet: {type: "text"},
                        VictimHome: {type: "text"},
                        VictimPostCode: {type: "text"},
                        VictimPhone: {type: "text"},
                        VictimAge: {type: "text"},
                        Contract: {type: "number"},
                        Unit: {type: "text"},
                        UnitID: {type: "number"},
                        EventType: {type: "text"},
                        EventTypeID: {type: "number"},
                        Basket: {type: "text"},
                        BasketID: {type: "number"},
                        Status: {type: "text"},
                        StatusID: {type: "number"},
                        StatusAuxiliary: {type: "text"},
                        StatusAuxiliaryID: {type: "number"},
                        Competition: {type: "text"},
                        CompetitionID: {type: "number"},
                        Relationship: {type: "text"},
                        StructID: {type: "number"}
                    }
                }
            },
            sort: {
                field: "ID",
                dir: "desc"
            }
        },
        toolbar: [
            {
                name: "adding",
                text: "Dodaj leada",
                iconClass: "k-icon k-i-plus",
            },
            {
                name: "clear_filter",
                text: "Wyczyść filtry",
                iconClass: "k-icon k-i-reset",
            },
            {
                name: "excel",
                text: "Exportuj do Excela",
                iconClass: "k-icon k-i-excel",
            }
        ],
        excel: {
            fileName: "Leads.xlsx",
            allPages: true
        },
        pageable: {
            refresh: true
        },
        filterable: true,
        height: 720,
        sortable: {
            mode: "single",
            allowUnsort: true,
            showIndexes: true
        },
        columns: [
            {
                command:
                    [
                        {
                            text: "Edytuj",
                            name: "edit",
                            iconClass: "k-icon k-i-edit",
                            className: "btn-edit",
                            visible: function(dataItem) {

                                if (edytuj_tylko_swoje && dataItem.UserLogin==user) {
                                    return true;
                                } else if (edytuj_przypisane && dataItem.AgentNumber==user) {
                                    return true;
                                } else if (edycja_leada) {
                                    return true;
                                } else {
                                    return false;
                                }
                            }
                        },
                        {
                            text: "Szczegóły",
                            name: "details",
                            iconClass: "k-icon k-i-preview",
                            className: "btn-edit",
                            click: showDetails
                        }
                    ],
                width: '150px'
            },
            { field: "ID", title: "ID", filterable: false, width: '100px' },
            { field: "AddDate", title: "Data dodania", format: "{0:yyyy-MM-dd}", width: '120px',
                filterable: {
                    ui: function(element) {
                        element.kendoDatePicker({
                            format: "yyyy-MM-dd"
                        })
                    },
                    mode: "menu, row",
                    extra: true,
                    operators: {
                        date: {
                            gt: "od dnia",
                            lt: "do dnia",
                            eq: "jest równe"
                        }
                    }
                }
            },
            { field: "UserLogin", title: "Wprowadzajcy", width: '150px',
                filterable: {
                    extra: false,
                    search: true
                }
            },
            { title: 'Struktura',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "AgentNumber", title: "Numer agenta", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "AgentName", title: "Nazwa przedstawiciela", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "DirectorNumber", title: "Numer dyrektora", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    {
                        field: "DirectorName", title: "Nazwa dyrektora", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { title: 'Data zdarzenia',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "StartEvent", title: "Dokładna data", format: "{0:yyyy-MM-dd}", width: '120px',
                        filterable: {
                            ui: function(element) {
                                element.kendoDatePicker({
                                    format: "yyyy-MM-dd"
                                })
                            },
                            mode: "menu, row",
                            extra: true,
                            operators: {
                                date: {
                                    gt: "od dnia",
                                    lt: "do dnia",
                                    eq: "jest równe"
                                }
                            }
                        }
                    },
                    { field: "ApproximateEventDate", title: "Przybliżona data", format: "{0:yyyy-MM}", width: '140px',
                        filterable: {
                            ui: function(element) {
                                element.kendoDatePicker({
                                    format: "MMMM yyyy"
                                })
                            },
                            mode: "menu, row",
                            extra: true,
                            operators: {
                                date: {
                                    gt: "od dnia",
                                    lt: "do dnia",
                                    eq: "jest równe"
                                }
                            }
                        }
                    }

                ]
            },
            { title: 'Poszkodowany',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    {
                        field: "VictimFirstName", title: "Imię", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "VictimLastName", title: "Nazwisko", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "VictimCity", title: "Miejscowość", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { title: 'Miejsce zdarzenia',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "EventCommune", title: "Gmina", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "EventDistrict", title: "Powiat", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "EventProvince", title: "Województwo", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { field: "Contract", title: "Ilość umów", filterable: false, width: '120px'},
            { field: "Unit", title: "Jednostka",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_unit",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name",
                        messages: {
                            clear: "Wyczyść filtr",
                            filter: "Filtr"
                        }
                    },
                    multi: true
                },
                width: '120px'
            },
            { field: "EventType", title: "Typ zdarzenia",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_event_type",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '140px'
            },
            { field: "Basket", title: "Koszyk",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_basket",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '120px'
            },
            { field: "Status", title: "Status",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_status",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '120px'
            }
        ],
        columnMenu: true,
        editable: {
            mode: "popup",
            template: $("#manageTemplate").html(),
            window: {
                title: "Lead",
                width: "60%",
                minWidth: 100,
                visible: false,
                position: {
                    top: 100,
                    left: "20%"
                }
            },
        },
        dataBound: function (){

            $(".k-grid-adding", "#grid_manager_leads").bind("click", function () {

                openWindow('add_leads_window', 'Dodaj leada');
                var dialog = kendoWindow.data("kendoWindow").open();

            });

            $(".k-grid-clear_filter", "#grid_manager_leads").bind("click", function () {

                $("form.k-filter-menu button[type='reset']").trigger("click");

            });

            var button = this.tbody.find('tr').each(function(){

                if (!dodawanie_leada) {
                    $(".k-grid-adding").hide();
                } else {
                    $(".k-grid-adding").show();
                }

            });

            if (!przypisz_agenta) {
                $(".assign_agent").hide();
            } else {
                $(".assign_agent").show();
            }

            if (!przypisz_dyrektora) {
                $(".assign_director").hide();
            } else {
                $(".assign_director").show();
            }
        },
        edit: function (e) {

            var buttons = e.container.find('.k-edit-buttons');

            var model = e.model;

            $( "<a role=\"button\" href=\"https://umowy.votum-sa.pl/moduly/druki/\" class=\"k-button k-button-icontext k-primary k-grid-add-contract\"><span class=\"k-icon k-i-paste-plain-text\"></span>Wypisz umowę</a>" ).appendTo(buttons);

            $('.k-grid-add-contract').on("click", function () {

                setCookie('aktywnaZakladka','zakladka_wypelnij_druk');
                mainPanel.zaladujTrescAjax('ajax/widoki/widok_zakladka_wypelnij_druk', null);
                setCookie('EventTypeID', model.EventTypeID);
                setCookie('Leads', model.ID);
                setCookie('VictimFirstName', model.VictimFirstName);
                setCookie('VictimLastName', model.VictimLastName);
            });

            $(".k-grid-save-changes", "#comment_list").bind("click", function () {

                if (!navigator.geolocation){
                    return;
                }

                function success(position) {

                    $.ajax({
                        url: API_URL+"lead/add_geolocalization_comment",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            leadId: model.ID
                        }
                    });

                }

                function error() {
                }

                navigator.geolocation.getCurrentPosition(success, error);

            });

            $(".refresh-grid", "#comment_list").bind("click", function () {



            });
        }
    });

    //////////////////////////////////////////////////////////////////////////////////////////////////////
    // GRID LEADS STRUCTURE
    //////////////////////////////////////////////////////////////////////////////////////////////////////

    kendoGridStruct = $("#grid_struct_leads").kendoGrid({
        dataSource: {
            transport: {
                read: {
                    type: "POST",
                    url: API_URL+"lead/leads_structure_agents/"+user,
                    dataType: "json"
                },
                update: {
                    type: "POST",
                    url: API_URL+"lead/edit_lead",
                    dataType: "json"
                },
                parameterMap: function (options, operation) {
                    if (operation !== "read" && options.models) {
                        return {
                            models: kendo.stringify(options.models),
                            api_key: '1aa53f75-55c8-41a7-8554-25e094c71b47',
                            user: user
                        };
                    }
                }
            },
            batch: true,
            pageSize: 12,
            schema: {
                model: {
                    id: "ID",
                    fields: {
                        ID: {type: "number", editable: false},
                        StartEvent: {type: "date", from: "StartEvent"},
                        AddDate: {type: "date", from: "AddDate"},
                        ApproximateEventDate: {type: "date", from: "ApproximateEventDate"},
                        VictimStreet: {type: "text"},
                        VictimHome: {type: "text"},
                        VictimPostCode: {type: "text"},
                        VictimPhone: {type: "text"},
                        VictimAge: {type: "text"},
                        Contract: {type: "number"},
                        Unit: {type: "text"},
                        UnitID: {type: "number"},
                        EventType: {type: "text"},
                        EventTypeID: {type: "number"},
                        Basket: {type: "text"},
                        BasketID: {type: "number"},
                        Status: {type: "text"},
                        StatusID: {type: "number"},
                        StatusAuxiliary: {type: "text"},
                        StatusAuxiliaryID: {type: "number"},
                        Competition: {type: "text"},
                        CompetitionID: {type: "number"},
                        Relationship: {type: "text"},
                        StructID: {type: "number"}
                    }
                }
            },
            sort: {
                field: "ID",
                dir: "desc"
            }
        },
        pageable: {
            refresh: true
        },
        filterable: true,
        toolbar: [
            {
                name: "adding",
                text: "Dodaj leada",
                iconClass: "k-icon k-i-plus",
            },
            {
                name: "clear_filter",
                text: "Wyczyść filtry",
                iconClass: "k-icon k-i-reset",
            },
        ],
        height: 720,
        sortable:
            {
                mode: "single",
                allowUnsort: true,
                showIndexes: true
            },
        columns: [
            {
                command: [
                    {
                        text: "Edytuj",
                        name: "edit",
                        iconClass: "k-icon k-i-edit",
                        className: "btn-edit",
                        visible: function(dataItem) {

                            if (edytuj_tylko_swoje && dataItem.UserLogin==user) {
                                return true;
                            } else if (edytuj_przypisane && dataItem.AgentNumber==user) {
                                return true;
                            } else if (edycja_leada) {
                                return true;
                            } else {
                                return false;
                            }
                        }
                    },
                    {
                        text: "Szczegóły",
                        name: "details",
                        iconClass: "k-icon k-i-preview",
                        className: "btn-edit",
                        click: showDetails
                    }
                ]
                ,width: '150px'
            },
            { field: "ID", title: "ID", filterable: false, width: '100px' },
            { field: "AddDate", title: "Data dodania", format: "{0:yyyy-MM-dd}", width: '120px',
                filterable: {
                    ui: function(element) {
                        element.kendoDatePicker({
                            format: "yyyy-MM-dd"
                        })
                    },
                    mode: "menu, row",
                    extra: true,
                    operators: {
                        date: {
                            gt: "od dnia",
                            lt: "do dnia",
                            eq: "jest równe"
                        }
                    }
                }
            },
            { field: "UserLogin", title: "Wprowadzajcy", width: '150px',
                filterable: {
                    extra: false,
                    search: true
                }
            },
            { title: 'Struktura',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "AgentNumber", title: "Numer agenta", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "AgentName", title: "Nazwa przedstawiciela", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "DirectorNumber", title: "Numer dyrektora", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    {
                        field: "DirectorName", title: "Nazwa dyrektora", width: '150px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { title: 'Data zdarzenia',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "StartEvent", title: "Dokładna data", format: "{0:yyyy-MM-dd}", width: '120px',
                        filterable: {
                            ui: function(element) {
                                element.kendoDatePicker({
                                    format: "yyyy-MM-dd"
                                })
                            },
                            mode: "menu, row",
                            extra: true,
                            operators: {
                                date: {
                                    gt: "od dnia",
                                    lt: "do dnia",
                                    eq: "jest równe"
                                }
                            }
                        }
                    },
                    { field: "ApproximateEventDate", title: "Przybliżona data", format: "{0:yyyy-MM}", width: '140px',
                        filterable: {
                            ui: function(element) {
                                element.kendoDatePicker({
                                    format: "MMMM yyyy"
                                })
                            },
                            mode: "menu, row",
                            extra: true,
                            operators: {
                                date: {
                                    gt: "od dnia",
                                    lt: "do dnia",
                                    eq: "jest równe"
                                }
                            }
                        }
                    }

                ]
            },
            { title: 'Poszkodowany',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    {
                        field: "VictimFirstName", title: "Imię", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "VictimLastName", title: "Nazwisko", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "VictimCity", title: "Miejscowość", width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { title: 'Miejsce zdarzenia',
                headerAttributes: {
                    style: "text-align: center"
                },
                columns: [
                    { field: "EventCommune", title: "Gmina", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "EventDistrict", title: "Powiat", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    },
                    { field: "EventProvince", title: "Województwo", filterable: true, width: '120px',
                        filterable: {
                            extra: false,
                            search: true
                        }
                    }
                ]
            },
            { field: "Contract", title: "Ilość umów", filterable: false, width: '120px'},
            {
                field: "Unit",
                title: "Jednostka",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_unit",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name",
                        messages: {
                            clear: "Wyczyść filtr",
                            filter: "Filtr"
                        }
                    },
                    multi: true
                },
                width: '120px'
            },
            {
                field: "EventType",
                title: "Typ zdarzenia",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_event_type",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '140px'
            },
            {
                field: "Basket",
                title: "Koszyk",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_basket",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '120px'
            },
            {
                field: "Status",
                title: "Status",
                filterable: {
                    cell: {
                        dataSource: new kendo.data.DataSource({
                            transport: {
                                read: {
                                    type: "POST",
                                    url: API_URL+"lead/get_status",
                                    dataType: "json"
                                }
                            }
                        }),
                        dataTextField: "Name"
                    },
                    multi: true
                },
                width: '120px'
            },
        ],
        columnMenu: true,
        editable: {
            mode: "popup",
            template: $("#editTemplate").html(),
            window: {
                title: "Lead",
                width: "60%",
                minWidth: 100,
                visible: false,
                position: {
                    top: 100,
                    left: "20%"
                }
            },
        },
        dataBound: function (){

            $(".k-grid-adding", "#grid_struct_leads").bind("click", function () {

                openWindow('add_leads_window', 'Dodaj leada');
                var dialog = kendoWindow.data("kendoWindow").open();

            });

            $(".k-grid-clear_filter", "#grid_struct_leads").bind("click", function () {

                $("form.k-filter-menu button[type='reset']").trigger("click");

            });


            var button = this.tbody.find('tr').each(function(){

                if (!dodawanie_leada) {
                    $(".k-grid-adding").hide();
                } else {
                    $(".k-grid-adding").show();
                }

            });

            if (!przypisz_agenta) {
                $(".assign_agent").hide();
            } else {
                $(".assign_agent").show();
            }

            if (!przypisz_dyrektora) {
                $(".assign_director").hide();
            } else {
                $(".assign_director").show();
            }
        },
        edit: function (e) {
            var buttons = e.container.find('.k-edit-buttons');

            var model = e.model;

            $( "<a role=\"button\" href=\"https://umowy.votum-sa.pl/moduly/druki/\" class=\"k-button k-button-icontext k-primary k-grid-add-contract\"><span class=\"k-icon k-i-paste-plain-text\"></span>Wypisz umowę</a>" ).appendTo(buttons);

            $('.k-grid-add-contract').on("click", function () {

                setCookie('aktywnaZakladka','zakladka_wypelnij_druk');
                mainPanel.zaladujTrescAjax('ajax/widoki/widok_zakladka_wypelnij_druk', null);
                setCookie('EventTypeID', model.EventTypeID);
                setCookie('Leads', model.ID);
                setCookie('VictimFirstName', model.VictimFirstName);
                setCookie('VictimLastName', model.VictimLastName);
            });

            $(".k-grid-save-changes", "#comment_list").bind("click", function () {

                if (!navigator.geolocation){
                    return;
                }

                function success(position) {

                    $.ajax({
                        url: API_URL+"lead/add_geolocalization_comment",
                        type: 'POST',
                        dataType: "json",
                        data: {
                            latitude: position.coords.latitude,
                            longitude: position.coords.longitude,
                            leadId: model.ID
                        }
                    });

                }

                function error() {
                }

                navigator.geolocation.getCurrentPosition(success, error);

            });
        }
    });

    //////////////////////////////////////////////////////////////////////////////////////////////////////
    // MAIN FUNCTION
    //////////////////////////////////////////////////////////////////////////////////////////////////////


        $("#datepickerApproximate").kendoDatePicker({
            start: "year",
            depth: "year",
            format: "MMMM yyyy",
            dateInput: true
        });


        detailWindow = $("#details_leads_window").kendoWindow({
            title: "Szczegóły leada",
            width: "60%",
            minWidth: 100,
            visible: false,
            position: {
                top: 100,
                left: "20%"
            }
        }).data("kendoWindow");

        detailsTemplate = kendo.template($("#detailsTemplate").html());


        function showDetails(e) {

            e.preventDefault();

            var dataItem = this.dataItem($(e.currentTarget).closest("tr"));
            detailWindow.content(detailsTemplate(dataItem));
            detailWindow.center().open();

            detailWindow.element.prev().find(".k-window-title").html("Szczegóły leada nr "+dataItem.ID);

            $('.k-grid-print').on("click", function () {

                $('.printLead').find(".pageHeader").html("<b>Szczegóły leada nr "+dataItem.ID+"</b>");
                $('.descriptionText').hide();
                $('.descriptionTextPrint').show();

                kendo.drawing.drawDOM(".printLead", {
                    forcePageBreak: ".new-page",
                    paperSize: "A4",
                    margin: "1cm",
                    scale: 0.5
                }).then(function(group){
                    kendo.drawing.pdf.saveAs(group, "lead_"+dataItem.ID+".pdf");
                    $('.printLead').find(".pageHeader").html('');
                    $('.descriptionText').show();
                    $('.descriptionTextPrint').hide();
                });
            });
        }

    function assignLead(e) {

        e.preventDefault();

        var dataItem = this.dataItem($(e.currentTarget).closest("tr"));

        $.ajax({
            type: "POST",
            url: API_URL+"lead/assign_lead/"+dataItem.ID+"/"+user+"/2",
            dataType: "json",
            success: function(data) {
                kendoGridUser.data('kendoGrid').dataSource.read();
                kendoGridUser.data('kendoGrid').refresh();
                kendoGridAll.data('kendoGrid').dataSource.read();
                kendoGridAll.data('kendoGrid').refresh();
                kendoGridStruct.data('kendoGrid').dataSource.read();
                kendoGridStruct.data('kendoGrid').refresh();
                kendoGridManager.data('kendoGrid').dataSource.read();
                kendoGridManager.data('kendoGrid').refresh();
            }
        });
    }

        function openWindow (id, title) {

            kendoWindow = $("#"+id).kendoWindow({
                title: title,
                width: "60%",
                minWidth: 100,
                visible: false,
                position: {
                    top: 100,
                    left: "20%"
                }
            });
        }

        kendo.ui.Grid.prototype.ensureMinWidth = function () {
            if (this.resizable) {
                this.resizable.bind("resize", function (e) {
                    var minTableWidth,
                        th = $(e.currentTarget).data("th"),
                        grid = th.closest(".k-grid").getKendoGrid();

                    if (e.x.delta > 0) {
                        minTableWidth = grid.tbody.closest("table").width();
                    }
                    else {
                        minTableWidth = grid.tbody.closest("table").width() + e.x.delta;
                    }
                    if (grid.options.scrollable) {
                        grid.thead.closest("table").css({ "min-width": minTableWidth });
                    }
                    grid.tbody.closest("table").css({ "min-width": minTableWidth });
                });
            }
        }

        kendo.ui.FilterMenu.fn.options.operators.string = {
            eq: "jest równy",
            neq: "nie jest równy",
            contains: "zawiera"
        };

        $("#save_column").click(function (e) {

            e.preventDefault();

            var optionsAll = kendoGridAll.data("kendoGrid").getOptions();
            var optionsUser = kendoGridUser.data("kendoGrid").getOptions();
            var optionsStruct = kendoGridStruct.data("kendoGrid").getOptions();
            var optionsManager = kendoGridManager.data("kendoGrid").getOptions();

            if($('.leadsMenu').find('.active')){
                var idName = $('.active').children().attr('id');

                if (idName == 'grid_all_leads') {
                    var gridName = kendoGridAll.data("kendoGrid");
                } else if (idName == 'grid_user_leads') {
                    var gridName = kendoGridUser.data("kendoGrid");
                } else if (idName == 'grid_struct_leads') {
                    var gridName = kendoGridStruct.data("kendoGrid");
                } else if (idName == 'grid_manager_leads') {
                    var gridName = kendoGridManager.data("kendoGrid");
                }
            }

            var columnOptions = gridName.getOptions().columns;
            var newOptions = columnOptions.slice(1);

            var allColumnOptions = optionsAll.columns;
            var allFirstColumnOptions = allColumnOptions.slice(0,1);
            var newAllColumnOptions = allFirstColumnOptions.concat(newOptions);

            var userColumnOptions = optionsUser.columns;
            var userFirstColumnOptions = userColumnOptions.slice(0,1);
            var newUserColumnOptions = userFirstColumnOptions.concat(newOptions);

            var structColumnOptions = optionsStruct.columns;
            var structFirstColumnOptions = structColumnOptions.slice(0,1);
            var newStructColumnOptions = structFirstColumnOptions.concat(newOptions);

            var managerColumnOptions = optionsManager.columns;
            var managerFirstColumnOptions = managerColumnOptions.slice(0,1);
            var newManagerColumnOptions = managerFirstColumnOptions.concat(newOptions);

            kendoGridAll.data("kendoGrid").setOptions({columns: newAllColumnOptions});
            kendoGridUser.data("kendoGrid").setOptions({columns: newUserColumnOptions});
            kendoGridStruct.data("kendoGrid").setOptions({columns: newStructColumnOptions});
            kendoGridManager.data("kendoGrid").setOptions({columns: newManagerColumnOptions});

            localStorage["kendo-grid-all-options"] = kendo.stringify(kendoGridAll.data("kendoGrid").getOptions());
            localStorage["kendo-grid-user-options"] = kendo.stringify(kendoGridUser.data("kendoGrid").getOptions());
            localStorage["kendo-grid-struct-options"] = kendo.stringify(kendoGridStruct.data("kendoGrid").getOptions());
            localStorage["kendo-grid-manager-options"] = kendo.stringify(kendoGridManager.data("kendoGrid").getOptions());

        });

    var optionsLoadAll = localStorage["kendo-grid-all-options"];
    var optionsLoadUser = localStorage["kendo-grid-user-options"];
    var optionsLoadStruct = localStorage["kendo-grid-struct-options"];
    var optionsLoadManager = localStorage["kendo-grid-manager-options"];

    console.log(optionsLoadAll);

    if (optionsLoadAll) {
        var gridAll = kendoGridAll.data("kendoGrid");
        var savedOptions = JSON.parse(optionsLoadAll);
        if (savedOptions) {
            savedOptions.columns[0].command[1].click = showDetails;
            savedOptions.columns[0].command[2].click = assignLead;
            gridAll.setOptions(savedOptions);
        } else {
            gridAll.dataSource.read();
        }
    }
    if (optionsLoadUser) {
        var gridUser = kendoGridUser.data("kendoGrid");
        var savedOptions = JSON.parse(optionsLoadUser);
        if (savedOptions) {
            savedOptions.columns[0].command[1].click = showDetails;
            gridUser.setOptions(savedOptions);
        } else {
            gridUser.dataSource.read();
        }
    }
    if (optionsLoadStruct) {
        var gridStruct = kendoGridStruct.data("kendoGrid");
        var savedOptions = JSON.parse(optionsLoadStruct);
        if (savedOptions) {
            savedOptions.columns[0].command[1].click = showDetails;
            gridStruct.setOptions(savedOptions);
        } else {
            gridStruct.dataSource.read();
        }
    }
    if (optionsLoadManager) {
        var gridManager = kendoGridManager.data("kendoGrid");
        var savedOptions = JSON.parse(optionsLoadManager);
        if (savedOptions) {
            savedOptions.columns[0].command[1].click = showDetails;
            gridManager.setOptions(savedOptions);
        } else {
            gridManager.dataSource.read();
        }
    }

});


function showMap(e){

    e.preventDefault();

    var dataItem = this.dataItem($(e.currentTarget).closest("tr"));

    $.ajax({
        url: API_URL+"lead/get_comment",
        type: 'POST',
        dataType: "json",
        data: {
            commentId: dataItem.Id
        },
        success: function(data) {
            var lat = data[0].Latitude;
            var lon = data[0].Longitude;

            var latlon = new google.maps.LatLng(lat, lon)
            var mapholder = document.getElementById('map')
            mapholder.style.height = '300px';
            mapholder.style.width = 'auto';

            var map = new google.maps.Map(mapholder, {
                zoom: 12,
                center: latlon
            });
            var geocoder = new google.maps.Geocoder;
            var infowindow = new google.maps.InfoWindow;

            geocodeLatLng(geocoder, map, infowindow);

            function geocodeLatLng(geocoder, map, infowindow) {
                var latlng = latlon;
                geocoder.geocode({'location': latlng}, function(results, status) {
                    if (status === 'OK') {
                        if (results[0]) {
                            map.setZoom(11);
                            var marker = new google.maps.Marker({
                                position: latlng,
                                map: map
                            });
                            infowindow.setContent(results[0].formatted_address);
                            infowindow.open(map, marker);
                        } else {
                            window.alert('Brak wyników');
                        }
                    } else {
                        window.alert('Błąd: ' + status);
                    }
                });
            }

            $('.alert_map').show();
        }

    });

}

function customBoolEditor(container, options) {
var guid = kendo.guid();
$('<input class="k-checkbox" id="' + guid + '" type="checkbox" name="Discontinued" data-type="boolean" data-bind="checked:Discontinued">').appendTo(container);
$('<label class="k-checkbox-label" for="' + guid + '">&#8203;</label>').appendTo(container);
}
