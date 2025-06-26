CREATE Table UTENTI(
    Id INTEGER PRIMARY KEY AUTO_INCREMENT,
    Nome VARCHAR(20),
    Cognome VARCHAR(20),
    Username VARCHAR(20),
    Password VARCHAR(30),
    Livello BOOLEAN default 0,
    N_post INTEGER DEFAULT 0 
) ENGINE = InnoDB;


CREATE Table SONDAGGI(
    Id INTEGER PRIMARY KEY AUTO_INCREMENT,
    Descrizione VARCHAR(255),
    Orario VARCHAR(10),
    Luogo VARCHAR(20),
    Data_evento date,
    Categoria VARCHAR(20),
    N_Votanti INTEGER DEFAULT 0,
    N_like INTEGER DEFAULT 0,
    N_commenti INTEGER DEFAULT 0,   
    Stato BOOLEAN,
    Utente INTEGER,    
    INDEX xutente(Utente),
    FOREIGN KEY (Utente) REFERENCES UTENTI(Id)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE = InnoDB;

CREATE Table LIKES(
    Utente INTEGER,
    Sondaggio INTEGER,
    INDEX xu(Utente),
    index xs(Sondaggio),
    foreign key(Utente) references UTENTI(id) on delete cascade on update cascade,
    foreign key(Sondaggio) references SONDAGGI(id) on delete cascade on update cascade,
    primary key(Utente, Sondaggio)
) Engine = InnoDB;

CREATE Table OPZIONI(
    Id integer primary key auto_increment,
    Sondaggio INTEGER,
    Opzione VARCHAR(20),
    INDEX xs(Sondaggio),
    FOREIGN KEY(Sondaggio) REFERENCES SONDAGGI(id)
) ENGINE = InnoDB;


CREATE Table PARTECIPANTI(
    Id integer primary key auto_increment,
    Utente INTEGER,
    Voto INTEGER,
    INDEX xu(Utente),
    index xo(Voto),
    FOREIGN key(Voto) REFERENCES OPZIONI(Id) on delete cascade on update cascade,
    foreign key(Utente) references UTENTI(Id) on delete cascade on update cascade
) Engine = InnoDB;


CREATE TABLE COMMENTI (
    Id integer primary key auto_increment,
    Utente integer,
    Sondaggio integer,
    Testo varchar(255),
    index xu(Utente),
    index xs(Sondaggio),
    foreign key(Utente) references UTENTI(id) on delete cascade on update cascade,
    foreign key(Sondaggio) references SONDAGGI(id) on delete cascade on update cascade
) Engine = InnoDB;


INSERT INTO UTENTI VALUES(1, 'matteo', 'c', 'mat', '123@m', 1, 0);
INSERT INTO UTENTI VALUES(2, 'matteo', 'c', 'mat', "", 0, NULL);
INSERT INTO UTENTI VALUES(3, 'vale', 'c', 'vale', '123@v', 1, NULL);
INSERT INTO UTENTI VALUES(4, 'davide', NULL, 'davide', NULL, 0, NULL);
INSERT INTO UTENTI VALUES(5, 'mari', 's', 'mari', '123@m', 1, NULL);
INSERT INTO UTENTI VALUES(6, 'fra', NULL, 'fra', NULL, 0, NULL);

INSERT INTO SONDAGGI VALUES(1, 'Partita', '10:00', 'CT', current_date(), 'SPORT', NULL, NULL, NULL, 0, 3);
INSERT INTO SONDAGGI VALUES(2, 'Norma', '20:00', 'Acireale', '2022-05-22', 'SPETTACOLO', NULL, NULL, NULL, 0, 3);

INSERT INTO OPZIONI VALUES(1, 1, 'Ci sono');
INSERT INTO OPZIONI VALUES(2, 1, 'Non ci sono');
INSERT INTO OPZIONI VALUES(3, 2, 'Ci sono');
INSERT INTO OPZIONI VALUES(4, 2, 'Sì');
INSERT INTO OPZIONI VALUES(5,2, 'No');

INSERT INTO partecipanti VALUES(1, 2, 1);  /* il Sondaggio 1 non ha l'opzione Sì! Gestisco questo problema con i RadioButton in JS */
INSERT INTO partecipanti VALUES(2,1, 2);
INSERT INTO partecipanti VALUES(3,3, 1);
INSERT INTO partecipanti VALUES(4, 6, 5);
INSERT INTO partecipanti VALUES(5,2, 4);
INSERT INTO partecipanti VALUES(6,3, 3);


SELECT  * FROM utenti;
SELECT * FROM sondaggi;
SELECT * FROM partecipanti;
SELECT * FROM opzioni;
SELECT Username, Password
FROM utenti WHERE Username = "matteo" AND Password = "123@m";


/* VOTANTI per un dato SONDAGGIO */
SELECT p.Voto, s.Descrizione, u.username as nome_votante, o.Opzione
FROM partecipanti as p JOIN utenti as u ON p.utente = u.Id JOIN sondaggi as s ON o.Sondaggio = s.Id JOIN opzioni as o ON p.Voto = o.Id
WHERE o.Sondaggio = 1;

INSERT INTO opzioni(Sondaggio, Opzione) VALUES("2", "opzione");



DELIMITER //
CREATE TRIGGER commenti_trigger
AFTER INSERT ON commenti
FOR EACH ROW
BEGIN
UPDATE sondaggi 
SET N_commenti = N_commenti + 1
WHERE id = new.Sondaggio;
END //
DELIMITER ;



DELIMITER //
CREATE TRIGGER partecipanti_trigger
AFTER INSERT ON partecipanti
FOR EACH ROW
BEGIN
UPDATE sondaggi 
SET N_Votanti = N_Votanti + 1
WHERE id in (SELECT sondaggio FROM partecipanti JOIN opzioni ON voto = opzioni.id WHERE voto = new.voto); 
END //
DELIMITER ;




