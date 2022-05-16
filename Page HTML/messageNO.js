function getMessages(){

    // Requête AJAX pour se connecter au serveur
    const requeteAjax = new XMLHttpRequest();
    requeteAjax.open("GET", "messageNO.php");

    // Afficher les données au format HTML
    requeteAjax.onload = function(){
        const resultat = JSON.parse(requeteAjax.responseText);

        // .reverse pour avoir les nouveaux messages en bas
        const html = resultat.reverse().map(function(message){
            return 
                <div class="message">
                    <span class="date">${message.created_at.substring(11, 16)}</span>
                    <span class="author">${message.author}</span>
                    <span class="content">${message.content}</span>
                </div>
        }).join("");

        const messages = document.querySelector(".messages");

        messages.innerHTML = html;
        messages.scrollTop = messages.scrollHeight; // Scrollbar reste en bas pour voir les nouveaux messages
    }
    requeteAjax.send()
}