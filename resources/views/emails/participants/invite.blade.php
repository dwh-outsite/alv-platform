@component('mail::message')
Beste {{ $participant->name }},

Bedankt voor het aangeven van interesse in het bijwonen van onze ALV.
In deze mail vind je de code waarmee je in kunt loggen op [alv.dwhdelft.nl](https://alv.dwhdelft.nl).
Via dit platform is het mogelijk om te stemmen over de voorstellen, (tekstuele) vragen te stellen tijdens de vergadering, de vergaderstukken in te zien en om naar de livestream te kijken.

De stemmingen zijn zoals gewoonlijk anoniem.
Om te voorkomen dat je meerdere keren kunt stemmen, slaan we wel op dát je gestemd hebt, maar niet wát je gestemd hebt.
Het ALV platform is [open source](https://github.com/dwh-outsite/alv-platform) en daardoor is het mogelijk te controleren dat dit inderdaad het geval is.
Meer informatie over de stemprocedure zullen we geven tijdens de vergadering.


Hieronder staat je unieke code om de ALV bij te wonen.
Het is niet toegestaan deze code door te geven.
Je kunt met deze code nu al inloggen op het [ALV platform](https://alv.dwhdelft.nl) om te kijken hoe dit bij de aankomende ALV zal werken.

@component('mail::panel')
## Unieke inlogcode
```
{{ $participant->code }}
```
@endcomponent

Heb je vragen omtrent het platform, de procedures of de ALV in het algemeen? Stuur dan een mailtje naar bestuur@dwhdelft.nl.

Tot de ALV!

DWH Bestuur
@endcomponent
