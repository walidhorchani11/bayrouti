//ce fichier est appele dans le fichier index de product
$(document).ready(function () {

    var panier = false;
    $(".buttonAddDelete").click(function () {

        //on recupere le id du produit pour le passaer au servuer on utilisant ajax
        var idProduct = $(this).attr('value');

        //recuperation du nom de lattribut name pour faire le test
        //si name = add cad que le boutton est pour ajouter produit au panier
        //apres le clique on change lattribut name to delete
        //et on change le text du boutton
        var state = $(this).attr("name");
        if (state == "add") {
            $(this).attr("name", "delete").text("retirer du panier");
        } else if (state == "delete") {
            $(this).attr("name", "add").text("ajouter au panier");
        }

        //a supprimer les param non utilises
        $.get(Routing.generate('panier_add', {'id': idProduct, 'qte': '1'}), function (data, status) {
            afficheBtnPanier();
        });
    });


    function afficheBtnPanier() {
        if (panier == false) {
            $('#idPanier').show();
            panier = true;
        }

    }
});
