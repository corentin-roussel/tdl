let main = document.querySelector("main")


let div = document.createElement("div");
div.setAttribute("id", "place");
main.appendChild(div);

let inscription = document.querySelector("#inscription");
let connexion = document.querySelector("#connexion");
let deconnexion = document.querySelector("#deconnexion")
let place = document.querySelector("#place");

// deconnexion.setAttribute("onclick", "window.location.href='deconnexion.php'")


inscription.addEventListener("click", () => {
    fetch('inscription.php')
        .then( response => {
            return response.text()
        })
        .then( form => {

            place.innerHTML = form
            let inscriptionForm = document.querySelector("#register-form")
            let registerInscription = document.querySelector("#submitReg")
            registerInscription.addEventListener("click", (e) => {
                e.preventDefault();
                let registerData = new FormData(inscriptionForm);
                fetch('inscription.php', {
                    body: registerData,
                    method: "POST"
                })
                    .then(response => {
                        return response;
                    })
            })
        })
})

connexion.addEventListener('click', () => {
    fetch('connexion.php')
        .then(response => {
            return response.text()
        })
        .then( form => {
            place.innerHTML = form;
            let connexionForm = document.querySelector("#connexion-form")
            let connexionSubmit = document.querySelector("#submitCon")

            connexionSubmit.addEventListener("click", (e) => {
                e.preventDefault()
                let connexionData = new FormData(connexionForm)
                fetch("connexion.php", {
                    body:connexionData,
                    method: "POST"
                })
                .then(response => {
                    return response;
                })
            })
        })
})

deconnexion.addEventListener("click", () => {

    window.location.href='deconnexion.php'
})