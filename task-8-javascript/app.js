function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

document.getElementById("splitButton").addEventListener("click", function() {
    const number = parseInt(document.getElementById("numberInput").value);
    const splits = parseInt(document.getElementById("splitInput").value);
    const container = document.getElementById("container");
    container.innerHTML = ""; 

    const splitValues = [];
    let remaining = number;

    for (let i = 0; i < splits - 1; i++) {
        const split = Math.floor(remaining / (splits - i));
        splitValues.push(split);
        remaining -= split;
    }
    
    splitValues.push(remaining);
    splitValues.reverse();

    for (let i = 0; i < splits; i++) {
        const div = document.createElement("div");
        div.classList.add("split-div");
        div.style.width = `${splitValues[i] * 20}px`;
        //div.style.backgroundColor = "blue";
        div.style.backgroundColor = getRandomColor();
        div.innerText = splitValues[i].toString();
        container.appendChild(div);
    }
});
