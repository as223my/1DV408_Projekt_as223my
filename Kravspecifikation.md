#FamilyBook – Kravspecifikation 

Jag har tänkt att göra en applikation som heter FamilyBook, i detta projekt.

I min applikation vill jag ha ett flöde som liknar facebook, där man kan skapa och ta bort inlägg.
Flödet visas bara för personer som är inloggade i den skapade gruppen, därav blir applikationen mer privat än facebook.
Det ska också gå att lägga till viktiga händelser (sticky notes) som visas automatiskt inom en bestämd tid. 
När man är inloggad har man i sin profil möjlighet att skapa och ta bort grupper med medlemmar som finns registrerade. 


##AF1 - Logga in 
###Huvud scenario
1. Användaren vill logga in i applikationen.
2. Systemet frågar efter användarnamn och lösenord.
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
1. Användaren vill registrera en ny användare. 
2. Systemet frågar efter tänkt användarnamn och lösenord.
3. Användaren ger systemet ett användarnamn och lösenord.
4. Systemet skapar en ny användare.

###Alternativt scenario
3a. Användaren har valt ett användarnamn som redan finns i systemet.
  1. Systemet presenterar ett felmeddelande.
  2. Användaren väljer därefter ett nytt användarnamn.
  3. Steg 4 i huvudscenario. 
  
##AF4 - Skapa Gruppp
###Förhandsvillkor
1. Användaren är inloggad, se AF1.

###Huvudscenario
1. Användaren vill skapa en ny grupp.  
2. Systemet frågar efter gruppnamn och antal användare. 
3. Användaren ger systemet ett gruppnamn och ett antal användare.
4. Systemet frågar därefter efter användarnas namn som man vill lägg till i gruppen.
5. Användaren ger systemet användarnamn. 
6. Systemet skapar en grupp med de användare man valt. 

###Alternativt scenario1
3a. Användaren har valt ett gruppnamn som redan finns hos användaren. 
  1. Systemet presenterar ett felmeddelande.
  2. Användaren väljer därefter ett nytt gruppnamn.
  3. Steg 4 i huvudscenario. 
  
###Alternativt scenario2
5a. Användaren har valt ett användarnamn som inte finns registrerat. 
  1. Systemet presenterar ett felmeddelande.
  2. Användaren väljer därefter ett nytt användarnamn.
  3. Steg 6 i huvudscenario. 
  
##AF5 - Ta bort Grupp
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Användaren har skapat en grupp, se AF4.

###Huvudscenario
1. Användaren vill ta bort en grupp.  
2. Systemet frågar efter gruppnamn. 
3. Användaren ger systemet ett gruppnamn.
4. Systemet tar bort gruppen från användaren.

###Alternativt scenario
3a. Användaren har valt ett gruppnamn som inte finns hos användaren. 
  1. Systemet presenterar ett felmeddelande.
  2. Användaren väljer därefter ett nytt gruppnamn.
  3. Steg 4 i huvudscenario. 
  
##AF6 - Välj grupp.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Användaren har skapat en grupp, se AF4.

###Huvudscenario
1. Användaren vill skapa ett inlägg i vald grupp.
2. Systemet ber om innehåll till inlägget.
3. Användaren ger systemet innehåll.
4. Systemet skapar ett inlägg i flödet. 

##AF7 - Skapa inlägg.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Användaren har skapat en grupp, se AF4.
3. Användaren har valt en grupp, se AF6.

###Huvudscenario
1. Användaren vill skapa ett inlägg i vald grupp.
2. Systemet ber om innehåll till inlägget.
3. Användaren ger systemet innehåll.
4. Systemet skapar ett inlägg i flödet. 

##AF8 - Ta bort inlägg.
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Användaren har skapat ett inlägg, se AF6.
3. Användaren har valt en grupp, se AF6.

###Huvudscenario
1. Användaren vill ta bort skapat inlägg.
2. Systemet presenterar en ta bort knapp. 
3. Användaren väljer ta bort.
4. Systemet raderar inlägget från flödet.

 
##AF9 - Skapa viktig händelse (sticky note).
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
2. Användaren har skapat en grupp, se AF4.
3. Användaren har valt en grupp, se AF6.

###Huvudscenario
1. Användaren vill skapa en viktig händelse som alla kan se. 
2. Systemet ber om innehåll till händelse.
3. Användaren ger systemet innehåll.
4. Systemet frågar användaren hur länge denna vill att händelsen ska visas.
5. Användaren ger systemet tid i antal dagar.
6. Systemet skapar en viktig händelse.

##AF10 - Ta bort viktig händelse (sticky note). 
###Förhandsvillkor
1. Användaren är inloggad, se AF1.
3. Användaren har valt en grupp, se AF6.
2. Användaren har skapat en viktig händelse, se AF9.

###Huvudscenario
1. Användaren vill ta bort en viktig händelse, innan tiden gått ut.
2. Systemet presenterar en X (ta bort) knapp. 
3. Användaren väljer X (ta bort).
4. Systemet tar bort den viktiga händelsen från alla användare.





