<?php 
include_once 'C:/wamp64/www/Vivote/config.php'; 
$page = 'Bienvenue';
include_once INCLUDES_PATH."/header.php";
?>

    <section class="mt-4" style="font-size: 109%; line-height: 1.6;">
        <div class="container text-center">
            <h2 class="fs-3 mb-2">Organisez vos votes gratuitement</h2>
            <p class="mt-4 px-2">
                Créez un vote planifier et selectionner une liste d'électeurs pour voter.
            </p>
            <p class="mt-4 px-2">
                Que vous soyez une société, une association ou simplement un groupe de personnes ayant besoin de prendre des décisions démocratiquement, Vivote est fait pour vous&nbsp;!
            </p>
        </div>
    </section>

    <div class="text-center my-4">
        <form class="button_to" method="get" action="login.php"><button class="m-2 btn sub-btn primary-color px-3" style="font-size: 113%; display: inline-flex; align-items: center;" type="submit">
                Je crée un vote...
            </button>
        <a href="/vivote/v/e/" class="m-2 btn sub-btn primary-color px-3" style="font-size: 113%; display: inline-flex; align-items: center;" type="submit">
                Je participe a un vote
            </a></form>
        <a href="/vivote/v/results/" class="m-2 btn sub-btn primary-color px-3" style="font-size: 113%; display: inline-flex; align-items: center;" type="submit">
                Voir les resultats d'un vote
            </a></form>
    </div>

    <section class="my-5">
        <div class="container px-5">
            <div class="row my-5">

                <div class="col-md-4 p-2">
                    <div class="shadow card p-4">
                        <h3>Simple</h3>
                        <p>
                            Rapide et facile a configurer
                        </p>
                    </div>
                </div>

                <div class="col-md-4 p-2 img-1">
                    <div class="shadow card p-4">
                        <h3>Fiable</h3>
                        <p>
                            Securise et transparent
                        </p>
                    </div>

                </div>

                <div class="col-md-4 p-2 img-1">
                    <div class="shadow card p-4">
                        <h3>Gratuit</h3>
                        <p>
                            Un forfait gratuit avec l'essentiel
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container px-5">

            <p class="text-center py-3 px-4 border rounded bg-gris mx-md-5">Avec Vivote, les decisions democratiques sont enfin simples a organiser.</p>

            <div class="row my-5">
                <div class="col-md-4 p-2">
                    <div class="shadow card p-4">
                        <h3>Gratuit</h3>
                        <p>
                            Vivote democratise la democatie en ligne en proposant un service gratuit et sans publicite
                        </p>
                    </div>
                </div>


                <div class="col-md-4 p-2">
                    <div class="shadow card p-4">
                        <h3>Vote a bultin secrets</h3>
                        <p>
                            Vivote simplifie la creation et la gestion des votes, eliminant toute complexite lie a leur caractere confidentiel
                        </p>
                    </div>

                </div>

                <div class="col-md-4 p-2">
                    <div class="shadow card p-4">
                        <h3>Accessible</h3>
                        <p>
                            Simple d'utilisation<br> vous obtiendrez des taux de participation eleves
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <div class="text-center m-5">
        <div class="fs-3 lh-sm">
            Créez ou participez à votre premier vote en 2 minutes
        </div>
        <div class="text-center mt-4">
            <form class="button_to" method="get" action="login.php"><button class="btn m-2 sub-btn primary-color px-3" style="font-size: 113%; display: inline-flex; align-items: center;" type="submit">
                    Je crée un vote...
                </button><a href="/vivote/v/e/" class="m-2 btn sub-btn primary-color px-3" style="font-size: 113%; display: inline-flex; align-items: center;" type="submit">
                Je participe a un vote
            </a><a href="/vivote/v/results/" class="m-2 btn sub-btn primary-color px-3" style="font-size: 113%; display: inline-flex; align-items: center;" type="submit">
                Voir les resultats d'un vote
            </a></form>
        </div>
    </div>
<?php include_once INCLUDES_PATH.'/footer.php'; ?>