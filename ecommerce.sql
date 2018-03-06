-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Mar 05, 2018 alle 08:37
-- Versione del server: 10.1.13-MariaDB
-- Versione PHP: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `id_ordine` int(11) NOT NULL,
  `codice_prodotto` varchar(15) NOT NULL,
  `data_ordine` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quantita` int(11) NOT NULL,
  `mail` varchar(60) NOT NULL,
  `data_spedizione` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`id_ordine`, `codice_prodotto`, `data_ordine`, `quantita`, `mail`, `data_spedizione`) VALUES
(32, '3', '2018-02-27 19:08:01', 1, 'gabbodb@gmail.com', '2018-02-27'),
(33, '22', '2018-02-27 19:08:43', 5, 'gabbodb@gmail.com', NULL),
(34, '3', '2018-02-27 19:09:12', 1, 'mail@mail.it', '2018-02-27'),
(35, '3', '2018-02-27 19:17:57', 8, 'gabbodb@gmail.com', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `prodotti`
--

CREATE TABLE `prodotti` (
  `codice_prodotto` int(15) NOT NULL,
  `nome_prodotto` varchar(50) NOT NULL,
  `prezzo` double NOT NULL,
  `quantita` int(11) NOT NULL,
  `immagine` varchar(50) NOT NULL,
  `descrizione` longtext NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `prodotti`
--

INSERT INTO `prodotti` (`codice_prodotto`, `nome_prodotto`, `prezzo`, `quantita`, `immagine`, `descrizione`, `categoria`) VALUES
(3, 'Split (DVD)', 17.8, 503, 'img/91yGG3JNw1L._SL1500_.jpg', 'Anche se Kevin (James McAvoy) ha mostrato ben 23 personalitÃ  alla sua psichiatra di fiducia, la dottoressa Fletcher (Betty Buckley), ne rimane ancora una nascosta, in attesa di materializzarsi e dominare tutte le altre. Dopo aver rapito tre ragazze adolescenti guidate da Casey (Anya Taylor-Joy, The Witch), ragazza molto attenta ed ostinata, nasce una guerra per la sopravvivenza, sia nella mente di Kevin â€“ tra tutte le personalitÃ  che convivono in lui â€“ che intorno a lui, mentre le barriere delle le sue varie personalitÃ  cominciano ad andare in frantumi.', 'DVD'),
(21, 'PROEL RSM180 asta giraffa microfono', 19, 20, 'img/rsm180.jpg', 'Asta a giraffa per microfono, con basetripoide in nylon. BASE TRIPOIDE - La nuova base in nylon Ã¨ ripiegabile per facilitare il trasporto. PIEDINI ANTISCIVOLO - Nuovo design del piedino in gomma naturale antiscivolo. REGOLAZIONE ALTEZZA - Nuova impugnatura in nylon per la regolazione dell''altezza. NUOVO SNODO - Lo nuovo snodo in nylon permette sempre una regolazione perfetta. GIRAFFA TELESCOPICA - Il nuovo giunto telescopico in nylon assicura la perfetta regolazione dell''estensione del tubo. Il modello RSM180 ha la filettatura grande per la pinza reggimicrofono (non inclusa - da acquistare a parte). Dimensione base: Ã˜ 680 mm Altezza minima:900 mm Altezza massima:1500 mm Peso: 2,2 kg Colori disponibili: Nero opaco - RSM180 / Cromato - RSM170 Lunghezza giraffa: 750 mm', 'Microfono'),
(22, 'AKG K52 Black Circumaural headphone', 32, 30, 'img/AKG K52.jpg', '3.5 mm connector: Y Audio adapters included: 6.3 mm Cable length: 2.5 m Colour of product: Black Connectivity technology: Wired Detachable cable: N Ear coupling: Circumaural Headphone frequency: 18 - 20000 Hz Headphone sensitivity: 110 dB Impedance: 32 Î© Master carton length: 47.3 cm Master carton weight: 6.33 kg Material: Leatherette, Metal Maximum input power: 200 mW Package depth: 110 mm Package height: 235 mm Package weight: 0.522 kg Package width: 220 mm Quantity: 1 Weight: 200 g', 'Cuffie'),
(23, 'A4 Tracing Light Box', 22.5, 60, 'img/A4 Tracing Light Box.jpg', '- Ãˆ super sottile in modo da poterlo portare ovunque con te, a differenza di un tradizionale tampone luminoso. - Questo tappetino luminoso Ã¨ un elegante tappetino luminoso, la luce dal tappetino attraverso la carta chiaramente illumina le immagini, che rendono le tracce delle immagini diventano facili. - Dimmable, luminositÃ  regolabile, cambia l''Illuminazione secondo le vostre esigenze. - Touch Switch Design --- Ã¨ sufficiente toccare il tappetino per accendere / spegnere il tappetino luminoso. - LuminositÃ  regolabile --- semplicemente tenere premuto il tastatore per diversi secondi fino a ottenere la luminositÃ  desiderata che si desidera. - Funzione memoria - memoria intelligente la luminositÃ  dell''ultimo utilizzo. - Alimentazione tramite cavo USB che significa facile accesso a qualsiasi porta USB come computer, adattatore USB o anche banca di potenza.', 'Disegno'),
(24, 'Penne da Disegno', 13.99, 201, 'img/Penne.jpg', 'Set di 10 pezzi di penne da disegno', 'Disegno'),
(25, 'Amplificatore per microfono', 19.9, 30, 'img/Amplificatore.jpg', 'E'' davvero un prodotto perfetto per teatro, palcoscenico, bar, studio,concerti, live ecc.  Resistente e stabile. Piccolo e leggero e non occupa troppo spazio, aspetto liscio, linee lisce. Molto conveniente da portare.  Dispone di un singolo canale con uscite ed ingressi di tipo bilanciati.PuÃ² essere usato per collegare a un microfono e un mixer.  Ha allegato molti tag necessari di utilizzo. Ad esempio: Output,input,interruttore, LED indicatore,adattatore e cosi via. Si puÃ² operare con il interruttore facile e LED indicatore.  Perfetto per gli studio musicale,scena,studio di registrazione e qualsiasi microfono.  Il pacchetto include 1x 48v phantom alimentazione. 1x Adattatore. 1x Cavo XLR Audio e non include il microfono e scheda audio.', 'Audio');

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `nome` varchar(40) NOT NULL,
  `cognome` varchar(40) NOT NULL,
  `indirizzo` varchar(40) DEFAULT NULL,
  `mail` varchar(60) NOT NULL,
  `passw` varchar(32) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `is_magazine` int(11) NOT NULL DEFAULT '0',
  `is_sped` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`nome`, `cognome`, `indirizzo`, `mail`, `passw`, `is_admin`, `is_magazine`, `is_sped`) VALUES
('gabriele', 'del barba', 'via pratolungo 98', 'gabbodb@gmail.com', 'ciao', 1, 1, 1),
('wawa', 'blbl', 'dvcsv', 'mail@mail.it', 'ciao', 0, 0, 0);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`id_ordine`);

--
-- Indici per le tabelle `prodotti`
--
ALTER TABLE `prodotti`
  ADD PRIMARY KEY (`codice_prodotto`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`mail`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `id_ordine` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT per la tabella `prodotti`
--
ALTER TABLE `prodotti`
  MODIFY `codice_prodotto` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
