CREATE TABLE UTILISATEUR(
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50),
    mdp VARCHAR(50)
);

CREATE TABLE PRODUIT(
    id INT AUTO_INCREMENT PRIMARY KEY,
    genre VARCHAR(50),
    libelle VARCHAR(50),
    artiste VARCHAR(50),
    prix DECIMAL(5,2),
    chemin VARCHAR(100)
);

INSERT INTO UTILISATEUR VALUES('alex@mail.fr','alex');
INSERT INTO UTILISATEUR VALUES('grig@mail.fr','grig');

INSERT INTO PRODUIT VALUES('Rock', 'Back in Black', 'AC/DC', 14.99, 'back_in_black.png');
INSERT INTO PRODUIT VALUES('Pop', 'Thriller', 'Michael Jackson', 12.99, 'thriller.png', );
INSERT INTO PRODUIT VALUES('Hip Hop', 'The Marshall Mathers LP', 'Eminem', 16.99, 'marshall_mathers_lp.png', );
INSERT INTO PRODUIT VALUES('Classical', 'Moonlight Sonata', 'Ludwig van Beethoven', 10.99, 'moonlight_sonata.png', );
INSERT INTO PRODUIT VALUES('Jazz', 'Kind of Blue', 'Miles Davis', 18.99, 'kind_of_blue.png', );
INSERT INTO PRODUIT VALUES('Country', 'Fearless', 'Taylor Swift', 13.99, 'fearless.png', );
INSERT INTO PRODUIT VALUES('Electronic', 'Random Access Memories', 'Daft Punk', 15.99, 'random_access_memories.png', );
INSERT INTO PRODUIT VALUES('Reggae', 'Legend', 'Bob Marley', 11.99, 'legend.png', );
INSERT INTO PRODUIT VALUES('Blues', 'The Best of Muddy Waters', 'Muddy Waters', 17.99, 'muddy_waters.png', );
INSERT INTO PRODUIT VALUES('R&B', 'Back to Black', 'Amy Winehouse', 14.99, 'back_to_black.png', );