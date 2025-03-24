function addStep() {
    const container = document.getElementById('steps-container');
    const stepDiv = document.createElement('div');
    stepDiv.classList.add('step-input');
    stepDiv.innerHTML = `
        <input type="text" name="steps[]" placeholder="Введите шаг" required>
        <button type="button" onclick="removeStep(this)">X</button>
    `;
    container.appendChild(stepDiv);
}

function removeStep(button) {
    button.parentElement.remove();
}
