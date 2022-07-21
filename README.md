# FORM

## lOGIN

### Front

    - required sulla email
    - input type mail
    - min="4"
    - aggiungere *

    - required psw
    - input type psw
    - min="8"
    - aggiungere *

### Back

    - required|email
    - min="4"
    - old

    - required psw
    - min="8"
    - old

## REGISTER

### Front

    - required sulla email
    - input type mail
    - min="4"
    - aggiungere *

    - required psw
    - input type psw
    - min="8"
    - aggiungere *

    - required confirm psw
    - input type psw
    - aggiungere *

    - mettere controllo if nome\mail (sulla navbar) || cognome\mail (sulla navbar)
    - min="3" nome e cogn

    - data non obbligatoria

### Back

    - required|email
    - min="4"
    - old

    - required psw
    - min="8"
    - old

    - required confirm-psw
    - min="8"
    - old

    - min="3" entrambi
    - old

    - verifica che abbia 18 anni
    - old

## CREATE

### Front

    - required
    - min="3"
    - aggiungere *

    - img -> let uploadField = document.getElementById("file");
            uploadField.onchange = function() {
                if(this.files[0].size > 2097152){
                alert("File is too big!");
                this.value = "";
                };
            };

    - required address
    - errore se non clicchi l'indirizzo corretto sulla modale
    - aggiungere *

    - sq min="1"
    - rooms min="1"
    - beds/bathroms min="0"

    - creare controllo che richieda la selezione di almeno 1 servizio

### Back

    - required|email
    - min="4"
    - old

    - required psw
    - min="8"
    - old

    - required confirm-psw
    - min="8"
    - old

    - min="3" entrambi
    - old

    - verifica che abbia 18 anni
    - old

## EDIT

### Front

    - required
    - min="3"
    - aggiungere *

    - img -> let uploadField = document.getElementById("file");
            uploadField.onchange = function() {
                if(this.files[0].size > 2097152){
                alert("File is too big!");
                this.value = "";
                };
            };

    - required address
    - errore se non clicchi l'indirizzo corretto sulla modale
    - aggiungere *

    - sq min="1"
    - rooms min="1"
    - beds/bathroms min="0"

    - creare controllo che richieda la selezione di almeno 1 servizio

### Back

    - required|email
    - min="4"
    - old

    - required psw
    - min="8"
    - old

    - required confirm-psw
    - min="8"
    - old

    - min="3" entrambi
    - old

    - verifica che abbia 18 anni
    - old

## RECUPERO DELLA PSW
