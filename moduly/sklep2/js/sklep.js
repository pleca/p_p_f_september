$(document).ready(function () {
    kendo.culture("pl-PL");

    var products = [{
        "ProductID": 1,
        "ProductName": "Chai",
        "UnitPrice": 18,
        "UnitsInStock": 39,
        "Discontinued": false
    }, {
        "ProductID": 2,
        "ProductName": "Chang",
        "UnitPrice": 19,
        "UnitsInStock": 17,
        "Discontinued": false
    }, {
        "ProductID": 3,
        "ProductName": "Aniseed Syrup",
        "UnitPrice": 10,
        "UnitsInStock": 13,
        "Discontinued": false
    }, {
        "ProductID": 4,
        "ProductName": "Chef Anton\u0027s Cajun Seasoning",
        "UnitPrice": 22,
        "UnitsInStock": 53,
        "Discontinued": false
    }, {
        "ProductID": 5,
        "ProductName": "Chef Anton\u0027s Gumbo Mix",
        "UnitPrice": 21.35,
        "UnitsInStock": 0,
        "Discontinued": true
    }, {
        "ProductID": 6,
        "ProductName": "Grandma\u0027s Boysenberry Spread",
        "UnitPrice": 25,
        "UnitsInStock": 120,
        "Discontinued": false
    }, {
        "ProductID": 7,
        "ProductName": "Uncle Bob\u0027s Organic Dried Pears",
        "UnitPrice": 30,
        "UnitsInStock": 15,
        "Discontinued": false
    }, {
        "ProductID": 8,
        "ProductName": "Northwoods Cranberry Sauce",
        "UnitPrice": 40,
        "UnitsInStock": 6,
        "Discontinued": false
    }, {
        "ProductID": 9,
        "ProductName": "Mishi Kobe Niku",
        "UnitPrice": 97,
        "UnitsInStock": 29,
        "Discontinued": true
    }, {
        "ProductID": 10,
        "ProductName": "Ikura",
        "UnitPrice": 31,
        "UnitsInStock": 31,
        "Discontinued": false
    }, {
        "ProductID": 11,
        "ProductName": "Queso Cabrales",
        "UnitPrice": 21,
        "UnitsInStock": 22,
        "Discontinued": false
    }, {
        "ProductID": 12,
        "ProductName": "Queso Manchego La Pastora",
        "UnitPrice": 38,
        "UnitsInStock": 86,
        "Discontinued": false
    }, {
        "ProductID": 13,
        "ProductName": "Konbu",
        "UnitPrice": 6,
        "UnitsInStock": 24,
        "Discontinued": false
    }, {
        "ProductID": 14,
        "ProductName": "Tofu",
        "UnitPrice": 23.25,
        "UnitsInStock": 35,
        "Discontinued": false
    }, {
        "ProductID": 15,
        "ProductName": "Genen Shouyu",
        "UnitPrice": 15.5,
        "UnitsInStock": 39,
        "Discontinued": false
    }, {
        "ProductID": 16,
        "ProductName": "Pavlova",
        "UnitPrice": 17.45,
        "UnitsInStock": 29,
        "Discontinued": false
    }
    ];
    // models / data
    //ODBIERA DANE JSON Z PLIKU menu.json
    var items = new kendo.data.DataSource({
        data: products,
        pageSize: 14
        // schema:
        //     {
        //         model: {}
        //     },
        // transport:
        //     {
        //         read:
        //             {
        //                 url:  "/data/menu.json",
        //                 dataType: "json"
        //             }
        //     }
    });

    $("#pager").kendoPager({
        dataSource: items
    });

    $("#pager-bottom").kendoPager({
        dataSource: items
    });

    var cart = kendo.observable({
        contents: [],
        cleared: false,

        //TU NIE TRAFIA!!
        contentsCount: function() {
            return this.get("contents").length;
        },

        add: function(item) {
            var found = false;
            this.set("cleared", false);
            //SPRAWDZA CZY PRODUKT JUŻ JEST W KOSZYKU
            for (var i = 0; i < this.contents.length; i ++) {
                var current = this.contents[i];
                if (current.item === item) {
                    current.set("quantity", current.get("quantity") + 1);
                    found = true;
                    break;
                }
            }
            //JEŚLI PRODUKTU NIE MA JESZCZE W KOSZYKU
            if (!found) {
                this.contents.push({ item: item, quantity: 1 });
            }
        },

        remove: function(item) {
            for (var i = 0; i < this.contents.length; i ++) {
                var current = this.contents[i];
                if (current === item) {
                    this.contents.splice(i, 1);
                    break;
                }
            }
        },

        empty: function() {
            var contents = this.get("contents");
            contents.splice(0, contents.length);
        },

        clear: function() {
            var contents = this.get("contents");
            contents.splice(0, contents.length);
            this.set("cleared", true);
        },

        total: function() {
            var price = 0,
                contents = this.get("contents"),
                length = contents.length,
                i = 0;

            for (; i < length; i ++) {
                price += parseInt(contents[i].item.UnitPrice) * contents[i].quantity;
            }

            return kendo.format("{0:c}", price);
        }
    });

    var indexModel = kendo.observable({
        items: items,
        cart: cart,
        addToCart: function(e) {
            cart.add(e.data);
        }
    });

    var cartPreviewModel = kendo.observable({
        cart: cart,

        cartContentsClass: function() {
            return this.cart.contentsCount() > 0 ? "active" : "empty";
        },

        removeFromCart: function(e) {
            this.get("cart").remove(e.data);
        },

        emptyCart: function() {
            cart.empty();
        },

        itemPrice: function(cartItem) {
            return kendo.format("{0:c}", cartItem.item.UnitPrice);
        },

        totalPrice: function() {
            return this.get("cart").total();
        },

        proceed: function(e) {
            this.get("cart").clear();
            sushi.navigate("/");
        }
    });

    kendo.bind($("#shop-info"), cartPreviewModel);
    kendo.bind($("#content"), indexModel);
    kendo.bind($("#cart-info"), cartPreviewModel);


//    panelBar
    var inlineDefault = new kendo.data.HierarchicalDataSource({
        data: [
            {
                text: "Furniture", items: [
                    {text: "Tables & Chairs"},
                    {text: "Sofas"},
                    {text: "Occasional Furniture"}
                ]
            },
            {
                text: "Decor", items: [
                    {text: "Bed Linen"},
                    {text: "Curtains & Blinds"},
                    {text: "Carpets"}
                ]
            }
        ]
    });

    $("#panelbar-left").kendoPanelBar({
        dataSource: inlineDefault
    });

    var inline = new kendo.data.HierarchicalDataSource({
        data: [
            {
                categoryName: "Storage", subCategories: [
                    {subCategoryName: "Wall Shelving"},
                    {subCategoryName: "Floor Shelving"},
                    {subCategoryName: "Kids Storage"}
                ]
            },
            {
                categoryName: "Lights", subCategories: [
                    {subCategoryName: "Ceiling"},
                    {subCategoryName: "Table"},
                    {subCategoryName: "Floor"}
                ]
            }
        ],
        schema: {
            model: {
                children: "subCategories"
            }
        }
    });
});
