// tak'an ko mag tulok sa laba nga line
export function element(selector) {
    const elements = document.querySelectorAll(selector);
    if (elements.length > 1) {
        return elements;
    } else if (elements.length === 1) {
        return elements[0];
    }
}

export function setSelectedOption(select, value) {
    const options = Array.from(select.options);
    options.forEach((option) => {
        const optionText = option.textContent.toLowerCase();
        if (optionText === value.toLowerCase()) {
            select.selectedIndex = options.indexOf(option);
        }
    });
}

export function showForm(form, overlay = element('.page-overlay')) {
    form.classList.add('show');
    overlay.classList.add('show');
    document.body.classList.add('no-scroll');
}

export function hideForm(form, overlay = element('.page-overlay')) {
    form.classList.remove('show');
    overlay.classList.remove('show');
    document.body.classList.remove('no-scroll');
}
