#FamilyBook – Kravspecifikation 

Jag har tänkt att göra en applikation som heter FamilyBook, i detta projekt.

I min applikation vill jag ha ett flöde som liknar facebook, där man kan skapa och ta bort inlägg.
I sin profil har man namn, en bild och en valfri kort text. 
Flödet visas bara för personer som är inloggade i den skapade gruppen, därav blir applikationen mer privat än facebook.
Det ska också gå att lägga till viktiga händelser som visas automatiskt inom en bestämd tid. 

##AF1 - Logga in 
###Huvud scenario
1. Användaren vill logga in i applikationen.
2. Systemet frågar efter användarnamn, lösenord och gruppnamn.
3. Användaren ger systemet dessa uppgifter.
4. Användare loggas in i applikationen.

###Alternativt scenario
4a. Användaren kunde inte loggas in i systemet pågrund av felaktigt lämnade uppgifter.
  1. Systemet ger användaren ett felmedelande.
  2. Steg 2 i huvudscenario. 
  
##AF2 - Logga ut
###Förhandsvillkor
1. Användaren är inloggad, se AF1.

###Huvudscenario
1. Änvändaren vill logga ut från applikationen. 
2. Systemet presenterar en logga ut knapp.
3. Användaren väljer logga ut. 
4. Systemet loggar ut användaren från applikationen.

##AF3 - Registrera Användare
###Huvudscenario
1. Användaren vill starta en ny grupp. 
2. Systemet frågar efter tänkt gruppnamn.
3. Användaren ger systemet ett gruppnamn.
4. Systemet skapar en ny grupp och frågar användaren om antal användare samt användarnamn och lösenord för dessa.
5. Användaren ger systemet användaruppgifterna. 
6. Systemet skapar användarprofiler till gruppen.

###Alternativt scenario
4a. Användaren har valt ett gruppnamn som redan finns i systemet.
  1. Systemet presenterar ett felmeddelande.
  2. Användaren väljer därefter ett nytt gruppnamn.
  3. Steg 4 i huvudscenario. 
  

##AF4 - Skapa inlägg.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.

###Huvudscenario
1. Användaren vill skapa ett inlägg.
2. Systemet ber om innehåll till inlägget.
3. Användaren ger systemet innehåll.
4. Systemet skapar ett inlägg i flödet. 

##AF5 - Ta bort inlägg.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Användaren har skapat ett inlägg, se AF6.

###Huvudscenario
1. Användaren vill ta bort skapat inlägg.
2. Systemet frågar användaren om denna är helt säker.
3. Användaren vill fortfarande ta bort inlägget.
4. Systemet raderar inlägget från flödet.

###Alternativt scenario
3a Användaren vill inte ta bort inlägget
  1. Systemet tar inte bort inlägget från flödet.
 
##AF6 - Skapa viktig händelse.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.

###Huvudscenario
1. Användaren vill skapa en viktig händelse som alla kan se. 
2. Systemet ber om innehåll till händelse.
3. Användaren ger systemet innehåll.
4. Systemet frågar användaren hur länge denna vill att händelsen ska visas.
5. Användaren ger systemet tid i antal dagar.
6. Systemet skapar en viktig händelse.

##AF7 - Ta bort viktig händelse.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. En viktig händelse finns.

###Huvudscenario
1. Användaren vill ta bort en viktig händelse, innan tiden gått ut.
2. Systemet frågar användaren om denna är säker.
3. Användaren är säker.
4. Systemet tar bort den viktiga händelsen.

###Alternativt scenario
3a Användaren vill inte ta bort den viktiga händelsen.
  1. Systemet tar inte bort händelsen.
 
##AF8 - Ändra profilbild.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.

###Huvudscenario
1. Användaren vill ändra sin profilbild.
2. Systemet frågar efter ny bild.
3. Användaren ger systemet ny bild.
4. Systemet ändrar profilbilden. 

###Alternativt scenario
3a. Användaren ger systemet en bildfil som inte är korrekt.
  1. Systemet presenterar ett felmeddelande.
  2. Steg 2 i huvudscenario. 
  
##AF9 - Ändra profiltext.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.

###Huvudscenario
1. Användaren vill ändra i sin profiltext.
2. Systemet ber om ny text.
3. Användare ger systemet ny text.
4. Systemet ändrar i profiltexten.

**-------------------- Användingsfall för senare utveckling --------------------------**

##AF10 - Ändra inlägg.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Användaren har skapat ett inlägg, se AF6.

###Huvudscenario
1. Användaren vill ändra i skapat inlägg.
2. Systemet ber användaren om ändringar.
3. Användaren ändrar i inlägget.
4. Systemet spara det ändrade inlägget.

##AF11 - Kommentera inlägg.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Inlägg finns skapade i flödet.

###Huvudscenario
1. Användaren vill kommentera ett inlägg i flödet.
2. Systemet ber om innehåll i kommentaren.
3. Användaren ger systemet innehåll till kommentaren.
4. Systemet skapar en kommentar till inlägget. 

##AF12 - Ta bort kommentar.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Användaren har kommenterat ett inlägg i flödet.

###Huvudscenario
1. Användaren vill ta bort en skapad kommentar.
2. Systemet tar bort kommentaren.

##AF13 - Ändra personer i gruppen.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Användaren har rättigheter att ändra personer i gruppen.

###Huvudscenario
1. Användaren vill ändra antal personer i gruppen.
2. Systemet frågar efter ändringar.
3. Användaren ger systemet ändringarna.
4. Systemet tar bort eller lägger till personer. 


