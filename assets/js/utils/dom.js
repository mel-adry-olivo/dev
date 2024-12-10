// tak'an ko mag tulok sa laba nga line
export function element(selector) {
    const elements = document.querySelectorAll(selector);
    if (elements.length > 1) {
        return elements;
    } else if (elements.length === 1) {
        return elements[0];
    }
}

export function elements(selector) {
    return document.querySelectorAll(selector);
}

export function addClass(element, className) {
    element.classList.add(className);
}

export function removeClass(element, className) {
    element.classList.remove(className);
}

export function toggleClass(element, className, force = undefined) {
    if (force !== undefined) element.classList.toggle(className, force);
    else element.classList.toggle(className);
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
    toggleClass(form, 'show', true);
    toggleClass(overlay, 'show', true);
    toggleClass(document.body, 'no-scroll', true);

    overlay.addEventListener('click', (e) => {
        if (e.target === overlay && form.classList.contains('show')) {
            hideForm(form, overlay);
        }
    });
}

export function hideForm(form, overlay = element('.page-overlay')) {
    toggleClass(form, 'show', false);
    toggleClass(overlay, 'show', false);
    toggleClass(document.body, 'no-scroll', false);
}
