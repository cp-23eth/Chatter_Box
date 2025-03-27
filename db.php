<?php
    class db {
        private PDO $dbh;

        function __construct($user, $password)
        {
            $this->dbh = new PDO('mysql:host=172.17.0.2;dbname=chatterbox', $user, $password);
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

            if ($stmt->rowCount() === 1){
                if($this->changePassword2($nouveauMdp)){
                    return true;
                }
            }
            else {
                return false;
            }
        }

        function changePassword2($nouveauMdp){
            $nomUser = $_SESSION['nomUser'];

            $stmt = $this->dbh->prepare("UPDATE `utilisateur` SET `motDePasse` = :nouveauMdp WHERE `nomUser` = :nomUser");
            $stmt->bindParam(':nouveauMdp', $nouveauMdp);
            $stmt->bindParam(':nomUser', $nomUser);
            $stmt->execute();

            $_SESSION['motDePasse'] = $nouveauMdp;
            return true;
        }

        function takeCanal($nomUser){
            $stmt = $this->dbh->prepare("SELECT `nomCanal` FROM `appartient` WHERE `nomUser` = :nomUser");
            $stmt->bindParam(':nomUser', $nomUser);
            $stmt->execute();

            $canaux = [];

            $canaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $canaux;
        }

        function takeAllCanal() {
            $stmt = $this->dbh->prepare("SELECT DISTINCT `nomCanal`, `nomUser` FROM `appartient` WHERE `isAdmin` = 1 ORDER BY `nomCanal` ASC");
            $stmt->execute();

            $canaux = [];

            $canaux = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $canaux;
        }

        function createPost($titre, $description, $datePost, $nomUser, $canal, $imgPath){
            $stmt = $this->dbh->prepare("INSERT INTO `post` (`nom`, `description`, `imagePath`, `datePost`, `nomUser`, `nomCanal`) VALUES (:titre, :description, :imagePath, :datePost, :nomUser, :canal)");
            $stmt->bindParam("titre", $titre);
            $stmt->bindParam("description", $description);
            $stmt->bindParam("imagePath", $imgPath);
            $stmt->bindParam("datePost", $datePost);
            $stmt->bindParam("nomUser", $nomUser);
            $stmt->bindParam("canal", $canal);
            $stmt->execute();

            return true;
        }

        function takePost($canal){
            $stmt = $this->dbh->prepare("SELECT * FROM `post` WHERE `nomCanal` = :canal");
            $stmt->bindParam("canal", $canal);
            $stmt->execute();

            $posts = [];

            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $posts;
        }

        function takeMyPost($user){
            $stmt = $this->dbh->prepare("SELECT * FROM `post` WHERE `nomUser` = :user");
            $stmt->bindParam("user", $user);
            $stmt->execute();

            $posts = [];

            $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $posts;
        }

        function checkCanal($nomCanal){
            $stmt = $this->dbh->prepare("SELECT * FROM `canal` WHERE `nomCanal` = :nomCanal");
            $stmt->bindParam("nomCanal", $nomCanal);
            $stmt->execute();

            if($stmt->rowCount() !== 0){
                return false;
            }
            else {
                $this->createCanal($nomCanal);
            }
        }

        function createCanal($nomCanal){
            $stmt = $this->dbh->prepare("INSERT INTO `canal` (`nomCanal`) VALUES (:nomCanal)");
            $stmt->bindParam(":nomCanal", $nomCanal);
            $stmt->execute();

            $this->peupleAppartientAdmin($nomCanal);
        }

        function peupleAppartientAdmin($nomCanal) {
            $nomUser = $_SESSION['user'];
            $stmt = $this->dbh->prepare("INSERT INTO `appartient` (`nomUser`, `nomCanal`, `isAdmin`) VALUES (:nomUser, :nomCanal, 1)");
            $stmt->bindParam(":nomUser", $nomUser);
            $stmt->bindParam(":nomCanal", $nomCanal);
            $stmt->execute();
        }

        function verfiySubscription($sub){
            $nomUser = $_SESSION['nomUser'];
            $stmt = $this->dbh->prepare("SELECT * FROM `appartient` WHERE `nomUser` = :nomUser AND `nomCanal` = :sub");
            $stmt->bindParam("nomUser", $nomUser);
            $stmt->bindParam("sub", $sub);
            $stmt->execute();

            if ($stmt->rowCount() == 1){
                return false;
            }
            else {
                return true;
            }
        }

        function makeSubscription($sub){
            $nomUser = $_SESSION['nomUser'];
            $stmt = $this->dbh->prepare("INSERT INTO `appartient` (`nomUser`, `nomCanal`, `isAdmin`) VALUES (:nomUser, :sub, 0)");
            $stmt->bindParam("nomUser", $nomUser);
            $stmt->bindParam("sub", $sub);
            $stmt->execute();

            return true;
        }

        function makeUnsubscription($sub){
            $nomUser = $_SESSION['nomUser'];
            $stmt = $this->dbh->prepare("DELETE FROM `appartient` WHERE `nomUser` = :nomUser AND `nomCanal` = :sub");
            $stmt->bindParam("nomUser", $nomUser);
            $stmt->bindParam("sub", $sub);
            $stmt->execute();
        }

        function takeFirstCanal() {
            $nomUser = $_SESSION['nomUser'];
            $stmt = $this->dbh->prepare("SELECT `nomCanal` FROM `appartient` WHERE `nomUser` = :nomUser LIMIT 1");
            $stmt->bindParam("nomUser", $nomUser);
            $stmt->execute();

            $firstCanal = $stmt->fetch(PDO::FETCH_ASSOC)['nomCanal'];

            return $firstCanal;
        }

        function addInfosUser($nom, $prenom, $pays, $age, $description){
            $nomUser = $_SESSION['nomUser'];
            $stmt = $this->dbh->prepare("UPDATE `utilisateur` SET `Nom` = :nom, `Prenom` = :prenom, `Pays` = :pays, `Age` = :age, `Description` = :description WHERE `nomUser` = :nomUser");
            $stmt->bindParam(":nom", $nom);
            $stmt->bindParam(":prenom", $prenom);
            $stmt->bindParam(":pays", $pays);
            $stmt->bindParam(":age", $age);
            $stmt->bindParam(":description", $description);
            $stmt->bindParam(":nomUser", $nomUser);
            $stmt->execute();

            return true;
        }

        function takeInfosUser(){
            $nomUser = $_SESSION['nomUser'];
            $stmt = $this->dbh->prepare("SELECT `nom`, `prenom`, `pays`, `age`, `description` FROM `utilisateur` WHERE `nomUser` = :nomUser");
            $stmt->bindParam("nomUser", $nomUser);
            $stmt->execute();

            $infoUser = $stmt->fetch(PDO::FETCH_ASSOC);

            return $infoUser;
        }
    }
?>