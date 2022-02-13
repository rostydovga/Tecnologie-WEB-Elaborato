create database CDDB;
use CDDB;

create table UTENTI (
     IdUtente int primary key auto_increment,
     Nome varchar(20) not null,
     Cognome varchar(25) not null,
     Email varchar(30) not null,
     Pwd varchar(30) not null,
     Venditore boolean);

create table CARRELLI (
     IdCliente int,
     NumeroOrdine int,
     ImportoTotale decimal(7,2) default 0.00,
     DataOrdine date,
     primary key (IdCliente, NumeroOrdine),
     foreign key (IdCliente) references UTENTI (IdUtente)
          on delete cascade
          on update no action);

create table CATEGORIE (
     IdCategoria int primary key auto_increment,
     Nome varchar(15) not null);

create table PRODOTTI (
     IdProdotto int primary key auto_increment,
     Nome varchar(30) not null,
     Ml int,
     Prezzo decimal(5,2) not null,
     Descrizione nvarchar(1800) not null,
     Quantita int not null,
     Sesso varchar(7) not null,
     Immagine varchar(255) not null,
     DataInserimento date not null,
     KCategoria int not null,
     foreign key (KCategoria) references CATEGORIE (IdCategoria));

create table CONTIENE_PRODOTTI (
     KProdotto int,
     KCliente int,
     KOrdine int,
     Quantita int not null,
     primary key (KProdotto, KCliente, KOrdine),
     foreign key (KProdotto) references PRODOTTI (IdProdotto),
     foreign key (KCliente, KOrdine) references CARRELLI (IdCliente, NumeroOrdine)
          on delete cascade
          on update no action);

create table NOTIFICHE (
     IdNotifica int auto_increment,
     KUtente int,
     DataOraNotifica datetime,
     DescrizioneNotifica varchar(255),
     primary key (IdNotifica,KUtente),
     foreign key (KUtente) references UTENTI(IdUtente)
          on delete cascade
          on update no action
);
