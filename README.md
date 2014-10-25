Projekt - FamilyBook
======================
## Applikationen

[FamilyBook!](http://anniesahlberg.se/familybook)

### Kravspecifikation (användningsfall)

[Till kravspecifikationen.](https://github.com/as223my/1DV408_Projekt_as223my/blob/master/Kravspecifikation.md)

### Testrapport

Testrapport med testfall finns som [realese (pdf)](https://github.com/as223my/1DV408_Projekt_as223my/releases). 

Exempel på registrerade medlemmar som går att lägga till när man skapar en ny grupp: 
* Annie
* Mia
* test (lösenord: test), om man vill testa applikationen utan att registrera sig. 

### Klassdiagram

[Bild över klassdiagram.](http://yuml.me/8979ebd2)

### Checklista för driftsättning av applikationen på nytt webbhotell

* I filhanteringen skapa en mapp som heter familybook.
* Ladda upp filerna: 
  * Settings.php
  * index.php
  * errors.log
* Och mapparna med innehåll:
  * css
  * helpers
  * src
* Importera databasen familybook.sql till webhotellets databas. 
* Ändra uppgifter för databasconnection i filen Settings.php