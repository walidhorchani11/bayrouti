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

        $.get('http://localhost/atelier3/web/app_dev.php/panier/update?idProd=' + idProd + '&qte=' + qte, function () {
            console.log('qte modifier avec success');
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

        $.get('http://localhost/atelier3/web/app_dev.php/panier/delete?idProd=' + idProd, function () {
            $(tr).remove();
            //on peut creer une fonction qui test le nombre de tr si = 1 cad qu il ya seulement le
            //tete du tableau, on change le bouton -> retour au produit

            tr_tbody--;
            console.log(tr_tbody);

            //if panier empty then delete button valider panier
            if (tr_tbody == 0) {
                $("#btn_valider").remove();
                var noeud_tr = "<tr> <td colspan=" + "5>" + "<span>votre panier est vide</span></td></tr>"
                $("tbody").append(noeud_tr);
            }

            //appel de fonction pour maj le total du panier
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
