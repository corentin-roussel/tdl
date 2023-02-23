let inputTache = document.querySelector("#submit-input")
let todo = document.querySelector("#todo")
let done = document.querySelector("#done")

inputTache.addEventListener("click", (e) => {
    e.preventDefault()
    let formTache = document.querySelector("#form-tache")
    let formDataTache = new FormData(formTache)
    fetch('todolist.php', {
        body: formDataTache,
        method: "POST"
    })
        .then(response => {
            return response
        })
})

inputTache.addEventListener("click", (e) => {
    e.preventDefault()
    fetch('todolist.php?task=all')
        .then(response => {
            return response.json()
        })
        .then(taches => {
            todo.innerHTML = ""
            for (const tache of taches) {
                let place_todo = document.createElement("div")
                place_todo.setAttribute("class", "place_todo")
                todo.appendChild(place_todo)
                place_todo.textContent = '-' + tache.tache + ' créée le ' + tache.date_creation
                let check = document.createElement("button")
                check.setAttribute("class", "check_id")
                check.textContent = "✔"
                place_todo.append(check)
            }
        })
})



window.addEventListener("load", () => {
    fetch('todolist.php?task=all')
        .then(response => {
            return response.json()
        })
        .then(taches => {
            todo.innerHTML = ""
            for (const tache of taches) {
                console.log(tache)
                let place_todo = document.createElement("div")
                place_todo.setAttribute("class", "place_todo")
                todo.appendChild(place_todo)
                place_todo.textContent = '-' + tache.tache + ' créée le ' + tache.date_creation
                let check = document.createElement("button")
                check.setAttribute("class", "check_id")
                check.setAttribute('id', tache.id)
                check.textContent = "✔"
                place_todo.append(check)
                check.addEventListener("click", (e) => {
                    //e.preventDefault()
                    let payload = new FormData();
                    payload.append("id_task", tache.id)
                    fetch('todolist.php?update=ok', {
                        method: "POST",
                        body: payload
                    })
                        .then(response => {
                            return response
                        })

                    fetch('todolist.php?task=all')
                        .then(response => {
                            return response.json()
                        })
                        .then(todo => {
                            todo.innerHTML = ""
                            for (const todos of todo) {
                                console.log(todos)
                                let place_todo = document.createElement("div")
                                place_todo.setAttribute("class", "place_todo")
                                todo.appendChild(place_todo)
                                place_todo.textContent = '-' + todos.tache + ' créée le ' + todos.date_creation
                                let check = document.createElement("button")
                                check.setAttribute("class", "check_id")
                                check.setAttribute('id', todos.id)
                                check.textContent = "✔"
                                place_todo.append(check)
                            }
                        })

                    fetch('todolist.php?done=all', {
                        method: "POST"
                    })
                        .then(response => {
                            return response.json()
                        })
                        .then(display => {
                            done.innerHTML = ""
                            for (const displays of display) {
                                console.log(displays)
                                let place_done = document.createElement("div")
                                place_done.setAttribute("class", "place_done")
                                done.appendChild(place_done)
                                place_done.textContent = '-' + displays.tache + ' créée le ' + displays.date_modification
                                let deletes = document.createElement("button")
                                deletes.setAttribute("class", "check_id")
                                deletes.setAttribute("id", displays.id)
                                deletes.textContent = "🗑"
                                place_done.append(check)
                            }
                        })
                })
            }
        })
})
window.addEventListener("load", (e) => {
    e.preventDefault()
    fetch('todolist.php?done=all')
        .then(response => {
            return response.json()
        })
        .then(display => {
            done.innerHTML = ""
            for (const displays of display) {
                let place_done = document.createElement("div")
                place_done.setAttribute("class", "place_todo")
                done.appendChild(place_done)
                place_done.textContent = '-' + displays.tache + ' créée le ' + displays.date_modification
                let deletes = document.createElement("button")
                deletes.setAttribute("class", "check_id")
                deletes.setAttribute("id", displays.id)
                deletes.textContent = "🗑"
                place_done.append(deletes)
            }
        })
})





// inputTache.addEventListener("click", (e) => {
//     e.preventDefault()
//     fetch('todolist.php?done=all')
//         .then(response => {
//             return response.json()
//         })
//         .then(taches => {
//             done.innerHTML = ""
//             for (const tache of taches) {
//                 let place_todo = document.createElement("div")
//                 place_todo.setAttribute("id", "place_todo")
//                 done.appendChild(place_todo)
//                 place_todo.textContent = '-' + tache.tache + ' créée le ' + tache.date_modification
//                 let check = document.createElement("button")
//                 check.setAttribute("class", "check_id")
//                 check.textContent = "🗑"
//                 place_todo.append(check)
//             }
//         })
// })

