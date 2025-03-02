--Creation de la BDD gestion_message

CREATE DATABASE Gestion_Messagerie;

-- CREATION DE LA TABLE UTILISATEUR
USE Gestion_Messagerie;
CREATE TABLE Utilisateur(
    ID_utilisateur INT PRIMARY KEY IDENTITY(1,1),
    Nom_utilisateur VARCHAR(50),
    Prenom_utilisateur VARCHAR(50),
	Date_inscription DATE DEFAULT GETDATE(),
    Email_utilisateur VARCHAR(60),
    MDP_utilisateur VARCHAR(300),
    Role_utilisateur VARCHAR(25) DEFAULT 'Client' CHECK(Role_utilisateur IN('Client', 'Administrateur')),
    Statut_utilisateur VARCHAR(25) DEFAULT 'Actif' CHECK(Statut_utilisateur IN('Actif', 'Inactif'))
);


--fonction pour ajouter un utilisateur a l'application
CREATE PROCEDURE AjouterUtilisateur
    @Nom_utilisateur VARCHAR(50),
    @Prenom_utilisateur VARCHAR(50),
    @Email_utilisateur VARCHAR(60),
    @MDP_utilisateur VARCHAR(300)
AS
BEGIN
    INSERT INTO Utilisateur (Nom_utilisateur, Prenom_utilisateur, Email_utilisateur, MDP_utilisateur)
    VALUES (@Nom_utilisateur, @Prenom_utilisateur, @Email_utilisateur, @MDP_utilisateur);
END;


--trigger qui verifis si l'utilisateur existe
CREATE TRIGGER VerifierUtilisateurExistant
ON Utilisateur
INSTEAD OF INSERT
AS
BEGIN
    IF EXISTS (
        SELECT 1
        FROM inserted i
        INNER JOIN Utilisateur u ON i.Email_utilisateur = u.Email_utilisateur
    )
    BEGIN
        RAISERROR('Un utilisateur avec cet email existe déjà.', 16, 1);
        ROLLBACK TRANSACTION;
    END
    ELSE
    BEGIN
        INSERT INTO Utilisateur (Nom_utilisateur, Prenom_utilisateur, Email_utilisateur, MDP_utilisateur)
        SELECT i.Nom_utilisateur, i.Prenom_utilisateur, i.Email_utilisateur, i.MDP_utilisateur
        FROM inserted i;
    END
END;

--recupere les infos des users s'il existe
CREATE FUNCTION ObtenirInformationsUtilisateur
(
    @Email_utilisateur VARCHAR(60)
)
RETURNS TABLE
AS
RETURN
(
    SELECT ID_utilisateur, Nom_utilisateur, Prenom_utilisateur, MDP_utilisateur
    FROM Utilisateur
    WHERE Email_utilisateur = @Email_utilisateur
);


