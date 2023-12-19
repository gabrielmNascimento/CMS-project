export const useToast = () => {
    const setToast = (alerts, message, time = 4000, autohide = true) => {
        return $(document).Toasts('create', {
            title: alerts.title,
            class: `bg-${alerts.status}`,
            autohide: autohide,
            delay: time,
            body: message,
            icon: `fas fa-${alerts.icon} fa-lg`,
        })
    }

    return { setToast }
}
