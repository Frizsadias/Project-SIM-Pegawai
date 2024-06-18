function checkNetwork() {
    if (navigator.onLine) {
        checkConnectionQuality();
    } else {
        if (sessionStorage.getItem('networkStatus') !== 'offline') {
            toastr.error('Anda sedang offline, periksa kembali jaringan anda!', 'Error');
            sessionStorage.setItem('networkStatus', 'offline');
        }
    }
}

function checkConnectionQuality() {
    let connection = navigator.connection || navigator.mozConnection || navigator.webkitConnection;

    if (connection) {
        let effectiveType = connection.effectiveType;
        let rtt = connection.rtt;
        let downlink = connection.downlink;

        if (effectiveType === '4g' && rtt < 150 && downlink > 2) {
            if (sessionStorage.getItem('networkStatus') !== 'online') {
                toastr.success('Anda kembali online!', 'Success');
                sessionStorage.setItem('networkStatus', 'online');
            }
        } else {
            if (sessionStorage.getItem('networkStatus') !== 'poor') {
                toastr.error('Jaringan anda sedang buruk, periksa kembali jaringan anda!', 'Error');
                sessionStorage.setItem('networkStatus', 'poor');
            }
        }
    } else {
        if (sessionStorage.getItem('networkStatus') !== 'online') {
            toastr.success('Anda kembali online!', 'Success');
            sessionStorage.setItem('networkStatus', 'online');
        }
    }
}

window.addEventListener('online', checkNetwork);
window.addEventListener('offline', checkNetwork);

document.addEventListener('DOMContentLoaded', (event) => {
    checkNetwork();
});