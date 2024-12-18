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

export function elementIn(element, selector) {
    return element.querySelector(selector);
}

export function elementsIn(element, selector) {
    return element.querySelectorAll(selector);
}

export function parentElement(child, selector) {
    return child.parentElement.querySelector(selector);
}

export function parentElements(child, selector) {
    return child.parentElement.querySelectorAll(selector);
}

export function addClass(e, c) {
    if (!e.classList.contains(c)) {
        e.classList.add(c);
    }
}

export function removeClass(e, c) {
    e.classList.remove(c);
}

export function toggleClass(e, c, force = undefined) {
    if (force !== undefined) e.classList.toggle(c, force);
    else e.classList.toggle(c);
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
