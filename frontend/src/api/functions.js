export function formatDateTime(date) {
    let hours = date.getHours().toString().padStart(2, '0');
    let minutes = date.getMinutes().toString().padStart(2, '0');
    let seconds = date.getSeconds().toString().padStart(2, '0');
    let day = date.getDate().toString().padStart(2, '0');
    let month = (date.getMonth() + 1).toString().padStart(2, '0'); // Tháng trong JavaScript bắt đầu từ 0
    let year = date.getFullYear();
    return `${hours}:${minutes}:${seconds} ${day}:${month}:${year}`;
}

export function formatPrice(price) {
    if (price == null) return;
    return price.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

export function getCookie(cookieName) {
    const name = cookieName + "=";
    const decodedCookie = decodeURIComponent(document.cookie);
    const cookieArray = decodedCookie.split(';');

    for (let i = 0; i < cookieArray.length; i++) {
        let cookie = cookieArray[i];
        while (cookie.charAt(0) === ' ') {
            cookie = cookie.substring(1);
        }
        if (cookie.indexOf(name) === 0) {
            return cookie.substring(name.length, cookie.length);
        }
    }
    return "";
}

export function checkLogin() {
    const token = getCookie("token");
    if (token === "") {
        window.location.href = "/staff/login";
    }
}