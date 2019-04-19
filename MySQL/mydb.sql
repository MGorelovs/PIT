DROP DATABASE IF EXISTS mydb;
CREATE DATABASE mydb;
USE mydb;

CREATE TABLE `tabula`
(
  `id`              int(6) UNSIGNED NOT NULL,
  `name`            varchar(30)     NOT NULL,
  `expiration_date` datetime        NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

CREATE TABLE `users`
(
  `id`       int(11)     NOT NULL,
  `fn`       varchar(32) NOT NULL,
  `ln`       varchar(32) NOT NULL,
  `email`    varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `userType` tinyint(1)  NOT NULL
) ENGINE = InnoDB
  DEFAULT CHARSET = latin1;

ALTER TABLE `tabula`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_uindex` (`email`);

ALTER TABLE `tabula`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 6;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 5;
COMMIT;

#PIT DB:

CREATE TABLE sacensibu_grupas
(
  grID          int unsigned unique not null primary key auto_increment,
  grVecumaGrupa varchar(50),
  grKlase       varchar(10)
);

CREATE TABLE sacensibas
(
  sacID        int unsigned unique not null primary key auto_increment,
  sacNosaukums varchar(50),
  sacDatums    date,
  sacVieta     varchar(50),
  fk_grID      int unsigned,
  FOREIGN KEY (fk_grID) REFERENCES sacensibu_grupas (grID)
);
CREATE TABLE dejotaji
(
  dejotID              int unsigned unique not null primary key auto_increment,
  dejotDzimsanasDatums date,
  dejotVardsUzvards    varchar(200),
  dejotDzimums         varchar(1),
  dejotVecumaGrupa     varchar(50),
  dejotKlase           varchar(10)
);

CREATE TABLE deju_pari
(
  dejparID                 int unsigned unique not null primary key auto_increment,
  dejparPartneraID         int unsigned,
  dejparPartneresID        int unsigned,
  dejparDibinasanasDatums  date,
  dejparLikvidacijasDatums date
);

CREATE TABLE pieteikumi
(
  pietID      int unsigned unique not null primary key auto_increment,
  pietKlase   varchar(10),
  fk_sacID    int unsigned,
  fk_dejparID int unsigned,
  fk_grID     int unsigned,
  parbaudits  boolean,
  FOREIGN KEY (fk_sacID) REFERENCES sacensibas (sacID) ON DELETE CASCADE,
  FOREIGN KEY (fk_dejparID) REFERENCES deju_pari (dejparID) ON DELETE CASCADE,
  FOREIGN KEY (fk_grID) REFERENCES sacensibu_grupas (grID) ON DELETE CASCADE
);

CREATE TABLE registretie_pari
(
  regID     int unsigned unique not null primary key auto_increment,
  fk_pietID int unsigned unique not null,
  FOREIGN KEY (fk_pietID) REFERENCES pieteikumi (pietID)
);

CREATE TABLE deju_gajieni
(
  dejgajID        int unsigned unique not null primary key auto_increment,
  fk_regID        int unsigned,
  dejgajKarte     varchar(10),
  dejgajLaiks     date,
  dejgajNosaukums varchar(30),
  dejgajNumurs    int,
  FOREIGN KEY (fk_regID) REFERENCES registretie_pari (regID)
);

CREATE TABLE darbinieki
(
  darbID             int unsigned unique not null primary key auto_increment,
  darbLietotajaVards varchar(50),
  darbParole         varchar(50)
);

CREATE TABLE sacensibu_rezultati
(
  rezID    int unsigned unique not null primary key auto_increment,
  vieta    int unsigned,
  fk_regID int unsigned,
  FOREIGN KEY (fk_regID) REFERENCES registretie_pari (regID)
);

