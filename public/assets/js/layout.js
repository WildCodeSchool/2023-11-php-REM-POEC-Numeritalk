function theme(element) {
    sun = document.getElementById("sun");
    moon = document.getElementById("moon");
    body = document.getElementsByTagName("body")[0];
    div_group_button_theme = document.getElementById("div_group_button_theme");
    button_theme = document.getElementById("button_theme");
    if (element.classList.contains("button_dark_mode")) {
        element.classList.remove("button_dark_mode");
        sun.classList.remove("hide");
        moon.classList.add("hide");
        div_group_button_theme.style.backgroundColor = "#F4CA25";
        button_theme.style.backgroundColor = "#FBEDB6";
        body.style.backgroundColor = "white";
    } else {
        element.classList.add("button_dark_mode");
        sun.classList.add("hide");
        moon.classList.remove("hide");
        div_group_button_theme.style.backgroundColor = "#2101A2";
        button_theme.style.backgroundColor = "#9680EC";
        body.style.backgroundColor = "#282727";
    }
}

function typeButtonClicked(element){
    var form = document.getElementById('formRadio');
    var selection_categories = document.getElementById("selection_categories");
    var bouton_categories = document.getElementById("bloc_bouton_categories");
    var form_categories = document.getElementById("form_categories");

    var titre_categories = document.getElementById("titre_categories");
    var bloc_selection_categories = document.getElementById("bloc_selection_categories");
    var name_category = document.getElementById("name_category");

    switch(element.id){
        case "addLink":
            form.action = 'category/add';
            selection_categories.setAttribute("style", "display : none");
            bouton_categories.setAttribute("style", "display : none");
            form_categories.setAttribute("style", "display : flex");
            titre_categories.innerText = "Ajouter une catégorie";
            name_category.setAttribute("style", "display : flex");
        break;
        case "updateLink":
            form.action = 'category/edit'; // Change l'attribut action du formulaire
            selection_categories.setAttribute("style", "display : none");
            bouton_categories.setAttribute("style", "display : none");
            form_categories.setAttribute("style", "display : flex");
            titre_categories.innerText = "Editer une catégorie";
            bloc_selection_categories.setAttribute("style", "display : flex");
            name_category.setAttribute("style", "display : flex");
        break;
        case "deleteLink":
            form.action = 'category/delete'; // Change l'attribut action du formulaire
            selection_categories.setAttribute("style", "display : none");
            bouton_categories.setAttribute("style", "display : none");
            form_categories.setAttribute("style", "display : flex");
            titre_categories.innerText = "Supprimer une catégorie";
            bloc_selection_categories.setAttribute("style", "display : flex");
        break;
        default:
            form.action = '';
            selection_categories.setAttribute("style", "display : flex");
            bouton_categories.setAttribute("style", "display : flex");
            form_categories.setAttribute("style", "display : none");
            titre_categories.innerText = "";
            bloc_selection_categories.setAttribute("style", "display : none");
            name_category.setAttribute("style", "display : none");
        break;
    }
}

function display(param) {
    var element = document.getElementById(param);
    var sujet_form = document.getElementById("sujet_form");
    var table_sujets = document.getElementById("table_sujets");
    var add_sujet = document.getElementById("add_sujet");
    if (element.style.display === "flex") {
        element.style.display = "none";
        sujet_form.style.display = "none";
        table_sujets.style.display = "block";
        add_sujet.innerText = "Créer un sujet"
    } else {
        element.style.display = "flex";
        sujet_form.style.display = "flex";
        table_sujets.style.display = "none";
        add_sujet.innerText = "Retour aux sujets"
    }
}

function displayForm() {
    var element = document.getElementById("form_message");
    var add_message = document.getElementById("add_message");
    if (element.style.display === "flex") {
        element.style.display = "none";
        add_message.innerText = "Poster un message";
    } else {
        element.style.display = "flex";
        add_message.innerText = "Annuler";
    }
}

function openEditForm(messageId, messageContent) {
    document.getElementById('editMessageId').value = messageId;
    document.getElementById('editMessageContent').value = messageContent;
    document.getElementById('editForm').style.display = 'block';
}

function closeEditForm() {
    document.getElementById('editForm').style.display = 'none';
}