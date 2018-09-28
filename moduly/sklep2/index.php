<?php require_once($_SERVER ['DOCUMENT_ROOT'] . '/header.php'); ?>
<?php
if (!in_array('134', $luzu)) {
    header('Location: https://' . $_SERVER ['HTTP_HOST'] . '/403 ');
}
tytul_strony('slklep');
?>

<link rel="stylesheet"
      href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/biblioteki/bootstrap-4.0.0-dist/css/bootstrap.css'; ?>"
      type="text/css"/>
<script type="text/javascript" src="<?php adres_strony(); ?>biblioteki/bootstrap-4.0.0-dist/js/bootstrap.js"></script>

<script src="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/js/jquery.js"></script>
<script src="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/js/kendo.all.js"></script>
<script type="text/javascript" src="<?php echo adres_strony(); ?>moduly/sklep2/js/sklep.js"></script>
<link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/styles/web/kendo.common.css"/>
<link rel="stylesheet" href="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/styles/web/kendo.bootstrap-v4.css"/>
<link rel="stylesheet"
      href="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/styles/web/kendo.bootstrap.mobile.css"/>
<script src="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/js/messages/kendo.messages.pl-PL.js"></script>
<script src="<?php adres_strony(); ?>biblioteki/telerik_2018.1.117/js/cultures/kendo.culture.pl-PL.js"></script>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/sklep2/css/sushi.css'; ?>"
      type="text/css"/>
<link rel="stylesheet" href="<?php echo 'https://' . $_SERVER ['HTTP_HOST'] . '/moduly/sklep2/css/sklep.css'; ?>"
      type="text/css"/>

<script type="text/x-kendo-template" id="cart-preview-template">
    <div id="shop-info" data-bind="attr: { class: cartContentsClass }">
        <ul data-role="listview" data-bind="source: cart.contents" data-template="cart-item" id="shop-list"></ul>
        <!--SUMA I GUZIKI "EMPTY CART" I "CHECKOUT"-->
        <div id="shopping-cart">
            <h3>your<br/>shopping cart</h3>
            <p class="total-price" data-bind="html: totalPrice"></p>
            <a id="empty-cart" href="#" data-bind="click: emptyCart">empty cart</a><a id="checkout" href="#/checkout">checkout</a>
        </div>
    </div>
</script>

<!--KOSZYK - LISTA PRODUKTÓW W KOSZYKU-->
<!--<LI>-->
<script type="text/x-kendo-template" id="cart-item">
    <li class="selected-products-list">
        <a data-bind="click: removeFromCart" class="view-selected-items"><img
                    width="100" height="100"
                    src="https://t00.deviantart.net/CDMPOjyGVx-ZQBRPXh_VmaTKLxk=/300x200/filters:fixed_height(100,100):origin()/pre00/f0e1/th/pre/f/2014/301/c/c/summer_night_by_px_stardust-d84gfwx.png"/>
        </a>
        <!--PODPIS NA DOLE PRODUKTU"1x$19,00"-->
        <span class="selected-image-price"><span data-bind="text: quantity"></span>x<span
                    data-bind="text: itemPrice"></span></span>
    </li>
</script>

<!--PRODUKTY ASORTYMENTU -->
<!--<LI>-->
<script type="text/x-kendo-template" id="item">
    <li class="products">
        <a class="view-details" href="">
            <img class="main-image"
                 src="https://t00.deviantart.net/CDMPOjyGVx-ZQBRPXh_VmaTKLxk=/300x200/filters:fixed_height(100,100):origin()/pre00/f0e1/th/pre/f/2014/301/c/c/summer_night_by_px_stardust-d84gfwx.png"
                 alt="#: ProductName#" title="#: ProductName #"
            />
            </div>
            <strong>#: ProductName #</strong>
            <span class="price"><span>#: UnitPrice #</span><span> zł</span></span>
        </a>
        <button class="add-to-cart" data-bind="click: addToCart">Dodaj do koszyka</button>
    </li>
</script>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <a href="https://umowy.votum-sa.pl/strona_glowna">
                <p>Strona główna</p>
            </a>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <div id="categories">
                <div class="panel-section k-content">
                    <div id="panelbar-left"></div>
                </div>
                <style>

                </style>
            </div>
        </div>
        <div class="col-md-10">
            <div class="row">
                <div class="col-md-12 1">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-9 2">
                                    <div class="dodajProduktNowy margin_b_10 padding_0">
                                        <div class="panel panel-default add-product-button">
                                            <div class="panel_naglowek"><i class="float_r fa fa-plus dodaj_produkt"
                                                                           aria-hidden="true"></i>
                                                <div class="clear_b"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 3">
                                    <a id="cart-info" href="#">Koszyk<span>&nbsp<span
                                                    data-bind="text: cart.contentsCount"></span></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="clear_b"></div>
                        <div class="col-md-12 4">
                            <div class="panel panel-default">
                                <!--LISTA PRODUKTÓW I KOSZYK-->
                                <div class="layout-products">
                                    <p data-bind="visible: cart.cleared"> Dziękujemy za zakupy!</p>
                                    <!--MIEJSCE DLA PRODUKTÓW W KOSZYKU I ASORTYMENTU-->
                                    <div id="main-section">
                                        <!--MIEJSCE DLA PRODUKTÓW DODANYCH DO KOSZYKA-->
                                        <section id="pre-content">
                                            <div>
                                                <div id="shop-info" data-bind="attr: { class: cartContentsClass }">
                                                    <ul data-role="listview" data-bind="source: cart.contents"
                                                        data-template="cart-item" id="shop-list"></ul>
                                                    <!--SUMA I GUZIKI "EMPTY CART" I "CHECKOUT"-->
                                                    <div id="shopping-cart">
                                                        <h3>twój<br/>koszyk</h3>
                                                        <p class="total-price" data-bind="html: totalPrice"></p>
                                                        <a id="empty-cart" href="#"
                                                           data-bind="click: emptyCart">wyczyść</a>
                                                        <a id="checkout" href="#">zamów</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <!--MIEJSCE DLA ASORTYMENTU-->
                                        <section id="content">
                                            <div id="pager" class="k-pager-wrap"></div>
                                            <ul data-role="listview" data-bind="source: items" data-template="item"
                                                id="main"></ul>
                                            <div id="pager-bottom" class="k-pager-wrap" style="margin-bottom: 200px"></div>
                                        </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="clear_b"></div>


<?php require_once($_SERVER ['DOCUMENT_ROOT'] . '/footer.php'); ?>

