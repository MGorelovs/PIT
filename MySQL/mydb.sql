DROP DATABASE IF EXISTS mydb;
CREATE DATABASE mydb;
USE mydb;


# CREATE TABLE `tabula`
# (
#   `id`              int(6) UNSIGNED NOT NULL,
#   `name`            varchar(30)     NOT NULL,
#   `expiration_date` datetime        NOT NULL
# ) ENGINE = InnoDB
#   DEFAULT CHARSET = latin1;

# CREATE TABLE `users`
# (
#   `id`       int(11)     NOT NULL,
#   `fn`       varchar(32) NOT NULL,
#   `ln`       varchar(32) NOT NULL,
#   `email`    varchar(32) NOT NULL,
#   `password` varchar(32) NOT NULL,
#   `userType` tinyint(1)  NOT NULL
# ) ENGINE = InnoDB
#   DEFAULT CHARSET = latin1;

# ALTER TABLE `tabula`
#   ADD PRIMARY KEY (`id`);
#
# ALTER TABLE `users`
#   ADD PRIMARY KEY (`id`),
#   ADD UNIQUE KEY `users_email_uindex` (`email`);
#
# ALTER TABLE `tabula`
#   MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT,
#   AUTO_INCREMENT = 6;
#
# ALTER TABLE `users`
#   MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,
#   AUTO_INCREMENT = 5;
# COMMIT;

#PIT DB:

CREATE TABLE sacensibas
(
    sacID        int unsigned unique not null primary key auto_increment,
    sacNosaukums varchar(50)         not null,
    sacDatums    date                not null,
    sacVieta     varchar(50)         not null
) DEFAULT CHAR SET = 'utf8';

CREATE TABLE sacensibu_grupas
(
    grID          int unsigned unique not null primary key auto_increment,
    grVecumaGrupa varchar(50)         not null,
    grKlase       varchar(10)         not null,
    fk_sacID      int unsigned        not null,
    FOREIGN KEY (fk_sacID) REFERENCES sacensibas (sacID)
) DEFAULT CHAR SET = 'utf8';

CREATE TABLE dejotaji
(
    dejotID              int unsigned unique not null primary key auto_increment,
    dejotDzimsanasDatums date                not null,
    dejotVardsUzvards    varchar(200)        not null,
    dejotDzimums         varchar(1)          not null,
    dejotVecumaGrupa     varchar(50)         not null,
    dejotKlase           varchar(10)         not null
) DEFAULT CHAR SET = 'utf8';

CREATE TABLE deju_pari
(
    dejparID                 int unsigned unique not null primary key auto_increment,
    dejparPartneraID         int unsigned        not null,
    dejparPartneresID        int unsigned        not null,
    dejparDibinasanasDatums  date                not null,
    dejparLikvidacijasDatums date,
    FOREIGN KEY (dejparPartneraID) references dejotaji (dejotID),
    FOREIGN KEY (dejparPartneresID) references dejotaji (dejotID)
) DEFAULT CHAR SET = 'utf8';

#CREATE TABLE pieteikumi
#(
#  pietID      int unsigned unique not null primary key auto_increment,
#  pietKlase   varchar(10) not null,
#  fk_sacID    int unsigned not null,
#  fk_dejparID int unsigned not null,
#  fk_grID     int unsigned not null,
#  parbaudits  boolean,
#  FOREIGN KEY (fk_sacID) REFERENCES sacensibas (sacID) ON DELETE CASCADE,
#  FOREIGN KEY (fk_dejparID) REFERENCES deju_pari (dejparID) ON DELETE CASCADE,
#  FOREIGN KEY (fk_grID) REFERENCES sacensibu_grupas (grID) ON DELETE CASCADE
#)DEFAULT CHAR SET = 'utf8';

CREATE TABLE registretie_pari
(
  regID     int unsigned unique not null primary key auto_increment,
#  pietKlase   varchar(10) not null,
  fk_sacID    int unsigned not null,
  fk_dejparID int unsigned not null,
  fk_grID     int unsigned not null,
  FOREIGN KEY (fk_sacID) REFERENCES sacensibas (sacID) ON DELETE CASCADE,
  FOREIGN KEY (fk_dejparID) REFERENCES deju_pari (dejparID) ON DELETE CASCADE,
  FOREIGN KEY (fk_grID) REFERENCES sacensibu_grupas (grID) ON DELETE CASCADE
)DEFAULT CHAR SET = 'utf8';

CREATE TABLE deju_gajieni
(
    dejgajID        int unsigned unique not null primary key auto_increment,
    fk_regID        int unsigned        not null,
    dejgajKarte     varchar(10)         not null,
    dejgajLaiks     date                not null,
    dejgajNosaukums varchar(30)         not null,
    dejgajNumurs    int                 not null,
    FOREIGN KEY (fk_regID) REFERENCES registretie_pari (regID)
) DEFAULT CHAR SET = 'utf8';

CREATE TABLE darbinieki
(
    darbID             int unsigned unique not null primary key auto_increment,
    darbLietotajaVards varchar(50)         not null,
    darbParole         varchar(50)         not null,
    darbEpasts         varchar(50)         not null,
    attempts           int,
    blocked            boolean
) DEFAULT CHAR SET = 'utf8';

CREATE TABLE sacensibu_rezultati
(
    rezID    int unsigned unique not null primary key auto_increment,
    vieta    int unsigned        not null,
    fk_regID int unsigned        not null,
    FOREIGN KEY (fk_regID) REFERENCES registretie_pari (regID)
) DEFAULT CHAR SET = 'utf8';

#default admin
insert into darbinieki
values (null, 'admin', 'admin', 'admin@admin.com',null,false);

