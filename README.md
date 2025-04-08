# iShit

![image](https://github.com/user-attachments/assets/3f8f7f26-1a4c-4cf0-8f8d-8b8154e2cabc)

**iShit** è un social network innovativo e unico nel suo genere, dove gli utenti possono condividere una parte del loro quotidiano che di solito rimane nascosta: le feci! È una piattaforma divertente e bizzarra che permette di condividere e apprezzare le esperienze più... particolari.

## Funzionalità principali

- **Condivisione delle feci:** Ogni utente può scattare foto delle proprie feci e condividerle con la community. Le immagini possono essere caricate direttamente dal dispositivo e pubblicate nel feed. Si può impostare i suoi parametri come colore, forma, e se galleggia!
  
- **Reazioni:** Gli altri utenti possono esprimere il loro apprezzamento tramite mi piace. Puoi vedere cosa pensano gli altri utenti delle tue "creazioni"!

- **Commenti**: Commenta il risultato altrui.

-**Statistiche**: Vedi quante volte hai fatto la cacca verde.  

- **Profilo utente:** Ogni utente avrà un profilo proprio.

## Come funziona

1. **Registrazione:** Crea un account inserendo il tuo nome utente, email e una password sicura.
2. **Carica il tuo primo post:** Scatta una foto delle tue feci, carica l'immagine e aggiungi un titolo o una descrizione. Scegli un hashtag che rappresenti la tua "opera d'arte".
3. **Condividi e interagisci:** Pubblica il tuo post e inizia a interagire con gli altri utenti commentando e reagendo ai loro contenuti.
4. **Classifica**: Post con piu' mi piace.

## Requisiti

- Server con PHP 5+ e MySQL come database.

## Installazione

### Modo 1

1. Carica i file su un server web.
2. Crea il database 'ishit'.
3. Cambia le credenziali di accesso al db in config.php se neccessario.
4. Crea le tabelle:
- - users: ![image](https://github.com/user-attachments/assets/5439ff0d-fc8c-4e3e-b37e-56dc4114942f)
- - posts: ![image](https://github.com/user-attachments/assets/352d4e7f-f83e-44a1-bc31-ef2b38890cce)
- - votes: ![image](https://github.com/user-attachments/assets/56c78f68-8cac-47c6-ae6a-f77596e90d7a)
- - comments: ![image](https://github.com/user-attachments/assets/2ce279c6-5276-411f-baa4-4cf6307a484c)

### ~~Modo 2~~

~~Usa lo script di installazione in installer. Ricorda di eliminarlo dopo averlo creato.~~

Lo script al momento non è completo.

## Screenshots

![image](https://github.com/user-attachments/assets/67459c69-bd03-4ea7-ac19-9350ced3def5)
![image](https://github.com/user-attachments/assets/87ede5cf-908f-40b8-a65a-074d71affb40)

 
## Contribuisci

Se desideri contribuire al progetto, puoi contribuire così:

1. Forka la repo e clonala.
2. Crea un branch per la tua modifica:
   ```
   git checkout -b nuovo-branch
   ```
3. Fai le tue modifiche e fai un commit:
   ```
   git commit -m "Descrizione"
   ```
4. Pusha le modifiche sul tuo fork:
   ```
   git push origin nome-del-tuo-branch
   ```
5. Crea una pull request sulla repo originale.

## Ringraziamenti

- [ChartJS](https://www.chartjs.org) per i grafici.

## Licenza

Distribuito sotto la licenza GNU GPL v2.
