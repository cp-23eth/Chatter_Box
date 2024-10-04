function changeCanal(channel) {
    fetch('changecanal.php?channel=' + channel);
    location.reload();
}

async function subscribe(sub){
    const result = await fetch('makeSubsciption.php?sub=' +sub);
    const text = await result.text();
    window.location.reload(true);
    // alert(text);
}

async function unSubscribe(sub){
    const result = await fetch('makeUnsubsciption.php?sub=' +sub);
    const text = await result.text();
    window.location.reload(true);
    // alert(text);
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