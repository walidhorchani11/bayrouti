//appele dans le fichier panier_show
$(document).ready(function () {
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
                var noeud_tr = "<tr> <td colspan=" + "5>" +"<span>votre panier est vide</span></td></tr>"
                $("tbody").append(noeud_tr);
            }

        });
    });
});
