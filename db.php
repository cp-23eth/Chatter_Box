<?php
    class db {
        private PDO $dbh;

        function __construct($user, $password)
        {
            $this->dbh = new PDO('mysql:host=localhost;dbname=chatterbox', $user, $password);
        }

        function verifyUser($adresseMail, $nomUser){
            $stmt = $this->dbh->prepare("SELECT * FROM `utilisateur` WHERE `nomUser` = :nomUser OR `adresseMail` = :adresseMail");
            $stmt->bindParam('nomUser', $nomUser);
            $stmt->bindParam('adresseMail', $adresseMail);
            $stmt->execute();

            $value = $stmt->rowCount();

            if ($value !== 0){
                return false;
                // ne différencie pas l'adresse mail et le nom
            }
            else{
                return true;
            }
        }

        function createUser($adresseMail, $nomUser, $motDePasse){
            $stmt = $this->dbh->prepare("INSERT INTO `utilisateur` (`nomUser`, `adresseMail`, `motDePasse`) VALUES(:nomUser, :adresseMail, :motDePasse)");
            $stmt->bindParam(':nomUser', $nomUser);
            $stmt->bindParam(':adresseMail', $adresseMail);
            $stmt->bindParam(':motDePasse', $motDePasse);
            $stmt->execute();

            return true;
        }

        function verifyLogin($nomUser, $motDePasse){
            $stmt = $this->dbh->prepare("SELECT * FROM `utilisateur` WHERE `nomUser` = :nomUser AND `motDePasse` = :motDePasse");
            $stmt->bindParam(':nomUser', $nomUser);
            $stmt->bindParam(':motDePasse', $motDePasse);
            $stmt->execute();

            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            $value = $stmt->rowCount();

            if($value === 1){
                $_SESSION['nomUser'] = $nomUser;
                $_SESSION['motDePasse'] = $motDePasse;
                $_SESSION['adresseMail'] = $user['adresseMail'];
                return true;
            }
            else {
                return false;
            }
        }

        function changePassword($mdpActuel, $nouveauMdp){
            $nomUser = $_SESSION['nomUser'];
            $stmt = $this->dbh->prepare("SELECT `motDePasse` FROM `utilisateur` WHERE `motDePasse` = :motDePasse AND `nomUser` = :nomUser");
            $stmt->bindParam(':motDePasse', $mdpActuel);
            $stmt->bindParam(':nomUser', $nomUser);
            $stmt->execute();

            $value = $stmt->rowCount();

            if ($value === 1){
                $stmt = $this->dbh->prepare("UPDATE `utilisateur` SET `motDePasse` = :nouveauMdp WHERE `nomUser` = :nomUser");
                $stmt->bindParam(':nouveauMdp', $nouveauMdp);
                $stmt->bindParam(':nomUser', $nomUser);
                $stmt->execute();

                $_SESSION['motDePasse'] = $nouveauMdp;
                return true;
            }
            else {
                return false;
            }
        }
    }
?>