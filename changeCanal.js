function changeCanal(channel) {
    fetch('changecanal.php?channel=' + channel);
    location.reload();
}

async function subscribe(sub){
    const result = await fetch('makeSubsciption.php?sub=' +sub);
    const text = await result.text();
    if (text.startsWith("Vous vous êtes")){
        alert(text);
    }
    else {
        alert("Vous êtes déjà abonnés à ce canal")
    }
    location.reload;
}

function init(){
    const channels = document.getElementsByClassName("channel");
    for(let elem of channels){
        elem.addEventListener("click",function (event) {
            console.log(elem.getAttribute("channel"));
            changeCanal(elem.getAttribute("channel"));
        })
    }
}