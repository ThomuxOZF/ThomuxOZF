<?php
 include"Commun/Header.php";
 ?>
 <body>
    

    <main>
        <div class="choco">
            
            
            <div class="contactez-nous">
                <h1>Contactez-nous</h1>
                <p>Un problème, une question, envie de nous envoyer un message d’amour ? N’hésitez pas à utiliser ce formulaire pour prendre contact avec nous !</p>
                <form class="formu" action="traitmentjb.php" method="post">
                <div>
                <label for="nom">Votre nom</label>
                <input type="text" id="nom" name="nom" placeholder="Nom" required>
                </div>
                <div>
                <label for="nom">Votre  Prenom</label>
                <input type="text" id="nom" name="prenom" placeholder="Prénom" required>
                </div>
                <div>
                <label for="email">Votre e-mail</label>
                <input type="email" id="email" name="email" placeholder="monadresse@mail.com" required>
                </div>
                <div>
                <!-- <label for="sujet">Quel est le sujet de votre message ?</label>
                <select name="sujet" id="sujet" required>
                <option value="" disabled selected hidden>Choisissez le sujet de votre message</option>
                <option value="probleme-compte">Problème avec mon compte</option>
                <option value="question-produit">Question à propos d’un produit</option> -->
                <label for="etat">Quel est le sujet du message:</label>
                <input type="radio" id="probleme" name="sujet" value="1" required>

                <label for="neuf">Probleme avec mon compte</label>
                <input type="radio" id="question " name="sujet" value="2 " required>

                <label for="question">Question sur un produit</label>
                <input type="radio" id="suivi" name="sujet" value="3" required>

                <label for="suivi">suivi d'une commande</label>
                <input type="radio" id="autre" name="sujet" value="4" required>
                <label for="autre">Autre</label>
                <input type="radio" id="autre" name="sujet" value="5" required>
                </div>
                <div>
                <label for="message">Votre message</label>
                <input type="text" id="message" name="message" placeholder="Bonjour, je vous contacte car...." required>
                </div>
                <div>
                <button type="submit">Envoyer mon message</button>
                </div>
                </form>
                </div>

                <?php
 include"Commun/footer.php";
 ?>
