function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}

document.getElementById("splitButton").addEventListener("click", function() {
    const numberInput = Number(document.getElementById("numberInput").value);
    const splitsInput = Number(document.getElementById("splitInput").value);
    const container = document.getElementById("container");
    container.innerHTML = ""; 
    
    const number = numberInput;
    const splits = splitsInput;
    
    if(splits > number){
        alert(`${number} cannot be divided into ${splits} integers.`);
        return;
    }

    if ( number < 1 || splits < 1 || number % 1 !== 0 || splits % 1 !== 0) {
        alert(`Please enter only postive integer numbers.`);
        return; // Exit the function if inputs are invalid
    }

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
