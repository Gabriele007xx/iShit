# iShit

![image](https://github.com/user-attachments/assets/67459c69-bd03-4ea7-ac19-9350ced3def5)

**iShit** è un social network innovativo e unico nel suo genere, dove gli utenti possono condividere una parte del loro quotidiano che di solito rimane nascosta: le feci! È una piattaforma divertente e bizzarra che permette di condividere e apprezzare le esperienze più... particolari.

## Funzionalità principali

- **Condivisione delle feci:** Ogni utente può scattare foto delle proprie feci e condividerle con la community. Le immagini possono essere caricate direttamente dal dispositivo e pubblicate nel feed. Si può impostare i suoi parametri come colore, forma, e se galleggia!
  
- **Reazioni:** Gli altri utenti possono esprimere il loro apprezzamento tramite mi piace. Puoi vedere cosa pensano gli altri utenti delle tue "creazioni"!

- **Profilo utente:** Ogni utente avrà un profilo dove poter raccogliere tutte le feci condivise.

## Come funziona

1. **Registrazione:** Crea un account inserendo il tuo nome utente, email e una password sicura.
2. **Carica il tuo primo post:** Scatta una foto delle tue feci, carica l'immagine e aggiungi un titolo o una descrizione. Scegli un hashtag che rappresenti la tua "opera d'arte".
3. **Condividi e interagisci:** Pubblica il tuo post e inizia a interagire con gli altri utenti commentando e reagendo ai loro contenuti.
4. **Esplora la community:** Scopri le creazioni degli altri utenti e partecipa alle discussioni nella sezione commenti.

## Requisiti

- Server con PHP 5+ e MySQL come database.

## Installazione

1. Carica i file su un server web.
2. Crea il database 'ishit'.
3. Cambia le credenziali di accesso al db in config.php se neccessario.
4. Crea le tabelle:
- - users: ![image](https://github.com/user-attachments/assets/5439ff0d-fc8c-4e3e-b37e-56dc4114942f)
- - posts: ![image](https://github.com/user-attachments/assets/806d5166-1073-4a83-b9f9-f7016ed905f4)
- - votes: ![image](https://github.com/user-attachments/assets/56c78f68-8cac-47c6-ae6a-f77596e90d7a)
 
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

## Licenza

Distribuito sotto la licenza GNU GPL v2.
