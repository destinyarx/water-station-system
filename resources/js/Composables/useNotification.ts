export function showSuccessMesage(toast: any, title, message) {
    toast.add({
        severity: 'custom',
        summary: title,
        detail: message,
        group: 'headless',
        life: 3000
    });
}