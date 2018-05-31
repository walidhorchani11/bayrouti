//appele dans le fichier panier_show
$(document).ready(function () {

    $(".update_qte").change(function () {

        var qte = $(this).val();
        var idProd = $(this).attr('id');


        //recuperer le prix pour lutiliser pour modifier le total
        var price = $(this).parent().siblings('.price').text();
        var somme = price * qte;
        //selectionner le td du total pour update
        var tdSomme = $(this).parent().siblings('.sommeProduct');

        $.get(Routing.generate('panier_update', {'idProd': idProd, 'qte': qte}), function (data) {
            console.log(data);
            tdSomme.text(somme);

            //appel de fonction pour maj le total du panier
            coutTotal();
        });

    });


    //**************************************hello
    var tr_tbody = $("tbody > tr").length;
    $(".lien_retirer").click(function () {
        var idProd = $(this).attr('id');
        var tr = $(this).parents("tr");

        $.get(Routing.generate('panier_delete', {'idProd': idProd}), function (data) {
            $(tr).remove();

            tr_tbody--;
            console.log(data);

            //if panier empty then delete button valider panier
            if (tr_tbody == 0) {
                $(".validation").remove();
                var noeud_tr = "<tr> <td colspan=" + "5>" + "<span>votre panier est vide</span></td></tr>";
                $("tbody").append(noeud_tr);
            }

            //appel de fonction pour majjj le total du panier
            coutTotal();


        });
    });


    function coutTotal() {

        var collectionSP = $('.sommeProduct');
        var total = 0;
        var i;

        for (i = 0; i < collectionSP.length; i++) {
            total = total + Number(collectionSP[i].innerHTML);


        }
        $('#totalpanier').text(total);

    }

});
