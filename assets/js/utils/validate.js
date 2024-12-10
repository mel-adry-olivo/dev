import { showSnackbar } from '../components/snackbar.js';

export function fileInput(f) {
    if (f.files.length === 0) {
        showSnackbar(f.placeholder);
        return false;
    }
    return true;
}

export function numberInput(n) {
    if (n.value > 0) {
        return true;
    } else {
        showSnackbar(n.placeholder);
        return false;
    }
}

export function numberInputs(inputs) {
    for (const input of inputs) {
        if (!numberInput(input)) return false;
    }
    return true;
}

export function textInput(s) {
    if (s.value.trim() !== '') {
        return true;
    } else {
        showSnackbar(s.placeholder);
        return false;
    }
}

// for product add/edit
export function conditionalInputs(inputs) {
    for (const { select, input } of inputs) {
        if (select.value === 'new' && !textInput(input)) return false;
    }
    return true;
}
