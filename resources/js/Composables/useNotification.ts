export function alert(toast: any, type: string, title: string, message: string) {
    toast.add({
        severity: 'custom',
        type: type,
        summary: title,
        detail: message,
        group: 'headless',
        life: 3000
    });
}
