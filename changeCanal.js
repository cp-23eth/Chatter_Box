function changeCanal(channel) {
    fetch('changecanal.php?channel=' + channel);
    location.reload();
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