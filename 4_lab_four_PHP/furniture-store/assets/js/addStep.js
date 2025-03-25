document.addEventListener("DOMContentLoaded", function () {
    const stepsContainer = document.getElementById("steps-container");
    const addStepButton = document.getElementById("add-step");

    addStepButton.addEventListener("click", function () {
        const stepDiv = document.createElement("div");
        stepDiv.classList.add("step", "flex", "gap-2", "mb-2");

        const input = document.createElement("input");
        input.type = "text";
        input.name = "steps[]";
        input.classList.add("shadow", "appearance-none", "border", "rounded", "w-full", "py-2", "px-3", "text-gray-700", "leading-tight", "focus:outline-none", "focus:shadow-outline");
        input.placeholder = "Enter step";

        const removeButton = document.createElement("button");
        removeButton.type = "button";
        removeButton.classList.add("remove-step", "bg-red-500", "text-white", "px-2", "rounded");
        removeButton.innerText = "✖";

        removeButton.addEventListener("click", function () {
            stepDiv.remove();
        });

        stepDiv.appendChild(input);
        stepDiv.appendChild(removeButton);
        stepsContainer.appendChild(stepDiv);
    });
});